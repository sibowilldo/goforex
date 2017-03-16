<div style="color:#505050;font-family:Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
    <div>Good Day, <b>{{ $username }}</b>,</div>
    <br/>
    <div><p>Your booking with <b>Ref#{{ $booking_ref }}</b> has been confirmed, bellow are the event details.</p></div>
    <br/>

    <p><b>Event Details :</b></p>
    <p>Event Name : <b> {{ $event_name }}</b></p>
    <p>Host : <b> {{ $host }}</b></p>
    <p>Date : <b> {{ $start_date }}</b></p>
    <p>Time : <b> {{ $start_time  }}</b></p>
    <p>Location : <b> {{ $address }}</b></p>

    <div>Kind Regards,<br/>
        <b>GoForex</b></div>
</div>
