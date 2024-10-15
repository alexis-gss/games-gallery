<!doctype html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('back.layouts.head')
</head>

{{-- blade-formatter-disable --}}
@use('\App\Enums\Theme\BootstrapThemeEnum', 'BootstrapThemeEnum')
<body class="bg-body-tertiary" data-bs-theme="{{ (BootstrapThemeEnum::make(intval(cache()->get('theme'))) ?? BootstrapThemeEnum::light)->name() }}">
    {{-- HEADER --}}
    @include('back.layouts.header')

    {{-- MAIN CONTENT --}}
    <main class="@auth('backend') container-fluid @else container d-flex flex-column align-items-center justify-content-center @endauth">
        <div class="row">
            @include('back.layouts.navigation')
            <section id="page-content" class="col-12 bg-body rounded-3 border p-3 py-2 py-md-3">
                <div class="container">
                    <x-back.noscript-warning/>
                    @auth('backend')
                        @include('back.modules.flash-messages')
                    @endauth
                    @yield('content')
                </div>
            </section>
        </div>
    </main>

    {{-- FOOTER --}}
    @include('back.layouts.footer')

    {{-- OTHER --}}
    @include('back.modules.window-system')
    @vite(['resources/ts/bo/back.ts'])
    @stack('scripts')
</body>
{{-- blade-formatter-enable --}}

</html>
