@extends('layouts.app')

@section('content')
    <?php $greetings = ['What\'s up', 'Hola', 'Greetings', 'Howdy there']; ?>
    @if(Auth::user()->status_is=='Active')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    {{ $greetings[rand(0,3)] }} {{ \Auth::user()->firstname }}, welcome!
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            
            <!-- Main content --> 
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon ion ion-ios-information-outline"></i> Important!</h4>
                            Please note: Upon booking an event (reserving a seat) you are required to make payment and upload the proof of payment within <strong>12</strong> hours, otherwise your reservation will be cancelled and you will be required to make the reservation again should seats be available. Thank you!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                EVENTS
                                </h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    @if(Auth::user()->hasRole('admin'))
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-wrench"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ url('events/create') }}"> Create Event</a></li>
                                                <li><a href="{{ url('events/') }}">Show All events</a></li>
                                            </ul>
                                    </div>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    @endif
                                </div>{{-- box-tools pull-right --}}
                            </div> 
                            <div class="box-body"> 
                                <p class="btn-group btn-group-sm pull-right" id="filters">
                                    <span class="btn btn-default">Filter</span>
                                    <a href="#!" data-filter="*"  class="btn btn-danger">All</a> 
                                    <a href="#!" data-filter=".Open"  class="btn btn-danger active">Open</a>
                                    <a href="#!" data-filter=".FullyBooked"  class="btn btn-danger">Fully Booked</a>
                                    <a href="#!" data-filter=".Closed"  class="btn btn-danger">Closed</a>            
                                </p>  
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul class="list-group isotope" id="event-wrap">
                                        @foreach($events as $event)
                                            <li class="list-group-item event-item {{ $event->status_is}} isotope-item">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="event-chart event-seats">
                                                                    @if($event->status_is == "Open")
                                                                        <input id="knob-{{ $event->id }}" type="text"
                                                                                class="knob"
                                                                                value="{{($event->number_of_seats - $bookings->where('event_id', $event->id)->where('status_is', 'Paid')->count())}}"
                                                                                data-thickness="0.1" data-width="80"
                                                                                data-min="0"
                                                                                data-max="{{ $event->number_of_seats }}"
                                                                                data-height="80" data-fgColor="#13BAFF"
                                                                                data-readonly="true">
                                                                    @else
                                                                        <input id="knob-{{ $event->id }}" type="text"
                                                                                class="knob" value="0" data-thickness="0.1"
                                                                                data-width="80" data-min="0"
                                                                                data-max="{{ $event->number_of_seats }}"
                                                                                data-height="80" data-fgColor="#13BAFF"
                                                                                data-readonly="true">
                                                                    @endif
                                                                    <p class="knob-label"><strong>Available Seats</strong></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 event-status">
                                                                <p>
                                                                <span class="btn btn-sm btn-block {{ $event->status_is == 'Open' ? 'bg-green' : 'bg-red' }}">Event is {{$event->status_is}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-9">
                                                        <div class="event-info {{ $event->status_is }}">
                                                            <span class="label bg-red pull-right">{{ $event->reference }}</span>
                                                            <h3 class="event-title">{{ $event->name }} <strong>@</strong> R{{number_format($event->item->price, 2, '.', '')}}
                                                            </h3>
                                                            <p class="event-meta">
                                                                <span><i class="fa ion ion-calendar"></i> {{ Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}</span>
                                                                <span><i class="fa ion ion-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}</span>
                                                                <span><i class="fa ion ion-person"></i> {{ $event->host }}</span>
                                                                <br>
                                                                <span><i class="fa ion ion-location"></i> {{ $event->address }}</span>
                                                                <br>
                                                                <span class="event-description"><i class="fa fa-question-circle"></i> {{ $event->description }}</span>
                                                            </p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-9 col-md-offset-3 text-right">
                                                    
                                                        <div class="event-action">
                                                            <a href="{{ url('view-event', $event->id) }}"
                                                                                    class="btn btn-social btn-default btn-sm"
                                                                                    rel="tooltip" title="View">
                                                                <i class="ion ion-ios-calendar-outline"></i> View Event
                                                            </a>
                                                            @if(Auth::user()->hasRole('admin'))
                                                            <a href="{{ url('events/'. $event->id) }}"
                                                                                    class="btn btn-social btn-default btn-sm"
                                                                                    rel="tooltip" title="View">
                                                                <i class="fa fa-calendar-check-o"></i> View Bookings
                                                            </a>
                                                            @if($event->status_is == 'Open' AND $bookings->where('event_id', $event->id)->count() < $event->number_of_seats)
                                                                <a href="{{ url('attendees/'. $event->id . '/add') }}"
                                                                                        class="btn btn-social btn-primary btn-sm"
                                                                                        rel="tooltip" title="View">
                                                                    <i class="fa ion-person-add"></i> Add Attendee
                                                                </a>
                                                            @endif                                         
                                                            @else
                                                            
                                                            @if($event->status_is == 'FullyBooked' || $event->number_of_seats == count(explode(',',$event->attendees)))
                                                                <button type="button" class="btn btn-social btn-disabled btn-sm" disabled>
                                                                   <i class="fa ion ion-ios-checkmark"></i> Fully Booked
                                                                </button>
                                                            @elseif($event->status_is == 'Open')
                                                                @if($bookings->where('user_id', Auth::id())->count() > 0)
                                                                    @foreach($bookings->where('user_id', Auth::id()) as $booking)
                                                                        @if($booking->event_id == $event->id)
                                                                            @if($booking->status_is == 'Paid')
                                                                                <span class="btn btn-social btn-success btn-disabled btn-sm" disabled><i class="ion ion-ios-checkmark-outline"></i> Booking Approved</span>
                                                                            @elseif($booking->status_is == 'Pending')
                                                                                <a class="btn btn-social btn-success btn-sm" href="{{ url('view-event', $event->id) }}" title="Proof of Payment" data-toggle="tooltip" data-placement="top"><i class="ion ion-social-usd"></i> {{ $booking->proof_of_payment == null ? 'Upload of Payment' : 'Update file'}}</a>
                                                                            @else
                                                                                <span class="btn btn-social btn-danger btn-disabled btn-sm" disabled><i class="ion ion-ios-clock-outline"></i> Booking {{ $booking->status_is }}</span>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                    
                                                                @if($bookings->where('event_id', $event->id)->where('user_id', Auth::id())->count() == 0)
                                                                    <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                                                                        class="btn btn-social btn-danger btn-sm"
                                                                        rel="tooltip"
                                                                        title="Edit">
                                                                        <i class="ion ion-ios-compose-outline"></i> Book Event
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Booked Events</span>
                                <span class="info-box-number">{{ $bookings->where('user_id', \Auth::id())->count() }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box">
                            <span class="info-box-icon bg-orange"><i class="fa ion ion-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Unpaid Bookings</span>
                                <span class="info-box-number">{{ $bookings->where('user_id', \Auth::id())->where('status_is', 'Pending')->count() }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box">
                            <span class="info-box-icon bg-blue"><i class="fa fa-bell-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Notifications</span>
                                <span class="info-box-number">{{ count(\App\Notification::where(['user_id' => \Auth::id(), 'viewed' => 0])->get()) .'/'. count(\App\Notification::where('user_id', \Auth::id())->get()) }} unread</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box">
                            <span class="info-box-icon bg-gray-light"><i class="fa fa-user text-gray"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Profile Last Updated</span>
                                <span class="info-box-number">{{ \Auth::user()->updated_at->diffForHumans()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
    @endif

@endsection

@section('styles')
    <!-- isotope -->
    <style> 
        /*Event Isotope Transitions */	
        .isotope, .isotope .isotope-item {
            -webkit-transition-duration: 0.8s;
            -moz-transition-duration: 0.8s;
            -ms-transition-duration: 0.8s;
            -o-transition-duration: 0.8s;
            transition-duration: 0.8s;
        }
        
        .isotope {
            -webkit-transition-property: height, width;
            -moz-transition-property: height, width;
            -ms-transition-property: height, width;
            -o-transition-property: height, width;
            transition-property: height, width;
        }
        
        .isotope .isotope-item {
        -webkit-transition-property: left, opacity;
        -moz-transition-property: left, opacity;
        -ms-transition-property: left, opacity;
        -o-transition-property: left, opacity;
            transition-property: left, opacity;
        }
        
        .isotope.no-transition, .isotope.no-transition .isotope-item, .isotope .isotope-item.no-transition {
            -webkit-transition-duration: 0s;
            -moz-transition-duration: 0s;
            -ms-transition-duration: 0s;
            -o-transition-duration: 0s;
            transition-duration: 0s;
        }
        .event-item.isotope-item{
            width: 100%
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
    <!-- jQuery isotope -->
    {!! Html::script('plugins/isotope/jquery.isotope.js') !!}
    {!! Html::script('plugins/isotope/isotope.pkgd.js') !!}
    {!! Html::script('plugins/isotope/vertical.js') !!}
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


        jQuery(document).ready(function($) {
            // Event Isotope
            var container = $('#event-wrap');


            container.isotope({
                animationEngine: 'best-available',
                animationOptions: {
                    duration: 200,
                    queue: false
                },
                layoutMode: 'vertical', 
                gutter: 2
            });

            container.isotope({
                filter: $('#filters').find('a.active').attr('data-filter')
            });
            
            $('#filters a').click(function() {
                $('#filters a').removeClass('active');
                $(this).addClass('active');
                var selector = $(this).attr('data-filter');
                container.isotope({
                    filter: selector,
                });
                
                return false;
            });
        });


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
                    console.log(data);
                    $.each(data.data, function (i, v) {
                        $('#knob-' + v.id).val(v.number_of_seats - v.attendees).trigger('change');
                    });
                });
            }
        }, 3000);
    </script>
@stop