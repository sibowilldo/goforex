<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Event;
use App\Invoice;
use App\Item;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\NotificationTraits;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CronsController extends Controller
{
    //
    // User Traits
    use NotificationTraits;

    public function processBookings()
    {
        $now = new Carbon();
        $bookings = Booking::where('status_is', 'Pending')->get();

        foreach ($bookings as $booking) {
            $bookingIsGreaterThan12Hours = Carbon::parse($booking->created_at)->addHours(12)->lt($now);

            if ($bookingIsGreaterThan12Hours) {
                $user = User::where('id', $booking->user_id)->first();
                $booking_ref = $booking->reference;

                $event = Event::where('id', $booking->event_id)->first();

                if ($event){
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
                        'event_url' => url('/view-event/'.$event->id),
                        'event_name' => $event->name,
                        'callout_button' => 'Sign In',
                        'callout_url' => url('login'),
                        'user' => $user,
                    );
                    // TODO add queue

                    $message = '<h5><strong>Hi '. $user->firstname .'!</strong></h5>
                                <p> Please note that because you have missed the 12 hour time window to make the payment for the <b>'
                                . $event->name .'</b> event that is taking place on '. $event->start_date .' @ '. $event->start_time 
                                .', your booking has therefore been reversed and you no longer have a seat reserved.</p> <br><br>
                                <p>Should you still be interested in this event please create a new booking if seats are still available.</p><br>';
                    $this->saveNotification($message,'notification',$user, 'Booking Reversed');
                    
                    if($user->subscription){
                            // Send email to confirm successful registration
                        Mail::send('emails.booking_reversed', $parameters, function ($message)
                        use ($email, $name, $booking_ref) {
                            $message->from('noreply@goforex.co.za');
                            $message->to($email, $name)->subject('GoForex - Booking with ref #' . $booking_ref .' was reversed!');
                        });
                    }
                    

                }

            }
        }
    }

    public function purge_unverified_users()
    {
        $users = User::where('verified', false)->get();
        Log::notice('Found  '.$users->count() . ' unverified users');

        if($users->count()){
            foreach ($users as $user){
                $now = new \DateTime();
                if($user->created_at->diff($now)->days > 30 ){
                    Log::info('Removing user with id:'.$user->id . ' email is ' . $user->email . ' user was created '. $user->created_at->diffForHumans());
                    $user->delete();
                    Log::info('Removed successfully');
                }else{
                    Log::info('User not removed. RESEAON: user is not 30 days old...');
                }
            }
        }else{
            Log::info('Nothing to purge');
        }
        Log::notice('Purge completed...');
    }
}
