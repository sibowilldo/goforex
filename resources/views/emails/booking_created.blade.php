<div style="color:#505050;font-family:Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
    <div>Good Day, <b>{{ $username }}</b>,</div>
    <br/>
    <div><p>You have created a booking with <b>Ref#{{ $booking_ref }}</b>, please make payments to the following details..</p></div>
    <br/>

    <p><b>Banking Details :</b></p>
    <p>Bank : <b> XXXXX XXXXXXX</b></p>
    <p>Acc Holder : <b> X.X XXXXXXX</b></p>
    <p>Acc Type : <b> XXXXXXX </b></p>
    <p>Acc Number : <b> XXXXXXXXXX</b></p>
    <p>Branch Code : <b> XXX XXX</b></p>

    <p><b>NB : Payment is expected to be made within 6 hours from the booking date/time</b></p>

    <p><b>Booking Date/Time : {{ $booking_date_time }}</b></p>

    <div>Kind Regards,<br/>
        <b>GoForex</b></div>
</div>
