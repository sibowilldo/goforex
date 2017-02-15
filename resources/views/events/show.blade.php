@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-content">
                    <table id="event" class="table table-bordered table-striped table-force-topborder"
                           style="clear: both">
                        <tbody>
                        <tr>
                            <td width="25%">ID</td>
                            <td width="50%">
                                <a href="{{ url('events/'.$event->id.'/edit') }}">{{ $event->id }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Reference</td>
                            <td width="50%">
                                {{ $event->reference }}
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Name</td>
                            <td width="50%">
                                {{ $event->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Host</td>
                            <td>
                                {{ $event->host }}
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                {{ $event->address }}
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>
                                {{ $event->description }}
                            </td>
                        </tr>
                        <tr>
                            <td>Number Of Seats</td>
                            <td>
                                {{ $event->number_of_seats }}
                            </td>
                        </tr>
                        <tr>
                            <td>Number Of Attendees</td>
                            <td>
                                {{ count(explode(',', $event->attendees)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Start Date</td>
                            <td>
                                {{ $event->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>End Date</td>
                            <td>
                                {{ $event->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Start Time</td>
                            <td>
                                {{ $event->start_time }}
                            </td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>
                                {{ $event->end_time }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                {{ $event->status_is }}
                            </td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>
                                {{ $event->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <td>Updated At</td>
                            <td>
                                {{ $event->updated_at }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b>User Bookings </b></h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Username</th>
                            <th>Proof Of Payment</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->reference }}</td>
                                <td>{{ $booking->user->username }}</td>
                                <td><img class="zoomTarget" data-targetsize="0.8" data-duration="600" style="width: 15%;height: 15%" src="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}"/></td>
                                <td>{{ $booking->status_is }}</td>
                                <td>{{ $booking->created_at }}</td>
                                <td>
                                    @if($booking->status_is == 'Pending')
                                        @if($booking->proof_of_payment != null)
                                            <a href="{{ url('booking/'.$booking->id.'/approve') }}" class="btn"
                                               rel="tooltip"
                                               title="Edit">
                                                <b>Approve</b>
                                            </a> /
                                            <a href="{{ url('booking/'.$booking->id.'/decline') }}" class="btn"
                                               rel="tooltip"
                                               title="Edit">
                                                <b>Decline</b>
                                            </a>

                                        @else
                                            <b>Pending</b>
                                        @endif
                                    @elseif($booking->status_is == 'Paid')
                                        <b>Approved</b>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop