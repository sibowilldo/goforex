@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Add a new Mentor
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add a new Mentor</li>
        </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add a new Mentor</h3>
                        </div>
                        @include('errors.forms')
                        {!! Form::open(['url'=>'mentors', 'role'=>'form', 'files' => true, 'enctype'=>'multipart/form-data']) !!}
                        @include('mentors._form', ['buttonText'=>'Save Mentor'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop


@section('styles')
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css') !!}
@stop

@section('javascript')
    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.js") !!}
    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js") !!}
<script>
    $(document).ready(function() {
        $("#branch").select2();
    });
</script>
@stop