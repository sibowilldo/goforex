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
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <a href="{{ url('/home') }}" class="btn btn-sm pull-right btn-primary btn-social" rel="tooltip" title="Book an event"><i class="fa fa-calendar-check-o"></i> Book an Event
                        </a>
              <h3 class="box-title">Bookings</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
              
                @if(count($bookings) > 0)
                <table id="bookings" class="nowrap dt-responsive table table-hover table-striped">
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
                        @if($booking->status_is == 'Paid')
                            <span class="label bg-green"><i class="fa fa-check-square-o"></i> All is well. No further action!</span>
                        @elseif($booking->status_is == 'Declined')
                            <span class="label bg-red"> <i class="fa ion ion-android-cancel"></i> {{$booking->status_is}}</span>
                        @else
                            <span class="label bg-orange"> <i class="fa ion ion-load-d fa-spin fa-fw" style="animation-timing-function: cubic-bezier(0.68, -0.55, 0.27, 1.55);"></i> {{$booking->status_is}} payment...</span>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <script>
        $(document).ready(function() {
            $('#bookings').DataTable({responsive: true});
        } );
    </script>
@stop