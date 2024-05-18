@extends('front.layout')

@section('title', $staticPageModel->seo_title ?? __('fo_home_title'))
@section('description', $staticPageModel->seo_description ?? __('fo_home_description'))

@section('content')
    <main class="main-home d-flex justify-content-center align-items-center mx-md-5 px-md-5 m-0 p-0 py-5">
        <div class="row w-100">
            <div class="col-12">
                <h1 class="title-font-regular position-relative text-primary text-center w-fit px-sm-5 mx-auto mb-3 p-0 py-1">
                    {{ config('app.name') }}
                    <span class="d-none d-sm-block angles"></span>
                </h1>
                @include('front.partials.games-search')
            </div>
            <div class="col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center pt-2">
                <div class="main-home-latest d-flex justify-content-start align-items-center pb-lg-0 pb-2">
                    <div class="home-text-label">
                        <p class="fw-bold m-0">{{ __('fo_last_games_added') }}</p>
                    </div>
                    <div class="home-text-content w-100 mx-2 overflow-hidden">
                        <p class="m-0">{{ $gamesLatestString }}</p>
                    </div>
                </div>
                <div class="home-btn-group btn-group bg-secondary p-2">
                    @if (!request()->routeIs('fo.ranks.index'))
                        <a class="btn btn-primary d-flex justify-content-center align-items-center text-light bg-primary w-fit flex-row border-0 p-3"
                            data-bs-tooltip="tooltip" type="button" href="{{ route('fo.ranks.index') }}"
                            title="{{ __('fo_ranking_personnal') }}">
                            <i class="fa-solid fa-ranking-star text-white"></i>
                        </a>
                    @endif
                    <button
                        class="btn btn-primary nav-link dropdown-toggle bg-primary d-flex align-items-center border-bottom-0 border-top-0 border-end-0 border-secondary flex-row border p-3"
                        data-bs-toggle="dropdown" type="button" aria-expanded="false">
                        <i class="fa-solid fa-globe text-white"></i>
                    </button>
                    <form class="dropdown-menu dropdown-menu-custom dropdown-menu-start bg-secondary p-2 text-center" id="lang-selector"
                        action="{{ route('fo.lang.set') }}" method="POST">
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
                            <input class="btn-check" id="lang{{ $key }}" name="lang" type="radio" value="{{ $locale }}">
                            <label for="lang{{ $key }}" @class([
                                'dropdown-item btn btn-secondary text-white',
                                'active' => $locale === app()->getLocale(),
                            ])>
                                {{ str($locale)->upper() }}
                            </label>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    {!! $staticPageModel->toSchemaOrg()->toScript() !!}
@endpush
