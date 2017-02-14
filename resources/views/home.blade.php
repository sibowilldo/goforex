@extends('layouts.app')

@section('content')
    @if(Auth::user()->status_is=='Active')
        @if(Auth::user()->verified==1)
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">Dashboard</div>
                            <div class="panel-body">
                                <div id="accordion">
                                    <h3>Open</h3>
                                    <div>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Reference</th>
                                                <th>Name</th>
                                                <th>Host</th>
                                                <th>Attending</th>
                                                <th>Start/End Date</th>
                                                <th>Start/End Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allEvents as $event)
                                                <tr>
                                                    <td>{{ $event->reference }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ $event->host }}</td>
                                                    @if(count(explode(',', $event->attendees)) > 0 && explode(',', $event->attendees)[0] != "")
                                                        <td>  {{ count(explode(',', $event->attendees)) }}
                                                            / {{ $event->number_of_seats }}</td>
                                                    @else
                                                        <td>  0
                                                            / {{ $event->number_of_seats }}</td>
                                                    @endif
                                                    <td>{{ $event->start_date }} - {{ $event->end_date }}</td>
                                                    <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                                                    <td>{{ $event->status_is }}</td>
                                                    <td>
                                                        <a href="{{ url('view-event', $event->id) }}" class="btn"
                                                           rel="tooltip" title="View">
                                                            <b>Show</b>
                                                        </a>
                                                        @if($event->status_is == 'FullyBooked')
                                                            <b>Fully Booked</b>
                                                        @elseif($event->status_is == 'Open')
                                                            @if(in_array(Auth::user()->id,explode(',', $event->attendees)))
                                                                <p>Booking Pending</p>
                                                            @else
                                                                <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                                                                   class="btn"
                                                                   rel="tooltip"
                                                                   title="Edit">
                                                                    <b>Book</b>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3>Close</h3>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" role="form" action="{{ url('/verification') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('verification') ? ' has-error' : '' }}">
                            <label for="verification" class="col-sm-8 control-label">Verification Code</label>
                            <div class="col-sm-4">
                                <input id="verification" name="verification" type="text"
                                       placeholder="Enter verification code" class="form-control">

                                @if ($errors->has('verification'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('verification') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-8 col-sm-8">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-default" data-dismiss="modal" href="{{ url('/resend') }}">Resend
                                    Code</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif
@endsection
