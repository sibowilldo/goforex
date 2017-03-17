@extends('layouts.auth')

@section('content')
    <!-- /.register-logo -->
    <div class="register-box-body">
        <h3 class="login-box-msg">Reset Password</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
                <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="has-feedback form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" placeholder="Confrim Password" type="password" class="form-control" name="password_confirmation" required>
                <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-danger">
                        Reset Password
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
