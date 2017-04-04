@extends('layouts.emails')

@section('content')

    We regret to inform you that your booking of <b>Ref#{{ $booking_ref }}</b> has been declined.<br/><br/>

    If you are still interested in attending the event please create another booking if seats are still available.<br/>

@endsection
