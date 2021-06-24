<!DOCTYPE html>
<html lang="{{ $app->getLocale() }}" >
<!-- begin::Head -->
<head><!--begin::Base Path (base relative path for assets of this page) -->
    <base href="{{ env('APP_URL') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex" />
    <meta charset="utf-8"/>

    <title>{{ __('text.login') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body>
    @yield('content')
</body>
<!-- end::Body -->
</html>
