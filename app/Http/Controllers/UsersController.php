<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileFormRequest;
use App\Http\Requests\PasswordFormRequest;

use Auth;
use Hash;
use Validator;

use App\User;
use App\Booking;
use App\Event;



class UsersController extends Controller
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

    public function index()
    {
        $profile = User::where('id', Auth::id())->get()->first();
        $bookings = Booking::where('user_id', Auth::id())->get();
        $eventsCount = Booking::where('user_id', Auth::id())->distinct('event_id')->count('event_id');
        return view('users.profile', compact('profile', 'bookings', 'eventsCount'));
    }

    public function store()
    {
        # code...
    }
    /**
    *
    *
    */
    public function editProfile($id)
    {
        $profile = User::where('id', $id)->get()->first();
        return response()->json(['data', $profile]);
    }

    public function update(ProfileFormRequest $request, User $profile)
    {
        $profile->update($request->all());
        flash('Profile updated', 'success');
        return redirect('profile');
    }

    public function editPassword($id)
    {
        
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            // Here's how our new validation rule is used.
            'current_password' => 'hash:' . $user->password,
            'password' => 'required|different:current_password|min:6|max:12|confirmed'
         ]);

        if ($validation->fails()) {
        return redirect()->back()->withErrors($validation->errors());
        }
        $user->password = Hash::make($request['password']);
        $user->save();

        flash('Your password was updated successfuly!', 'success');
        return redirect()->back();
    }
}
