@extends('layouts.emails')

@section('content')

    Your booking of <b>Ref#{{ $booking_ref }}</b> has been confirmed, please find event details below:<br/><br>

    <p style="font-size: 12px; line-height: 15px;">
        <i>Event Details :</i><br>
        Event Name : <b> {{ $event_name }}</b><br>
        Host : <b> {{ $host }}</b><br>
        Date : <b> {{ $start_date }}</b><br>
        Time : <b> {{ $start_time  }}</b><br>
        Location : <b> {{ $address }}</b><br>
    </p>
    <br>

@endsection
