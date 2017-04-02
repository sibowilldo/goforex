@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				View Item
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">View Item</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="box">
						<div class="box-content">
							<table id="item" class="table table-bordered table-striped table-force-topborder" style="clear: both">
								<tbody>
								<tr>
									<td width="25%">Name</td>
									<td width="50%">
										<a href="{{ url('items/'.$item->id.'/edit') }}">{{ $item->name }}</a>
									</td>
								</tr>
								<tr>
									<td>Price</td>
									<td>
										R{{ $item->price }}
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td>
										{{ $item->status_is }}
									</td>
								</tr>
								<tr>
									<td>Created On</td>
									<td>
										{{ $item->created_at }}
									</td>
								</tr>
								<tr>
									<td>Modified On</td>
									<td>
										{{ $item->updated_at }}
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@stop