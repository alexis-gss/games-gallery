@if (request()->routeIs('fo.games.index'))
    <div id="loading-screen"
        class="position-fixed top-0 start-0 d-flex flex-column justify-content-center align-items-center bg-white w-100 h-100">
        <x-front.noscript-warning />
        <p class="w-fit">{{ __('fo_text_loading') }}</p>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('fo_text_loading') }}</span>
        </div>
    </div>
@endif
