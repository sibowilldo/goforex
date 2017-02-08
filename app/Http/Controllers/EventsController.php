<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventsFormRequest;
use Auth;

class EventsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::get();
        return view('events.index', compact(['events']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventsFormRequest $request)
    {
        $event = $request->all();
        $event['status_is'] = 'Pending';
        $event['reference'] = str_random(7);
//        dd($event);
        Event::create($event);
        flash('You have successfully created and Event.', 'success');

        $events = Event::get();
        return view('events.index', compact(['events']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        return view('events.show', compact(['event']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        return view('events.edit', compact(['event']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventsFormRequest $request, Event $event)
    {
        //
        // Update the existing account
        $event->update($request->all());
        flash('Event has been updated!', 'success');
        return redirect('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        if ($event->status_is == 'Pending'){
            // Delete a account
            $event->delete();
            flash('Event has been deleted!', 'success');
            $events = Event::get();
            return view('events.index', compact(['events']));
        }else{
            flash('You can only delete an event that\'s Pending', 'danger');
        }
    }


    public function submitEvent($id){
        $event = Event::where('id',$id)->first();
        if ($event){
            $event->update(['status_is'=>'Open']);
            flash('Event is now open and members can book it!', 'success');
        }else{
            flash('The event you are looking for is invalid.', 'danger');
        }

        $events = Event::get();
        return view('events.index', compact(['events']));
    }
}
