@extends('web.steel.layouts.app')

@section('title') {{ $page->translationForCurrentLocale->metas['title'] ?? null }} @endsection
@section('description') {{ $page->translationForCurrentLocale->metas['description'] ?? null }} @endsection
@section('keywords') {{ $page->translationForCurrentLocale->metas['keywords'] ?? null }} @endsection

@section('content')

    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url({{ asset('web/steel/images/mission.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h1 class="text-white">{{ $page->translationForCurrentLocale->metas['title'] ?? null }}</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-block">
            <div class="section-full content-inner bg-white video-section" style="background-image:url('images/background/bg-video.png');">
                <div class="container">
                    <div class="section-content">
                        {!! $page->translationForCurrentLocale->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
