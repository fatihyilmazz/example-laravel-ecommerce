@extends('web.steel.layouts.app')

@section('content')

    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('web/steel/images/mission.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Contact Us 2</h1>

                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Contact Form -->
        <div class="section-full content-inner contact-page-8 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-location-pin"></i></span>
                                            {{ setting('general_seo_title', '') }}
                                        </h5>
                                        <p class="m-b0">{{ setting('general_contact_phone', '') }}</p>
                                        <p class="m-b0">{{ setting('general_contact_e_mail', '') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-email"></i></span>
                                            {{ setting('general_seo_title', '') }}
                                        </h5>

                                        <p class="m-b0">{{ setting('general_contact_e_mail', '') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-mobile"></i></span>
                                            {{ setting('general_seo_title', '') }}
                                        </h5>
                                        <p class="m-b0">{{ setting('general_contact_phone', '') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   {{-- <div class="col-lg-8 col-md-12 m-b30">
                        <form class="inquiry-form wow fadeInUp" data-wow-delay="0.2s">
                            <h3 class="title-box font-weight-300 m-t0 m-b10">Let's Convert Your Idea into Reality <span class="bg-primary"></span></h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-user text-primary"></i></span>
                                            <input name="dzName" type="text" required class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-mobile text-primary"></i></span>
                                            <input name="dzOther[Phone]" type="text" required class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-email text-primary"></i></span>
                                            <input name="dzEmail" type="email" class="form-control" required  placeholder="Your Email Id" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-check-box text-primary"></i></span>
                                            <input name="dzOther[Subject]" type="text" required class="form-control" placeholder="Upload File">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-file text-primary"></i></span>
                                            <input name="dzOther[Subject]" type="text" required class="form-control" placeholder="Upload File">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                            <textarea name="dzMessage" rows="4" class="form-control" required placeholder="Tell us about your project or idea"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button name="submit" type="submit" value="Submit" class="site-button button-md"> <span>Get A Free Quote!</span> </button>
                                </div>
                            </div>
                        </form>
                    </div>--}}
                </div>
            </div>
        </div>
        <!-- Contact Form END -->
    </div>

@endsection()
