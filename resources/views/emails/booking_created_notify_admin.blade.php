@extends('layouts.emails')

@section('content')

    A new booking has been created by <strong>{{ $user->firstname }} {{ $user->lastname }}</strong> details are as follows:<br>

    <h3>User Details</h3>
    <table  style="width: 100%; border-collapse:collapse; border-color: gray; text-align: left;">
        <thead>
            <tr>
                <th align="left" style="font-family: Tahoma; font-size: 12px;">First Name</th>
                <th align="left" style="font-family: Tahoma; font-size: 12px;">Last Name</th>
                <th align="left" style="font-family: Tahoma; font-size: 12px;">Contact Number</th>
                <th align="left" style="font-family: Tahoma; font-size: 12px;">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="left" style="font-family: Tahoma; font-size: 12px;">{{ $user->firstname }}</td>
                <td align="left" style="font-family: Tahoma; font-size: 12px;">{{ $user->lastname }}</td>
                <td align="left" style="font-family: Tahoma; font-size: 12px;">{{ $user->cell }}</td>
                <td align="left" style="font-family: Tahoma; font-size: 12px;">{{ $user->email }}</td>
            </tr>
        </tbody>
    </table>
    <br>

    <h3>Event Details</h3>
    <table style="width: 100%; border-collapse:collapse; border-color: gray;">
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Event Title</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->name}}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Host</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->host }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Venue</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->address }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Max. Seats</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->number_of_seats }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Number of Attendees</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $bookings->count() }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Event Dates</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->start_date }} -  {{ $event->end_date }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 12px;"><strong>Event Times</strong></td>
            <td style="font-family: Tahoma; font-size: 12px;">{{ $event->start_time }} -  {{ $event->end_time }}</td>
        </tr>
    </table>

    <table style="width: 100%; border-collapse: collapse; border: none; text-align: center" class="mcnButtonBlock">
    <tbody class="mcnButtonBlockOuter">
        <tr>
        
        <td style="padding-top:25px; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 3px;background-color: #212223;">
                <tbody>
                    <tr>
                        <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Tahoma; font-size: 16px; padding: 10px;">
                            <a target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;" class="mcnButton" href="{{ url('/view-event/'. $event->id)}}">View Event</a> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
        <td style="padding-top:25px; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 3px;background-color: #212223;">
                <tbody>
                    <tr>
                        <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Tahoma; font-size: 16px; padding: 10px;">
                            <a target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;" class="mcnButton" href="{{ url('/events/' . $event->id) }}">View Bookings</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
        </tr>
    </tbody>
    </table>

@endsection