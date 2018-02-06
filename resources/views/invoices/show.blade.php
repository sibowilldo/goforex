@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="invoice-title">
					<h2>Invoice # {{ $invoice->id }}</h2><p class="pull-right"><a href="{{ url('/invoices') }}">Back to Invoices</a></p>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Billed To:</strong><br>
							{{ $invoice->address->contact_person }}<br>
							@if(strlen($invoice->address->billing_unit)>1) {{ $invoice->address->billing_unit }}, @endif {{ $invoice->address->billing_street }}<br>
							{{ $invoice->address->billing_town }}, {{ $invoice->address->billing_city }}<br>
							{{ $invoice->address->billing_code }}
						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<strong>Posted To:</strong><br>
							{{ $invoice->address->contact_person }}<br>
							@if(strlen($invoice->address->postal_unit)>1) {{ $invoice->address->postal_unit }}, @endif {{ $invoice->address->postal_street }}<br>
							{{ $invoice->address->postal_town }}, {{ $invoice->address->postal_city }}<br>
							{{ $invoice->address->postal_code }}
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Payment Method:</strong><br>
							Please check booking confirmation email for corresponding banking details.

						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<strong>Invoice Date:</strong><br>
							{{ $invoice->created_at->format('F d, Y') }}<br><br>
							<strong>Due Date:</strong><br>
							{{ $invoice->created_at->addDays(7)->format('F d, Y') }}<br><br>
							<strong>Status:</strong><br>
							{{ $invoice->status_is }}<br>
						</address>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Invoice summary</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
								<tr>
									<td><strong>Item</strong></td>
									<td class="text-center"><strong>Price</strong></td>
									<td class="text-center"><strong>Quantity</strong></td>
									<td class="text-right"><strong>Totals</strong></td>
								</tr>
								</thead>
								<tbody>

								@foreach($invoice->items as $item)
									<tr>
										<td>{{ $item->name }}</td>
										<td class="text-center">R{{ number_format($item->pivot->price,2,'.',',') }}</td>
										<td class="text-center">{{ $item->pivot->quantity }}</td>
										<td class="text-right">R{{ number_format($item->pivot->quantity * $item->pivot->price,2,'.',',') }}</td>
									</tr>
								@endforeach

								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right">R{{ number_format($invoice->amount,2,'.',',') }}</td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Discount</strong></td>
									<td class="no-line text-right">R{{ number_format(0,2,'.',',') }}</td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>VAT @14%</strong></td>
									<td class="no-line text-right">R{{ number_format(0,2,'.',',') }}</td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Total</strong></td>
									<td class="no-line text-right">R{{ number_format($invoice->amount,2,'.',',') }}</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop