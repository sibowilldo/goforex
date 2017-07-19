@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit {{ $user->firstname }}'s Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Edit User Profile</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">  
            <div class="col-md-6 col-md-offset-3">
            <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gold-active">
                    <h3 class="widget-user-username">{{ $user->firstname }} {{ $user->lastname }}</h3>
                    <h5 class="widget-user-desc">{{ $user->email }}</h5>
                    </div>
                    <div class="widget-user-image">
                    <img class="img-circle" src="{{ url('img/all-white-bull-shield-logo.png') }}" alt="{{$user->firstname}}">
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            <!-- /.widget-user -->
            </div>
        </div>

        <div class="row">        
            <div class="col-md-6 col-md-offset-3">
                <div class="nav-tabs-custom" id="profiletabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#user" data-toggle="tab">Profile</a></li>
                        <li><a href="#password" data-toggle="tab">Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user">
                        
                                {!! Form::model($user, ['method'=>'PATCH', 'url'=>'users/'.$user->id, 'class'=>'form-horizontal']) !!}
                                    {{ csrf_field() }}
                                    <div class="form-group row has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="firsname">First Name</label>
                                            <input id="firstname" type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ $user->firstname }}" required autofocus>
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
                                            <input id="lastname" type="text" class="form-control"  placeholder="Last Name" name="lastname" value="{{ $user->lastname }}" required autofocus>
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
                                            <input id="username" type="text" class="form-control"  placeholder="Username" name="username" value="{{ $user->username }}" {{ ($user->username == $user->email) ? '' : 'disabled' }} required autofocus>
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
                                            <input id="cell" type="text" class="form-control"  placeholder="Contact Number (Mobile)" name="cell" value="{{ $user->cell }}" required autofocus>
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
                                            <input id="location" type="text" class="form-control"  placeholder="Location" name="location" value="{{ $user->location }}" required autofocus>
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
                                            <input id="email" type="email" class="form-control"  placeholder="E-Mail Address" name="email" value="{{ $user->email }}" disabled required>
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
                                                <input type="checkbox" name="subscription" id="subscription" {{ ($user->subscription) ? 'checked' : '' }}>
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
                        {!! Form::open(array('action' => array('ProfilesController@updatePassword'), 'method' => 'patch', 'class' => 'form-horizontal')) !!}

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