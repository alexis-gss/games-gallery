<header
    class="navbar @auth('backend') navbar-expand-lg @else navbar-expand @endauth position-fixed fixed-top bg-body-tertiary"
    id="header">
    <div class="container-fluid">
        {{-- BUTTON MENU NAVIGATION --}}
        @auth('backend')
            <button class="navbar-toggler" data-bs-tooltip="collapse" data-bs-target="#navigation" type="button"
                aria-controls="navigation" aria-expanded="false"
                aria-label="{{ __('Afficher/Masquer le menu de navigation') }}">
                <span class="navbar-toggler-icon fa-sm"></span>
            </button>
        @endauth
        <a class="navbar-brand d-flex flex-column d-lg-block fs-4 fw-bold lh-sm me-lg-2 pe-lg-3 m-0 p-0"
            data-bs-tooltip="tooltip" data-bs-placement="bottom" href="{{ route('fo.games.index') }}"
            title="{{ __('global_access_website') }}" target="_blank">
            <span>{{ config('app.name', 'Laravel') }}</span>
            <span class="text-body-secondary fs-6 fst-italic">by {{ config('app.conceptor') }}</span>
        </a>
        {{-- BUTTON MENU USER --}}
        @auth('backend')
            <button class="navbar-toggler" data-bs-tooltip="offcanvas" data-bs-target="#menuUser" type="button" aria-controls="menuUser"
                aria-expanded="false" aria-label="{{ __('Afficher/Masquer le menu d\'utilisateur') }}">
                <i class="fa-solid fa-gear"></i>
            </button>
        @endauth
        {{-- MENU USER --}}
        <div class="offcanvas offcanvas-end" id="menuUser" aria-labelledby="menuUserContent" tabindex="-1">
            <div class="offcanvas-header border border-top-0 border-start-0 border-end-0 border-2 border-secondary">
                <h5 class="offcanvas-title" id="menuUserContent">{{ __('Menu utilisateur') }}</h5>
                <button class="btn-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto">
                    {{-- BOOTSTRAP THEMES --}}
                    <li class="nav-item dropdown @auth('backend') border-lg-end @endauth">
                        <button
                            class="btn nav-link dropdown-toggle d-flex align-items-center justify-content-center w-100 h-100 pe-lg-3 flex-row border-0"
                            data-bs-toggle="dropdown" type="button" aria-expanded="false">
                            <i class="d-none d-lg-block fa-solid fa-paint-roller"></i>
                            <span class="d-lg-none">{{ __('bo_other_change_theme') }}</span>
                        </button>
                        <form class="dropdown-menu dropdown-menu-custom dropdown-menu-end p-1 text-center" id="theme-selector"
                            action="{{ route('bo.theme.set') }}" method="POST">
                            @push('scripts')
                                <script @if (!empty($nonce)) nonce="{{ $nonce }}" @endif>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const themeSelector = document.getElementById('theme-selector');
                                        if (themeSelector) {
                                            themeSelector.addEventListener('change', function() {
                                                this.submit();
                                            });
                                        }
                                    });
                                </script>
                            @endpush
                            @csrf
                            @use('\App\Enums\Theme\BootstrapThemeEnum', 'BootstrapThemeEnum')
                            @foreach (BootstrapThemeEnum::toArray() as $key => $bootstrapTheme)
                                <input class="btn-check" id="theme{{ $key }}" name="theme" type="radio"
                                    value="{{ $bootstrapTheme->value }}">
                                <label for="theme{{ $key }}"
                                    @class([
                                        'dropdown-item btn btn-secondary py-2',
                                        'active' => !is_null(cache()->get('theme'))
                                            ? $bootstrapTheme->value === intval(cache()->get('theme'))
                                            : $bootstrapTheme->value === BootstrapThemeEnum::light->value,
                                    ])>{{ str($bootstrapTheme->label)->ucFirst() }}</label>
                            @endforeach
                        </form>
                    </li>
                    {{-- LANG SWITCH --}}
                    <li class="nav-item dropdown @auth('backend') border-lg-end @endauth">
                        <button
                            class="btn nav-link dropdown-toggle d-flex align-items-center justify-content-center w-100 h-100 px-lg-3 flex-row border-0 px-0"
                            data-bs-toggle="dropdown" type="button" aria-expanded="false">
                            <i class="d-none d-lg-block fa-solid fa-language fa-lg"></i>
                            <span class="d-lg-none">{{ __('bo_other_change_locale') }}</span>
                        </button>
                        <form class="dropdown-menu dropdown-menu-custom dropdown-menu-end p-1 text-center" id="lang-selector"
                            action="{{ route('bo.lang.set') }}" method="POST">
                            @push('scripts')
                                <script @if (!empty($nonce)) nonce="{{ $nonce }}" @endif>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const langSelector = document.getElementById('lang-selector');
                                        if (langSelector) {
                                            langSelector.addEventListener('change', function() {
                                                this.submit();
                                            });
                                        }
                                    });
                                </script>
                            @endpush
                            @csrf
                            @foreach (config('app.locales') as $key => $locale)
                                <input class="btn-check" id="lang{{ $key }}" name="lang" type="radio"
                                    value="{{ $locale }}">
                                <label for="lang{{ $key }}" @class([
                                    'dropdown-item btn btn-secondary py-2',
                                    'active' => $locale === app()->getLocale(),
                                ])>{{ str($locale)->upper() }}</label>
                            @endforeach
                        </form>
                    </li>
                    {{-- AUTHENTICATION LINKS --}}
                    @auth('backend')
                        <li class="nav-item dropdown">
                            <button
                                class="btn nav-link dropdown-toggle d-flex align-items-center justify-content-center w-100 h-100 ps-lg-3 flex-row border-0"
                                id="navbarDropdown" data-bs-toggle="dropdown" type="button">
                                <div class="d-flex flex-column align-items-start align-items-lg-end lh-1">
                                    <span class="fw-bold">
                                        {{ auth('backend')->user()->first_name }}&nbsp;{{ auth('backend')->user()->last_name }}
                                    </span>
                                    <small class="text-secondary-body">{{ str(auth('backend')->user()->role->label())->ucFirst() }}</small>
                                </div>
                                <div class="profile-picture me-1 ms-2">
                                    <img class="w-100 h-100 rounded-circle" src="{{ asset(auth('backend')->user()->picture) }}"
                                        alt="{{ auth('backend')->user()->picture_alt }}">
                                </div>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end m-0 p-1 text-center" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item w-100 text-decoration-none p-2" data-bs-tooltip="tooltip" data-bs-placement="left"
                                    href="{{ route('bo.users.show', auth('backend')->user()->getKey()) }}"
                                    title="{{ __('bo_tooltip_to_show_profile') }}">
                                    {{ __('bo_other_edit_profile') }}
                                </a>
                                <hr class="dropdown-divider m-0">
                                <form class="m-0 text-center" id="logout-form" action="{{ route('bo.logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item w-100 text-decoration-none p-2" data-bs-tooltip="tooltip" data-bs-placement="left"
                                        type="submit" title="{{ __('bo_tooltip_to_disconnect') }}">
                                        {{ __('bo_other_disconnect') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
