@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Create a new Event
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Create Event</li>
        </ol>
        </section>

        <section class="content">
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

        </section>
    </div>
@stop