@extends('layouts.auth')

@section('content')

    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">It won't be the same without you!</h3>

        <form role="form" method="POST" action="{{ url('unsubscribe/'.$user->id.'/'.$user->code) }}">
            {{ csrf_field() }}
            
        <div class="form-group">
            <p>If you are certain that you'll be fine with us not sending you any email communications, including Event activities and Bookings, then please click the button below.</p>
            <p>But, by doing so you're simply telling us that "I, <strong>{{ $user->firstname }} {{ $user->lastname }}</strong> will hold no one accountable except for myself in case this backfires.</p>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-danger btn-block btn-flat">
                    Unsubscribe me now!
                </button>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <!-- /.col -->
            
            <div class="col-xs-12 text-center "><br><br>
                <em class="text-grey">In case you change your mind at a later stage, 
                there is a subscribe to emails option in your <a href="{{ url('profile/'.$user->id) }}">profile page</a></em>
            </div>
            <!-- /.col -->
        </div>
        </form>
        </div>
    </div>
@stop