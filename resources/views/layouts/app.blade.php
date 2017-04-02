<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoForex - Wealth Creation') }}</title>
    <!-- ===== FAVICON =====-->
    {!! Html::style('img/All-Black-Bull-Shield-LOGO-1.png', ['rel'=>'shortcut icon', 'type'=>'image/png']) !!}

    <!-- Font Awesome -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
    <!-- JQuery UI -->
    {{ Html::style('css/jquery-ui.css') }}
      <!-- Bootstrap 3.3.6 -->
    {{ Html::style('bootstrap/css/bootstrap.min.css') }}
      <!-- Ionicons -->
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}
      <!-- jvectormap -->
    {{ Html::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
      <!-- Theme style -->
    {{ Html::style('css/AdminLTE.min.css') }}
      <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    {{ Html::style('css/skins/skin-gold.css') }}
    
    <!-- SweetAlert -->
    {{ Html::script('plugins/sweetalert/sweetalert.min.js') }} {{-- Sweet Alert JS needs to be loaded first, before using it on body--}}
    {{ Html::style('plugins/sweetalert/sweetalert.css') }}
    <!-- Animate CSS-->
    {{ Html::style('css/knight/animate.css') }}


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  {!! Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') !!}
  {!! Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
  <![endif]-->
@yield('styles')

<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
      *{
        -moz-transform-origin: inherit !important;
        -webkit-transform-origin: inherit !important;
        -o-transform-origin: inherit !important;
        -ms-transform-origin: inherit !important;
        transform-origin: inherit !important;
      }    
    </style>
</head>
<body class="hold-transition skin-gold sidebar-mini">

<div id="app">
    @include('flash::message')
    <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="{{ url('/home')}}" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-mini"><img src="{{ url('/img/All-Black-Bull-Shield-LOGO-1.png') }}" alt="{{ config('app.name') }}" style="height: 40px;"></span>
        <span class="logo-lg"><img src="{{ url('/img/full-black-and-white-logo.png') }}" alt="{{ config('app.name') }}" style="height: 40px;"></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notification_count">
                <i class="fa fa-bell"></i>
                <span class="label label-info"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header" id="notification_count_message"></li>
                @if(session()->has('unread-notifications:'.Auth::user()->id))
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                  @foreach(session('unread-notifications:'.Auth::user()->id) as $item)
                    <li>
                      <a href="{{ url('/notifications/'.$item->id ) }}">
                        <i class="fa fa-{{ $item->type == 'notification' ? 'bell' : 'envelope' }} text-aqua"></i> {!! strip_tags($item->message) !!}
                      </a>
                    </li>
                  @endforeach
                  </ul>
                </li>
                  @endif
                <li class="footer"><a href="{{url('notifications')}}" class="bg-gray-light">View all</a></li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Avatar::create(Auth::user()->firstname )->toBase64() }}" class="user-image img-bordered-sm img-circle" alt="{{ Auth::user()->firstname }}">
                <span class="hidden-xs">{{ Auth::user()->firstname }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ url('img/All-Black-Bull-Shield-LOGO-1.png') }}" class="img-circle" alt="User Image">

                  <p>
                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                    <small>Member since: {{ Auth::user()->created_at->formatLocalized('%A, %d %B %Y') }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                      </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ Avatar::create(Auth::user()->firstname )->toBase64() }}" class="img-bordered img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->status_is }}</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" style="">
          <li>
            <a href="{{ url('/')}}">
              <i class="fa fa-home"></i>
              <span>Main site</span>
            </a>
          </li>
        </ul>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Main Navigation</li>
          <li>
            <a href="{{ url('/home')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->hasRole('admin'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Administrator</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('/events') }}"><i class="fa fa-circle-o"></i> Events</a></li>
                    <li><a href="{{ url('/items') }}"><i class="fa fa-circle-o"></i> Items</a></li>
                    <li><a href="{{ url('/invoices') }}"><i class="fa fa-circle-o"></i> Invoices</a></li>
                </ul>
            </li>
          @endif
          <li>
            <a href="{{ url('/profile')}}">
              <i class="fa fa-user"></i>
              <span>My Profile</span>
            </a>
          </li>
            <li>
                <a href="{{ url('/my-invoices')}}">
                    <i class="fa fa-money"></i>
                    <span>My Invoices</span>
                </a>
            </li>
          <li>
            <a href="{{ url('/notifications')}}">
              <i class="fa fa-bell"></i>
              <span>Notifications</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    
    @yield('content')
    

    <footer class="main-footer">
      <strong>Copyright &copy; {{ \Carbon\Carbon::now()->year  }} <a href="/">GoForex</a> - Wealth Creation.</strong> All rights reserved.
    </footer>
    
</div>
<!-- ./wrapper -->
</div>

<!-- jQuery 2.2.3 -->
{!! Html::script('plugins/jQuery/jquery-2.2.3.min.js') !!}
{!! Html::script('js/jquery-ui.min.js') !!}

<!-- Bootstrap 3.3.6 -->
{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
<!-- Slim Scroll -->
{!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
<!-- Elevate Zoom -->
{!! Html::script('plugins/elevatezoom/jquery.elevatezoom.min.js') !!}

{!! Html::script('js/app.js') !!}
@yield('javascript')
{!! Html::script('js/messages.js') !!}

</body>
</html>
