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
				<div class="col-md-10 col-md-offset-1">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">All Items
								<b>
									<a href="{{ url('items/create') }}" class="btn" rel="tooltip" title="View">[ + ]</a>
								</b>
							</h3>
						</div>
						<div class="box-body">
							<table class="ui table table-hover table-striped table-condensed" id="events">
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
											<a href="{{ url('items', $item->id) }}" class="btn" rel="tooltip" title="View">
												<b>Show</b>
											</a>
											<a href="{{ url('items/'.$item->id.'/edit') }}" class="btn" rel="tooltip"
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
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.semanticui.min.css">

	<style type="text/css">
		.ui.grid{
			margin: 0;
			padding-left: 2.5rem;
		}
		.ui.table td {
			padding: .58571429em .98571429em;
		}
		.ui.table td.unread {
			font-weight: bold;
		}
	</style>
@stop

@section('javascript')
	{{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
	{{ Html::script('https://cdn.datatables.net/1.10.13/js/dataTables.semanticui.min.js') }}
	{{ Html::script('http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js') }}

	<script>
		$(document).ready(function() {
			$('#events').DataTable();
		} );
	</script>
@stop