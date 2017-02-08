<div class="box-body">
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('host', 'Host:') !!}
		{!! Form::text('host', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('address', 'Address:') !!}
		{!! Form::text('address', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description', 'Description:') !!}
		{!! Form::text('description', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('number_of_seats', 'Number Of Seats:') !!}
		{!! Form::number('number_of_seats', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('start_date', 'Start Date:') !!}
		{!! Form::date('start_date', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('end_date', 'End Date:') !!}
		{!! Form::date('end_date', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('start_time', 'Start Time:') !!}
		{!! Form::text('start_time', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('end_time', 'End Time:') !!}
		{!! Form::text('end_time', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>