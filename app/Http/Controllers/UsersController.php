<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\PasswordFormRequest;
use Illuminate\Support\Facades\Response; 

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
        $users = User::all();
        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new user
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user = User::create($request->all());
        flash('New user has been added!', 'success');
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Show user of $id
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        // Update data
        $request['subscription'] = ($request['subscription'] == 'on' ? true : false);
        $user->update($request->all());
        flash('Details updated!', 'success');
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete a user
        $user->delete();
        flash('User has been deleted!', 'success');
        return redirect('users');
    }
    

    public function editPassword($id)
    {
        //
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

        flash('Your password was updated successfully!', 'success');
        return redirect()->back();
    }

    public function updateVerify(Request $request)
    {
        $user =  User::findOrFail($request->id);
        $user->update(['verified' => $request->state == 'true' ? 1 : 0]);
        $title = 'All Done!';
        $message = 'has been ' .( $user->verified ? 'verified' : 'unverified');
        $level = 'success';
        $data = $user->username;

        return response()->json(['status'=> 'OK', 'data' => ['data'=>$data, 'title' => $title, 'message' => $message, 'level' => $level]]);
    }

    public function updateBlockStatus(Request $request)
    {
        $user =  User::findOrFail($request->id);
        $user->update(['status_is' => $request->action == 'block' ? 'Blocked' : 'Active']);
        $title = 'All Done!';
        $message = 'has been ' .( $user->status_is == 'Blocked' ? 'Blocked' : 'Unblocked and Activated');
        $level = 'success';
        $data = ['username' => $user->username,
                    'status' => $user->status_is];

        return response()->json(['status'=> 'OK', 'data' => ['data'=>$data, 'title' => $title, 'message' => $message, 'level' => $level]]);
    }
}
