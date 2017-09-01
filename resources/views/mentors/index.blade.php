

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mentors
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Mentors</li>
            </ol>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="row">
                @if($mentors->count() > 0)
                    @foreach($mentors as $mentor)
                        <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                            <div class="box box-primary">
                                @if(Auth::user()->hasRole('admin'))
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $mentor->firstname }} {{ $mentor->lastname }}</h3>

                                    <div class="box-tools pull-right">
                                        <a href="{{ url('mentors/' . $mentor->id . '/edit') }}" class="btn btn-box-tool blue-text" ><i class="ion ion-edit"></i></a>
                                        {!! Btn::delete($mentor->id, url('mentors'), false, $mentor->name)!!}
                                    </div>
                                </div>
                                @endif
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="{{ url($mentor->image_path . 'thumb_'. $mentor->image) }}" alt="GoForex : {{ $mentor->firstname }} {{ $mentor->lastname }}">

                                    <h3 class="profile-username text-center">{{ $mentor->firstname }} {{ $mentor->lastname }}</h3>

                                    <p class="text-muted text-center">{{ implode(", ", unserialize($mentor->branch)) }}</p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b><span class="fa fa-phone"></span> </b> <a class="pull-right">{{ $mentor->contact_number }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="col-sm-12">

                    <div class="box box-primary">
                        <div class="box-body">
                            <h1 class="text-center">Nothing to display! Check again later...</h1>
                            @if(Auth::user()->hasRole('admin'))
                                <p class="text-center">
                                        <a href="{{ url('mentors/create') }}" class="btn btn-primary" ><i class="ion ion-plus-circled"></i> Add a mentor </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>

@endsection

@section('styles')

    <style>
        .box-tools .ion{
            font-size: 1.5em;
        }
        .profile-user-img {
            width: 230px;
        }
        .list-group-unbordered li{border:none; border-top: 1px solid #efefef;margin: 0 3em 20px;}
    </style>
@stop

@section('javascript')
    <script>

    </script>
@stop