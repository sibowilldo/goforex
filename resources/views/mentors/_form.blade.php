<div class="box-body">
	<div class="form-group">
		{!! Form::label('firstname', 'First Name:') !!}
		{!! Form::text('firstname', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('lastname', 'Last Name:') !!}
		{!! Form::text('lastname', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('contact_number', 'Contact Number:') !!}
		{!! Form::text('contact_number', null, ['class'=>'form-control', 'placeholder' => 'eg. 012 345 6789']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('branch', 'Branch/es:') !!}
		{!! Form::select('branch[]', $branches, null, ['class'=>'form-control', 'multiple'=>true, 'id' => 'branch']) !!}
	</div>
		@isset($mentor)
		<div class="form-group">
		<img class="profile-user-img img-responsive img-circle" style="margin: 0 0" src="{{ url($mentor->image_path . 'thumb_'. $mentor->image) }}" alt="GoForex : {{ $mentor->firstname }} {{ $mentor->lastname }}">

		</div>
		@endisset
	<div class="form-group">
		{!! Form::label('image', 'Change Image:') !!}
		{!! Form::file('image',['class'=>'filestyle', 'data-buttonText' => 'Choose Image', 'data-buttonname' => 'btn-primary', 'data-iconname' => 'ion ion-image']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('status_is', 'Status:') !!}
		{!! Form::select('status_is', $statuses, null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>