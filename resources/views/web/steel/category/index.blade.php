@extends('web.steel.layouts.app')

@section('content')

    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('web/steel/images/mission.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{ $category->translationForCurrentLocale->name }}</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">

                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 m-b30">
                        <aside class="side-bar shop-categories sticky-top">
                            <div class="widget recent-posts-entry">
                                <div class="dlab-accordion advanced-search toggle" id="accordion1">
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-toggle="collapse" href="#categories">
                                                    Product categories
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="categories" class="acod-body collapse show">
                                            <div class="acod-content">
                                                <div class="widget widget_services">
                                                    <ul>
                                                        @foreach($mainCategories as $key => $category)
                                                            <li>
                                                                <a href="{{ route('web.categories.index', ['slug' => $key]) }}">{{ $category }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-9 col-md-8 m-b30">
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="item-box m-b10">
                                        <div class="item-img">
                                            @php
                                                $media = ($product->images->firstWhere('order', 0)) ?? false;
                                            @endphp

                                            @if($media)
                                                <picture>
                                                    <source
                                                        id="product-{{ $product->id }}"
                                                        srcset="{{ asset(env('IMAGE_PATH_PRODUCT', \App\Media::DEFAULT_IMAGE_PATH_PRODUCT) . $media->source) }}"
                                                        type="image/png"
                                                    >
                                                    <img
                                                        src="{{ asset('images/no-image.png') }}"
                                                        onerror="document.getElementById('product-{{ $product->id }}').srcset=this.src;"
                                                    >
                                                </picture>
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}">
                                            @endif

                                            <div class="item-info-in center">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('web.products.detail', ['slug' => $product->translationForCurrentLocale->slug]) }}"
                                                           hreflang="{{ app()->getLocale() }}"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="item-info text-center text-black p-a10">
                                            <h6 class="item-title font-weight-500">
                                                <a href="{{ route('web.products.detail', ['slug' => $product->translationForCurrentLocale->slug]) }}">{{ $product->translationForCurrentLocale->name }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <span>ÜRÜN BULUNAMADI</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </div>
    </div>

@endsection()

