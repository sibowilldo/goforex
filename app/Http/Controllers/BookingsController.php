<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use App\Invoice;
use App\Item;
use App\Transaction;
use App\User;
use App\Http\Requests\AttendeeFormRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\NotificationTraits;
use App\Notification;
use Storage;
use Carbon\Carbon;

class BookingsController extends Controller
{
    // User Traits
    use NotificationTraits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['profile'], ['except' => [
                                                    'sagepay_accepted', 
                                                    'sagepay_declined', 
                                                    'sagepay_redirect', 
                                                    'sagepay_notify']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->hasRole('admin')){
            $bookings = Booking::orderBy('created_at', 'desc')->paginate(15);
        }else{

            $bookings = Auth::user()->orderBy('created_at')->booking()->paginate(15);
        }


       return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Creates a new booking for logged in user using the event id
     *
     * @return \Illuminate\Http\Response
     */
    public function createEventBooking($eventId)
    {
        //
        $event = Event::where('id', $eventId)->first();
        $bookings = Booking::where('event_id', $event->id)->select('id', 'event_id', 'user_id', 'status_is', 'created_at', 'updated_at')->get();

        if($bookings->where('user_id', Auth::id())->count() > 0){
            flash('You\'ve already booked a seat for this event!', 'info');
            return back();
        }
        if ($bookings->count() == $event->number_of_seats && $event->status_is == "FullyBooked"){
            flash("Sorry this event is fully booked.","error");
            return redirect('/home');
        }

        $booking = Booking::create(['user_id'=>Auth::user()->id,
                        'event_id'=>$eventId,
                        'reference'=>'BO'.str_random(9),
                        'status_is'=>'Pending']);

        $email = Auth::user()->email;
        $name = Auth::user()->username;

        $parameters = array(
            'username' => Auth::user()->username,
            'callout_button' => 'View Booking',
            'callout_url' => url('/view-event/'.$eventId),
            'event' => $event,
            'booking_ref' => $booking->reference,
            'booking_date_time' => $booking->created_at,
            'user' => Auth::user()
        );


        if(Auth::user()->subscription){
            // Send email to show booking has been created
            Mail::send('emails.booking_created', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex - Your booking was created successfully!');
            });
        }

        if(!Auth::user()->hasRole('admin')){
            $parameters = [ 'username' => 'Admin',
                            'user' => Auth::user(), 
                            'bookings' => $bookings,
                            'booking' => $booking,
                            'event' => $event,
                            'callout_button' => 'Login to Dashboard',
                            'callout_url' => url('/login')];

            Mail::send('emails.booking_created_notify_admin', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex - A user has created a new Booking.');
            });
        }

        $message = '<p>You have created a booking of <b>Ref# '.$booking->reference.'</b></p>
                    <p>Please make a payment to below details, and update your online booking by uploading proof of payment:</p>
                    <br/>
                    <p><i>Banking Details :</i><br>
                        Bank : <b>' . $booking->event->bank_account->bank.'</b><br>
                        Acc Holder : <b> ' . $booking->event->bank_account->account_holder.'</b><br>
                        Acc Number : <b> ' . $booking->event->bank_account->account_number.'</b><br>
                        Branch Code : <b> ' . $booking->event->bank_account->branch.' </b></p><br>
                        Reference : <b> ' . $booking->reference.' </b></p>
                    <p><b>Booking Date/Time : '. $booking->created_at .'</b></p>';

        $this->saveNotification($message,'notification',Auth::user(), 'Booking Created');
        flash("You have successfully created a booking, please make payment to complete your reservations.", "success");

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        // Delete Booking
        $booking->delete();
        flash('Booking has been deleted!', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $bookingId)
    {
        //
        $booking = Booking::where('id', $bookingId)->first();

        if ($booking){
            $booking->update(['status_is'=>'Paid']);

            $event = Event::where('id', $booking->event_id)->first();

            $attendees = explode(',', $event->attendees);



            $bookings = Booking::whereIn('user_id', $attendees)->where('event_id', $event->id)->get();

            // Add Paid Invoice
            $this->addInvoice($booking);

            flash("Booking approved successfully.", "success");

            $user = User::where('id', $booking->user_id)->first();

            $email = $user->email;
            $name = $user->username;

            $parameters = array(
                'username' => $user->username,
                'callout_button' => 'View Event',
                'callout_url' => url('/view-event/'.$event->id),
                'event_name' => $event->name,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'start_time' => $event->start_time,
                'address' => $event->address,
                'host' => $event->host,
                'booking_ref'=> $booking->reference,
                'user' => $user,
            );
            // TODO add queue

            if($user->subscription){
                    
                // Send email to confirm successful registration
                Mail::send('emails.booking_confirmed', $parameters, function ($message)
                use ($email, $name) {
                    $message->from('noreply@goforex.co.za');
                    $message->to($email, $name)->subject('GoForex - Booking Confirmed!');
                });

            }
            $message = '<h5><strong>Hey there!</strong></h5> <br><p>Congratulations, your booking for '. $event->name .' on '. $event->start_date .' @ '. $event->start_time .' has been approved.</p><br>
                        <p>Please be there at least 30min  before the specified start time.</p>';
            $this->saveNotification($message,'notification',$user, 'Booking Approved');

                return back();


        } else {
            flash("The booking you are searching for doesn't exist.", "error");
        }
    }

    /**
     * Add Paid Invoice.
     */
    public function addInvoice($booking)
    {
        // Create 'Pending' Invoice
        $invoice = Invoice::create([
            'user_id'=>$booking->user->id,
            'amount'=>$booking->event->item->price,
            'discount' => 0,
            'notes' => '',
            'status_is'=>'Paid',
        ]);

        $items = Item::where('id',$booking->event->item->id)->get();
        foreach ($items as $item) {
            $invoice->items()->attach($item->id, ['quantity' => 1, 'price' => $item->price]);
        }
    }

    /**
     * Booking declined.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function decline($bookingId)
    {
        //
        $booking = Booking::where('id', $bookingId)->first();

        if ($booking){
            $user = User::where('id', $booking->user_id)->first();
            $booking_ref = $booking->reference;

            $event = Event::where('id', $booking->event_id)->first();

            $attendees = explode(',', $event->attendees);

            if (($key = array_search($user->id, $attendees)) !== false) {
                unset($attendees[$key]);
            }

            $event->update(['attendees'=>implode(',', $attendees),]);

            $booking->delete();

            $email = $user->email;
            $name = $user->username;

            $parameters = array(
                'username' => $user->username,
                'booking_ref'=> $booking_ref,
                'callout_button' => 'Sign In',
                'callout_url' => url('login'),
                'user' => $user
            );
            // TODO add queue

            if($user->subscription){
                    
                // Send email to confirm successful registration
                Mail::send('emails.booking_declined', $parameters, function ($message)
                use ($email, $name) {
                    $message->from('noreply@goforex.co.za');
                    $message->to($email, $name)->subject('GoForex - Your booking is declined!');
                });
                
            }
            $message = '<h5><strong>Greetings '. $user->firstname .'!</strong></h5><p> It is in our deepest regrets to inform you that your booking for '. $event->name .' on '. $event->start_date .' @ '. $event->start_time .' has been declined. <br>This could be because your proof of payment could not be verified, please contact us for more info.</p> <br>
                            <p>If you are still interested in this event please create another booking if seats are still available.</p>';
            $this->saveNotification($message,'notification',$user, 'Booking Declined');

            $bookings = Booking::whereIn('user_id', $attendees)->where('event_id', $event->id)->get();

            flash("Booking declined, and " . $user->firstname . " has been notified!", "success");
            return back();

        }else {
            flash("Failed to decline booking.", "error");
            return back();
        }
    }

    /**
    *
    *
    *
    *
    *
    *
    */
    public function add_attendees(Event $event)
    {
        
        $event = $event;
        $events = Event::where('status_is', 'Open')->pluck('name', 'id');
        $bookings = Booking::where('event_id', $event->id)->select('id', 'user_id', 'event_id', 'status_is', 'created_at', 'updated_at')->get();
        $attendees = User::where(['status_is' => 'Active', 'verified' => 1])->orderBy('email', 'asc')->pluck('email', 'id');
        if($event->number_of_seats == $bookings->where('status_is', 'Paid')->count() || $event->status == "FullyBooked"){
            flash('The event is now fully booked!', 'info');
            return redirect('/home');
        }
        return view('bookings.create', compact('event', 'events', 'bookings', 'attendees'));
    }

    /**
    *
    *
    *
    *
    *
    *
    */
    public function save_attendees(AttendeeFormRequest $request, Event $event)
    {

        $password = str_random(8);
        $username = $request['email'];
        
        // Generate new reference number
        $ref = rand(1000000, 9999999);
        $results = User::where('reference', $ref)->count();

        // Loop and regenerate $ref while $results is more than 0
        while ($results > 0) {
            $ref = rand(100000, 999999);
            $results = User::where('reference', $ref)->count();
        }

        $user = User::firstOrCreate([
            'reference' => $ref,
            'verified' => 0, // Not yet verified
            'code' => str_random(6),
            'username' => $username,
            'cell' => $request['cell'],
            'email' => $request['email'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'password' => bcrypt($password),
            'status_is' => User::$statuses['Active'],
            'location' => $request['location'],
            'sponsor' => '',
        ]);

        // Assign Role to User 'member'
        $user->actAs('member');

        $email = $user->email;
        $name = $user->username;

        $parameters = array(
            'username' => $user->username,
            'callout_button' => 'Sign In',
            'callout_url' => url('login'),
            'password' => $password,
            'user' => $user,
        );

        // Send email to confirm successful registration
        Mail::send('emails.attendee_account_created', $parameters, function ($message)
        use ($email, $name) {
            $message->from('noreply@goforex.co.za');
            $message->to($email, $name)->subject('Welcome To GoForex!');
        });

        //Add Booking
        $request['user'] = $user->id;
        $this->add_attendees_booking($request, $event);

        flash('Booking for ' . $user->firstname . ' ' . $user->lastname . ' was created successfully!', 'success');
        return back();
    }

    //Add Booking method, use both in this class and via routes
    public function add_attendees_booking(Request $request, Event $event)
    {
        $user = User::findOrFail($request['user']);
        $bookings = Booking::where('event_id', $event->id)->select('id', 'event_id', 'user_id', 'status_is', 'created_at', 'updated_at')->get();
        
        if($bookings->where('user_id', $user->id)->count() > 0){
            flash('A user with an identical email address is already booked a seat for this event!', 'info');
            return back();
        }
        $booking = Booking::create(['user_id'=> $user->id,
                        'event_id'=>$event->id,
                        'reference'=>'BO'.str_random(9),
                        'status_is'=>'Pending']);

        $email = $user->email;
        $name = $user->username;
        
        $parameters = array(
            'username' => $user->username,
            'callout_button' => 'Sign In',
            'callout_url' => url('login'),
            'user' => $user,
            'booking' => $booking,
            'event' => $event,
        );

        // Send email to confirm successful booking
        Mail::send('emails.attendee_booking_created', $parameters, function ($message)
        use ($email, $name) {
            $message->from('noreply@goforex.co.za');
            $message->to($email, $name)->subject('Booking created on your behalf!');
        });
        
        if($bookings->count() >= $event->number_of_seats AND $booking->where('status_is', 'Pending')->count() > 0 ){
            flash('Booking created but ... Caution! This event is fully booked, with pending bookings.', 'info');
            return back();
        }elseif($bookings->count() >= $event->number_of_seats AND $booking->where('status_is', 'Pending')->count() == 0 ){
            flash('Event is fully booked, no further bookings allowed.', 'warning');
            return redirect('/home');
        }

        flash('Booking for ' . $user->firstname . ' ' . $user->lastname . ' was created successfully!', 'success');
        return redirect('/attendees/' . $event->id . '/add');

    }
    /**
     * Sagepay payment accepted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sagepay_accepted(Request $request)
    {
        $transaction = Transaction::updateOrCreate(['reference' => $request['reference']], $request->all());
        $transaction->update(['reason' => null]);
        $booking = Booking::where('id', $transaction->extra2)->update(['status_is' => 'Paid']);

        return response()->json(['status' => 'OK']);
    }

    /**
     * Sagepay payment notify.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sagepay_notify(Request $request)
    {
        $transaction = Transaction::updateOrCreate(['reference' => $request['reference']], $request->all());
        $booking = Booking::where('id', $transaction->extra2)->update(['status_is' => 'Waiting']);

        return response()->json(['status' => 'OK']);
    }

    /**
     * Sagepay payment declined.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sagepay_declined(Request $request)
    {
        $transaction = Transaction::updateOrCreate(['reference' => $request['reference']], $request->all());
        $booking = Booking::where('id', $transaction->extra2)->first();

        $user = User::where('id', $transaction->extra1)->first();
        $event = Event::where('id', $transaction->extra3)->first();

        $attendees = explode(',', $event->attendees);

        if (($key = array_search($user->id, $attendees)) !== false) {
            unset($attendees[$key]);
        }

        $event->update(['attendees'=>implode(',', $attendees),]);

        $email = $user->email;
        $name = $user->username;

        $parameters = array(
            'username' => $user->username,
            'user' => $user,
            'event'=> $event,
            'transaction' => $transaction,
            'callout_button' => 'Sign In',
            'callout_url' => url('login'),
        );
        // TODO add queue

        if($user->subscription){
                
            // Send email to confirm successful registration
            Mail::send('emails.payment_declined', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex - Payment Declined by Service Provider!');
            });
            
        }
        $message = '<h5><strong>Greetings '. $user->firstname .'!</strong></h5><p> We\'ve received a response from our service provider SagePay PayNow that your payment request for '. $event->name .', amount of R'. $event->item->price .' was declined.
                        <p>Please click -> <a href="https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace='. $transaction->requestTrace .'">here</a> <- or copy and paste the link below to your browser to find out why.</p><br>
                        <strong>Request Trace link:</strong><br>
                        <a href="https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace='. $transaction->requestTrace .'">https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace='. $transaction->requestTrace .'</a>
                        ';
        $this->saveNotification($message,'notification',$user, 'Payment declined by Service Provider');


        $transaction->delete();
        $booking->delete();
        return response()->json(['status' => 'OK']);
    }

    /**
     * Sagepay payment redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sagepay_redirect(Request $request)
    {
        $transaction = Transaction::updateOrCreate(['reference' => $request['reference']], $request->all());
        $booking = Booking::where('id', $transaction->extra2)->update(['status_is' => 'Waiting']);

        return response()->json(['status' => 'OK']);
    }

    /**
     * Uploads attachments
     *
     * @param Request $request
     *
     */
    public function upload(Request $request, Booking $booking)
    {

//        if(Gate::denies('owner-or-admin', $booking->user->id)) {
//            flash('Unauthorized access attempt!', 'error');
//            return redirect('/dashboard');
//        }

        if($request['file'] == null){
            flash('Please select a file!', 'warning');
            return back();
        }
        $extension = $request->file->extension();
        $filename = Carbon::now()->timestamp.'.'.$extension;
        $path = 'bookings/'.$booking->event->id.'/'.$booking->user->id;

        $resource = $request->file('file')->storeAs($path, $filename, 'local');

        if($booking->payment_attachment != null){
            Storage::disk('local')->delete($path.'/'.$booking->payment_attachment);
        }
        $booking->update(['payment_attachment' => $path.'/'. $filename]);

        //Notify Booking Owner via Email & Notification
//        SendAttachmentUploadedEmail::dispatch($booking->user, $booking);
//        $booking->user->notify(new NotifyAttachmentUploaded($booking));
//
//        //Get Administrators
//        $administrators = User::whereHas('role', function ($query) { $query->where('name', '=', 'admin'); })->get();
//
//        //Notify info mail
//        SendAttachmentUploadedAdminEmail::dispatch($booking);

        return back();
    }

}
