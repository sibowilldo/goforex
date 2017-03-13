@extends('layouts.auth')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <div class="header">
            <img src="/img/logo.png" alt="GoForex"><br>
            <h1 style="color:white" class="animated fadeInDown delay-07s">GoForex <small>Wealth Creation</small></h1>
        
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">Create new account</h3>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group row has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="firstname" type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required autofocus>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif            
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="lastname" type="text" class="form-control"  placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" required autofocus>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="username" type="text" class="form-control"  placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('cell') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="cell" type="text" class="form-control"  placeholder="Contact Number (Mobile)" name="cell" value="{{ old('cell') }}" required autofocus>
                    <i class="glyphicon glyphicon-phone form-control-feedback"></i>
                    @if ($errors->has('cell'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cell') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="location" type="text" class="form-control"  placeholder="Location" name="location" value="{{ old('location') }}" required autofocus>
                    <i class="glyphicon glyphicon-pushpin form-control-feedback"></i>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="email" type="email" class="form-control"  placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required>
                    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="password" type="password" class="form-control"  placeholder="Password" name="password" required>
                    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback">
                <div class="col-xs-12">
                    <input id="password-confirm" type="password" class="form-control"  placeholder="Confirm Password" name="password_confirmation" required>
                    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                </div>
            </div>

            <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">
                        Create Account
                    </button><br><br>
                    <p>
                    
                Already have an account? <a href="{{route('login')}}">Sign in</a>
                    </p>
            </div>
        </form>
    </div>
</div>
@endsection
