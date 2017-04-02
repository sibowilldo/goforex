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
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">All Events
                                <b>
                                    <a href="{{ url('events/create') }}" class="btn" rel="tooltip" title="View">[ + ]
                                    </a>
                                </b>
                            </h3>
                        </div>
                        <div class="box-body">
                            <table class="ui table table-hover table-striped table-condensed" id="events">
                                <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Name</th>
                                    <th>Host</th>
                                    <th>Attendees</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->reference }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->host }}</td>

                                        @if(count(explode(',', $event->attendees)) > 0 && explode(',', $event->attendees)[0] != "")
                                            <td>  {{ count(explode(',', $event->attendees)) }}
                                                / {{ $event->number_of_seats }}</td>
                                        @else
                                            <td> 0
                                                / {{ $event->number_of_seats }}</td>
                                        @endif

                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>{{ $event->status_is }}</td>
                                        <td>{{ $event->created_at }}</td>
                                        <td>
                                            <a href="{{ url('events', $event->id) }}" class="btn" rel="tooltip" title="View">
                                                <b>Show</b>
                                            </a>
                                            <a href="{{ url('events/'.$event->id.'/edit') }}" class="btn" rel="tooltip"
                                            title="Edit">
                                                <b>Edit</b>
                                            </a>
                                            @if($event->status_is == 'Pending')
                                                <a href="{{ url('events/'.$event->id.'/submitEvent') }}" class="btn"
                                                rel="tooltip"
                                                title="Edit">
                                                    <b>Submit</b>
                                                </a>
                                            @elseif($event->status_is == 'Open')
                                                <b>Open</b>
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