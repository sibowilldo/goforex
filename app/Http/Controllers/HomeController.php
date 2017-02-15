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
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
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
        if (Auth::user()->role->first()->name == 'admin' && Auth::user()->verified == 1) {
            return Redirect('/events');
        }

        $allEvents = Event::whereNotIn('status_is', ['Pending'])->get();
//        dd($allEvents);
        $bookings = Booking::where('user_id', Auth::user()->id)->get();

        return view('home', compact(['allEvents', 'bookings']));
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
                $message->from('noreply@innobrand.co.za');
                $message->to($email, $name)->subject('GoForex Profile Complete');
            });
            flash('Your profile has been verified and is complete!', 'success');
        } else {
            flash('The code you submitted is incorrect, please try again.', 'danger');
        }

        return redirect('/home');
    }

    public function viewEvent($eventId)
    {
        $event = Event::where('id', $eventId)->first();
        $booking = Booking::where('event_id', $eventId)->first();

        return view('view-event', compact(['event', 'booking', 'img']));
    }

    public function updateProofOfPayment(Request $request)
    {
        // Get the file from the request
        $file = $request->file('image');

        // Get the contents of the file
        $contents = $file->openFile()->fread($file->getSize());

        // Store the contents to the database
        $booking = Booking::where('event_id', $request['eventId'])->first();
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

}
