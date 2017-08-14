@extends('layouts.emails')

@section('content')

    <p style="text-align: left; font-size: 12px">A Booking has been created on your behalf by Admin, for the <strong>{{ $event->name }}</strong><br>
    The Payment Details and Event Details Details are as follows:<br></p>

    <h4 style="text-align: left;">Payment Details</h4>
    <p style="text-align: left; font-size: 12px">
        <strong>Please make a direct deposit or EFT Payment of a total of <strong>R{{ $event->item->price }}</strong> to the following bank details:</strong><br>
        <strong>Amount:</strong> R{{ $event->item->price }}<br>
        <strong>Bank:</strong> First National Bank<br>
        <strong>Acc Holder:</strong> Forex Wealth Creation SA<br>
        <strong>Acc Number:</strong> 62715445658<br>
        <strong>Branch Code: </strong>250655<br>
    </p>
    <h4 style="text-align: left;">Event Details</h4>
    <p style="text-align: left; font-size: 12px">
        <strong>Event Name: </strong>{{ $event->name }}  <br>
        <strong>Start Date: </strong>{{ $event->start_date }} <br>
        <strong>End Date: </strong>{{ $event->end_date }} <br>
        <strong>Event Times: </strong>From {{ $event->start_time }} to {{ $event->end_time }} <br>
        <strong>Venue: </strong>{{ $event->address }} <br>
        <strong>Hosted by: </strong>{{ $event->host }} <br>
    </p>

    <p style="text-align: left; font-size: 12px"><strong>Already paid for this booking? </strong> <a href="{{ url('/view-event/'. $event->id) }}">Click here to Upload Proof of Payment</a></p>
    <span  style="text-align: left; font-size: 12px" color="red">NB: You are expected to make payment and upload proof of payment, or your booking will be cancelled.</span><br><br>

    <p style="font-size: 12px; line-height: 15px;"><b>Booking Date/Time : {{ $booking->created_at->toDayDateTimeString() }}</b></p>

    <br/>

@endsection