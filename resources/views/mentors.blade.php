

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
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Andile-Zulu.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Andile Zulu</h3>

                            <p class="text-muted text-center">JHB Sandton Branch</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (83) 5438329</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Anele-Gasa.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Anele Gasa</h3>

                            <p class="text-muted text-center">Pretoria and Mpumalanga Branch</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (83) 2463189</a>
                                 </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                {{--<div class="col-xs-12 col-sm-12 col-md- col-lg-4">--}}
                    {{--<div class="box box-primary">--}}
                        {{--<div class="box-body box-profile">--}}
                            {{--<img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Kaylin-Govendor.jpg') }}" alt="User profile picture">--}}

                            {{--<h3 class="profile-username text-center">Kaylin Govendor</h3>--}}

                            {{--<p class="text-muted text-center">Empangeni Branch</p>--}}

                            {{--<ul class="list-group list-group-unbordered">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (63) 0583012</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<!-- /.box-body -->--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Mbuso-Gumede.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Mbuso Gumede</h3>

                            <p class="text-muted text-center">Pretoria and Limpopo Branch</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (78) 2701486</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Msizi-Mbele.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Msizi Mbele</h3>

                            <p class="text-muted text-center">Pretoria and Mpumalanga Branch</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (71) 8335634</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Ndumiso-Sokhela.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Ndumiso Sokhela</h3>

                            <p class="text-muted text-center">Empangeni Branch </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (73) 4287553</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md- col-lg-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ url('/img/mentors/Zazi-Ngema.jpg') }}" alt="User profile picture">

                            <h3 class="profile-username text-center">Zazi Ngema</h3>

                            <p class="text-muted text-center">JHB , Sandton Branch</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><span class="fa fa-phone"></span> </b> <a class="pull-right">+27 (78) 8477802</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('styles')

    <style>
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