<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-front.layouts.head />
</head>

<body>
    <x-front.layouts.loading-screen />

    <main class="container overflow-hidden">
        <x-front.noscript-warning />
        <x-front.btn-github />

        {{-- NAVIGATION --}}
        @if (!request()->routeIs('fo.games.index') && isset($gameModel))
            <x-front.layouts.nav />
        @endif

        {{-- MAIN CONTENT --}}
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <x-front.layouts.footer />

    {{-- TOAST MESSAGES CONTAINER --}}
    @if (request()->routeIs('fo.games.show'))
        <div class="toast-container position-fixed top-0 p-3"></div>
    @endif

    {{-- OTHER --}}
    <x-front.window-system />
    @vite(['resources/ts/fo/front.ts'])
    @stack('scripts')
</body>

</html>
