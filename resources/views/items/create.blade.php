@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Create a new Item
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Create Item</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Add New</h3>
						</div>
						@include('errors.forms')
						{!! Form::open(['url'=>'items', 'role'=>'form', 'files'=>'true']) !!}
						@include('items._form', ['buttonText'=>'Save Item'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>

		</section>
	</div>
@stop