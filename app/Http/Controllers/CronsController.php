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
                        'callout_button' => 'Sign In',
                        'callout_url' => url('login'),
                    );
                    // TODO add queue

                    // Send email to confirm successful registration
                    Mail::send('emails.booking_declined', $parameters, function ($message)
                    use ($email, $name) {
                        $message->from('noreply@goforex.co.za');
                        $message->to($email, $name)->subject('GoForex - Your booking is declined!');
                    });

                    $message = '<h5><strong>Greetings '. $user->firstname .'!</strong></h5><p> It is in our deepest regrets to inform you that your booking for '. $event->name .' on '. $event->start_date .' @ '. $event->start_time .' has been declined. <br>This could be because your proof of payment could not be verified, please contact us for more info.</p> <br>
                            <p>If you are still interested in this event please create another booking if seats are still available.</p>';
                    $this->saveNotification($message,'notification',$user, 'Booking Declined');

                }

            }
        }
    }
}
