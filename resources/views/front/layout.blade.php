<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('front.layouts.head')
</head>

<body>
    @if (request()->routeIs('fo.games.index'))
        @include('front.layouts.loading-screen')
    @endif

    <div class="container overflow-hidden">
        @include('front.partials.btn-github')

        @if (request()->routeIs('fo.games.show') || request()->routeIs('fo.ranks.index'))
            @include('front.layouts.nav')
        @endif

        <div data-aos="fade">
            <!-- Main content -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('front.layouts.footer')

    <!-- Toast messages container -->
    @if (request()->routeIs('fo.games.show'))
        <div class="toast-container position-fixed top-0 p-3"></div>
    @endif

    <!-- Other -->
    @include('front.modules.window-system')
    @vite(['resources/ts/fo/front.ts'])
    @stack('scripts')
</body>

</html>
