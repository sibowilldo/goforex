@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        View Event
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Event</li>
    </ol>
    </section>
    <section class="content">
    
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box">
                    <div class="box-content">
                        <table id="user" class="table table-bordered table-striped table-force-topborder"
                               style="clear: both">
                            <tbody>
                            <tr>
                                <td width="25%">Reference</td>
                                <td width="50%">
                                    {{ $event->reference }}
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">Name</td>
                                <td width="50%">
                                    {{ $event->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Host</td>
                                <td>
                                    {{ $event->host }}
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {{ $event->address }}
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>
                                    {{ $event->description }}
                                </td>
                            </tr>
                            <tr>
                                <td>Number Of Seats</td>
                                <td>
                                    {{ $event->number_of_seats }}
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>
                                    {{ $event->start_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td>
                                    {{ $event->end_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Start Time</td>
                                <td>
                                    {{ $event->start_time }}
                                </td>
                            </tr>
                            <tr>
                                <td>End Time</td>
                                <td>
                                    {{ $event->end_time }}
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    {{ $event->status_is }}
                                </td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>
                                    {{ $event->created_at }}
                                </td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td>
                                    {{ $event->updated_at }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($event->status_is == 'Open')
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-info">
                    <div class="box-header">
                    <h3 class="box-title">Upload Proof of Payment <small>(Allowed file types: jpg, jpeg, png)</small></h3>
                    </div>
                        <div class="box-body">
                            @if(in_array(Auth::user()->id,explode(',', $event->attendees)))
                                @if($booking != null && $booking->proof_of_payment != null)
                                    {{--{{ $img }}--}}
                                    {{--<img src="proofOfPayment/{{ $booking->id }}">--}}
                                    <div class="form-group">
                                        <img src="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}" class="img-thumbnail"/>
                                    </div>
                                    {!! Form::open(
                                                array(
                                                    'url' => 'imageUploadForm',
                                                    'class' => 'form',
                                                    'novalidate' => 'novalidate',
                                                    'files' => true)) !!}

                                    @if($booking->status_is != 'Paid')
                                    <div class="form-group">
                                        {!! Form::file('image', ['class' => 'inputfile', 'accept' => '.jpeg, .jpg, .png']) !!}
                                    </div>
                                    <div class="form-group" hidden>
                                        {!! Form::label('eventId') !!}
                                        {!! Form::text('eventId', $event->id, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"><i class="ion ion-ios-cloud-upload-outline"></i> Update file</button>
                                    </div>
                                    @endif
                                    {!! Form::close() !!}

                                @else

                                    {!! Form::open(
                                                array(
                                                    'url' => 'imageUploadForm',
                                                    'class' => 'form',
                                                    'novalidate' => 'novalidate',
                                                    'files' => true)) !!}

                                    @if($booking->status_is != 'Paid')
                                    <div class="form-group">
                                        {!! Form::file('image', ['class' => 'inputfile', 'accept' => '.jpeg, .jpg, .png']) !!}
                                    </div>

                                    <div class="form-group" hidden>
                                        {!! Form::label('eventId') !!}
                                        {!! Form::text('eventId', $event->id, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"><i class="ion ion-ios-cloud-upload-outline"></i> Upload selected file</button>
                                    </div>
                                    @endif
                                    {!! Form::close() !!}

                                @endif

                        </div>
                        @else
                            <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                               class="btn"
                               rel="tooltip"
                               title="Edit">
                                <b>Book Now</b>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </section>
</div>
@stop