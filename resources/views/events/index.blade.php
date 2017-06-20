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
                                            <td>{{ $event->name }} <span
                                                        class="label label-{{ ($event->status_is == 'Open') ? 'success' : 'danger'}}">{{ $event->status_is }}</span>
                                            </td>
                                            <td>{{ $event->host }}</td>
                                            <td>{{ $bookings->where('event_id', $event->id)->count() }}
                                                / {{ $event->number_of_seats }}</td>

                                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('F j') }}
                                                <strong>-</strong>
                                                {{ \Carbon\Carbon::parse($event->end_date)->format('F j') }}</td>
                                            <td>{{ $event->status_is }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-default">Choose Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ url('attendees/'. $event->id . '/add') }}"
                                                               rel="tooltip" title="View">
                                                                <i class="fa ion-person-add"></i> Add Attendee
                                                            </a>
                                                        </li>
                                                        <li><a href="{{ url('events', $event->id) }}"
                                                               rel="tooltip"
                                                               title="View">
                                                                <i class="fa ion ion-ios-calendar-outline"></i> View Event
                                                            </a></li>
                                                        <li><a href="{{ url('events/'.$event->id.'/edit') }}"
                                                               rel="tooltip"
                                                               title="Edit"><i
                                                                        class="fa ion ion-ios-compose-outline"></i> Edit Event
                                                            </a></li>
                                                        <li class="divider"></li>
                                                        @if($event->status_is == 'Pending')
                                                            <li><a href="{{ url('events/'.$event->id.'/submitEvent') }}"
                                                                   rel="tooltip"
                                                                   title="Publish"><i
                                                                            class="fa fa-send-o blue-text"></i> Publish Event
                                                                </a></li>
                                                        @else

                                                            <li class="disabled"><a href="javascript:;"
                                                                                          class="grey-text"
                                                                                          rel="tooltip"
                                                                                          title="Published"><i
                                                                            class="fa ion ion-information-circled"></i> {{ $event->status_is }}
                                                                </a></li>
                                                        @endif
                                                    </ul>
                                                </div>


                                                @if($event->status_is == 'Pending')
                                                    {!! Btn::delete($event->id, url('events'), true, $event->name)!!}
                                                @else
                                                    {!! Btn::delete($event->id, url('events'), true,  $event->name, 'Any booking linked to this event will also be deleted!')!!}
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