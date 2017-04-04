@extends('layouts.emails')

@section('content')
    You have successfully registered with GoForex. <br>Here are your registration details:<br><br>

    <p style="font-size: 12px; line-height: 15px;">
        Full Name: <b>{{ $fullname }}</b><br>
        Cell No: <b>{{ $cell }}</b><br>
        Reference Number: <b>{{ $reference }}</b><br>
        Location: <b>{{ $location }}</b><br>
        Username: <b>{{ $username }}</b><br>
        Password: <b>{{ $password }}</b><br><br/>
    </p>

    Here is you verification code <b>{{ $code }}</b> which will verify and complete your online profile.<br>
@endsection