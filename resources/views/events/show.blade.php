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
                <div class="col-xs-12">
                    <div class="box box-{{ $event->status_is=='Open' ? 'success' : 'danger'}}">
                        <div class="box-body">
                                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="event-chart event-seats">
                                            @if($event->status_is == 'Open')
                                                <input id="knob-{{ $event->id }}" type="text"
                                                        class="knob"
                                                        value="{{ ($event->number_of_seats - $bookings->where('status_is', 'Paid')->count()) }}"
                                                        data-thickness="0.1" data-width="120"
                                                        data-min="0"
                                                        data-max="{{ $event->number_of_seats }}"
                                                        data-height="120" data-fgColor="{{ (($bookings->where('status_is', 'Paid')->count())/$event->number_of_seats * 100) < 30 ? '#13BAFF' : '#F44336'}}"
                                                        data-readonly="true">
                                            @else
                                                <input id="knob-{{ $event->id }}" type="text"
                                                        class="knob" value="0" data-thickness="0.1"
                                                        data-width="120" data-min="0"
                                                        data-max="{{ $event->number_of_seats }}"
                                                        data-height="120" data-fgColor="#FF0000"
                                                        data-readonly="true">
                                            @endif
                                            <p class="knob-label"><strong>Available Seats</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p>
                                            <span class="btn btn-sm btn-block {{ $event->status_is == 'Open' ? 'bg-green' : 'bg-red' }}">Event is {{$event->status_is}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="event-info {{ $event->status_is }}">
                                        <span class="label bg-red pull-right">{{ $event->reference }}</span>
                                        <h3 class="event-title">{{ $event->name }} <strong>@</strong> R{{number_format($event->item->price, 2, '.', '')}}
                                        </h3>
                                        <div class="event-meta">
                                            <span><i class="fa ion ion-calendar"></i> {{ Carbon\Carbon::parse($event->start_date)->formatLocalized('%a, %d %B %Y') }} - {{ Carbon\Carbon::parse($event->end_date)->formatLocalized('%a, %d %B %Y') }}</span>
                                            <span><i class="fa ion ion-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}</span>
                                            <span><i class="fa ion ion-person"></i> {{ $event->host }}</span>
                                            <br>
                                            <span><i class="fa ion ion-location"></i> {{ $event->address }}</span>
                                            <br>
                                            <span class="event-description"><i class="fa fa-question-circle"></i> {{ $event->description }}</span>
                                            
                                <div class="text-right">
                                <a href="{{ url('events/'. $event->id .'/edit') }}" class="btn btn-default btn-social btn-sm"><i class="fa ion ion-ios-compose-outline"></i>Edit Event</a>
                                
                                @if($event->status_is == 'Pending')
                                    {!! Btn::delete($event->id, $event->name)!!}
                                @else
                                {!! Btn::delete($event->id, $event->name, 'Any booking linked to this event will also be deleted!')!!}
                                @endif
                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 text-right">
                                <span class="text-gray">Last updated: {{ $event->updated_at->format('l, F jS Y h:i:s A') }}</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><b>User Bookings </b></h3>
                               <p class="text-right">
                                @if($event->status_is == 'Open')
                                    <a href="{{ url('attendees/'. $event->id . '/add') }}"
                                                            class="btn btn-social btn-primary btn-sm"
                                                            rel="tooltip" title="View">
                                        <i class="fa ion-person-add"></i> Add Attendee
                                    </a>
                                @endif  
                                <a href="{{ url('attendees/'. $event->id .'/print') }}" class="btn btn-default btn-social btn-sm"><i class="fa ion ion-printer"></i>Print Register</a></p>
                            
                        </div>
                        <div class="box-body table-responsive">
                        
                            <table class="table table-bordered nowrap dt-responsive table-striped" id="bookings">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Date Booked</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Date Booked</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($bookings as $booking)
                                    <tr id="booking-row-{{$booking->id}}">
                                        <td>{{ $booking->user->firstname }} {{ $booking->user->lastname }}</td>
                                        <td>{{ $booking->user->email }}</td>
                                        <td>{{ $booking->user->cell }}</td>
                                        <td>{{ $booking->created_at->toDayDateTimeString() }}</td>
                                        <td>
                                            @if($booking->proof_of_payment == null)
                                                <button id="booking-{{ $booking->id }}" type="button" value="{{ $booking->event_id }}" data-userid="{{ $booking->user_id }}" data-fullname="{{ $booking->user->firstname }} {{ $booking->user->lastname }}" data-toggle="modal" data-target="#proof-modal" class="btn btn-success btn-sm btn-social btn-proof"><i class="fa ion ion-social-usd"></i>Upload Proof</button>
                                            @else
                                                <button class="btn btn-primary btn-xs btn-proof" type="button" data-toggle="collapse" data-target="#collapse-{{ $booking->reference }}" aria-expanded="false" aria-controls="collapse-{{ $booking->reference }}">
                                                Proof of Payment
                                                </button>
                                                <div class="collapse" id="collapse-{{ $booking->reference }}">
                                                    <a target="_blank" href="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}">
                                                    <img class="elevatezoom" style="width: 100%;height: auto" src="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}" data-zoom-image="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}"/></a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $booking->status_is }}</td>
                                        <td>
                                            @if($booking->status_is == 'Pending')
                                                @if($booking->proof_of_payment != null)
                                                    <a href="{{ url('booking/'.$booking->id.'/approve') }}" class="btn btn-sm btn-default"
                                                    rel="tooltip"
                                                    title="Edit" id="approve-{{ $booking->id }}">
                                                        <b>Approve</b>
                                                    </a>
                                                    <a href="{{ url('booking/'.$booking->id.'/decline') }}" class="btn btn-sm btn-danger"
                                                    rel="tooltip"
                                                    title="Edit">
                                                        <b>Decline</b>
                                                    </a>
                                                @else
                                                    <span class="btn-warning btn disabled btn-social btn-xs"
                                                    rel="tooltip"
                                                    title="Published"><i class="fa ion ion-ios-clock-outline"></i> Pending!
                                                    </span>
                                                @endif
                                            @elseif($booking->status_is == 'Paid')
                                                
                                                <span class="btn-success btn disabled btn-social btn-xs"
                                                rel="tooltip"
                                                title="Published"><i class="fa fa-check-circle"></i> Approved!
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="proof-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa ion ion-ios-close"></i></span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    {!! Form::open(['url' => 'imageUploadForm', 'id' => '#proof-form' , 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}     
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::file('image', ['class' => 'inputfile well', 'accept' => '.jpeg, .jpg, .png', 'style' => 'width: 100%']) !!}
                            </div>
                            <div class="form-group" hidden>
                                {!! Form::label('eventId') !!}
                                {!! Form::hidden('eventId', $event->id, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group" hidden>
                                {!! Form::label('userId') !!}
                                {!! Form::hidden('userId', Auth::id(), ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" id="upload-proof" class="btn btn-md btn-danger"><i class="ion ion-ios-cloud-upload-outline"></i> Upload selected file</button>
                        </div>
                    {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </section>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <!-- jQuery Knob -->
    {!! Html::script('plugins/knob/jquery.knob.js') !!}
    <script>
        $(function () {
            /* jQueryKnob */
            $(".knob").knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv) // Angle
                            ,
                            sa = this.startAngle // Previous start angle
                            ,
                            sat = this.startAngle // Start angle
                            ,
                            ea // Previous end angle
                            , eat = sat + a // End angle
                            ,
                            r = true;

                        this.g.lineWidth = this.lineWidth;

                        this.o.cursor &&
                        (sat = eat - 0.3) &&
                        (eat = eat + 0.3);

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value);
                            this.o.cursor &&
                            (sa = ea - 0.3) &&
                            (ea = ea + 0.3);
                            this.g.beginPath();
                            this.g.strokeStyle = this.previousColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });
            /* END JQUERY KNOB */
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-proof').on('click', function(e){
                var booking = $(this);
                $('.modal-title').html('Upload Proof of Payment for <strong>' + booking.attr('data-fullname') + '</strong>');
                $('#eventId').val(booking.attr('value'));
                $('#userId').val(booking.attr('data-userid'));
            });

            $('.elevatezoom').elevateZoom({
                zoomType: 'lens',
            });
            $('#bookings').DataTable();
        });
    </script>
@stop