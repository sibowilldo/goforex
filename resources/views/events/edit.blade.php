@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Event
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Edit Event</li>
      </ol>
    </section>

    <section class="content">
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

    </section>
</div>
@stop

@section('styles')
  <!-- Bootstrap time Picker -->
  {!! Html::style('plugins/timepicker/bootstrap-timepicker.min.css') !!}
  <!-- bootstrap datepicker -->
  {!! Html::style('plugins/datepicker/datepicker3.css') !!}

@stop

@section('javascript')
<!-- bootstrap time picker -->
{!! Html::script('plugins/timepicker/bootstrap-timepicker.min.js') !!}
<!-- bootstrap date picker -->
{!! Html::script('plugins/datepicker/bootstrap-datepicker.js') !!}
<script>
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

    //Date picker
    $('.eventdatepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        startDate: '1d'
    });
</script>
@stop