@extends('layouts.auth')

@section('content')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="row">
            <div class="col-sm-12 text-center">        
                    <p>Please enter the <strong>Verification Code </strong>sent to your mailbox.</p>
            </div>
        </div>
        <form class="form-horizontal" role="form" action="{{ url('/verification') }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('verification') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <input id="verification" name="verification" type="text"
                            placeholder="Enter verification code" class="form-control">

                    @if ($errors->has('verification'))
                        <span class="help-block">
                                <strong>{{ $errors->first('verification') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-default" data-dismiss="modal" href="{{ url('/resend') }}">Resend
                        Code</a>
                </div>
            </div>
        </form>
    </div>
@endsection
