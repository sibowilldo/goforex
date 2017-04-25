@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Add Attendee
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Attendee</li>
        </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Attendee</h3>
                        </div>
                        <div class="event-header">
                            <img src="{{ url('img/section-bg1.jpg') }}" alt="" class="img-responsive">
                            <h1 class="text-center event-title">
                                                {{ $event->name }}
                            <small><br><i class="fa fa-user"></i> <strong>{{ $event->host }}</strong></small></h1>
                        </div>
                        <div class="box-body">
                            <div class="row event-dt">
                                <div class="col-xs-4">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <p>{{ \Carbon\Carbon::parse($event->start_date)->format('l jS F Y') }} <strong>to</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('l jS F Y')  }}</p>
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa fa-clock-o"></i>
                                    <p> {{ $event->start_time }} <strong>to</strong> 
                                    {{ $event->end_time }}</p>
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa ion-ios-people"></i>
                                    <p><b>{{ ($event->number_of_seats - $bookings->count()) }}</b> {{ ($event->number_of_seats - $bookings->count()) > 1  ?'Seats' : 'Seat' }} Available <br>
                                    <strong>and</strong>
                                    {{ ($bookings->where('status_is', 'Pending')->count()) }}</b> Pending {{ ($event->number_of_seats - $bookings->count()) > 1  ?'Seats' : 'Seat' }}                                    
                                    </p>
                                </div>
                            </div>
                            <h3>Attendee's Details</h3>
                            
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#new" data-toggle="tab" aria-expanded="true">New user</a></li>
                                    <li class=""><a href="#existing" data-toggle="tab" aria-expanded="false">Existing user</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="new">
                                        <div class="callout callout-info alert-dismissable alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            Please select "Exisiting User" if the user already exists on the system.
                                        </div>
                                        {!! Form::open(['url'=>'attendees/'.$event->id.'/save', 'role'=>'form']) !!}
                                            @include('errors.forms')
                                        
                                            <div class="form-group row">
                                                <div class="col-xs-12 col-md-6">
                                                    <label for="firstname">First Name</label>
                                                    <input type="hidden" name="user" value="null">
                                                    <input value="{{ old('firstname') }}" type="text" class="form-control has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}" name="firstname"  id="firstname" placeholder="First Name">
                                                    @if ($errors->has('firstname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('firstname') }}</strong>
                                                        </span>
                                                    @endif  
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <label for="lastname">Last Name</label>
                                                    <input value="{{ old('lastname') }}" type="text" class="form-control has-feedback{{ $errors->has('lastname') ? ' has-error' : '' }}" name="lastname"  id="lastname" placeholder="Last Name">
                                                    @if ($errors->has('lastname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                        </span>
                                                    @endif  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-12 col-md-6 has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email">Email</label>
                                                    <input value="{{ old('email') }}" type="text" class="form-control" name="email"  id="email" placeholder="Email">
                                                    @if ($errors->has('firstname'))
                                                        <span class="help-email">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-xs-12 col-md-6 has-feedback{{ $errors->has('cell') ? ' has-error' : '' }}">
                                                    <label for="cell">Mobile Number</label>
                                                    <input value="{{ old('cell') }}" type="text" class="form-control" name="cell"  id="cell" placeholder="Mobile Number">
                                                    @if ($errors->has('cell'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('cell') }}</strong>
                                                        </span>
                                                    @endif               
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
                                                <label for="location">Location</label>
                                                <input value="{{ old('location') }}" type="text" class="form-control" name="location"  id="location" placeholder="Location">
                                                @if ($errors->has('location'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('location') }}</strong>
                                                    </span>
                                                @endif  
                                            </div> 
                                            <div class="form-group">
                                                <button class="btn btn-md btn-primary" type="submit">Add Attendee</button>
                                            </div>
                                        {!! Form::close() !!}   

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="existing">
                                        <div class="callout callout-info alert-dismissable alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            Can't find the user's email? They're probably not on the system, add them by clicking "New user"
                                        </div>
                                        {!! Form::open(['url'=>'attendees/'.$event->id.'/book', 'role'=>'form', 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label for="user">Search/Select Email Address</label>
                                                {!! Form::select('user', $attendees, null, ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
                                            </div>
                                            
                                            <div class="form-group">
                                                <button class="btn btn-md btn-primary" type="submit">Add Attendee</button>
                                            </div>
                                        {!! Form::close() !!}   
                                    </div>
                                <!-- /.tab-pane -->
                                </div>
                            <!-- /.tab-content -->
                            </div>
                        </div>               
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop


@section('styles')
  <!-- Bootstrap time Picker -->
  {!! Html::style('plugins/timepicker/bootstrap-timepicker.min.css') !!}
  <!-- bootstrap datepicker -->
  {!! Html::style('plugins/datepicker/datepicker3.css') !!}

@stop

@section('javascript')
<!-- bootstrap time picker -->
{!! Html::script('plugins/timepicker/bootstrap-timepicker.min.js') !!}
<!-- bootstrap date picker -->
{!! Html::script('plugins/datepicker/bootstrap-datepicker.js') !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js') !!}
<script>

    //Select2 Elements
    $(".select2").select2();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

    //Date picker
    $('.eventdatepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        startDate: '1d'
    });

    $('#start_date').datepicker().on('change', function(e){
        $('#end_date').removeAttr('disabled placeholder');
        $('#end_date').datepicker('setStartDate', $('#start_date').val());
        
        if($('#end_date').val() != ''){
            if(($('#start_date').datepicker('getDate') - $('#end_date').datepicker('getDate')) < 0 ){
                //Nothing to do here all is well
            }else{//NaN is returned if false
               $('#end_date').val($('#start_date').val());
            }
        }
        
    });

</script>
@stop