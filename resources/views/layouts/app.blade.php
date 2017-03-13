<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{ Html::style('css/app.css') }}
{{ Html::style('css/font-awesome.min.css') }}
{{ Html::style('css/jquery-ui.css') }}
  <!-- Bootstrap 3.3.6 -->
{{ Html::style('bootstrap/css/bootstrap.min.css') }}
  <!-- Ionicons -->
{{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}
  <!-- jvectormap -->
{{ Html::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
  <!-- Theme style -->
{{ Html::style('css/AdminLTE.min.css') }}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
{{ Html::style('css/skins/skin-gold.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-gold sidebar-mini">

<div id="app">
    @include('flash::message')
    <div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg ogo-mini">GoForex</span>
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
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/img/small-logo.png" class="user-image" alt="{{ Auth::user()->firstname }}">
              <span class="hidden-xs">{{ Auth::user()->firstname }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/img/small-logo.png" class="/img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                  <small>Member since: {{ Auth::user()->created_at->formatLocalized('%A, %d %B %Y') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
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
          <img src="/img/logo.png" class="/img-circle" alt="User Image">
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
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Main Navigation</li>
        <li>
          <a href="/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/events')}}">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

    @yield('content')
    

  <footer class="main-footer">
    <strong>Copyright &copy; {{ \Carbon\Carbon::now()->year  }} <a href="/">GoForex</a> Wealth Creation.</strong> All rights
    reserved.
  </footer>
    
</div>
<!-- ./wrapper -->
</div>

<!-- Scripts -->

<!-- jQuery 2.2.3 -->
{!! Html::script('plugins/jQuery/jquery-2.2.3.min.js') !!}

{!! Html::script('/js/app.js') !!}
<!-- AdminLTE App -->
{!! Html::script('js/app.min.js') !!}
{!! Html::script('/js/jquery-ui.min.js') !!}
<!-- Bootstrap 3.3.6 -->
{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('/js/jquery.zoomooz.min.js') !!}

@yield('javascript')



<script type="text/javascript" language="javascript">
    $('div.alert').not('.alert-important').delay(7000).fadeOut(500);

    $( function() {
        $( "#accordion" ).accordion({
            collapsible: true
        });
    } );


    $( function() {
        $( "#dialog-make-booking" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            show: {
                effect: "blind",
                duration: 500
            },
            hide: {
                effect: "explode",
                duration: 500
            },
            width: "auto",
            modal: true,
            buttons: {
                "Delete all items": function() {
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    } );

    $( ".view-event" ).on( "click", function() {
        $( "#dialog-make-booking" ).dialog( "open" );
    });
</script>
</body>
</html>
