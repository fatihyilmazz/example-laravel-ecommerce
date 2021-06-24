@extends('web.canvas.layouts.app')

@section('content')

        <section id="page-title">

            <div class="container clearfix">
                <h1>SHOP</h1>
                <span>{{ $category->translationForCurrentLocale->name }}</span>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </div>

        </section><!-- #page-title end -->
        <!-- Content
            ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <!-- Post Content
                    ============================================= -->
                    <div class="postcontent nobottommargin col_last">

                        <!-- Shop
                        ============================================= -->
                        <div id="shop" class="shop product-3 grid-container clearfix" data-layout="fitRows">
                                @forelse($products as $product)
                                   <div class="product clearfix">
                                        <div class="product-image">
                                            @if($product->images()->exists())
                                                @foreach($product->medias as $media)
                                                    <a href="#">
                                                    <img src="{{ asset(env('PRODUCT_IMAGE_PATH', \App\Media::DEFAULT_PRODUCT_IMAGE_PATH) . $media->source) }}">
                                                    </a>
                                                @endforeach
                                            @else
                                                <a href="#">
                                                    <img src="{{ asset('images/no-image.png') }}">
                                                </a>
                                            @endif
                                            <div class="product-overlay">
                                                <a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
                                                <a href="{{ asset('include/ajax/shop-item.html')}}" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
                                            </div>
                                        </div>
                                        <div class="product-desc center">
                                            <div class="product-title"><h3><a href="#">{{ $product->translationForCurrentLocale->name }}</a></h3></div>
                                            <div class="product-price">$39.99</div>
                                            <div class="product-rating">
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star-half-full"></i>
                                                <i class="icon-star-empty"></i>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <span>ÜRÜN BULUNAMADI</span>
                                @endforelse
                        </div><!-- #shop end -->
                    </div><!-- .postcontent end -->
                    <!-- Sidebar -->
                    @include('web.canvas.layouts.inc.components.category.left_side_bar.sidebar')
                </div>
            </div>
        </section><!-- #content end -->
@endsection()

