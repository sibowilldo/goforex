@extends('layouts.app')

@section('content')
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Invoices
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">My Invoices</li>
			</ol>
		</section>

		<!-- Main Content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
							<h3 class="box-title">My Invoices</h3>
						</div>
						<div class="box-body">
							<table class="nowrap table table-hover table-striped table-condensed" id="invoices">
								<thead>
								<tr>
									<th>ID</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach($invoices as $invoice)
									<tr>
										<td class='hidden-350'>{{ $invoice->id }}</td>
										<td>R{{ $invoice->amount }}</td>
										<td>{{ $invoice->status_is }}</td>
										<td>{{ $invoice->created_at }}</td>
										<td>
											<a href="{{ url('invoices', $invoice->id) }}" class="btn btn-social btn-sm btn-default" rel="tooltip" title="View">
													<i class="fa ion ion-ios-calendar-outline"></i> View
											</a>
											<a href="{{ url('invoices/'.$invoice->id.'/print') }}" class="btn-social btn btn-sm btn-default" rel="tooltip"
											   title="Print">
												<i class="fa ion ion-printer"></i> <b>Print</b>
											</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <script>
        $(document).ready(function() {
            $('#invoices').DataTable({responsive: true});
        } );
    </script>
@stop