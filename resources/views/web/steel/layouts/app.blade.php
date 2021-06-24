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
    <link rel="icon" href="{{ asset('web/steel/images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/steel/images/favicon.png') }}"/>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if lt IE 9]>
    <script src="{{ asset('web/steel/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('web/steel/js/respond.min.js') }}"></script>
    <![endif]-->

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/steel/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/steel/css/style.min.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('web/steel/css/skin/skin-9.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/steel/css/templete.min.css') }}">
    <!-- Google Font -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Playfair+Display:400,400i,700,700i,900,900i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
    </style>

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/steel/plugins/revolution/revolution/css/revolution.min.css') }}">

    @yield('pageStyle')
</head>
<body id="bg">
<div class="page-wraper">
    <div id="loading-area"></div>

    <!-- header -->
    @include('web.steel.layouts.inc.header')
    <!-- header END -->

    <!-- Content -->
    @yield('content')
    <!-- Content END -->

    <!-- Footer -->
    @include('web.steel.layouts.inc.footer')
    <!-- Footer END -->

    <button class="scroltop style2 radius" type="button"><i class="fa fa-arrow-up"></i></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{ asset('web/steel/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
<script src="{{ asset('web/steel/plugins/wow/wow.js') }}"></script><!-- WOW JS -->
<script src="{{ asset('web/steel/plugins/bootstrap/js/popper.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('web/steel/plugins/bootstrap/js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('web/steel/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('web/steel/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('web/steel/plugins/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('web/steel/plugins/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('web/steel/plugins/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
<script src="{{ asset('web/steel/plugins/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('web/steel/plugins/masonry/masonry-3.1.4.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('web/steel/plugins/masonry/masonry.filter.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('web/steel/plugins/owl-carousel/owl.carousel.js') }}"></script><!-- OWL SLIDER -->
<script src="{{ asset('web/steel/plugins/lightgallery/js/lightgallery-all.min.js') }}"></script><!-- Lightgallery -->
<script src="{{ asset('web/steel/js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('web/steel/js/dz.carousel.min.js') }}"></script><!-- SORTCODE FUCTIONS  -->
<script src="{{ asset('web/steel/plugins/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="{{ asset('web/steel/js/dz.ajax.js') }}"></script><!-- CONTACT JS  -->
<script src="{{ asset('web/steel/plugins/rangeslider/rangeslider.js') }}" ></script><!-- Rangeslider -->

<script src="{{ asset('web/steel/js/jquery.lazy.min.js') }}"></script>
<!-- REVOLUTION JS FILES -->
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('web/steel/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('web/steel/js/rev.slider.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        'use strict';
        dz_rev_slider_8();
        $('.lazy').Lazy();
    });	/*ready*/
</script>

@yield('pageScript')

</body>
</html>
