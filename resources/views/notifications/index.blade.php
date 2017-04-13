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
            <div class="col-md-10 col-md-offset-1">
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
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table id="notifications" class="ui table table-hover table-striped">
                    <thead class="hide">
                        <tr>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th>Message</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                  <tbody>
                @if(count($notifications) > 0)
                @foreach($notifications as $notification)
                    <tr>
                        <td><i class="fa fa-{{ $notification->viewed == 0 ? 'square text-aqua' : 'check-square text-gray' }}"></i></td>
                        <td class="mailbox-attachment"><i class="text-orange ion ion-{{ $notification->type == 'notification' ? 'android-notifications' : 'android-mail' }}"></i></td>
                        <td class="mailbox-name"><a href="{{ url('/notifications/'.$notification->id) }}">{{ $notification->reference_number }}</a></td>
                        <td class="mailbox-subject {{ $notification->viewed == 0 ? 'unread' : '' }}"><p class="truncate">{{ strip_tags($notification->message) }}</p></td>
                        <td>{{ $notification->created_at->diffForHumans() }}
                        </td>
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
        $('#notifications').DataTable();
    } );
</script>
@stop