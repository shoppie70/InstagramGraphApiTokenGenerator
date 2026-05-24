<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ Lang::get('description.meta_description') }}">
    <title>{{ $title }}</title>

    <link rel="canonical" href="{{ request()->url() }}">

    @php
        $currentRoute = Route::currentRouteName();
        $isJa = $currentRoute ? str_ends_with($currentRoute, '.ja') : false;
        $enRoute = $currentRoute ? ($isJa ? str_replace('.ja', '.en', $currentRoute) : $currentRoute) : null;
        $jaRoute = $currentRoute ? ($isJa ? $currentRoute : str_replace('.en', '.ja', $currentRoute)) : null;
        $routeParams = request()->route() ? request()->route()->parameters() : [];
        $enUrl = $enRoute ? route($enRoute, $routeParams) : url('/');
        $jaUrl = $jaRoute ? route($jaRoute, $routeParams) : url('/ja');
    @endphp
    <link rel="alternate" hreflang="en" href="{{ $enUrl }}" />
    <link rel="alternate" hreflang="ja" href="{{ $jaUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $enUrl }}" />

    <!-- OGP Tags -->
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ Lang::get('description.meta_description') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="{{ asset('/assets/img/instagram.png') }}">
    <meta property="og:site_name" content="{{ Lang::get('common.title') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ Lang::get('description.meta_description') }}">
    <meta name="twitter:image" content="{{ asset('/assets/img/instagram.png') }}">

    @yield('json_ld')

    @yield('styles')
    @include('partials.styles')

</head>
<body class="antialiased">

@yield('main')

</body>
@include('partials.scripts')
@yield('scripts')
</html>
