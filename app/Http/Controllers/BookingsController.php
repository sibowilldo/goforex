<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Event;
use Auth;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
     * Creates a new booking for logged in user using the event id
     *
     * @return \Illuminate\Http\Response
     */
    public function createEventBooking($eventId)
    {
        //
        $event = Event::where('id', $eventId)->first();

        // Get all signals
        $attendees = explode(',', $event->attendees);
        if(count($attendees) > 0 && $attendees[0] != ""){
            if (count($attendees) == $event->number_of_seats || $event->status_is == "FullyBooked"){
                flash("Sorry this event is fully booked.","danger");
                return redirect('/home');
            }else{
                array_push($attendees, Auth::user()->id);
                $event->attendees = implode(',', $attendees);
                $event->save();
            }
        }else{
            $event->update(['attendees'=>Auth::user()->id]);
        }


        Booking::create(['user_id'=>Auth::user()->id,
                        'event_id'=>$eventId,
                        'reference'=>'BO'.str_random(9),
                        'status_is'=>'Pending']);

        flash("You have successfully created a booking, please make payment to get approval.","success");
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
