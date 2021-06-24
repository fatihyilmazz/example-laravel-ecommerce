@extends('web.steel.layouts.app')

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

{{--    <div class="page-content bg-white">--}}
{{--        <!-- inner page banner -->--}}
{{--        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url(images/banner/bnr5.jpg);">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">Product Details</h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                    <div class="breadcrumb-row">--}}
{{--                        <ul class="list-inline">--}}
{{--                            <li><a href="index.html">Home</a></li>--}}
{{--                            <li>Product Details</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- inner page banner END -->--}}
{{--        <!-- contact area -->--}}
{{--        <div class="section-full content-inner bg-white">--}}
{{--            <!-- Product details -->--}}
{{--            <div class="container woo-entry">--}}
{{--                <div class="row m-b30">--}}
{{--                    <div class="col-md-5 col-lg-5 col-sm-12">--}}
{{--                        <div class="product-gallery on-show-slider lightgallery" id="lightgallery">--}}
{{--                            <div id="sync1" class="owl-carousel owl-theme owl-btn-center-lr m-b5 owl-btn-1 primary">--}}
{{--                                <div class="item">--}}
{{--                                    <div class="mfp-gallery">--}}
{{--                                        <div class="dlab-box">--}}
{{--                                            <div class="dlab-thum-bx dlab-img-overlay1 ">--}}
{{--                                                <img src="{{ asset('images/product/item1.jpg') }}" alt="">--}}
{{--                                                <div class="overlay-bx">--}}
{{--                                                    <div class="overlay-icon">--}}
{{--														<span data-exthumbimage="{{ asset('images/product/item1.jpg') }}" data-src="{{ asset('images/product/item1.jpg') }}" class="check-km" title="Image 1 Title will come here">--}}
{{--															<i class="ti-fullscreen"></i>--}}
{{--														</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="mfp-gallery">--}}
{{--                                        <div class="dlab-box">--}}
{{--                                            <div class="dlab-thum-bx dlab-img-overlay1 ">--}}
{{--                                                <img src="images/product/item2/item2.jpg" alt="">--}}
{{--                                                <div class="overlay-bx">--}}
{{--                                                    <div class="overlay-icon">--}}
{{--														<span data-exthumbimage="images/product/item2/item2.jpg" data-src="images/product/item2/item2.jpg" class="check-km" title="Image 2 Title will come here">--}}
{{--															<i class="ti-fullscreen"></i>--}}
{{--														</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="mfp-gallery">--}}
{{--                                        <div class="dlab-box">--}}
{{--                                            <div class="dlab-thum-bx dlab-img-overlay1 ">--}}
{{--                                                <img src="images/product/item2/item3.jpg" alt="">--}}
{{--                                                <div class="overlay-bx">--}}
{{--                                                    <div class="overlay-icon">--}}
{{--														<span data-exthumbimage="images/product/item2/item3.jpg" data-src="images/product/item2/item3.jpg" class="check-km" title="Image 3 Title will come here">--}}
{{--															<i class="ti-fullscreen"></i>--}}
{{--														</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="mfp-gallery">--}}
{{--                                        <div class="dlab-box">--}}
{{--                                            <div class="dlab-thum-bx dlab-img-overlay1 ">--}}
{{--                                                <img src="images/product/item2/item4.jpg" alt="">--}}
{{--                                                <div class="overlay-bx">--}}
{{--                                                    <div class="overlay-icon">--}}
{{--														<span data-exthumbimage="images/product/item2/item4.jpg" data-src="images/product/item2/item4.jpg" class="check-km" title="Image 4 Title will come here">--}}
{{--															<i class="ti-fullscreen"></i>--}}
{{--														</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="mfp-gallery">--}}
{{--                                        <div class="dlab-box">--}}
{{--                                            <div class="dlab-thum-bx dlab-img-overlay1 ">--}}
{{--                                                <img src="images/product/item2/item5.jpg" alt="">--}}
{{--                                                <div class="overlay-bx">--}}
{{--                                                    <div class="overlay-icon">--}}
{{--														<span data-exthumbimage="images/product/item2/item5.jpg" data-src="images/product/item2/item5.jpg" class="check-km" title="Image 5 Title will come here">--}}
{{--															<i class="ti-fullscreen"></i>--}}
{{--														</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div id="sync2" class="owl-carousel owl-theme owl-none">--}}
{{--                                <div class="item">--}}
{{--                                    <div class="dlab-media">--}}
{{--                                        <img src="{{ asset('images/product/item1.jpg') }}" alt="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="dlab-media">--}}
{{--                                        <img src="images/product/thumb/item2.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="dlab-media">--}}
{{--                                        <img src="images/product/thumb/item3.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="dlab-media">--}}
{{--                                        <img src="images/product/thumb/item4.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="dlab-media">--}}
{{--                                        <img src="images/product/thumb/item5.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-7 col-lg-7 col-sm-12">--}}
{{--                        <form method="post" class="cart sticky-top">--}}
{{--                            <div class="dlab-post-title">--}}
{{--                                <h4 class="post-title"><a href="javascript:void(0);">Product name</a></h4>--}}
{{--                                <p class="m-b10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</p>--}}
{{--                                <div class="dlab-divider bg-gray tb15">--}}
{{--                                    <i class="icon-dot c-square"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="relative">--}}
{{--                                <h3 class="m-tb10">$2,140.00 </h3>--}}
{{--                                <div class="shop-item-rating">--}}
{{--									<span class="rating-bx">--}}
{{--										<i class="fa fa-star"></i>--}}
{{--										<i class="fa fa-star"></i>--}}
{{--										<i class="fa fa-star"></i>--}}
{{--										<i class="fa fa-star-o"></i>--}}
{{--										<i class="fa fa-star-o"></i>--}}
{{--									</span>--}}
{{--                                    <span>4.5 Rating</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="shop-item-tage">--}}
{{--                                <span>Tags :- </span>--}}
{{--                                <a href="javascript:void(0);">Shoes,</a>--}}
{{--                                <a href="javascript:void(0);">Clothing</a>--}}
{{--                                <a href="javascript:void(0);">T-shirts</a>--}}
{{--                            </div>--}}
{{--                            <div class="dlab-divider bg-gray tb15">--}}
{{--                                <i class="icon-dot c-square"></i>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="m-b30 col-md-7 col-sm-8">--}}
{{--                                    <h6>Product Size</h6>--}}
{{--                                    <div class="btn-group product-item-size" data-toggle="buttons">--}}
{{--                                        <label class="btn active">--}}
{{--                                            <input type="radio" name="options" id="option1" checked>XS--}}
{{--                                        </label>--}}
{{--                                        <label class="btn">--}}
{{--                                            <input type="radio" name="options" id="option2"> LG--}}
{{--                                        </label>--}}
{{--                                        <label class="btn">--}}
{{--                                            <input type="radio" name="options" id="option3"> MD--}}
{{--                                        </label>--}}
{{--                                        <label class="btn">--}}
{{--                                            <input type="radio" name="options" id="option4"> SM--}}
{{--                                        </label>--}}
{{--                                        <label class="btn">--}}
{{--                                            <input type="radio" name="options" id="option5"> Xl--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="m-b30 col-md-5 col-sm-4">--}}
{{--                                    <h6>Select quantity</h6>--}}
{{--                                    <div class="quantity btn-quantity style-1">--}}
{{--                                        <input id="demo_vertical2" type="text" value="1" name="demo_vertical2"/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="m-b30">--}}
{{--                                <h6>Select the color</h6>--}}
{{--                                <div class="btn-group product-item-color" data-toggle="buttons">--}}
{{--                                    <label class="btn bg-red active">--}}
{{--                                        <input type="radio" name="options" id="option6" checked>--}}
{{--                                    </label>--}}
{{--                                    <label class="btn bg-pink">--}}
{{--                                        <input type="radio" name="options" id="option7">--}}
{{--                                    </label>--}}
{{--                                    <label class="btn bg-yellow">--}}
{{--                                        <input type="radio" name="options" id="option8">--}}
{{--                                    </label>--}}
{{--                                    <label class="btn bg-blue">--}}
{{--                                        <input type="radio" name="options" id="option9">--}}
{{--                                    </label>--}}
{{--                                    <label class="btn bg-green">--}}
{{--                                        <input type="radio" name="options" id="option10">--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <button class="site-button radius-no">--}}
{{--                                <i class="ti-shopping-cart"></i> Add To Cart--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="dlab-tabs  product-description tabs-site-button">--}}
{{--                            <ul class="nav nav-tabs ">--}}
{{--                                <li><a data-toggle="tab" href="#web-design-1" class="active"><i class="fa fa-globe"></i> Description</a></li>--}}
{{--                                <li><a data-toggle="tab" href="#graphic-design-1"><i class="fa fa-photo"></i> Additional Information</a></li>--}}
{{--                                <li><a data-toggle="tab" href="#developement-1"><i class="fa fa-cog"></i> Product Review</a></li>--}}
{{--                            </ul>--}}
{{--                            <div class="tab-content">--}}
{{--                                <div id="web-design-1" class="tab-pane active">--}}
{{--                                    <p class="m-b10">Suspendisse et justo. Praesent mattis commyolk augue Aliquam ornare hendrerit augue Cras tellus In pulvinar lectus a est Curabitur eget orci Cras laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis  commyolk augue aliquam ornare augue.</p>--}}
{{--                                    <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>--}}
{{--                                    <ul class="list-check primary">--}}
{{--                                        <li>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and </li>--}}
{{--                                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div id="graphic-design-1" class="tab-pane">--}}
{{--                                    <table class="table table-bordered" >--}}
{{--                                        <tr>--}}
{{--                                            <td>Size</td>--}}
{{--                                            <td>Small, Medium & Large</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Color</td>--}}
{{--                                            <td>Pink & White</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Rating</td>--}}
{{--                                            <td>--}}
{{--												<span class="rating-bx">--}}
{{--													<i class="fa fa-star"></i>--}}
{{--													<i class="fa fa-star"></i>--}}
{{--													<i class="fa fa-star"></i>--}}
{{--													<i class="fa fa-star-o"></i>--}}
{{--													<i class="fa fa-star-o"></i>--}}
{{--												</span>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Waist</td>--}}
{{--                                            <td>26 cm</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Length</td>--}}
{{--                                            <td>40 cm</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Chest</td>--}}
{{--                                            <td>33 inches</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Fabric</td>--}}
{{--                                            <td>Cotton, Silk & Synthetic</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Warranty</td>--}}
{{--                                            <td>3 Months</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Chest</td>--}}
{{--                                            <td>33 inches</td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                                <div id="developement-1" class="tab-pane">--}}
{{--                                    <div id="comments">--}}
{{--                                        <ol class="commentlist">--}}
{{--                                            <li class="comment">--}}
{{--                                                <div class="comment_container">--}}
{{--                                                    <img class="avatar avatar-60 photo" src="images/testimonials/pic1.jpg" alt="">--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div  class="star-rating">--}}
{{--                                                            <div data-rating="3">--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="3" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="4" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="5" title="regular"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p class="meta">--}}
{{--                                                            <strong class="author">Cobus Bester</strong>--}}
{{--                                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>--}}
{{--                                                        </p>--}}
{{--                                                        <div class="description">--}}
{{--                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li class="comment">--}}
{{--                                                <div class="comment_container">--}}
{{--                                                    <img class="avatar avatar-60 photo" src="images/testimonials/pic2.jpg" alt="">--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div  class="star-rating">--}}
{{--                                                            <div data-rating="3">--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="4" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="5" title="regular"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p class="meta">--}}
{{--                                                            <strong class="author">Cobus Bester</strong>--}}
{{--                                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>--}}
{{--                                                        </p>--}}
{{--                                                        <div class="description">--}}
{{--                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li class="comment">--}}
{{--                                                <div class="comment_container">--}}
{{--                                                    <img class="avatar avatar-60 photo" src="images/testimonials/pic3.jpg" alt="">--}}
{{--                                                    <div class="comment-text">--}}
{{--                                                        <div  class="star-rating">--}}
{{--                                                            <div data-rating="3">--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star text-yellow" data-alt="4" title="regular"></i>--}}
{{--                                                                <i class="fa fa-star-o text-yellow" data-alt="5" title="regular"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p class="meta">--}}
{{--                                                            <strong class="author">Cobus Bester</strong>--}}
{{--                                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>--}}
{{--                                                        </p>--}}
{{--                                                        <div class="description">--}}
{{--                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        </ol>--}}
{{--                                    </div>--}}
{{--                                    <div id="review_form_wrapper">--}}
{{--                                        <div id="review_form">--}}
{{--                                            <div id="respond" class="comment-respond">--}}
{{--                                                <h3 class="comment-reply-title" id="reply-title">Add a review</h3>--}}
{{--                                                <form class="comment-form" method="post" >--}}
{{--                                                    <div class="comment-form-author">--}}
{{--                                                        <label>Name <span class="required">*</span></label>--}}
{{--                                                        <input type="text" aria-required="true" size="30" value="" name="author" id="author">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-form-email">--}}
{{--                                                        <label>Email <span class="required">*</span></label>--}}
{{--                                                        <input type="text" aria-required="true" size="30" value="" name="email" id="email">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-form-rating">--}}
{{--                                                        <label class="pull-left m-r20">Your Rating</label>--}}
{{--                                                        <div class="rating-widget">--}}
{{--                                                            <!-- Rating Stars Box -->--}}
{{--                                                            <div class="rating-stars">--}}
{{--                                                                <ul id="stars">--}}
{{--                                                                    <li class="star" title="Poor" data-value="1">--}}
{{--                                                                        <i class="fa fa-star fa-fw"></i>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="star" title="Fair" data-value="2">--}}
{{--                                                                        <i class="fa fa-star fa-fw"></i>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="star" title="Good" data-value="3">--}}
{{--                                                                        <i class="fa fa-star fa-fw"></i>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="star" title="Excellent" data-value="4">--}}
{{--                                                                        <i class="fa fa-star fa-fw"></i>--}}
{{--                                                                    </li>--}}
{{--                                                                    <li class="star" title="WOW!!!" data-value="5">--}}
{{--                                                                        <i class="fa fa-star fa-fw"></i>--}}
{{--                                                                    </li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-form-comment">--}}
{{--                                                        <label>Your Review</label>--}}
{{--                                                        <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-submit">--}}
{{--                                                        <input type="submit" value="Submit" class="site-button" id="submit" name="submit">--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <h5 class="m-b20">Related Products</h5>--}}
{{--                        <div class="img-carousel-content owl-carousel owl-btn-center-lr owl-btn-1 primary">--}}
{{--                            <div class="item">--}}
{{--                                <div class="item-box">--}}
{{--                                    <div class="item-img">--}}
{{--                                        <img src="images/product/item1.jpg" alt="">--}}
{{--                                        <div class="item-info-in">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="shop-cart.html"><i class="ti-shopping-cart"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-eye"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-heart"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item-info text-center text-black p-a10">--}}
{{--                                        <h6 class="item-title text-uppercase font-weight-500"><a href="shop-product-details.html">Product Title</a></h6>--}}
{{--                                        <ul class="item-review">--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star-half-o"></i></li>--}}
{{--                                            <li><i class="fa fa-star-o"></i></li>--}}
{{--                                        </ul>--}}
{{--                                        <h4 class="item-price">--}}
{{--                                            <del>$232</del>--}}
{{--                                            <span class="text-primary">$192</span>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="item">--}}
{{--                                <div class="item-box">--}}
{{--                                    <div class="item-img">--}}
{{--                                        <img src="images/product/item2.jpg" alt="">--}}
{{--                                        <div class="item-info-in">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="shop-cart.html"><i class="ti-shopping-cart"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-eye"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-heart"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item-info text-center text-black p-a10">--}}
{{--                                        <h6 class="item-title text-uppercase font-weight-500"><a href="shop-product-details.html">Product Title</a></h6>--}}
{{--                                        <ul class="item-review">--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star-half-o"></i></li>--}}
{{--                                            <li><i class="fa fa-star-o"></i></li>--}}
{{--                                        </ul>--}}
{{--                                        <h4 class="item-price">--}}
{{--                                            <del>$232</del>--}}
{{--                                            <span class="text-primary">$192</span>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="item">--}}
{{--                                <div class="item-box">--}}
{{--                                    <div class="item-img">--}}
{{--                                        <img src="images/product/item3.jpg" alt="">--}}
{{--                                        <div class="item-info-in">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="shop-cart.html"><i class="ti-shopping-cart"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-eye"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-heart"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item-info text-center text-black p-a10">--}}
{{--                                        <h6 class="item-title text-uppercase font-weight-500"><a href="shop-product-details.html">Product Title</a></h6>--}}
{{--                                        <ul class="item-review">--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star-half-o"></i></li>--}}
{{--                                            <li><i class="fa fa-star-o"></i></li>--}}
{{--                                        </ul>--}}
{{--                                        <h4 class="item-price">--}}
{{--                                            <del>$232</del>--}}
{{--                                            <span class="text-primary">$192</span>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="item">--}}
{{--                                <div class="item-box">--}}
{{--                                    <div class="item-img">--}}
{{--                                        <img src="images/product/item4.jpg" alt="">--}}
{{--                                        <div class="item-info-in">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="shop-cart.html"><i class="ti-shopping-cart"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-eye"></i></a></li>--}}
{{--                                                <li><a href="javascript:void(0);"><i class="ti-heart"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item-info text-center text-black p-a10">--}}
{{--                                        <h6 class="item-title text-uppercase font-weight-500"><a href="shop-product-details.html">Product Title</a></h6>--}}
{{--                                        <ul class="item-review">--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star-half-o"></i></li>--}}
{{--                                            <li><i class="fa fa-star-o"></i></li>--}}
{{--                                        </ul>--}}
{{--                                        <h4 class="item-price">--}}
{{--                                            <del>$232</del>--}}
{{--                                            <span class="text-primary">$192</span>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Product details -->--}}
{{--        </div>--}}
{{--        <!-- contact area  END -->--}}
{{--        <!-- Shop Service info -->--}}
{{--        <div class="section-full p-t50 p-b20 bg-primary text-white">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-4 col-lg-4">--}}
{{--                        <div class="icon-bx-wraper left shop-service-info m-b30">--}}
{{--                            <div class="icon-md text-black radius">--}}
{{--                                <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-gift"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="icon-content">--}}
{{--                                <h5 class="dlab-tilte">Free shipping on orders $60+</h5>--}}
{{--                                <p>Order more than 60$ and you will get free shippining Worldwide. More info.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 col-lg-4">--}}
{{--                        <div class="icon-bx-wraper left shop-service-info m-b30">--}}
{{--                            <div class="icon-md text-black radius">--}}
{{--                                <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-plane"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="icon-content">--}}
{{--                                <h5 class="dlab-tilte">Worldwide delivery</h5>--}}
{{--                                <p>We deliver to the following countries: USA, Canada, Europe, Australia</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 col-lg-4">--}}
{{--                        <div class="icon-bx-wraper left shop-service-info m-b30">--}}
{{--                            <div class="icon-md text-black radius">--}}
{{--                                <a href="javascript:void(0);" class="icon-cell text-white"><i class="fa fa-history"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="icon-content">--}}
{{--                                <h5 class="dlab-tilte">60 days money back guranty!</h5>--}}
{{--                                <p>Not happy with our product, feel free to return it, we will refund 100% your money!</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Shop Service info End -->--}}
{{--    </div>--}}


    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('web/steel/images/mission.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{ $product->translationForCurrentLocale->name }}</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white">
            <!-- Product details -->
            <div class="container woo-entry">
                <div class="row m-b30">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <div class="product-gallery on-show-slider lightgallery" id="lightgallery">
                            <div id="sync1" class="owl-carousel owl-theme owl-btn-center-lr m-b5 owl-btn-1 primary">
                                @php
                                    $medias = $product->images->where('media_type', 1) ?? [] ;
                                @endphp

                                @forelse($medias as $media)
                                    <div class="item">
                                        <div class="mfp-gallery">
                                            <div class="dlab-box">
                                                <div class="dlab-thum-bx dlab-img-overlay1 ">
                                                    <img
                                                        src="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT) . $media->source) }}"
                                                        title="{{ $media->content->title }}"
                                                        alt="{{ $media->content->alt }}"
                                                    >
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon">
														<span
                                                            data-exthumbimage="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT) . $media->source) }}"
                                                            data-src="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT) . $media->source) }}"
                                                            class="check-km" title="{{ $media->content->title }}">
															<i class="ti-fullscreen"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <div class="mfp-gallery">
                                            <div class="dlab-box">
                                                <div class="dlab-thum-bx dlab-img-overlay1 ">
                                                    <img src="{{ asset('images/no-image.png') }}">
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon">
														<span
                                                            data-exthumbimage="{{ asset('images/no-image.png') }}"
                                                            data-src="{{ asset('images/no-image.png') }}"
                                                            class="check-km" title="">
															<i class="ti-fullscreen"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div id="sync2" class="owl-carousel owl-theme owl-none">
                                @forelse($medias as $media)
                                    <div class="item">
                                        <div class="dlab-media">
                                            <img
                                                src="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT) . $media->source) }}"
                                                title="{{ $media->content->title }}"
                                                alt="{{ $media->content->alt }}"
                                            >
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <div class="dlab-media">
                                            <img src="{{ asset('images/no-image.png') }}" alt="">
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12">
                        <form method="post" class="cart sticky-top">
                            <div class="dlab-post-title">
                                <h4 class="post-title"><a href="javascript:void(0);">{{ $product->translationForCurrentLocale->name }}</a></h4>
                                <p class="m-b10">{{ $product->translationForCurrentLocale->short_description }}</p>
                            </div>
                            <div class="dlab-divider bg-gray tb15">
                                <i class="icon-dot c-square"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dlab-tabs  product-description tabs-site-button">
                            <ul class="nav nav-tabs ">
                                <li><a data-toggle="tab" href="#web-design-1" class="active"><i class="fa fa-globe"></i> Description</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane active">
                                    {!! $product->translationForCurrentLocale->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product details -->
        </div>
        <!-- contact area  END -->
    </div>
@stop

@section('pageScript')
    <script>
        $(document).ready(function() {

            var sync1 = $("#sync1");
            var sync2 = $("#sync2");
            var slidesPerPage = 4; //globaly define number of elements per page
            var syncedSecondary = true;

            sync1.owlCarousel({
                items : 1,
                slideSpeed : 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate : 200,
                navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            }).on('changed.owl.carousel', syncPosition);

            sync2.on('initialized.owl.carousel', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            }).owlCarousel({
                items : slidesPerPage,
                dots: false,
                nav: false,
                margin:5,
                smartSpeed: 200,
                slideSpeed : 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate : 100
            }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count-1;
                var current = Math.round(el.item.index - (el.item.count/2) - .5);

                if(current < 0) {
                    current = count;
                }
                if(current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if(syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = $(this).index();
                //sync1.data('owl.carousel').to(number, 300, true);

                sync1.data('owl.carousel').to(number, 300, true);

            });
        });

        $(".my-rating").starRating({
            initialRating: 4,
            strokeColor: '#894A00',
            strokeWidth: 10,
            starSize: 25
        });
    </script>
@endsection
