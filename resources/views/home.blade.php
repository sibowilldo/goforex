@extends('layouts.app')

@section('content')
    @if(Auth::user()->status_is=='Active')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content --> 
                    <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon ion ion-ios-information-outline"></i> Important!</h4>
                            Please note: upon booking an event (reserving a seat) you are required to make payment and upload the proof of payment with in <strong>12</strong> hours, otherwise your reservation will be cancelled and you will be required to make the reservation again should seats be available. Thank you!
                        </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Open Events</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    @if(Auth::user()->hasRole('admin'))
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="ion ion-ios-gear"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ url('/events') }}">View All Events</a></li>
                                                <li><a href="{{ url('/events/create') }}">Create an Event</a></li>
                                            </ul>
                                        </div>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                    @endif
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="events-list product-list-in-box">
                                    @foreach($allEvents as $event)
                                        @if($event->status_is == "Open")
                                            <li class="item">
                                                <div class="loader-seat-container">
                                                    <div class="loader"></div>
                                                    <p>Loading Seats...</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="event-chart">
                                                            @if(count(explode(',', $event->attendees)) > 0 && explode(',', $event->attendees)[0] != "")
                                                                <input id="knob-{{ $event->id }}" type="text"
                                                                       class="knob"
                                                                       value="{{($event->number_of_seats - count(explode(',', $event->attendees)))}}"
                                                                       data-thickness="0.2" data-width="100"
                                                                       data-min="0"
                                                                       data-max="{{ $event->number_of_seats }}"
                                                                       data-height="100" data-fgColor="#3c8dbc"
                                                                       data-readonly="true">
                                                            @else
                                                                <input id="knob-{{ $event->id }}" type="text"
                                                                       class="knob" value="0" data-thickness="0.2"
                                                                       data-width="100" data-min="0"
                                                                       data-max="{{ $event->number_of_seats }}"
                                                                       data-height="100" data-fgColor="#3c8dbc"
                                                                       data-readonly="true">
                                                            @endif
                                                            <p class="knob-label">Available Seats</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="event-info">
                                                            <span class="label label-success pull-right">{{ $event->status_is }}</span>
                                                            <h3 class="event-title no-margin">{{ $event->name }} <br>
                                                                <small>with <strong>{{ $event->host }}</strong></small>
                                                            </h3>
                                                            <p>Event Reference: <span
                                                                        style="text-decoration: underline;"
                                                                        class="copy">{{ $event->reference }}</span></p>
                                                            <span class="event-description">
                                    <strong>Starts </strong> {{ Carbon\Carbon::parse($event->start_date)->formatLocalized('%A %d %B %Y') }} @ {{ $event->start_time }}
                                                                <br/>
                                    <strong>Ends</strong> {{ Carbon\Carbon::parse($event->end_date)->formatLocalized('%A %d %B %Y') }} @ {{ $event->end_time }}
                                                                <br>
                                    <strong>Location</strong> {{ $event->address }}
                                  </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <br>
                                                        <br>
                                                        <p class="pull-right">
                                                            <a href="{{ url('view-event', $event->id) }}"
                                                               class="btn btn-default"
                                                               rel="tooltip" title="View">
                                                                <i class="ion ion-ios-calendar-outline"></i> View Event
                                                            </a>
                                                            @if($event->status_is == 'FullyBooked' || $event->number_of_seats == count(explode(',',$event->attendees)))
                                                                <button type="button" class="btn btn-disabled" disabled>
                                                                    Fully Booked
                                                                </button>
                                                            @elseif($event->status_is == 'Open')
                                                                @if(in_array(Auth::user()->id,explode(',', $event->attendees)))
                                                                    @foreach($bookings as $booking)
                                                                        @if($booking->event_id == $event->id AND $booking->user_id == Auth::id())
                                                                            @if($booking->status_is == 'Paid')
                                                                                <span class="btn btn-success btn-disabled"
                                                                                      disabled><i
                                                                                            class="ion ion-ios-checkmark-outline"></i> Booking Approved</span>
                                                                            @elseif($booking->status_is == 'Pending')
                                                                                    <button class="btn btn-danger btn-disabled" disabled title="Time remaining to make payment" data-toggle="tooltip" data-placement="top"><i class="ion ion-ios-clock-outline"></i> <span data-countdown="{{ $booking->created_at->addHours(12) }}"></span></button>
                                                                            @else
                                                                                <span class="btn btn-danger btn-disabled"
                                                                                      disabled><i
                                                                                            class="ion ion-ios-clock-outline"></i> Booking {{ $booking->status_is }}</span>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                                                                       class="btn btn-danger btn-sm"
                                                                       rel="tooltip"
                                                                       title="Edit">
                                                                        <i class="ion ion-ios-compose-outline"></i> Book
                                                                        Event
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- /.item -->
                                        @endif
                                    @endforeach
                                    @if($events->where('status_is', 'Open')->count() < 1)
                                        <li class="item">
                                            <h1 class="text-center text-gray">
                                                <i class="ion ion-ios-information-outline"></i><br>No events to display
                                                <br>
                                                @if(Auth::user()->hasRole('admin'))
                                                    <a href="{{url('events/create')}}" class="btn btn-default btn-sm">Create
                                                        Event</a>
                                                @endif
                                            </h1>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- ./box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <!-- Right col -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Passed Events</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>

                                    @if(Auth::user()->hasRole('admin'))
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                    class="fa fa-times"></i></button>
                                    @endif
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="events-list product-list-in-box">
                                    @foreach($allEvents as $event)
                                        @if($event->status_is == "Closed")
                                            <li class="item bg-gray-light">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="event-chart">
                                                            <input type="text" class="knob" value="0"
                                                                   data-thickness="0.2" data-width="100" data-min="0"
                                                                   data-max="{{ $event->number_of_seats }}"
                                                                   data-height="100" data-fgColor="#3c8dbc"
                                                                   data-readonly="true">
                                                            <p class="knob-label">Available Seats</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="event-info">
                                                            <span class="label label-danger pull-right">{{ $event->status_is }}</span>
                                                            <h3 class="event-title no-margin">{{ $event->name }} <br>
                                                                <small>with <strong>{{ $event->host }}</strong></small>
                                                            </h3>
                                                            <p>Event Reference: <span
                                                                        style="text-decoration: underline;"
                                                                        class="copy">{{ $event->reference }}</span></p>
                                                            <span class="event-description">
                                    <strong>Started </strong> {{ Carbon\Carbon::parse($event->start_date)->formatLocalized('%A %d %B %Y') }} @ {{ $event->start_time }}
                                                                <br/>
                                    <strong>Ended</strong> {{ Carbon\Carbon::parse($event->end_date)->formatLocalized('%A %d %B %Y') }} @ {{ $event->end_time }}
                                                                <br>
                                    <strong>Location</strong> {{ $event->address }}
                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6 text-center">
                                                                {{ sprintf("%02d", count(explode(',', $event->attendees))) }}
                                                                <br>
                                                                <strong>ATTENDEES</strong>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                {{ sprintf("%02d", App\Booking::where('event_id', $event->id)->count()) }}
                                                                <br>
                                                                <strong>BOOKINGS</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="text-right">
                                                            <a href="{{ url('view-event', $event->id) }}"
                                                               class="btn btn-default"
                                                               rel="tooltip" title="View">
                                                                <i class="ion ion-ios-calendar-outline"></i> View Event
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- /.item -->
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    @endif

@endsection

@section('styles')
    <style>
        .item {
            position: relative;
        }

        .loader-seat-container {
            z-index: 99999;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            border-radius: 3px;
        }

        .loader {
            border: 5px solid transparent;
            border-radius: 50%;
            border-top: 5px solid #D2AB66;
            display: inline-block;
            width: 50px;
            height: 50px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin-top: 10%;
            border-bottom: 5px solid #D2AB66
        }

        .loader-seat-container p {
            color: #D2AB66
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg)
            }
            100% {
                -webkit-transform: rotate(360deg)
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg)
            }
            100% {
                transform: rotate(360deg)
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
                    $this.html(event.strftime('%H:%M:%S'));
                });
                // }
            });
        };


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

        //update knobs
        setInterval(function () {
            if (document.hasFocus()) {
                $.get('/ajax/knobs', function (data) {
                    $.each(data.data, function (i, v) {
                        $('#knob-' + v.id).val(v.number_of_seats - (v.attendees == '' ? 0 : (v.attendees).split(',').length));
                    });
                });
            }
        }, 3000);

        $(document).ready(function(){
            $('.loader-seat-container').fadeOut('normal', function () {
                $(this).remove();
            });
        });
    </script>
@stop