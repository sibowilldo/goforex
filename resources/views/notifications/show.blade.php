@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Notifcation
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('/notifications') }}">Notifcations</a></li>
        <li class="active">View Notifcation</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">  
            <div class="col-md-8 col-md-offset-2">
            
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Notification</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{ $notification->reference_number }}</h3>
                <h5>From: GFX Wealth Creation Team
                  <span class="mailbox-read-time pull-right">{{ $notification->created_at->toDayDateTimeString()}}</span></h5>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{!! $notification->message !!}</p>
                <br>
                <p>Thanks.<br>Regards,<br>GFX Team</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
                <a href="{{url('/notifications')}}" class="btn btn-default"><i class="fa fa-arrow-left pull"></i> Back to Notifications</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
            </div>
        </div>
    </section>
</div>
@stop

@section('styles')
@stop

@section('javascript')
@stop