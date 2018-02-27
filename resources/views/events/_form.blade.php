<div class="box-body">
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'eg. Durban Forex Class']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('host', 'Host:') !!}
		{!! Form::text('host', null, ['class'=>'form-control', 'placeholder' => 'eg. Ashley Hestibeer']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('address', 'Address:') !!}
		{!! Form::text('address', null, ['class'=>'form-control', 'placeholder' => 'eg. Elangeni Hotel, 63 Snell Parade, North Beach, Durban']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description', 'Description:') !!}
		{!! Form::text('description', null, ['class'=>'form-control', 'placeholder' => 'eg. Beginner\'s class']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('number_of_seats', 'Number Of Seats:') !!}
		{!! Form::number('number_of_seats', null, ['class'=>'form-control', 'placeholder' => '']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('status_is', 'Status:') !!}
		{!! Form::select('status_is', $statuses, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('bank_account_id', 'Bank Account:') !!}
		{!! Form::select('bank_account_id', $bank_accounts, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('item_id', 'Item:') !!}
		{!! Form::select('item_id', $items, null, ['class'=>'form-control']) !!}
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