{{-- Title --}}
{{-- blade-formatter-disable --}}
<title>{{ config('app.name') }}@hasSection('title') - @yield('title')@endif</title>
{{-- blade-formatter-enable --}}

{{-- Meta --}}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="@yield('description')">
<meta name="robots" content="index,follow">

{{-- Open Graph --}}
{{-- blade-formatter-disable --}}
<meta property="og:title" content="{{ config('app.name') }}@hasSection('title') - @yield('title')@endif">
{{-- blade-formatter-enable --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ \config('app.url') }}/{{ \request()->path() }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:image" content="{{ asset('assets/images/visual-fo.png') }}">
<meta property="og:description" content="@yield('description')">

{{--  Favicon --}}
<link href="{{ asset('favicon.ico') }}" rel="icon">
<link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
<link type="image/png" href="{{ asset('favicon-16x16.png') }}" rel="icon" sizes="16x16">
<link type="image/png" href="{{ asset('favicon-32x32.png') }}" rel="icon" sizes="32x32">
<link href="{{ asset('site.webmanifest') }}" rel="manifest">
<link href="{{ asset('safari-pinned-tab.svg') }}" rel="mask-icon" color="#5bbad5">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="msapplication-TileImage" content="{{ asset('mstile-144x144.png') }}">
<meta name="theme-color" content="#121416">

{{-- Others --}}
<link href="{{ \config('app.url') }}/{{ \request()->path() }}" rel="canonical">
@include('breadcrumbs.breadcrumb-head')

{{-- Styles --}}
@vite(['resources/sass/fo/front.scss'])
@stack('styles')

{{-- DEBUG --}}
@if (config('app.debug'))
    <script @if (!empty($nonce)) nonce="{{ $nonce }}" @endif>
        window.vueDebug = true;
    </script>
@endif
