<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">

    <title>GoForex - Wealth Creation</title>
    {!! Html::style('img/All-Black-Bull-Shield-LOGO-1.png', ['rel'=>'shortcut icon', 'type'=>'image/png']) !!}

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600'
          rel='stylesheet' type='text/css'>
    <!-- ionic icons -->
    {{ Html::style('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}

    {{ Html::style('css/knight/bootstrap.css') }}
    {{ Html::style('css/knight/style.css') }}
    {{ Html::style('css/knight/font-awesome.css') }}
    {{ Html::style('css/knight/responsive.css') }}
    {{ Html::style('css/knight/animate.css') }}

    {{--<!--[if IE]><style type="text/css">.pie {behavior:url(PIE.htc);}</style><![endif]-->--}}

    <!-- jQuery 2.2.3 -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
    
<!-- Toastr --> 
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') }}
    {{ Html::style('css/toastr-custom.css') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js') }}

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        }
    </script>
    {!! Html::script('/js/knight/bootstrap.js') !!}
    {!! Html::script('/js/knight/jquery-scrolltofixed.js') !!}
    {!! Html::script('/js/knight/jquery.easing.1.3.js') !!}
    {!! Html::script('/js/knight/jquery.isotope.js') !!}
    {!! Html::script('/js/knight/wow.js') !!}
    {!! Html::script('/js/knight/classie.js') !!}

    <style>
        * {
            -moz-transform-origin: inherit !important;
            -webkit-transform-origin: inherit !important;
            -o-transform-origin: inherit !important;
            -ms-transform-origin: inherit !important;
            transform-origin: inherit !important;
        }

        .no-margin {
            margin: 0 !important;
        }

        .white-text {
            color: #fff !important;
        }
        @media only screen and (min-width: 767px){
            .team-leader-box:first-child{
                margin-left: 18%;
            }
        }
    </style>

</head>
<body>
@include('flash::message')

<header class="header" id="header"><!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
            {{ Html::image('img/Full-logo-white.png',config('app.name')) }}
        </figure>
        <h1 class="animated fadeInDown delay-07s">Welcome To GoForex Wealth Creation</h1>
        <ul class="we-create animated fadeInUp delay-1s">
            <li>Your adaptive and Selective approach to trading Forex.</li>
        </ul>
        <a class="link animated fadeInUp delay-1s servicelink" href="#training">Lets GoForex</a>
    </div>
</header><!--header-end-->

<nav class="main-nav-outer" id="test"><!--main-nav-start-->
    <div class="container">
        <ul class="main-nav">
            <li><a href="#header">Home</a></li>
            <li><a href="#training">Training</a></li>
            <li><a href="#aboutus">About Us</a></li>
            <li class="small-logo">
                <a href="#header">
                    {{ Html::image('img/All-Black-Bull-Shield-LOGO-1.png',config('app.name')) }}
                </a>
            </li>
            {{--<li><a href="#Portfolio">Portfolio</a></li>--}}
            <li><a href="#team">Our Team</a></li>
            <li><a href="#contact">Contact</a></li>
            @if(!Auth::check())
                <li><a href="#signin">Sign In</a></li>
            @else
                <li>
                    <a href="{{url('/home')}}" class="btn btn-warning" style="color: white;">Dashboard</a>
                </li>
            @endif
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav><!--main-nav-end-->


<section class="main-section" id="training"><!--main-section-start-->
    <div class="container">
        <h2>GoForex Education Calendar</h2>
        <h6>Book your seat for the next on-demand Forex Trading training near you in South Africa,
            <br/>with GoForex exclusive and user-friendly booking system.</h6>
        <div class="row">
            <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s">
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="ion ion-laptop"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>Easy &amp; booking</h3>
                        <p>GoForex has a smart online training booking system. Customers can <a class="signin_link"
                                                                                                href="#signin">register</a>
                            for training events, pay and upload proof of payment.</p>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="ion ion-android-contacts"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>guidance &amp; mentorship</h3>
                        <p>In GoForex training we help beginners with the best possible opportunity to make a success of
                            Forex trading
                            and build a profitable profile.</p>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="ion ion-thumbsup"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>Formula to success</h3>
                        <p>We intend to shorten the time, cost and pain required to reach your goal by training you on
                            the
                            formula to success in Forex markets.</p>
                    </div>
                </div>
            </div>
            <figure class="col-lg-8 col-sm-6  text-right wow fadeInUp delay-02s">
                <img src="img/mac_goforex.png" alt="">
            </figure>

        </div>
    </div>
</section><!--main-section-end-->


<section class="main-section client-part" id="aboutus"><!--main-section client-part-start-->
    <div class="container">
        <b class="quote-right wow fadeInDown delay-03"><i class="fa-quote-right"></i></b>
        <div class="row">
            <div class="col-lg-12">
                <p class="client-part-haead wow fadeInDown delay-05">GoForex is a movement that aims on empowering
                    people about Forex Trading, by teaching people what really works and all the secrets and techniques
                    of trading the markets. We have empowered many people with our strategy called the Major Key that
                    was developed by one of our mentors and the strategy has changed many people's lives.
                </p>
            </div>
        </div>
        {{--<ul class="client wow fadeIn delay-05s">--}}
        {{--<li><a href="#">--}}
        {{--<img src="img/client-pic1.jpg" alt="">--}}
        {{--<h3>James Bond</h3>--}}
        {{--<span>License To Drink Inc.</span>--}}
        {{--</a></li>--}}
        {{--</ul>--}}
    </div>
</section><!--main-section client-part-end-->

<section class="main-section team" id="team"><!--main-section team-start-->
    <div class="container">
        <h2>Our Team</h2>
        <h6>Take a closer look into our amazing team. <br/>We won’t bite :)</h6>
        <div class="team-leader-block clearfix">
            <div class="team-leader-box">
                <div class="team-leader wow fadeInDown delay-03s">
                    <div class="team-leader-shadow"><a href="#"></a></div>
                    {{ Html::image("img/ashley_goforex.jpg", 'Joel') }}
                    <ul>
                        <li><a href="https://www.facebook.com/rowan.jnr" class="fa-facebook" target="_blank"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-03s">Ashley</h3>
                <span class="wow fadeInDown delay-03s">Mentor</span>
                <p class="wow fadeInDown delay-03s">A young professional Forex Trader from Richards Bay, that is 24
                    years old, passion driven and who wishes to see everyone doing well in life through Trading Forex.
                    Ashley studied I.T at Durban University of Technology and started trading Forex in his final year.
                    He has been very consistent after developing a new technique for himself around May 2016 that works
                    of which is called "The Major Key". He eventually decided to release his working strategy to the
                    public after seeing his friends that he helped in 2016 doing extremely well in Trading Forex. Ashley
                    and his team have helped many people with their trading careers and aim on taking the Major Key
                    movement very far with the support from GFX Family.</p>
            </div>
            <div class="team-leader-box">
                <div class="team-leader  wow fadeInDown delay-06s">
                    <div class="team-leader-shadow"><a href="#"></a></div>
                    {{ Html::image("img/andile_goforex.jpg", 'Joel') }}
                    <ul>
                        <li><a href="#" class="fa-facebook"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-06s">Andile</h3>
                <span class="wow fadeInDown delay-06s">Mentor</span>
                <p class="wow fadeInDown delay-06s">Andile Tshona from Lusikisiki Eastern Cape is a mentor that also
                    studied I.T at Durban University of Technology. Andile produced extreme results in his first week of
                    trading after learning the secret key and has been consistent. After seeing many people that were
                    struggling and consulting Ashley, Andile and others, they then decided to start the movement called
                    "The Major Key" and it has produced outstanding results.</p>
            </div>
        </div>
    </div>
</section><!--main-section team-end-->


<div class="c-logo-part"><!--c-logo-part-start-->
    <div class="container">
        <ul>

            {{--<h2 class="no-margin">Coming Soon! <br><small class="white-text">Brokers Recommended by us</small></h2>--}}
            <h2>Keep In Touch!</h2>
            {{--<li><a href="#"><img src="img/c-liogo1.png" alt=""></a></li>--}}
            {{--<li><a href="#"><img src="img/c-liogo2.png" alt=""></a></li>--}}
            {{--<li><a href="#"><img src="img/c-liogo3.png" alt=""></a></li>--}}
            {{--<li><a href="#"><img src="img/c-liogo4.png" alt=""></a></li>--}}
            {{--<li><a href="#"><img src="img/c-liogo5.png" alt=""></a></li>--}}
        </ul>
    </div>
</div><!--c-logo-part-end-->


{{--<section class="main-section paddind" id="Portfolio"><!--main-section-start-->--}}
{{--<div class="container">--}}
{{--<h2>Portfolio</h2>--}}
{{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
{{--<div class="portfolioFilter">--}}
{{--<ul class="Portfolio-nav wow fadeIn delay-02s">--}}
{{--<li><a href="#" data-filter="*" class="current">All</a></li>--}}
{{--<li><a href="#" data-filter=".branding">Branding</a></li>--}}
{{--<li><a href="#" data-filter=".webdesign">Web design</a></li>--}}
{{--<li><a href="#" data-filter=".printdesign">Print design</a></li>--}}
{{--<li><a href="#" data-filter=".photography">Photography</a></li>--}}
{{--</ul>--}}
{{--</div>--}}

{{--</div>--}}
{{--<div class="portfolioContainer wow fadeInUp delay-04s">--}}
{{--<div class=" Portfolio-box printdesign">--}}
{{--<a href="#"><img src="img/Portfolio-pic1.jpg" alt=""></a>--}}
{{--<h3>Foto Album</h3>--}}
{{--<p>Print Design</p>--}}
{{--</div>--}}
{{--<div class="Portfolio-box webdesign">--}}
{{--<a href="#"><img src="img/Portfolio-pic2.jpg" alt=""></a>--}}
{{--<h3>Luca Theme</h3>--}}
{{--<p>Web Design</p>--}}
{{--</div>--}}
{{--<div class=" Portfolio-box branding">--}}
{{--<a href="#"><img src="img/Portfolio-pic3.jpg" alt=""></a>--}}
{{--<h3>Uni Sans</h3>--}}
{{--<p>Branding</p>--}}
{{--</div>--}}
{{--<div class=" Portfolio-box photography">--}}
{{--<a href="#"><img src="img/Portfolio-pic4.jpg" alt=""></a>--}}
{{--<h3>Vinyl Record</h3>--}}
{{--<p>Photography</p>--}}
{{--</div>--}}
{{--<div class=" Portfolio-box branding">--}}
{{--<a href="#"><img src="img/Portfolio-pic5.jpg" alt=""></a>--}}
{{--<h3>Hipster</h3>--}}
{{--<p>Branding</p>--}}
{{--</div>--}}
{{--<div class=" Portfolio-box photography">--}}
{{--<a href="#"><img src="img/Portfolio-pic6.jpg" alt=""></a>--}}
{{--<h3>Windmills</h3>--}}
{{--<p>Photography</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section><!--main-section-end-->--}}

<div class="container">
    <section class="main-section contact" id="contact">

        <div class="row">
            <div class="col-lg-6 col-sm-7 wow fadeInLeft">
                <div class="contact-info-box address clearfix">
                    <h3><i class=" icon-map-marker"></i>Address:</h3>
                    <span>Opening Soon In Durban</span>
                </div>
                <div class="contact-info-box phone clearfix">
                    <h3><i class="fa-phone"></i>Phone:</h3>
                    <span><a href="tel:+27719200123">+27 71 920 0123</a> / <a
                                href="tel:+27630005773">+27 63 000 5773</a></span>
                </div>
                <div class="contact-info-box email clearfix">
                    <h3><i class="fa-pencil"></i>email:</h3>
                    <span><a href="mailto:info@goforex.co.za">info@goforex.co.za</a></span>
                </div>
                <div class="contact-info-box hours clearfix">
                    <h3><i class="fa-clock-o"></i>Hours:</h3>
                    <span id="contact_form"><strong>Monday - Friday:</strong> 8am - 5pm<br><strong>Saturday - Sunday:</strong>
                        Online Bookings Only <br><a class="signin_link" href="#signin">Sign In</a>
                    </span>
                </div>
                <ul class="social-link">
                    {{--<li class="twitter"><a href="#"><i class="fa-twitter"></i></a></li>--}}
                    <li class="facebook"><a target="_blank" href="https://www.facebook.com/goforexwealth/?fref=ts"><i
                                    class="fa-facebook"></i></a></li>
                    {{--<li class="pinterest"><a href="#"><i class="fa-pinterest"></i></a></li>--}}
                    {{--<li class="gplus"><a href="#"><i class="fa-google-plus"></i></a></li>--}}
                    <li class="instagram"><a target="_blank"
                                             href="https://www.instagram.com/goforex_wealth_creation/?hl=en"><i
                                    class="fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-5 wow fadeInUp delay-05s">
                <div class="form">

                    <div id="sendmessage">Your message has been sent!</div>
                    <div id="errormessage"></div>
                    <form action="{{ url('/contact-us') }}" method="POST" role="form" class="contactForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-text" id="name"
                                   placeholder="Your Name" data-rule="minlen:4"
                                   data-msg="Please enter at least 4 chars" value="{{ old('name') }}" required/>
                            <div class="validation"></div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-text" name="email" id="email"
                                   placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"
                                   value="{{ old('email') }}" required/>
                            <div class="validation"></div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-text" name="subject" id="subject"
                                   placeholder="Subject" data-rule="minlen:4"
                                   data-msg="Please enter at least 8 chars of subject" value="{{ old('subject') }}"
                                   required/>
                            <div class="validation"></div>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control input-text text-area" name="bodymessage" rows="5"
                                      data-rule="required" data-msg="Please write something for us"
                                      placeholder="Message" required></textarea>
                            <div class="validation"></div>
                            @if ($errors->has('bodymessage'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('bodymessage') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="input-btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<section class="business-talking"><!--business-talking-start-->
    <div class="container">
        <h2>Be Part Of GoForex Wealth Creation</h2>
    </div>
</section><!--business-talking-end-->

@if(!Auth::check())
    <div class="container">
        <section class="main-section contact" id="signin">
            <div class="row">
                @include('layouts.tabs')
            </div>
        </section>
    </div>
@endif
<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a id="back-top" href="#">
                {{ Html::image('img/Full-logo-white.png') }}
            </a></div>
        <span class="copyright">&copy; GoForex. All Rights Reserved</span>
    </div>
</footer>


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <?php $title = 'Sorry!'; $message = $error; $level = 'error';  ?>
        @include('layouts.toastr', compact('title', 'message', 'level'))
    @endforeach
@endif

{!! Html::script('/js/main.js') !!}

</body>
</html>