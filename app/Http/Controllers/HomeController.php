<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\VerifyFormRequest;
use Auth;
use App\Event;
use App\User;
use Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use App\Http\Traits\NotificationTraits;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

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
        $this->middleware('auth');
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
        $events = Event::get();

        $allEvents = Event::whereNotIn('status_is', ['Pending'])->orderBy('created_at','desc')->get();
        $bookings = Booking::where('user_id', Auth::user()->id)->get();


        $message = 'You, welcome to GoForex Wealth Creation!';
        $this->saveNotification($message,'profile-verified',Auth::user());

        return view('home', compact(['allEvents', 'bookings', 'events']));
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
            );

            // Send email to confirm successful registration
            Mail::send('emails.verified', $parameters, function ($message)
            use ($email, $name) {
                $message->from('noreply@goforex.co.za');
                $message->to($email, $name)->subject('GoForex Profile Complete');
            });

            $message = 'You have successfully verified your profile, welcome to GoForex Wealth Creation!';
            $this->saveNotification($message,'profile-verified',$user);

            flash('Your profile has been verified and is complete!', 'success');
        } else {
            flash('The code you submitted is incorrect, please try again.', 'error');
        }

        return redirect('/home');
    }

    public function viewEvent($eventId)
    {
        $event = Event::where('id', $eventId)->first();
        $booking = Booking::where(['event_id'=> $eventId, 'user_id' => Auth::id()])->first();

        return view('view-event', compact(['event', 'booking', 'img']));
    }

    public function updateProofOfPayment(Request $request)
    {
        // Get the file from the request
        $file = $request->file('image');

        // Get the contents of the file
        $contents = $file->openFile()->fread($file->getSize());

        // Store the contents to the database
        $booking = Booking::where(['event_id'=> $request['eventId'], 'user_id' => Auth::id() ])->first();
        $booking->proof_of_payment = $contents;
        $booking->mime_type = $file->getClientMimeType();
        $booking->save();

        $event = Event::where('id', $request['eventId'])->first();

        return view('view-event', compact(['event', 'booking']));
    }

    public function proofOfPayment($bookingID){
        $booking = Booking::where('id', $bookingID)->first();

        $pic = Image::make($booking->proof_of_payment);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', $booking->mime_type);

        return $response;
    }

    public function updateKnobs(Request $request)
    {
        $events = Event::where('status_is', 'Open')->select('id', 'number_of_seats', 'attendees')->get();
        return response()->json(['status'=> 'OK', 'data' => $events]);
    }
}
