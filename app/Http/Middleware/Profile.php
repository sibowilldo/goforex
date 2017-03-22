<?php

namespace App\Http\Middleware;

use App\Notification;
use Closure;

use Auth;
use Session;

class Profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Store user_id in Session
        if(!Session::has('user_id')) {
            Session::put('user_id', Auth::user()->id);
        }

        // Store user in Session
        if(!Session::has(Session::get('user_id').':user')) {
            Session::put(Session::get('user_id').':user', Auth::user());
        }

//        // Store account in Session
//        if(!Session::has(Session::get('user_id').':account')) {
//            Session::set(Session::get('user_id').':account', Auth::user()->account->first());
//        }

        $notifications = new Notification;
        $unreadNotifications = $notifications->where('user_id',Auth::user()->id)->where('viewed', false)->take(5)->get();
        Session::put('unread-notifications:'.Auth::user()->id, $unreadNotifications);

        return $next($request);
    }
}