@extends('layouts.emails')

@section('content')

    You have created a booking of <b>Ref#{{ $booking_ref }}</b><br>
    Please make a payment to below details, and update your online booking by uploading proof of payment:<br><br>

    <p style="font-size: 12px; line-height: 15px;">
        <i>Banking Details :</i><br>
        <strong>Bank:</strong> {{ $event->bank_account->bank }}<br>
        <strong>Acc Holder:</strong> {{ $event->bank_account->account_holder }}<br>
        <strong>Acc Number:</strong> {{ $event->bank_account->account_number }}<br>
        <strong>Branch Code: </strong>{{ $event->bank_account->branch }}<br>
        <strong>Reference: </strong>{{ $booking_ref }}<br>
    </p>

    <b>NB: You are expected to make payment, or your booking will be cancelled.</b><br><br>

    <p style="font-size: 12px; line-height: 15px;"><b>Booking Date/Time : {{ $booking_date_time }}</b></p>

    <br/>

@endsection