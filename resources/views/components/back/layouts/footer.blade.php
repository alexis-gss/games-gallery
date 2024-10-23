<footer class="text-center px-0" id="footer">
    <div class="p-2 text-center">
        @if (isset($globalLicense))
            <span>{{ $globalLicense }}</span>
            <span>-</span>
        @endif
        @if (isset($globalName))
            <a class="text-reset text-decoration-none" data-bs-tooltip="tooltip" data-bs-placement="top"
                href="https://github.com/alexis-gss/games-gallery" title="{{ __('global_acces_github') }}" target="_blank">
                {{ $globalName }}
            </a>
            <span>-</span>
        @endif
        @if (isset($globalVersion))
            v{{ $globalVersion }}&nbsp;<span>-</span>
        @endif
        <span class="text-reset">{{ config('app.name') }}</span>
        <span>©&nbsp;{{ date('Y') }}</span>
    </div>
</footer>
