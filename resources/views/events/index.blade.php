@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Events
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Events</li>
            </ol>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>New Feature! <small class="white-text">28 Feb 2018 1:00am</small></h4>
                        <p>Now you can update event status directly from the list of events. Simply click the event status, select the desired status and click the check [<i class="fa fa-check"></i>] button to confirm.
                            <br>
                            <em>Hint: An event must be Closed or Pending in order to delete it and remember, bookings linked to that event will also be deleted!</em>
                        </p>
                    </div>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <a href="{{ url('events/create') }}" class="btn btn-sm btn-social pull-right btn-primary"
                               rel="tooltip" title="View"><i class="fa fa-plus-circle"></i> Create Event
                            </a>
                            <h3 class="box-title">All Events
                            </h3>
                        </div>
                        <div class="box-body">
                            @if(count($events)> 0)
                                <table class="nowrap table table-hover table-striped table-condensed" id="events">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Linked Bank Acc.</th>
                                        <th>Host</th>
                                        <th>Attendees</th>
                                        <th>Event Dates</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->bank_account->account_holder }}</td>
                                            <td>{{ $event->host }}</td>
                                            <td>{{ $bookings->where('event_id', $event->id)->count() }}
                                                / {{ $event->number_of_seats }}</td>

                                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                                <strong>-</strong>
                                                {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</td>
                                            <td>

                                                {{ Form::open(['route' =>['events.status', $event->id], 'method' =>'patch', 'id' => 'form-event-status-'.$event->id]) }}
                                                    <div class="input-group input-group-sm input-group-select">
                                                    {{ Form::select('status_is', \App\Event::$statuses, $event->status_is, ['class' => 'form-control']) }}
                                                        <div class="input-group-btn">

                                                            <button class="btn btn-icon btn- btn-sm"><i class="fa fa-check"></i></button>
                                                        </div>
                                                    </div>
                                                {{ Form::close() }}
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">

                                                    <a href="{{ url('attendees/'. $event->id . '/add') }}"
                                                       data-toggle="tooltip" data-original-title="Add Guest" class="btn btn-sm btn-default">
                                                        <i class="fa ion-person-add"></i>
                                                    </a>
                                                    <a href="{{ url('events', $event->id) }}"
                                                       data-toggle="tooltip" data-original-title="View Event" data-placement="left"  class="btn btn-sm btn-default">
                                                        <i class="fa ion ion-ios-calendar-outline"></i>
                                                    </a>
                                                    <a href="{{ url('events/'.$event->id.'/edit') }}"
                                                       data-toggle="tooltip" data-original-title="Edit Event" data-placement="left" class="btn btn-sm btn-default"><i
                                                                class="fa ion ion-ios-compose-outline"></i>
                                                    </a>
                                                    @if($event->status_is == 'Pending')
                                                        <a href="{{ url('events/'.$event->id.'/submitEvent') }}"
                                                           data-toggle="tooltip" data-original-title="Publish Event" data-placement="left"  class="btn btn-sm btn-default"><i
                                                                        class="fa fa-send-o blue-text"></i>
                                                            </a>
                                                    @endif
                                                </div>


                                                @if($event->bookings()->count() == 0)
                                                    {!! Btn::delete($event->id, url('events'), '',true, $event->name)!!}
                                                @else
                                                    {!! Btn::delete($event->id, url('events'), '', true,  $event->name, 'Any booking linked to this event will also be deleted!')!!}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h2 class="text-gray text-center">Nothing to see here! :) Yet...</h2>
                                        <p class="text-center">Why don't you check again later? Greater things are
                                            coming!</p>

                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <script>
        $(document).ready(function () {
            $('#events').DataTable({responsive: true});
        });
    </script>
@stop