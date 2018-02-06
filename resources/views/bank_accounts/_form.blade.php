
<div class="form-group{{ $errors->has('account_holder') ? ' has-error' : '' }}">
	{!! Form::label('account_holder', 'Account Holder:') !!}
	{!! Form::text('account_holder', null, ['class'=>'form-control']) !!}
	@if ($errors->has('account_holder'))
		<span class="help-block">
			<strong>{{ $errors->first('account_holder') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
    {!! Form::label('account_number', 'Account Number:') !!}
    {!! Form::text('account_number', null, ['class'=>'form-control']) !!}
    @if ($errors->has('account_number'))
        <span class="help-block">
			<strong>{{ $errors->first('account_number') }}</strong>
		</span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('bank', 'Status:') !!}
    {!! Form::select('bank', $banks, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
	{!! Form::label('branch', 'Branch Code:') !!}
	{!! Form::text('branch', null, ['class'=>'form-control']) !!}
	@if ($errors->has('branch'))
		<span class="help-block">
			<strong>{{ $errors->first('branch') }}</strong>
		</span>
	@endif
</div>
<div class="form-group">
	{!! Form::label('status_is', 'Status:') !!}
	{!! Form::select('status_is', $statuses, null, ['class'=>'form-control']) !!}
</div>
