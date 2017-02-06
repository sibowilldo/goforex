<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VerifyFormRequest;
use Auth;
use App\Event;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

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
        if(Auth::user()->role->first()->name == 'admin'){
            return Redirect('/events');
        }
        return view('home');
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
            flash('Your profile has been verified and is complete!', 'success' );
        }else{
            flash('The code you submitted is incorrect, please try again.', 'danger' );
        }

        return redirect('/home');
    }
}
