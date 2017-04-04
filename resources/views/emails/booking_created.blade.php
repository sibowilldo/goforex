@extends('layouts.emails')

@section('content')

    You have created a booking of <b>Ref#{{ $booking_ref }}</b><br>
    Please make a payment to below details, and update your online booking by uploading proof of payment:<br><br>

    <p style="font-size: 12px; line-height: 15px;">
        <i>Banking Details :</i><br>
        Bank : <b> First National Bank</b><br>
        Acc Holder : <b> AJ Hastibeer</b><br>
        Acc Number : <b> 626-06406-909</b><br>
        Branch Code : <b> 250655 </b><br><br>
    </p>

    <b>NB: You are expected to make payment within 12 hours from the booking date/time, or your booking will be cancelled.</b><br><br>

    <p style="font-size: 12px; line-height: 15px;"><b>Booking Date/Time : {{ $booking_date_time }}</b></p>

    <br/>

@endsection