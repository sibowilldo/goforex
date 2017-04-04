$(document).ready(function (e) {
    // Some Test
    $('#test').scrollToFixed();

    $('.res-nav_click').click(function () {
        $('.main-nav').slideToggle();
        return false

    });

    // Form Tabs
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    // Scroll body to 0px on click
    $('#back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

    // Something to do with NavBar
    $(window).load(function () {

        $('.main-nav li a, .servicelink, .signin_link').bind('click', function (event) {
            var $anchor = $(this);

            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 102
            }, 1500, 'easeInOutExpo');

            event.preventDefault();
        });
    });

    // Some WOW
    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();

    // Portfolio Container
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

    // TAWKTO live chat
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/58c9b1295b89e2149e17c922/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
});




