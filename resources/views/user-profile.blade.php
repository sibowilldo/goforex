@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Edit Profile</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">  
            <div class="col-md-6 col-md-offset-3">
            <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gold-active">
                    <h3 class="widget-user-username">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
                    <h5 class="widget-user-desc">{{ Auth::user()->email }}</h5>
                    </div>
                    <div class="widget-user-image">
                    <img class="img-circle" src="{{ url('img/all-white-bull-shield-logo.png') }}" alt="{{Auth::user()->firstname}}">
                    </div>
                    <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ count($bookings)}}</h5>
                            <span class="description-text">Bookings</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $eventsCount }}</h5>
                            <span class="description-text">Events</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">{{ Auth::user()->updated_at->diffForHumans() }}</h5>
                            <span class="description-text">Last updated</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                </div>
            <!-- /.widget-user -->
            </div>
        </div>

        @if ($errors->has('password'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->has('current_password'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="row">        
            <div class="col-md-6 col-md-offset-3">
                <div class="nav-tabs-custom" id="profiletabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#password" data-toggle="tab">Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                        
                                {!! Form::model($profile, ['method'=>'PATCH', 'url'=>'profile/'.$profile->id, 'class'=>'form-horizontal']) !!}
                                    {{ csrf_field() }}
                                    <div class="form-group row has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="firsname">First Name</label>
                                            <input id="firstname" type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ $profile->firstname }}" required autofocus>
                                            <i class="glyphicon glyphicon-user form-control-feedback"></i>
                                            @if ($errors->has('firstname'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                            @endif            
                                        </div>
                                    </div>

                                    <div class="form-group row has-feedback{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="lastname">Last Name</label>
                                            <input id="lastname" type="text" class="form-control"  placeholder="Last Name" name="lastname" value="{{ $profile->lastname }}" required autofocus>
                                            <i class="glyphicon glyphicon-user form-control-feedback"></i>
                                            @if ($errors->has('lastname'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control"  placeholder="Username" name="username" value="{{ $profile->username }}" disabled required autofocus>
                                            <i class="glyphicon glyphicon-user form-control-feedback"></i>
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row has-feedback{{ $errors->has('cell') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="cell">Contact Number (Mobile)</label>
                                            <input id="cell" type="text" class="form-control"  placeholder="Contact Number (Mobile)" name="cell" value="{{ $profile->cell }}" required autofocus>
                                            <i class="glyphicon glyphicon-phone form-control-feedback"></i>
                                            @if ($errors->has('cell'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cell') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="location">Location</label>
                                            <input id="location" type="text" class="form-control"  placeholder="Location" name="location" value="{{ $profile->location }}" required autofocus>
                                            <i class="glyphicon glyphicon-pushpin form-control-feedback"></i>
                                            @if ($errors->has('location'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="email">Email Address</label>
                                            <input id="email" type="email" class="form-control"  placeholder="E-Mail Address" name="email" value="{{ $profile->email }}" disabled required>
                                            <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                         <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="subscription" id="subscription" {{ ($profile->subscription) ? 'checked' : '' }}>
                                                Subscribe to our email communications
                                            </label>
                                         </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Update Profile
                                            </button>
                                    </div>
                                {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="password">
                        {!! Form::open(array('action' => array('UsersController@updatePassword'), 'method' => 'patch', 'class' => 'form-horizontal')) !!}

                                <div class="form-group row has-feedback{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                    <label for="current_password">Current Password</label>
                                        <input id="current_password" type="password" class="form-control"  placeholder="Current Password" name="current_password" required>
                                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                                    </div>
                                </div>

                                <div class="form-group row has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-xs-12">
                                    <label for="password">New Password</label>
                                        <input id="password" type="password" class="form-control"  placeholder="New Password" name="password" required>
                                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                                    </div>
                                </div>

                                <div class="form-group row has-feedback">
                                    <div class="col-xs-12">
                                    <label for="password_confirmation">Confirm New Password</label>
                                        <input id="password_confirmation" type="password" class="form-control"  placeholder="Confirm Password" name="password_confirmation" required>
                                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Update Password
                                        </button>
                                </div>
                                
                        {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>

    </section>
</div>
@stop

@section('styles')

<!-- iCheck -->
{{ Html::style('plugins/iCheck/all.css') }}
<style type="text/css">
    .bg-gold-active{
        background-color: #D2AB66;
    }
    .bg-gold-active *{     
        color: white;
        text-shadow: none !Important;
    }
    .widget-user-image img{
        border:none !important;
        border-radius: 0;
    }
    .widget-user-image {
        background-color: #263238;
        padding: 20px 15px 10px 15px;
        border-radius: 50%;
        border: 3px solid #fff;
        top: 55px !important;
        left: 48% !important;
    }
    .widget-user .box-footer {
        padding-top: 55px !important;
    }
</style>
@stop

@section('javascript')
    <!-- iCheck -->
    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    <script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        increaseArea: '20%' // optional
        });
    });
    </script>
    @if ($errors->has('password') || $errors->has('current_password'))
        <script>
            $('#profiletabs a[href="#password"]').tab('show');
        </script>
    @endif
@stop