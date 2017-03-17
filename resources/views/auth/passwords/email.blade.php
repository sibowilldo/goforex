@extends('layouts.auth')

@section('content')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">Reset your password</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="row has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>
                    </div>    
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-xs-12 text-center">
                - OR -
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/login') }}" class="btn btn-link">Login</a>|<a href="{{ url('/register') }}" class="btn btn-link">Register</a>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
@endsection
