@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New</h3>
                </div>
                @include('errors.forms')
                {!! Form::open(['url'=>'events', 'role'=>'form']) !!}
                @include('events._form', ['buttonText'=>'Save'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop