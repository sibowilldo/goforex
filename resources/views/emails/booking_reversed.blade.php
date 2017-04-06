@extends('layouts.emails')

@section('content')

    <p>We would like to inform you that because you've missed the 12 hour time window to make the payment for booking reference #<b>{{ $booking_ref }}</b>
    of the <strong><a href="{{ $event_url }}" target="_blank">{{ $event_name }}</a></strong> event, 
    your booking has therefore been reversed and you no longer have a seat reserved for it.</p> <br><br>
    <p>Should you still be interested in this event please create a new booking if seats are still available.</p>

@endsection
