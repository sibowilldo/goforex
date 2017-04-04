@extends('layouts.emails')

@section('content')

    This is a message from Contact us form, sent by <strong>{{ $sender }}</strong>:<br/><br>
    <i>{{ $bodymessage }}</i><br><br>

    <strong>From:</strong> {{ $sender }} <br>
    <strong>Email:</strong> {{ $sender_email}}
    <br/>

@endsection
