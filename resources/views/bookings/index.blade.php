@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bookings
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bookings</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">  
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <a href="{{ url('/home') }}" class="btn btn-sm pull-right btn-default" rel="tooltip" title="Book an event"><i class="fa fa-calendar-check-o"></i> Book an Event
                        </a>
              <h3 class="box-title">Bookings</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              
                @if(count($bookings) > 0)
                <table id="bookings" class="ui table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reference</th>
                            <th>Booked Event</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->reference }}</td>
                        <td>{{ App\Event::select('name')->where('id', $booking->event_id)->first()->name }}</td>
                        <td>{{ $booking->status_is }}</td>
                        <td>{{ $booking->created_at->toFormattedDateString() }}</td>
                        <td>
                        @if(!$booking->proof_of_payment)
                            <a href="{{ url('/view-event/'.$booking->event_id) }}" class="btn btn-danger btn-sm">Upload Proof of Payment</a>
                        @else
                            @if($booking->status_is == 'Paid')
                                <b>No further action!</b>
                            @elseif($booking->status_is == 'Pending')
                                <b>Your proof is being validated...</b>
                            @endif
                        @endif
                        </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                @else
                <div class="panel panel-default">
                <div class="panel-body">
                <h2 class="text-gray text-center">Nothing to see here! :) Yet...</h2><p class="text-center">Why don't you come back after you've booked an event?</p>
                </div>
                </div>
                
                @endif
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
          </div>
            
            </div>
        </div>
    </section>
</div>
@stop

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
        $('#bookings').DataTable();
    } );
</script>
@stop