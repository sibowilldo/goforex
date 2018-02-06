@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Create a new Bank Account
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Create Bank Account</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">New Bank Account</h3>
						</div>
						{!! Form::open(['url'=>route('bank_accounts.store'), 'role'=>'form', 'files'=>'true']) !!}
						@include('errors.forms')
						<div class="box-body">
						@include('bank_accounts._form', ['buttonText'=>'Save Bank Account'])

						</div>
						<div class="box-footer">
							<button class="btn btn-primary btn-social" type="submit"><i class="io ion-checkmark-round"></i> Save Bank Account</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

		</section>
	</div>
@stop