@extends('backend.master')

@section('content')
	@include('backend.page-header', ['header'=>'Edit: '.$user->name, 'level'=>'users' ,'resource'=>'Edit'])

	<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
		            	<h3 class="box-title">Make Changes</h3>
		            </div>	

					{!! Form::model($user, ['method'=>'PATCH', 'url'=>'users/'.$user->id, 'role'=>'form']) !!}
						@include('backend.users._form', ['buttonText'=>'Update changes'])
					{!! Form::close() !!}
					
					@include('errors.forms')
				</div>
			</div>
		</div>
	</section>
@stop