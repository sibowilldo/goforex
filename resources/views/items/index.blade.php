@extends('layouts.app')

@section('content')
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Items
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Items</li>
			</ol>
		</section>

		<!-- Main Content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <a href="{{ url('items/create') }}" class="btn btn-sm pull-right btn-primary btn-social" rel="tooltip" title="View"><i class="fa fa-plus-circle"></i> Create Item
                            </a>
							<h3 class="box-title">All Items
							</h3>
						</div>
						<div class="box-body">
							<table class="nowrap table table-hover table-striped table-condensed" id="items">
								<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Price</th>
									<th>Category</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach($items as $item)
									<tr>
										<td class='hidden-350'>{{ $item->id }}</td>
										<td>{{ $item->name }}</td>
										<td>R{{ $item->price }}</td>
										<td>{{ $item->category_is }}</td>
										<td>{{ $item->status_is }}</td>
										<td>
											<a href="{{ url('items', $item->id) }}" class="btn btn-default btn-sm" rel="tooltip" title="View">
												<b>Show</b>
											</a>
											<a href="{{ url('items/'.$item->id.'/edit') }}" class="btn btn-default btn-sm" rel="tooltip"
											   title="Edit">
												<b>Edit</b>
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
            $('#items').DataTable({responsive: true});
        } );
    </script>
@stop