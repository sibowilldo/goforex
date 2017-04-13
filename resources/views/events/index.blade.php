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
                <div class="col-md-10 col-md-offset-1">
                
                        <div class="callout callout-info">
                        <h4>Legend (Action icons)</h4>
                            <div class="row">
                                <div class="col-sm-3"><span class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></span> View event info</div>
                                <div class="col-sm-3"><span class="btn btn-xs btn-danger"><i class="fa fa-pencil-square-o"></i></span> Edit event info</div>
                                <div class="col-sm-3"><span class="btn btn-xs btn-primary"><i class="fa fa-send"></i></span> Publish Event</div>
                                <div class="col-sm-3"><span class="btn btn-xs btn-success"><i class="fa fa-check"></i></span> Event Published</div>
                            </div>
                        </div>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <a href="{{ url('events/create') }}" class="btn btn-sm pull-right btn-primary" rel="tooltip" title="View"><i class="fa fa-plus-circle"></i> Create Event
                            </a>
                            <h3 class="box-title">All Events 
                            </h3>
                        </div>
                        <div class="box-body">
                            @if(count($events)> 0)
                            <table class="ui table table-hover table-striped table-condensed" id="events">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Host</th>
                                    <th>Attendees</th>
                                    <th>Event Dates</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->name }} <em class="pull-right label label-info">({{ $event->reference }})</em></td>
                                        <td>{{ $event->host }}</td>

                                        @if(count(explode(',', $event->attendees)) > 0 && explode(',', $event->attendees)[0] != "")
                                            <td>  {{ count(explode(',', $event->attendees)) }}
                                                / {{ $event->number_of_seats }}</td>
                                        @else
                                            <td> 0
                                                / {{ $event->number_of_seats }}</td>
                                        @endif

                                        <td>{{ \Carbon\Carbon::parse($event->start_date)->toFormattedDateString() }} <br> <strong>to</strong> 
                                        {{ \Carbon\Carbon::parse($event->end_date)->toFormattedDateString() }}</td>
                                        <td>{{ $event->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ url('events', $event->id) }}" class="btn btn-sm btn-warning" rel="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('events/'.$event->id.'/edit') }}" class="btn btn-sm btn-danger" rel="tooltip"
                                            title="Edit"><i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            @if($event->status_is == 'Pending')
                                                <a href="{{ url('events/'.$event->id.'/submitEvent') }}" class="btn btn-sm btn-primary"
                                                rel="tooltip"
                                                title="Publish"><i class="fa fa-paper-plane"></i>
                                                </a>
                                                @else
                                                
                                                <span class="btn btn-sm btn-success"
                                                rel="tooltip"
                                                title="Published"><i class="fa fa-check"></i>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="panel panel-default">
                            <div class="panel-body">
                            <h2 class="text-gray text-center">Nothing to see here! :) Yet...</h2><p class="text-center">Why don't you check again later? Greater things are coming!</p>
                            
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.semanticui.min.css">

    <style type="text/css">
        .ui.grid{
            margin: 0;
            padding-left: 2.5rem;
        }
        .ui.table td {
            padding: .58571429em .98571429em;
        }
        .ui.table td.unread {
            font-weight: bold;
        }
    </style>
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/dataTables.semanticui.min.js') }}
    {{ Html::script('http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js') }}

    <script>
        $(document).ready(function() {
            $('#events').DataTable();
        } );
    </script>
@stop