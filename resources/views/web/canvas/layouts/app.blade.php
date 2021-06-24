<!DOCTYPE html>
<html lang="{{ $app->getLocale() }}">
<head>

    <title>@yield('title', setting('general_seo_title', ''))</title>
    <meta name="keywords" content="@yield('title', setting('general_seo_keywords', ''))"/>
    <meta name="description" content="@yield('title', setting('general_seo_description', ''))"/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content=""/>

    <meta property="og:title" content="@yield('title', setting('general_seo_title', ''))"/>
    <meta property="og:description" content="@yield('title', setting('general_seo_description', ''))"/>
    <meta property="og:image" content="{{ asset('web/steel/images/logo.svg') }}" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{ asset('web/canvas/images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/canvas/images/favicon.png') }}"/>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if lt IE 9]>


    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{ asset('web/canvas/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/css/swiper.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/css/dark.') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/css/font-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/canvas/css/magnific-popup.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('web/canvas/css/responsive.css') }}" type="text/css" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Playfair+Display:400,400i,700,700i,900,900i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
    </style>

    <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/canvas/include/rs-plugin/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/canvas/include/rs-plugin/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/canvas/include/rs-plugin/css/navigation.css') }}">

    <style>

        .revo-slider-emphasis-text {
            font-size: 58px;
            font-weight: 700;
            letter-spacing: 1px;
            font-family: 'Raleway', sans-serif;
            padding: 15px 20px;
            border-top: 2px solid #FFF;
            border-bottom: 2px solid #FFF;
        }

        .revo-slider-desc-text {
            font-size: 20px;
            font-family: 'Lato', sans-serif;
            width: 650px;
            text-align: center;
            line-height: 1.5;
        }

        .revo-slider-caps-text {
            font-size: 16px;
            font-weight: 400;
            letter-spacing: 3px;
            font-family: 'Raleway', sans-serif;
        }

        .tp-video-play-button { display: none !important; }

        .tp-caption { white-space: nowrap; }

    </style>

    @yield('pageStyle')
</head>
<body class="stretched">
<div id="wrapper" class="clearfix">
    <div id="loading-area"></div>

    <!-- header -->
    @include('web.canvas.layouts.inc.header')
    <!-- header END -->

    <!-- Content -->
    @yield('content')
    <!-- Content END -->

    <!-- Footer -->
    @include('web.canvas.layouts.inc.footer')
    <!-- Footer END -->

    <button class="scroltop style2 radius" type="button"><i class="fa fa-arrow-up"></i></button>
</div>
<!-- External JavaScripts
============================================= -->
<script src="{{ asset('web/canvas/js/jquery.js') }}"></script>
<script src="{{ asset('web/canvas/js/plugins.js') }}"></script>

<!-- Footer Scripts
============================================= -->
<script src="{{ asset('web/canvas/js/functions.js') }}"></script>

<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
<script src="{{ asset('web/canvas/include/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('web/canvas/include/rs-plugin/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script>

    var tpj=jQuery;
    tpj.noConflict();

    tpj(document).ready(function() {

        var apiRevoSlider = tpj('#rev_slider_ishop').show().revolution(
            {
                sliderType:"standard",
                jsFileLocation:"include/rs-plugin/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {},
                responsiveLevels:[1200,992,768,480,320],
                gridwidth:1140,
                gridheight:500,
                lazyType:"none",
                shadow:0,
                spinner:"off",
                autoHeight:"off",
                disableProgressBar:"on",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    disableFocusListener:false,
                },
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"off",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "ares",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '<div class="tp-title-wrap">	<span class="tp-arr-titleholder">{{setting('general_seo_title', '')}}</span> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        }
                    }
                }
            });

        apiRevoSlider.bind("revolution.slide.onloaded",function (e) {
            SEMICOLON.slider.sliderParallaxDimensions();
        });

    }); //ready

</script>


@yield('pageScript')

</body>
</html>
