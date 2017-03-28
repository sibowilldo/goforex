<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">

    <title>GoForex - Wealth Creation</title>
    <link rel="icon" 
      type="image/png" 
      href="{{ url('img/All-Black-Bull-Shield-LOGO-1.png') }}">

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600'
          rel='stylesheet' type='text/css'>

    {{ Html::style('css/knight/bootstrap.css') }}
    {{ Html::style('css/knight/style.css') }}
    {{ Html::style('css/knight/font-awesome.css') }}
    {{ Html::style('css/knight/responsive.css') }}
    {{ Html::style('css/knight/animate.css') }}

    {{--<!--[if IE]><style type="text/css">.pie {behavior:url(PIE.htc);}</style><![endif]-->--}}


    {!! Html::script('/js/knight/jquery.1.8.3.min.js') !!}
    {!! Html::script('/js/knight/bootstrap.js') !!}
    {!! Html::script('/js/knight/jquery-scrolltofixed.js') !!}
    {!! Html::script('/js/knight/jquery.easing.1.3.js') !!}
    {!! Html::script('/js/knight/jquery.isotope.js') !!}
    {!! Html::script('/js/knight/wow.js') !!}
    {!! Html::script('/js/knight/classie.js') !!}

    {{--{!! Html::script('/js/knight/jquery-ui.min.js') !!}--}}

    {{--<script src="contactform/contactform.js"></script>--}}
    
    <!-- SweetAlert -->
    {!! Html::script('plugins/sweetalert/sweetalert-dev.js') !!}
    {{ Html::style('plugins/sweetalert/sweetalert.css') }}

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
<body>
@include('flash::message')
<header class="header" id="header"><!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
           <img src="{{ url('img/Full-logo-white.png')}}" alt="{{ config('app.name') }}">
        </figure>
        <h1 class="animated fadeInDown delay-07s">Welcome To GoForex Wealth Creation</h1>
        <ul class="we-create animated fadeInUp delay-1s">
            <li>Your adaptive and Selective approach to trading Forex.</li>
        </ul>
        <a class="link animated fadeInUp delay-1s servicelink" href="#service">Lets GoForex</a>
    </div>
</header><!--header-end-->

<nav class="main-nav-outer" id="test"><!--main-nav-start-->
    <div class="container">
        <ul class="main-nav">
            <li><a href="#header">Home</a></li>
            <li><a href="#service">Vision</a></li>
            <li><a href="#client">About Us</a></li>
            <li class="small-logo"><a href="#header"><img src="img/All-Black-Bull-Shield-LOGO-1.png" alt=""></a></li>
            {{--<li><a href="#Portfolio">Portfolio</a></li>--}}
            <li><a href="#team">Our Team</a></li>
            <li><a href="#contact">Contact</a></li>
            @if(!Auth::check())
                <li><a href="#contact1">Sign In</a></li>
            @else
                <li>
                        <a href="{{url('/home')}}" class="btn btn-warning" style="color: white;">Dashboard</a></li>
            @endif
        </ul>
        <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
    </div>
</nav><!--main-nav-end-->


<section class="main-section" id="service"><!--main-section-start-->
    <div class="container">
        <h2>Vision</h2>
        <h6>We offer exceptional service with complimentary hugs.</h6>
        <div class="row">
            <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s">
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="fa-paw"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>experience &amp; knowledge</h3>
                        <p>To bring some order and respectability to this industry by sharing our experiences and
                            knowledge</p>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="fa-gear"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>good & bad</h3>
                        <p>As well as what works and what does not.</p>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="fa-apple"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>guidance &amp; mentorship</h3>
                        <p>Help the new entrant with the best possible opportunity to make a success of forex trading
                            and build a profitable home business.</p>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-list-col1">
                        <i class="fa-medkit"></i>
                    </div>
                    <div class="service-list-col2">
                        <h3>formula of success</h3>
                        <p>We intend to shorten the time,cost and pain required to reach their goal by teaching them the
                            formula of success in this business..</p>
                    </div>
                </div>
            </div>
            <figure class="col-lg-8 col-sm-6  text-right wow fadeInUp delay-02s">
                <img src="img/mac_goforex.png" alt="">
            </figure>

        </div>
    </div>
</section><!--main-section-end-->


<section class="main-section client-part" id="client"><!--main-section client-part-start-->
    <div class="container">
        <b class="quote-right wow fadeInDown delay-03"><i class="fa-quote-right"></i></b>
        <div class="row">
            <div class="col-lg-12">
                <p class="client-part-haead wow fadeInDown delay-05">We want to erase the current perspective that
                    people have of forex trading as just another kind of gambling and prove that when sound business
                    principles are followed and one can build a low risk profitable business to support your family and
                    all their needs. We also aim to remove the excessive stress levels normally associated with forex
                    trading and change it into a non-emotional business investment practise that is viable option for
                    starting a home business.</p>
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
        <h2>team</h2>
        <h6>Take a closer look into our amazing team. We won’t bite.</h6>
        <div class="team-leader-block clearfix">
            <div class="team-leader-box">
                <div class="team-leader wow fadeInDown delay-03s">
                    <div class="team-leader-shadow"><a href="#"></a></div>
                    <img src="img/team-leader-pic1.jpg" alt="">
                    <ul>
                        <li><a href="#" class="fa-twitter"></a></li>
                        <li><a href="#" class="fa-facebook"></a></li>
                        <li><a href="#" class="fa-pinterest"></a></li>
                        <li><a href="#" class="fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-03s">Ashley Hastibeer</h3>
                <span class="wow fadeInDown delay-03s">Mentor & Managing Director</span>
                <p class="wow fadeInDown delay-03s">A professional mentor who has prided himself in offering the most
                    honest and relevant training and mentorship to the forex trading community.</p>
            </div>
            <div class="team-leader-box">
                <div class="team-leader  wow fadeInDown delay-06s">
                    <div class="team-leader-shadow"><a href="#"></a></div>
                    <img src="img/team-leader-pic2.jpg" alt="">
                    <ul>
                        <li><a href="#" class="fa-twitter"></a></li>
                        <li><a href="#" class="fa-facebook"></a></li>
                        <li><a href="#" class="fa-pinterest"></a></li>
                        <li><a href="#" class="fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-06s">Andile</h3>
                <span class="wow fadeInDown delay-06s">Mentor & Managing Director</span>
                <p class="wow fadeInDown delay-06s">Teaches and makesure best practise is applied when offering the best
                    and reliable ways of trading the forex market.</p>
            </div>
            <div class="team-leader-box">
                <div class="team-leader wow fadeInDown delay-09s">
                    <div class="team-leader-shadow"><a href="#"></a></div>
                    <img src="img/team-leader-pic3.jpg" alt="">
                    <ul>
                        <li><a href="#" class="fa-twitter"></a></li>
                        <li><a href="#" class="fa-facebook"></a></li>
                        <li><a href="#" class="fa-pinterest"></a></li>
                        <li><a href="#" class="fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-09s">Joel</h3>
                <span class="wow fadeInDown delay-09s">Sales and Marketing Director</span>
                <p class="wow fadeInDown delay-09s">
                    Ensures all marketing posters as well as classes advertised in the specified area in which we are
                    teaching.</p>
            </div>
        </div>
    </div>
</section><!--main-section team-end-->


<div class="c-logo-part"><!--c-logo-part-start-->
    <div class="container">
        <ul>
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
                    <span>+27 71 920 0123 / +27 63 000 5773</span>
                </div>
                <div class="contact-info-box email clearfix">
                    <h3><i class="fa-pencil"></i>email:</h3>
                    <span>info@goforexwealth.com</span>
                </div>
                <div class="contact-info-box hours clearfix">
                    <h3><i class="fa-clock-o"></i>Hours:</h3>
                    <span><strong>Monday - Friday:</strong> 8am - 5pm<br><strong>Saturday - Sunday:</strong> Online Bookings Only</span>
                </div>
                <ul class="social-link">
                    {{--<li class="twitter"><a href="#"><i class="fa-twitter"></i></a></li>--}}
                    <li class="facebook"><a href="https://www.facebook.com/goforexwealth/?fref=ts"><i class="fa-facebook"></i></a></li>
                    {{--<li class="pinterest"><a href="#"><i class="fa-pinterest"></i></a></li>--}}
                    {{--<li class="gplus"><a href="#"><i class="fa-google-plus"></i></a></li>--}}
                    <li class="instagram"><a href="https://www.instagram.com/goforex_wealth_creation/?hl=en"><i class="fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-5 wow fadeInUp delay-05s">
                <div class="form">

                    <div id="sendmessage">Your message has been sent!</div>
                    <div id="errormessage"></div>
                    <form action="{{ url('/contact-us') }}" method="POST" role="form" class="contactForm" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-text" id="name"
                                   placeholder="Your Name" data-rule="minlen:4"
                                   data-msg="Please enter at least 4 chars"  value="{{ old('name') }}" required/> 
                            <div class="validation"></div>
                             @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                             @endif
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-text" name="email" id="email"
                                   placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"  value="{{ old('email') }}" required/>
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
                                   data-msg="Please enter at least 8 chars of subject" value="{{ old('subject') }}" required/>
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
        <section class="main-section contact" id="contact1">
            <div class="row">
                @include('layouts.tabs')
            </div>
        </section>
    </div>
@endif
<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a id="back-top" href="#"><img src="{{ url('img/full-logo-white.png')}}" alt=""></a></div>
        <span class="copyright">&copy; GoForex. All Rights Reserved</span>
    </div>
</footer>


<script type="text/javascript">
    $(document).ready(function (e) {
        $('#test').scrollToFixed();
        $('.res-nav_click').click(function () {
            $('.main-nav').slideToggle();
            return false

        });

        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        });

        // scroll body to 0px on click
        $('#back-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 1000);
            return false;
        });
    });
</script>

<script>
    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100
        }
    );
    wow.init();
</script>


<script type="text/javascript">
    $(window).load(function () {

        $('.main-nav li a, .servicelink').bind('click', function (event) {
            var $anchor = $(this);

            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 102
            }, 1500, 'easeInOutExpo');
            /*
             if you don't want to use the easing effects:
             $('html, body').stop().animate({
             scrollTop: $($anchor.attr('href')).offset().top
             }, 1000);
             */
            event.preventDefault();
        });
    })
</script>

<script type="text/javascript">
    $(window).load(function () {

        var $container = $('.portfolioContainer'),
            $body = $('body'),
            colW = 375,
            columns = null;


        $container.isotope({
            // disable window resizing
            resizable: true,
            masonry: {
                columnWidth: colW
            }
        });

        $(window).smartresize(function () {
            // check if columns has changed
            var currentColumns = Math.floor(( $body.width() - 30 ) / colW);
            if (currentColumns !== columns) {
                // set new column count
                columns = currentColumns;
                // apply width to container manually, then trigger relayout
                $container.width(columns * colW)
                    .isotope('reLayout');
            }

        }).smartresize(); // trigger resize to set container width
        $('.portfolioFilter a').click(function () {
            $('.portfolioFilter .current').removeClass('current');
            $(this).addClass('current');

            var selector = $(this).attr('data-filter');
            $container.isotope({

                filter: selector,
            });
            return false;
        });

    });

    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/58c9b1295b89e2149e17c922/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();

</script>

</body>
</html>