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
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{!! Form::label('start_date', 'Start Date:') !!}
				{!! Form::text('start_date', null, ['class'=>'form-control eventdatepicker']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{!! Form::label('end_date', 'End Date:') !!}
				{!! Form::text('end_date', null, ['class'=>'form-control eventdatepicker']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="bootstrap-timepicker">
					<div class="form-group">
						{!! Form::label('start_time', 'Start Time:') !!}
						{!! Form::text('start_time', null, ['class'=>'form-control timepicker']) !!}
					</div>
				</div>
			</div>
		<div class="col-md-6">
			<div class="bootstrap-timepicker">
				<div class="form-group">
					{!! Form::label('end_time', 'End Time:') !!}
					{!! Form::text('end_time', null, ['class'=>'form-control timepicker']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>