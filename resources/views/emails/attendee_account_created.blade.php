@extends('layouts.emails')

@section('content')

    <p style="text-align: left; font-size: 12px">A GoForex account has been created on your behalf by our Admin. 
    <strong>Welcome to GoForex!</strong> <br>
    Please note that the account is not yet verified and as a first step please verify it by following the instructions below:<br><br>
    </p>
    <h4 style="text-align: left;">Account Verification Instructions:</h4>
    <ol style="text-align: left; font-size: 12px">
        <li style="text-align: left; font-size: 12px"><a href="{{ url('/login') }}" target="_blank">Click here to begin</a></li>
        <li style="text-align: left; font-size: 12px">Your Login Name is <strong>{{ $user->email }}</strong>  and your Password is <strong>{{ $password }}</strong> then click Sign In button.</li>
        <li style="text-align: left; font-size: 12px">You will then be redirected to the verification page where you will enter this code <strong>{{ $user->code }}</strong> and click the Submit button.</li>
        <li style="text-align: left; font-size: 12px">And you're done! :) </li>
    </ol>
    
    <p style="text-align: left; font-size: 12px">Kindly note Your Booking was created as well and the details will follow shortly.</p>
@endsection