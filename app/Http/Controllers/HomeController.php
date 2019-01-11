<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\VerifyFormRequest;
use App\Http\Requests\ContactFormRequest;
use Auth;
use App\Event;
use App\User;
use Illuminate\Support\Facades\Cache;
use Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use App\Http\Traits\NotificationTraits;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Notification;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
        $this->middleware(['auth','profile'], ['except'=>'contact_us']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->verified==0){
            return view('auth.verification');
        }
        return view('home')->with('events', Event::where('status_is', 'Open')->orderBy('created_at','desc')->paginate(12));
    }

    /**
     * Process verification code submitted.
     *
     * @return \Illuminate\Http\Response
     */
    public function verification(VerifyFormRequest $request)
    {
        $code = $request['verification'];

        // Get user info from Session
        $user = Auth::user();

        if ($code == $user->code) {
            $user = User::findOrFail($user->id);
            $user->verified = 1;
            $user->update(['verified']);

            $email = $user->email;
            $name = $user->username;

            $parameters = array(
                'username' => $user->username,
                'callout_button' => 'Sign In',
                'callout_url' => url('login'),
                'user' => $user,
            );

            $message = 
            '<h5><strong>Great Work! You have successfully verified your account</strong></h5>
             <p>Welcome to GoForex Wealth Creation!</p>';
            $this->saveNotification($message, 'notification', $user, 'Account Verified');

            if($user->subscription){
                    // Send email to confirm successful registration
                Mail::send('emails.verified', $parameters, function ($message)
                use ($email, $name) {
                    $message->from('noreply@goforex.co.za');
                    $message->to($email, $name)->subject('GoForex - Your profile is activated!');
                });

            }
           
            flash('Your profile has been verified and activated!', 'success');
        } else {
            flash('The code you submitted is incorrect, please try again.', 'error');
        }

        return redirect('/home');
    }

    public function viewEvent($eventId)
    {
        $event = Event::where('id', $eventId)->first();
        $booking = Booking::where(['event_id'=> $eventId, 'user_id' => Auth::id()])->first();

        return view('view-event', compact('event', 'booking', 'img'));
    }

    public function updateProofOfPayment(Request $request)
    {
        // Get the file from the request
        $file = $request->file('image');
        if($file == null){
            flash('Please select a file', 'error');
            return back();
        }
        if($file->getSize() >= 2e+6 OR $file->getSize() == 0){
            flash('Files over 2MB are not allowed! Please decrease file size', 'error');
            return back();
        }
        // Get the contents of the file
        $contents = $file->openFile()->fread($file->getSize());

        // Store the contents to the database
        $booking = Booking::where(['event_id'=> $request['eventId'], 'user_id' => $request['userId']])->first();
        $booking->proof_of_payment = $contents;
        $booking->mime_type = $file->getClientMimeType();
        $booking->save();

        $event = Event::where('id', $request['eventId'])->first();

        flash('Proof uploaded successfully!', 'success');

        return back();
    }

    public function proofOfPayment($bookingID){
        $booking = Booking::where('id', $bookingID)->first();

        $pic = Image::make($booking->proof_of_payment)->resize(1920, 1080);
        $response = Response::make($pic->encode('jpg'));

        //setting content-type
        $response->header('Content-Type', $booking->mime_type);

        return $response;
    }

    public function updateKnobs(Request $request)
    {
        $events = Event::where('status_is', 'Open')->select('id', 'number_of_seats')->get();
        $bookings =  Booking::whereIn('event_id', $events->pluck('id'))->get();

        $data = collect();
        foreach($events as $event){
            $attendees = $bookings->where('event_id', $event->id)->where('status_is', 'Paid')->count();
            $array = $event->toArray();
            $data->push(array_merge($array, ['attendees'=> $attendees]));
        }
        return response()->json(['status'=> 'OK', 'data' => $data]);
    }

    public function contact_us(ContactFormRequest $request)
    {
        $email = 'info@goforex.co.za';
        $name = 'GoForex Wealth Creation | Contact us form';
        $sender_email = $request['email'];
        $subject = $request['subject'];
        $parameters = array(
            'username' => 'Admin',
            'callout_button' => 'Visit Website',
            'callout_url' => url('/'),
            'bodymessage' => $request['bodymessage'],
            'sender' => $request['name'],
            'sender_email' => $request['email'],
        );

        Mail::send('emails.contact', $parameters, function ($message)
        use ($email, $name, $sender_email, $subject) {
            $message->from($sender_email);
            $message->to($email, $name)->subject($subject);
        });

        flash('Thank You! Your message was sent successfuly.', 'success');
        return back();
    }

    public function loadInvoices()
    {
        $invoices = Invoice::where('user_id', Auth::user()->id)->get();
        return view('user-invoices', compact('invoices'));
    }

}
