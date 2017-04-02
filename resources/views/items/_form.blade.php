<div class="box-body">
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('price', 'Price:') !!}
		{!! Form::text('price', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('status_is', 'Status:') !!}
		{!! Form::select('status_is', \App\Item::$statuses, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('rate_is', 'Rate:') !!}
		{!! Form::select('rate_is', \App\Item::$rates, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('category_is', 'Category:') !!}
		{!! Form::select('category_is', \App\Item::$categories, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('type_is', 'Type:') !!}
		{!! Form::select('type_is', \App\Item::$types, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('featured', 'Featured:') !!}
		{!! Form::number('featured', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description', 'Description:') !!}
		{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>

<br>