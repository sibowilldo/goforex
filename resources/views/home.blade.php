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
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="alert alert-info alert-dismissible">--}}
                            {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                            {{--<h4><i class="icon ion ion-ios-information-outline"></i> Important!</h4>--}}
                            {{--Please note: Upon booking an event (reserving a seat) you are required to make payment and upload the proof of payment within <strong>12</strong> hours, otherwise your reservation will be cancelled and you will be required to make the reservation again should seats be available. Thank you!--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="row">
                    <div class="col-sm 12 col-md-6 col-lg-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ Auth::user()->booking()->count() }}</h3>

                                <p>Booked Events</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-calendar-outline"></i>
                            </div>
                            <a href="{{ url('bookings') }}" class="small-box-footer">
                                View Bookings
                            </a>
                        </div>
                    </div>
                    <div class="col-sm 12 col-md-6 col-lg-3">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ Auth::user()->booking()->where('proof_of_payment', null)->count() }}</h3>

                                <p>Unpaid Bookings</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-time-outline"></i>
                            </div>
                            <a href="{{ url('bookings') }}" class="small-box-footer">
                                View Bookings
                            </a>
                        </div>
                    </div>
                    <div class="col-sm 12 col-md-6 col-lg-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ count(\App\Notification::where(['user_id' => \Auth::id(), 'viewed' => 0])->get()) .' of '. count(\App\Notification::where('user_id', \Auth::id())->get()) }}</h3>

                                <p>Unread Notifications</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-bell-outline"></i>
                            </div>
                            <a href="{{ url('notifications') }}" class="small-box-footer">
                                View Notifications
                            </a>
                        </div>
                    </div>
                    <div class="col-sm 12 col-md-6 col-lg-3">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ \Auth::user()->updated_at->diffForHumans()}}</h3>

                                <p>Profile Last Updated</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-reload"></i>
                            </div>
                            <a href="{{ url('profile') }}" class="small-box-footer">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>



                <div class="row">
                    @foreach($events as $event)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="box box-{{ $event->status_is == 'Open' ? 'success' : 'danger' }}">
                            <div class="box-header with-border">
                                <span class="label label-{{ $event->status_is == 'Open' ? 'success' : 'danger' }}">
                                    {{ strtoupper($event->status_is) }}
                                </span>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="ion ion-android-remove"></i>
                                    </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="ion ion-ios-gear"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                @if(Auth::user()->hasRole('admin'))
                                                @if($event->status_is == 'Open')
                                                    <li>
                                                        <a href="{{ url('attendees/'. $event->id . '/add') }}">
                                                            <i class="fa ion-person-add"></i> Add Attendee
                                                        </a>
                                                    </li>
                                                @endif
                                                <li><a href="{{ url('events/') }}">
                                                        <i class="ion ion-ios-list-outline"></i> All Events</a></li>
                                                <li><a href="{{ url('events/create') }}">
                                                        <i class="ion ion-plus-round"></i> Create Event</a></li>
                                                <li><a href="{{ url('events/'. $event->id) }}">
                                                        <i class="fa fa-calendar-check-o"></i>View Bookings</a>
                                                </li>
                                                @endif
                                                <li>
                                                    <a href="{{ url('view-event', $event->id) }}"
                                                       class=""
                                                       rel="tooltip" title="View">
                                                        <i class="ion ion-eye"></i> View Event
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <h4 class="event-title">{{ $event->name }}
                                </h4>
                                <h3 class="event-title">R{{number_format($event->item->price, 2, '.', '')}}
                                </h3>
                                <div class="event-meta" style="overflow: hidden">
                                    <p class="event-description text-truncate"><i class="fa ion-ios-paper-outline"></i> {{ $event->description }}</p>
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <span><i class="fa ion ion-calendar"></i> {{ Carbon\Carbon::parse($event->start_date)->formatLocalized('%a, %d %b %y') }} - {{ Carbon\Carbon::parse($event->end_date)->formatLocalized('%a, %d %b %y') }}</span>
                                            <br>
                                            <span><i class="fa ion ion-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}</span>
                                            <br>

                                            <span><i class="fa ion ion-person"></i> {{ $event->host }}</span>
                                            <br>
                                            <span><i class="fa ion ion-location"></i> {{ $event->address }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="progress progress-md" style="margin-top: 10px; border-radius: 3px">

                                            @if($event->status_is == "Open")
                                                <div class="progress-bar progress-bar-green progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{($event->number_of_seats - $event->bookings()->where('status_is', 'Paid')->count())*10}}%">
                                                    {{($event->number_of_seats - $event->bookings()->where('status_is', 'Paid')->count())}} of {{$event->number_of_seats}} Seats Available
                                                </div>
                                            @else
                                                <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                    Event is {{ strtoupper($event->status_is) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            @if($event->bookings()->where('user_id', Auth::id())->count() == 0)
                                                <a href="{{ url('booking/create-event-booking/'.$event->id) }}"
                                                   class="btn btn-social btn-success btn-sm"
                                                   data-toggle="tooltip"
                                                   data-original-title="Book a seat for this event" data-placement="left">
                                                    <i class="ion ion-android-done"></i> Book Event
                                                </a>
                                            @else
                                                <button class="btn btn-warning btn-sm disabled btn-disabled btn-social" data-placement="left" data-toggle="tooltip" data-original-title="You're booked for this event"><i class="ion ion-android-done-all"></i>Booked</button>
                                                @if($event->bookings()->where('user_id', Auth::id())->first()->status_is != 'Paid')
                                                <button id="booking-{{ $event->bookings()->where('user_id', Auth::id())->first()->id }}" type="button"
                                                        value="{{ $event->id }}"
                                                        data-userid="{{ Auth::id()}}"
                                                        data-toggle="modal" data-target="#proof-modal"
                                                        class="btn btn-success btn-sm btn-social btn-proof"><i
                                                            class="fa ion ion-android-clipboard"></i>{{ $event->bookings()->where('user_id', Auth::id())->first()->proof_of_payment == null ? 'Attach' : 'Update' }} Payment Receipt
                                                </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{ $events->links() }}
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    @endif


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
                    <button type="submit" id="upload-proof" class="btn btn-md btn-primary">Upload selected file
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('styles')
    <!-- isotope -->
    <style>
        .text-truncate {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .small-box h3 {
            font-size: 38px;
            font-weight: 100;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }
    </style>
@stop

@section('javascript')

    <script>
        $(document).ready(function () {
            $('.btn-proof').on('click', function (e) {
                var booking = $(this);
                $('.modal-title').html('Upload Proof of Payment');
                $('#eventId').val(booking.attr('value'));
                $('#userId').val(booking.attr('data-userid'));
            });
        });
    </script>
@stop