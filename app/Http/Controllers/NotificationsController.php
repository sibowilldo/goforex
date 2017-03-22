<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;

class NotificationsController extends Controller
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

    //
    public function index()
    {
        $notification = new Notification;
        $notifications = $notification->where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('notifications.index', compact('notifications'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $notification = new Notification;
        $notification->where('user_id', Auth::id())->where('id', $id)->update(['viewed'=>true]);
        $notification = $notification->where('user_id', Auth::user()->id)->where('id', $id)->first();

        
        $notifications = new Notification;
        $unreadNotifications = $notifications->where('user_id', Auth::id())->where('viewed', false)->take(5)->get();
        session(['unread-notifications:'.Auth::user()->id =>  $unreadNotifications]);
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        
    }

}