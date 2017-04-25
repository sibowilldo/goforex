@extends('layouts.emails')

@section('content')

<p> 
We've received a response from our service provider SagePay PayNow that your payment request for {{$event->name}}, amount of R{{ $event->item->price }} was declined.
<p>Please click <a href="https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace={{$transaction->requestTrace}}">here</a> or copy and paste the link below to your browser to find out why.</p><br>
<strong>Request Trace link:</strong><br>
<a href="https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace={{ $transaction->requestTrace }}">https://ws.sagepay.co.za/PayNow/TransactionStatus/Check?RequestTrace={{$transaction->requestTrace}}</a>
@endsection
