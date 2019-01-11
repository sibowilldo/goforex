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
            <div class="col-md-8 col-md-offset-2">
            @if($event->status_is == 'Open')
                 @if($booking != null && $booking->proof_of_payment == null)
                        <div class="callout callout-danger animated fadeInDown">
                            <h4><i class="fa fa-info-circle"></i> Pending Important Document</h4>

                            <p>Hi there, we see you haven't uploaded your proof of payment as yet. Please make payment if not already made, and take a clear snapshot of your receipt and upload it on the "<a href='#proof' class='btn btn-xs btn-primary scroll'>Proof of Payment</a>" section below, you have limited time to do this.</p>
                        </div>
                @endif
            @endif
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-success">
                <div class="event-header">
                    <img src="{{ url('img/section-bg1.jpg') }}" alt="" class="img-responsive">
                    <h1 class="text-center event-title">
                                        {{ $event->name }}
                    <small><br>Hosted by: <strong>{{ $event->host }}</strong></small></h1>
                </div>
                    <div class="box-body">
                    <div class="row event-dt">
                        <div class="col-xs-4">
                            <i class="fa fa-calendar-check-o"></i>
                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('l jS F Y') }} <strong>to</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('l jS F Y')  }}</p>
                        </div>
                        <div class="col-xs-4">
                            <i class="fa fa-clock-o"></i>
                            <p> {{ $event->start_time }} <strong>to</strong> 
                             {{ $event->end_time }}</p>
                        </div>
                        <div class="col-xs-4">
                            <i class="fa fa-map-marker"></i>
                            <p>{{ $event->address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 event-description text-center">
                            <h3>About</h3>
                            <p>{{ $event->description }}</p>
                        </div>
                        <div class="col-xs-12">
                            <h3>Meta</h3>
                            <table class="table table-striped tabe-condensed">
                                <tr>
                                    <td>Reference No.</td>
                                    <td>{{ $event->reference }}</td>
                                </tr>
                                <tr>
                                    <td>Max. seats</td>
                                    <td>{{ $event->number_of_seats }}</td>
                                </tr>
                                <tr>
                                    <td>Event Created</td>
                                    <td>{{ $event->created_at->toFormattedDateString() }}</td>
                                </tr>
                                <tr>
                                    <td>Last Updated</td>
                                    <td>{{ $event->updated_at->toFormattedDateString() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row" data-countdown="{{ \Carbon\Carbon::parse($event->start_date . ' ' . $event->start_time) }}">
                        <div class="col-xs-12 text-center">
                        <div class="event-counter">
                                                    <h3>Starts in</h3>
                                                    <br>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 col-md-3  text-center">
                                    <input id="days" type="text" class="knob" value="0"
                                            data-thickness="0.2" data-width="100" data-min="0"
                                            data-max="{{ $event->created_at->diffInDays(\Carbon\Carbon::parse($event->start_date), false) }}"
                                            data-height="100" data-fgColor="#F44336"
                                            data-readonly="true">
                                    <p class="knob-label">Days</p>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-md-3  text-center">
                                    <input id="hours" type="text" class="knob" value="0"
                                            data-thickness="0.2" data-width="100" data-min="0"
                                            data-max="24"
                                            data-height="100" data-fgColor="#FF9800"
                                            data-readonly="true">
                                    <p class="knob-label">Hours</p>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-md-3  text-center">
                                    <input id="minutes" type="text" class="knob" value="0"
                                            data-thickness="0.2" data-width="100" data-min="0"
                                            data-max="60"
                                            data-height="100" data-fgColor="#13BAFF"
                                            data-readonly="true">
                                    <p class="knob-label">Minutes</p>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-md-3 text-center">
                                    <input id="seconds" type="text" class="knob" value="0"
                                            data-thickness="0.2" data-width="100" data-min="0"
                                            data-max="60"
                                            data-height="100" data-fgColor="#4CAF50"
                                            data-readonly="true">
                                    <p class="knob-label">Seconds</p>
                                </div>
                            </div>
                        </div>

                            
                        </div>
                    </div>
                    </div>
                    <div class="box-footer">
                        <div class="row" id="proof">
                            <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                                <h3>Proof of Payment</h3>
                                @if($event->status_is == 'Open')
                                    @if($booking != null && $booking->user_id == Auth::id() && $booking->event_id == $event->id)
                                        @if($booking != null && $booking->proof_of_payment != null)
                                            <div class="form-group">
                                                <img src="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}" class="img-responsive img-thumbnail"/>
                                            </div>
                                            @if($booking->status_is != 'Paid')
                                            {!! Form::open(['url' => 'imageUploadForm', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                                                <div class="form-group">
                                                    {!! Form::file('image', ['class' => 'inputfile well', 'accept' => '.jpeg, .jpg, .png', 'style' => 'width: 100%']) !!}
                                                </div>
                                                <div class="form-group" hidden>
                                                    {!! Form::label('eventId') !!}
                                                    {!! Form::text('eventId', $event->id, ['class'=>'form-control']) !!}
                                                </div>
                                                <div class="form-group" hidden>
                                                    {!! Form::label('userId') !!}
                                                    {!! Form::text('userId', Auth::id(), ['class'=>'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger btn-md"><i class="ion ion-ios-cloud-upload-outline"></i> Update file</button>
                                                </div>
                                            {!! Form::close() !!}
                                            @endif
                                        @else
                                            @if($booking->status_is != 'Paid')

                                                <div class="panel panel-bordered">
                                                    <span class="ribbon ribbon-reverse ribbon-{{ $booking->payment_attachment != null ? 'success' : 'danger'}}">
                                                        <span class="ribbon-inner">{{ $booking->payment_attachment !=null ? 'Has Attachment' : 'No Attachment'}}</span>
                                                    </span>
                                                    <div class="panel-body">
                                                        {!! Form::open(['method'=> 'post',  'url' => '/bookings/'. $booking->id .'/attachment/upload', 'id' => '#upload-form' , 'class' => 'form mb-0 dropzone', 'novalidate' => 'novalidate', 'files' => true, 'enctype'=>'multipart/form-data']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                    <a href="{{ url('/booking/create-event-booking/'.$event->id) }}" class="btn btn-social btn-success btn-sm" rel="tooltip" title="Edit">
                                        <i class="ion ion-ios-compose-outline"></i> Book this Event
                                    </a>
                                    @endif
                                @else
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Event Status</span>
                                    <span class="info-box-number">{{ $event->status_is }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop


@section('styles')
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/basic.min.css") !!}
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css") !!}
    <style>
        .avatar-lg {
            width: 100px;
        }
        .page-user .page-content form {
            margin-bottom: 40px;
        }

        .page-user .page-content .list-group-item {
            padding: 25px 0;
            border-top-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item:first-child {
            border-top-color: transparent;
        }

        .page-user .page-content .list-group-item:last-child {
            border-bottom-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item .media-heading > small {
            margin-left: 10px;
        }

        .page-user .page-content .list-group-item p {
            margin-bottom: 5px;
        }

        .page-user .page-content .nav-tabs-horizontal {
            position: relative;
        }

        .page-user .page-content .page-user-sortlist {
            position: absolute;
            top: 5px;
            right: 0;
            z-index: 2;
        }

        @media (max-width: 991px) {
            .page-user .page-content .page-user-sortlist {
                top: -15px;
            }
        }

        @media (max-width: 479px) {
            .page-user .page-content .list-group-item .media-body {
                display: block;
                text-align: center;
            }
            .page-user .page-content .list-group-item .media-body {
                width: auto;
            }
            .page-user .page-content .list-group-item .media-body {
                margin-top: 15px;
            }
            .page-user .page-content .tab-content nav {
                text-align: center;
            }
        }

    </style>
@stop

@section('javascript')
    <!-- jQuery Knob -->
    {!! Html::script('plugins/knob/jquery.knob.js') !!}
    <!-- ChartJS 1.0.1 -->
    {!! Html::script('plugins/chartjs/Chart.min.js') !!}
    <!-- jQuery Countdown -->
    {!! Html::script('plugins/jcountdown/jquery.countdown.min.js') !!}
   
    <script>

        window.onload = function(){
            $('[data-countdown]').each(function() {
                var $this = $(this), finalDate = $(this).data('countdown');
                // if (event.strftime('%D days %H:%M:%S') == '00 days 00:00:00'){
                //     // call ajax method to block user
                // }else {
                $this.countdown(finalDate, function (event) {
                    $('#days').val(event.strftime('%D')).trigger('change');
                    $('#hours').val(event.strftime('%H')).trigger('change');
                    $('#minutes').val(event.strftime('%M')).trigger('change');
                    $('#seconds').val(event.strftime('%S')).trigger('change');
                });
                // }
            });
                // Smooth scroll

            $('.scroll').bind('click', function (event) {
                var $anchor = $(this);

                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1500, 'linear');

                event.preventDefault();
            });
        };


        $(function () {
            /* jQueryKnob */
            $(".knob").knob({
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


    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js") !!}
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        Dropzone.options.uploadForm = {}

        $(document).ready(function(){

            $('.dropzone').dropzone({
                dictDefaultMessage: '<h5>Upload attachment...</h5> <br> Accepted file types (.jpg, .jpeg, .png, .gif, .pdf)',
                acceptedFiles: 'image/*, application/pdf',
                maxFilesize: 2,
                maxFiles : 1,
                init: function() {
                    this.on("success", function(file, response) {
                        toastr.success('Attachment uploaded successfully!');
                        $('#download_link').attr('disabled', 'disabled').addClass('disabled').text('Link updated, Please refresh page');
                    }),
                        this.on("error", function(file, response, errorMessage) {
                            console.log('file '+file + ' Response: ' + response + ' ErrorMessage: ' + errorMessage );
                            toastr.error(response, 'Could not upload attachment');
                        }),
                        this.on("info", function(file, response) {
                            toastr.info(response);
                        })
                }
            });
        });
    </script>
@stop