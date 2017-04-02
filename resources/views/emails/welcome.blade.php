@extends('layouts.emails')

@section('content')
    <h3>Hi,{{ $username }}</h3>
    <p>You have successfully registered with GoForex.</p>
    <p><h4>Here are your registration details.</h4></p>
    <p>Full Name: <b>{{ $fullname }}</b></p>
    <p>Cell No: <b>{{ $cell }}</b></p>
    <p>Reference Number: <b>{{ $reference }}</b></p>
    <p>Location: <b>{{ $location }}</b></p>
    <p>Username: <b>{{ $username }}</b></p>
    <p>Password: <b>{{ $password }}</b></p>
    <br/>
    <p>Here is you verification code <b>{{ $code }}</b> which will verify and complete your online profile.</p>

    <p>Kind Regards,<br/>
        <b>GoForex</b>
    </p>
@endsection