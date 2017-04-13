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
                @if(in_array(Auth::user()->id,explode(',', $event->attendees)))
                    @if($booking != null && $booking->proof_of_payment == null)
                        <div class="callout callout-danger animated fadeInDown">
                            <h4><i class="fa fa-info-circle"></i> Pending Important Document</h4>

                            <p>Hi there, we see you haven't uploaded your proof of payment as yet. Please make payment if not already made, and take a clear snapshot of your receipt and upload it on the "<a href='#proof' class='btn btn-xs btn-primary scroll'>Proof of Payment</a>" section below, you have limited time to do this.</p>
                        </div>
                    @endif
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
                            <div class="col-xs-12 text-center">
                                <h3>Proof of Payment</h3>
                                <br>
                                @if($event->status_is == 'Open')
                                    @if(in_array(Auth::user()->id,explode(',', $event->attendees)))
                                        @if($booking != null && $booking->proof_of_payment != null)
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
                                                {!! Form::file('image', ['class' => 'inputfile well', 'accept' => '.jpeg, .jpg, .png', 'style' => 'width: 100%']) !!}
                                            </div>
                                            <div class="form-group" hidden>
                                                {!! Form::label('eventId') !!}
                                                {!! Form::text('eventId', $event->id, ['class'=>'form-control']) !!}
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger btn-md"><i class="ion ion-ios-cloud-upload-outline"></i> Update file</button>
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
                                                {!! Form::file('image', ['class' => 'inputfile well', 'accept' => '.jpeg, .jpg, .png', 'style' => 'width: 100%']) !!}
                                            </div>

                                            <div class="form-group" hidden>
                                                {!! Form::label('eventId') !!}
                                                {!! Form::text('eventId', $event->id, ['class'=>'form-control']) !!}
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-danger"><i class="ion ion-ios-cloud-upload-outline"></i> Upload selected file</button>
                                            </div>
                                            @endif
                                            {!! Form::close() !!}

                                        @endif
                                    @else
                                        <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                                            class="btn btn-md btn-success"
                                            rel="tooltip"
                                            title="Reserve a seat">
                                            Book Now
                                        </a>
                                    @endif
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
<style>
    .event-header {
        position: relative;
    }

    .event-header img {
        position: relative;
        top: 0;
    }

    .event-header h1 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 5px;
        color: #fff;
        font-size: 2em;
        font-weight: 100;
        letter-spacing: -1px;
    }
.event-header h1 small{
    color: #BBBBBB;
}
    .row.event-ls > p
    i, .row.event-dt > p
    i {color: rgba(0,0,0,.3);display: inline-block;font-size: 2em;line-height: 1.5em;margin-right: .5em;background-color: #00C0EF;width: 1.5em;text-align: center;color: #fff;}

 .event-dt p strong {
        display: block;
        /* padding: 1.1em 0; */
    }
    .event-counter{
        background-image: url("{{url('img/boxed-bg.png')}}");
        background-repeat: repeat;
        background-attachment: fixed;
        background-size: 10%;
        padding: .8em 0
    }
        .event-dt i.fa{
        display: block;
        text-align: center;
        font-size: 3em;
        color: rgba(150,150,150,.3);
        margin: .3em 0;
    }

    .event-dt p{
        text-align: center;
        display: block;
        line-height: 1.5em;
    }

    .event-dt::after {
        width: 100%;
        height: 1px;
        transform: rotateY(10deg);
        box-shadow: 0 0px 0px 0px rgba(0,0,0, .5);
        background-color: rgba(0,0,0,.1);

        animation-name: expandafter;
        animation-duration: 2s;
        animation-timing-function: ease-in
    }
    /* The animation code */
    @keyframes expandafter {
        from {transform: rotateY(90deg)}
        to { transform: rotateY(10deg)}
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
@stop