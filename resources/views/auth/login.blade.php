@extends('layouts.auth')

@section('content')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">Sign in to start your session</h3>

        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Email" required autofocus>
            <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control" name="password" required>
            <i class="glyphicon glyphicon-lock form-control-feedback"></i>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Sign in
                </button>
            </div>
            <!-- /.col -->
        </div>
        </form>
        <div class="row">
            <div class="col-xs-12 text-center">
            <br>
            <a class="btn btn-link" href="{{ route('register') }}">Create Account</a> 
            |<a class="btn btn-link" href="{{ route('password.request') }}">Reset Password</a>     
            </div>
        </div>
    </div>
@endsection
