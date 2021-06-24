@extends('web.canvas.layouts.app')

@section('title') {{ $page->translationForCurrentLocale->metas['title'] ?? null }} @endsection
@section('description') {{ $page->translationForCurrentLocale->metas['description'] ?? null }} @endsection
@section('keywords') {{ $page->translationForCurrentLocale->metas['keywords'] ?? null }} @endsection

@section('content')

    <!-- Page Title
		============================================= -->
    <section id="page-title">
        <div class="container clearfix">
            <h1>{{ $page->translationForCurrentLocale->metas['title'] ?? null }}</h1>
        </div>
    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                {!! $page->translationForCurrentLocale->content !!}
            </div>
        </div>
    </section><!-- #content end -->

@endsection()
