@extends('web.steel.layouts.app')

@section('content')
    <div class="page-content bg-white">
        <!-- Slider -->
        <div class="main-slider style-two default-banner">
            <div class="tp-banner-container">
                <div class="tp-banner">
                    <div id="rev_slider_1069_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="restaurant-header" data-source="gallery" style="background-color:#222222;padding:0px;">
                        <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
                        <div id="rev_slider_1069_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
                            <ul>    <!-- SLIDE  -->
                                <li data-index="rs-3015"
                                    data-transition="fade"
                                    data-slotamount="default"
                                    data-hideafterloop="0"
                                    data-hideslideonmobile="off"
                                    data-easein="Power4.easeInOut"
                                    data-easeout="default"
                                    data-masterspeed="2000"
                                    data-rotate="0"
                                    data-saveperformance="off"
                                    data-title="Slide"
                                    data-param1=""
                                    data-param2=""
                                    data-param3=""
                                    data-param4=""
                                    data-param5=""
                                    data-param6=""
                                    data-param7=""
                                    data-param8=""
                                    data-param9=""
                                    data-param10=""
                                    data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ asset('images/sliders/slider_bg.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="3" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- BACKGROUND VIDEO LAYER -->
                                    <div class="rs-background-video-layer"
                                         data-forcerewind="on"
                                         data-volume="mute"
                                         data-videowidth="100%"
                                         data-videoheight="100%"
                                         data-videomp4="videos/haddecilik.mp4"
                                         data-videopreload="auto"
                                         data-videoloop="loopandnoslidestop"
                                         data-aspectratio="16:9"
                                         data-autoplay="true"
                                         data-autoplayonlyfirsttime="false">
                                    </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption tp-shape tp-shapewrapper"
                                         id="slide-3015-layer-1"
                                         data-x="['center','center','center','center']"
                                         data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']"
                                         data-voffset="['0','0','0','0']"
                                         data-width="full"
                                         data-height="full"
                                         data-whitespace="nowrap"
                                         data-type="shape"
                                         data-basealign="slide"
                                         data-responsive_offset="off"
                                         data-responsive="off"
                                         data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 7; background-color:rgba(51, 51, 51, 0.6);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>
                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                                         id="slide-3015-layer-6"
                                         data-x="['center','center','center','center']"
                                         data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']"
                                         data-voffset="['-86','-86','-86','-86']"
                                         data-width="100"
                                         data-height="2"
                                         data-whitespace="nowrap"
                                         data-type="shape"
                                         data-responsive_offset="on"
                                         data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 8; background-color:rgba(255, 255, 255, 0.25);border-color:rgba(0, 0, 0, 0);border-width:0px;">
                                    </div>
                                    <!-- LAYER NR. 5 -->
                                    <div class="tp-caption Dining-Title tp-resizeme"
                                         id="slide-3015-layer-7"
                                         data-x="['center','center','center','center']"
                                         data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']"
                                         data-voffset="['-158','-158','-158','-158']"
                                         data-width="none"
                                         data-height="none"
                                         data-whitespace="nowrap"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                         data-textAlign="['center','center','center','center']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 9; white-space: nowrap; font-size: 100px; line-height: 100px;">
                                        <img src="{{ asset('images/common/banner_ico.svg') }}" alt=""/>
                                    </div>
                                    <!-- LAYER NR. 6 -->
                                    <div class="tp-caption Dining-Title tp-resizeme"
                                         id="slide-3015-layer-2"
                                         data-x="['center','center','center','center']"
                                         data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']"
                                         data-voffset="['-28','-28','-37','-28']"
                                         data-fontsize="['70','70','50','30']"
                                         data-lineheight="['70','70','50','30']"
                                         data-width="none"
                                         data-height="none"
                                         data-whitespace="nowrap"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1750,"ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 10; white-space: nowrap; font-family: 'Poppins', sans-serif; font-weight:500;">WE MAKE EVERYTHING WITH PASSION</div>

                                    <!-- LAYER NR. 8 -->
                                    <a class="tp-caption Dining-BtnLight rev-btn"
                                       href="{{ route('web.static_pages.contact') }}"
                                       id="slide-3015-layer-8"
                                       data-x="['center','center','center','center']"
                                       data-hoffset="['-150','-150','0','0']"
                                       data-y="['middle','middle','middle','middle']"
                                       data-voffset="['100','120','120','120']"
                                       data-width="none"
                                       data-height="none"
                                       data-whitespace="nowrap"
                                       data-type="button"
                                       data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""},{"event":"mouseenter","action":"startlayer","layer":"slide-3015-layer-14","delay":""},{"event":"mouseleave","action":"stoplayer","layer":"slide-3015-layer-14","delay":""}]'
                                       data-responsive_offset="off"
                                       data-responsive="off"
                                       data-frames='[{"from":"y:50px;opacity:0;","speed":2000,"to":"o:1;","delay":2250,"ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"200","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]'
                                       data-textAlign="['left','left','left','left']"
                                       data-paddingtop="[17,17,17,17]"
                                       data-paddingright="[73,73,73,73]"
                                       data-paddingbottom="[17,17,17,17]"
                                       data-paddingleft="[50,50,50,50]"
                                       style="z-index: 12; white-space: nowrap; outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer; font-family: 'Poppins', sans-serif;">
                                        <i class="la la-phone" style="font-size:25px; float: left; margin-top:-6px; margin-right: 10px"></i>
                                        {{ __('text.contact') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                        </div>
                    </div><!-- END REVOLUTION SLIDER -->
                </div>
            </div>
        </div>
        <!-- Slider END -->
        <!-- contact area -->
        <div class="content-block">
            <div class="section-full content-inner bg-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12 m-b30 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="our-story">
                                <span>OUR STORY</span>
                                <h2 class="title">Running a <br/>successful business <br/><span class="text-primary">since 1955</span></h2>
                                <h4 class="title">Industrial engineering is a branch of engineering which deals with the optimization.</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting Factory. Lorem Ipsum has been the Factory's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting Factory.</p>
                                <a href="about-2.html" class="site-button btnhover20">About Us</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 m-b30 our-story-thum wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                            <img src="{{ asset('web/steel/images/hakkimizda.png') }}" class="radius-sm" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Us End -->
            <!-- Our Services -->
            <div class="section-full content-inner overlay-black-middle bg-img-fix" style="background-image: url({{ asset('web/steel/images/mission.png') }});">
                <div class="container">
                    <div class="section-content row text-black">
                        <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="icon-bx-wraper">
                                <div class="icon-content">
                                    <div class="row">
                                        <div class="col-md-9"><h2 class="dlab-tilte">Visyonumuz - Misyonumuz</h2></div>
                                        <div class="col-md-3"><img src="{{ asset('web/steel/images/etik.svg') }}" alt=""></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="icon-bx-wraper">
                                <div class="icon-content">
                                    <div class="row">
                                        <div class="col-md-9"><h2 class="dlab-tilte">Kalite Politikamız</h2></div>
                                        <div class="col-md-3"><img src="{{ asset('web/steel/images/etik.svg') }}" alt=""></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="icon-bx-wraper">
                                <div class="icon-content">
                                    <div class="row">
                                        <div class="col-md-9"><h2 class="dlab-tilte">Etik Değerlemiz</h2></div>
                                        <div class="col-md-3"><img src="{{ asset('web/steel/images/etik.svg') }}" alt=""></div>
                                    </div>

                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Our Services End -->

            <!-- About Me End -->
            <div class="section-full content-inner" style="background-color: #ffffff">
                <div class="container">
                    <div class="section-head style2 text-center text-white">
                        <h2 class="title">Latest blog post</h2>
                        <p>There are many variations of passages of Lorem Ipsum typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
                    </div>
                    <div class="blog-carousel owl-carousel owl-btn-3 owl-btn-center-lr btn-white">
                        <div class="item wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                            <div class="blog-post blog-grid blog-rounded blog-effect1">
                                <div class="dlab-post-media dlab-img-effect">
                                    <a href="blog-single.html"><img src="{{ asset('web/steel/images/export.jpg') }}" alt=""></a>
                                </div>
                                <div class="dlab-info p-a20 border-1">
                                    <div class="dlab-post-meta">
{{--                                        <ul>--}}
{{--                                            <li class="post-date"> <strong>10 Aug</strong> <span> 2016</span> </li>--}}
{{--                                        </ul>--}}
                                    </div>
                                    <div class="dlab-post-title">
                                        <h4 class="post-title"><a href="blog-single.html">EXPORT / İHRAÇAT</a></h4>
                                    </div>
                                    <div class="dlab-post-text">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true.</p>
                                    </div>
                                    <div class="dlab-post-readmore">
{{--                                        <a href="blog-single.html" title="READ MORE" rel="bookmark" class="site-button btnhover20">READ MORE--}}
{{--                                            <i class="ti-arrow-right"></i>--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                            <div class="blog-post blog-grid blog-rounded blog-effect1">
                                <div class="dlab-post-media dlab-img-effect">
                                    <a href="blog-single.html"><img src="{{ asset('web/steel/images/sector.jpg') }}" alt=""></a>
                                </div>
                                <div class="dlab-info p-a20 border-1">
                                    <div class="dlab-post-meta">
                                    </div>
                                    <div class="dlab-post-title">
                                        <h4 class="post-title"><a href="blog-single.html">SEKTÖR TECRÜBEMİZ</a></h4>
                                    </div>
                                    <div class="dlab-post-text">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true.</p>
                                    </div>
                                    <div class="dlab-post-readmore">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.9s">
                            <div class="blog-post blog-grid blog-rounded blog-effect1">
                                <div class="dlab-post-media dlab-img-effect">
                                    <a href="blog-single.html"><img src="{{ asset('web/steel/images/certificate.jpg') }}" alt=""></a>
                                </div>
                                <div class="dlab-info p-a20 border-1">
                                    <div class="dlab-post-meta">
                                    </div>
                                    <div class="dlab-post-title">
                                        <h4 class="post-title"><a href="blog-single.html">KALİTE SERTİFİKALARIMIZ</a></h4>
                                    </div>
                                    <div class="dlab-post-text">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true.</p>
                                    </div>
                                    <div class="dlab-post-readmore">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services -->
        </div>
        <!-- contact area END -->
    </div>
@endsection()
