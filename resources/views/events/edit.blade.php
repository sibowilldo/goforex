@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Make Changes</h3>
                </div>

                @include('errors.forms')
                {!! Form::model($event, ['method'=>'PATCH', 'url'=>'events/'.$event->id, 'role'=>'form']) !!}
                @include('events._form', ['buttonText'=>'Update changes'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop