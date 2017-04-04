@extends('layouts.emails')

@section('content')

    Message from Contact us form, sent by <strong>{{ $sender }}</strong>:<br/>
    <i>{{ $bodymessage }}</i>

    <strong>From:</strong> {{ $sender }} <br>
    <strong>Email:</strong> {{ $sender_email}}
    <br/>

@endsection
