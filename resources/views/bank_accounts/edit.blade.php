@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Bank Account
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Edit Bank Account</li>
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
						{!! Form::model($bank_account, ['method'=>'PATCH', 'url'=>route('bank_accounts.update', $bank_account->id), 'role'=>'form', 'files'=>'true']) !!}
						<div class="box-body">
							@include('bank_accounts._form')
						</div>
						<div class="box-footer">
							<button class="btn btn-primary btn-sm" type="submit"><i class="ion ion-checkmark-round"></i> Save Changes</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

		</section>
	</div>
@stop