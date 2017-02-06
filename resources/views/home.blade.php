@extends('layouts.app')

@section('content')
    @if(Auth::user()->status_is=='Active')
        @if(Auth::user()->verified==1)
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Dashboard</div>

                            <div class="panel-body">
                                Your profile is verified and complete!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" role="form" action="{{ url('/verification') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('verification') ? ' has-error' : '' }}">
                            <label for="verification" class="col-sm-8 control-label">Verification Code</label>
                            <div class="col-sm-4">
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
                            <div class="col-sm-offset-8 col-sm-8">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-default" data-dismiss="modal" href="{{ url('/resend') }}">Resend
                                    Code</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif
@endsection
