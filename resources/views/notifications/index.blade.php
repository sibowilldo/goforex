@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notifications
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Notifications</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">  
            <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Notifications</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback text-gray">
                    {{count($notifications)}} Notification(s)
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
                <table id="notifications" class="nowrap table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th>Read/Unread</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                  <tbody>
                @if(count($notifications) > 0)
                @foreach($notifications as $notification)
                    <tr><td class="mailbox-name"><a href="{{ url('/notifications/'.$notification->id) }}">{{ $notification->reference_number }}</a></td>
                        <td class="mailbox-subject {{ $notification->viewed == 0 ? 'unread' : '' }}"><p class="truncate">{{ strip_tags($notification->message) }}</p></td>
                        <td>{{ $notification->created_at->diffForHumans() }}
                        </td>
                        <td><i class="fa fa-{{ $notification->viewed == 0 ? 'square text-aqua' : 'check-square text-gray' }}"></i> {{ $notification->viewed == 0 ? 'Unread' : 'Read' }}</td>
                        <td class="mailbox-attachment"><i class="text-orange ion ion-{{ $notification->type == 'notification' ? 'android-notifications' : 'android-mail' }}"></i></td>
                        
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2 class="text-gray text-center">Nothing to see here! :) Yet...</h2></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                  </tbody>
                </table>
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
            $('#notifications').DataTable({responsive: true});
        } );
    </script>
@stop