<!DOCTYPE html>

<html class="wide wow-animation" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Camokakis Music Stations</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="Camokakis Music Stations - @yield('title')" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="@yield('og-image')" />
    <meta property="og:description" content="@yield('description')">
    <meta name="description"
        content="@yield('meta_description', 'Camokakis is a brand new free radio app offering uninterrupted streaming of all the music you love (88.3JIA, 88.3JIA WEB HITS, 88.3JIA K-POP, POWER 98 LOVE SONGS, POWER 98 HITS!, POWER 98 RAW). Download Camokakis now and experience the best of music on the go!')">
    <meta name="google-play-app" content="app-id=com.safraradio.jia883"
        app-argument="https://play.google.com/store/apps/details?id=com.safraradio.jia883">
    <meta name="apple-itunes-app"
        content="app-id=1060133120,app-argument=https://apps.apple.com/sg/app/jia-88-3/id1060133120">
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KJ5CV63');
    </script>
    <!-- End Google Tag Manager -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-142494701-1', 'auto');
        ga('send', 'pageview');
    </script>
    <link rel="icon" href="{{ asset('img/frontend/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('meta')
    @yield('pagestyles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    @push('before-styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .lyric-div {
            max-height: 100% !important;
            background: #252525 !important;
            max-width: 100% !important;
            position: relative;
            overflow: auto;
        }

        @media (max-width: 991px) {
            .lyric-div {
                bottom: 471px !important;
            }
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }

        .highlight {
            color: #fff
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fff;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
    </style>
    <style type="text/css">
        .text-center {
            text-align-last: center !important;
            text-align: center !important;
        }

        #lyric-div .box-live-wrap {
            text-align-last: center !important;
        }

        @media (min-width: 576px) {
            #lyric-div .box-live-wrap {
                text-align-last: center !important;
                text-align: center !important;
            }
        }
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartbanner/1.0.0/jquery.smartbanner.css">
    @endpush
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/frontend.css')) }}

    @stack('after-styles')
    <script type="text/javascript">
        var appurl = '{{url("/")}}/';
    </script>
</head>

<body style="background-color: #353a40;">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJ5CV63" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img
                src="{{asset('images/ie8-panel/warning_bar_0000_us.jpg')}}" height="42" width="820"
                alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a>
    </div>
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-container">
                <div class="cssload-speeding-wheel"></div>
            </div>
        </div>
    </div>
    <div id="app">
        <div class="page">
            @include('frontend.includes.header')
            @yield('content')
            @include('frontend.includes.footer')
        </div>

    </div><!-- #app -->
    @if(!$is_ie11)
    <iframe src="{{ asset('img/frontend/1sec.mp3') }}" allow="autoplay" id="iframeAudio" style="display:none"></iframe>
    @endif
    <div class="snackbars" id="form-output-global"></div>

    <a id="return-to-top"><i class="fal fa-angle-up"></i></a>
    <!-- Scripts -->
    @push('after-scripts')

    <script src="{{ asset('js/core.min.js') }} "></script>
    <script src="{{ asset('js/script.js') }} "></script>
    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200); // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200); // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function () { // When arrow is clicked
            $('body,html').animate({
                scrollTop: 0 // Scroll to top of body
            }, 500);
        });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142494701-2"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartbanner/1.0.0/jquery.smartbanner.js"></script>
    <script type="text/javascript">
        //A function to return a random number between a min and a max value
        function randomNumber(min, max) {
            number = Math.floor((Math.random() * (max - min)) + min);
            return number;
        }

        //Initialise starting values
        var purple, blue, cyan, green, yellow, orange, red;
        purple = 22;
        blue = 14;
        cyan = 2;
        green = 12;
        yellow = 3;
        orange = 11;
        red = 20;

        function changeHeight(column, height) {
            height -= randomNumber(-6, 6);
            if (height > 20) height = 20;
            if (height < 1) height = 1;
            column.style.height = height + "px";
            return height;
        }

        var playing = true;

        function playeqpause() {
            console.log('console');
            playing = false;
        }

        function playeqplay() {
            console.log('console');
            playing = true;
            animate();
        }

        //A Function that will be run every 50ms to animate the equalizer
        function animate() {
            // console.log('playing', playing)
            if (playing) {
                purple = changeHeight(document.getElementById("volume-1"), purple);
                blue = changeHeight(document.getElementById("volume-2"), blue);
                cyan = changeHeight(document.getElementById("volume-3"), cyan);
                green = changeHeight(document.getElementById("volume-4"), green);
                yellow = changeHeight(document.getElementById("volume-5"), yellow);
                orange = changeHeight(document.getElementById("volume-6"), orange);
                red = changeHeight(document.getElementById("volume-7"), red);

                //Repeat this function every 50 ms
                setTimeout(animate, 90);
            }
        }

        animate();
        var autoScroll;
        $('.show-box-live-wrap').on('click', function () {
            if ($('.mobile-tablet').hasClass('show-live-wrap')) {
                $('.mobile-tablet').removeClass('show-live-wrap').addClass('hide-live-wrap');
            } else {
                $('.mobile-tablet').removeClass('hide-live-wrap').addClass('show-live-wrap');
            }
            setInterval(function () {
                var playerPos = $('.mobile-tablet .player-name').scrollLeft();

                if ($('.mobile-tablet .player-name').get(0).scrollWidth - $(
                        '.mobile-tablet .player-name').get(0).clientWidth <= playerPos) {
                    $('.mobile-tablet .player-name').scrollLeft(0);
                } else {
                    $('.mobile-tablet .player-name').scrollLeft(playerPos + 1);
                }

                var singlePos = $('.mobile-tablet .artist-song-name').scrollLeft();

                if ($('.mobile-tablet .artist-song-name').get(0).scrollWidth - $(
                        '.mobile-tablet .artist-song-name').get(0).clientWidth <= singlePos) {
                    $('.mobile-tablet .artist-song-name').scrollLeft(0);
                } else {
                    $('.mobile-tablet .artist-song-name').scrollLeft(singlePos + 1);
                }

            }, 30)
        });
        $(function () {
            $.smartbanner({
                appendToSelector: 'header',
                daysHidden: 0,
                daysReminder: 0,
                icon: '{{ asset("img/frontend/camologo.png") }}'
            })
            $('.sb-close').on('click', function () {
                $('#smartbanner').slideUp();
            });
        })

        $('.rd-dropdown-link').on('click', function (e) {
            $('#lyric-div').hide();
            $(".lyricType").removeClass("active");
            $(".syncType").removeClass("active");
            //$(".lyricType").prop('disabled', false);
            //$(".syncType").prop('disabled', false);
        });
    </script>
    @endpush

    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js')) !!}
    @stack('after-scripts')
    @yield('pagescripts')
</body>

</html>