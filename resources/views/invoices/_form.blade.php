<div class="box-body">
	<div class="form-group">
		{!! Form::label('amount', 'Amount:') !!}
		{!! Form::text('amount', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('discount', 'Discount:') !!}
		{!! Form::text('discount', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('status_is', 'Status:') !!}
		{!! Form::select('status_is', \App\Invoice::$statuses, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('notes', 'Notes:') !!}
		{!! Form::textarea('Notes', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>

<br>