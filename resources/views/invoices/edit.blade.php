@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Invoice
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Edit Invoice</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Make Changes</h3>
						</div>

						@include('errors.forms')

						{!! Form::model($invoice, ['method'=>'PATCH', 'url'=>'/invoices/'.$invoice->id, 'role'=>'form', 'files'=>'true']) !!}
						@include('invoices._form', ['buttonText'=>'Update changes'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Invoice Items</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <a href="{{ url('items', $item->id) }}" class="btn-social btn btn-sm btn-default" rel="tooltip" title="View">
                                        <i class="fa ion ion-eye"></i>	View
                                    </a>
                                    <a href="{{ url('items/'.$item->id.'/edit') }}" class="btn-social btn btn-sm btn-default" rel="tooltip"
                                       title="Edit">
                                        <i class="fa ion ion-ios-compose-outline"></i>	Edit
                                    </a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</section>
	</div>
@stop

{{--"id" => 1--}}
{{--"name" => "Adults Price"--}}
{{--"description" => "Beginners and  Advance course."--}}
{{--"price" => "7500.00"--}}
{{--"type_is" => "Product"--}}
{{--"rate_is" => "Seat"--}}
{{--"category_is" => "Training"--}}
{{--"status_is" => "Published"--}}
{{--"featured" => 0--}}
{{--"image" => null--}}
{{--"url" => null--}}
{{--"created_at" => "2017-04-01 23:02:38"--}}
{{--"updated_at" => "2017-06-01 14:39:55"--}}
{{--"pivot_invoice_id" => 5--}}
{{--"pivot_item_id" => 1--}}
{{--"pivot_quantity" => 1--}}
{{--"pivot_price" => "5000.00"--}}