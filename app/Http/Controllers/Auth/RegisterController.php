<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required|min:6|max:15|unique:users',
            'cell' => 'required|min:9|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:12|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        // Generate new reference number
        $ref = rand(1000000, 9999999);
        $results = User::where('reference', $ref)->count();

        // Loop and regenerate $ref while $results is more than 0
        while ($results > 0) {
            $ref = rand(100000, 999999);
            $results = User::where('reference', $ref)->count();
        }


        $user = User::create([
            'reference' => $ref,
            'verified' => 0, // Not yet verified
            'code' => str_random(6),
            'username' => $data['username'],
            'cell' => $data['cell'],
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'password' => bcrypt($data['password']),
            'status_is' => User::$statuses['Active'],
            'location' => $data['location'],
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
            'password' => $data['password'],
            'cell' => $user->cell,
            'reference' => $user->reference,
            'code' => $user->code,
            'location' => $user->location,
            'fullname' => $user->firstname . ' ' .$user->lastname,
        );

        // Send email to confirm successful registration
        Mail::send('emails.welcome', $parameters, function ($message)
        use ($email, $name) {
            $message->from('noreply@goforex.co.za');
            $message->to($email, $name)->subject('Welcome To GoForex!');
        });

        flash('Awesome! You have successfully registered with GoForex :-)', 'success' );

        return $user;
    }
}
