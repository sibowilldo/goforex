@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Item Changes</div>

					<div class="panel-body">
						@include('errors.forms')

						{!! Form::model($item, ['method'=>'PATCH', 'url'=>'/admin/items/'.$item->id, 'role'=>'form', 'files'=>'true']) !!}
						@include('backend.items._form', ['buttonText'=>'Update changes'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop