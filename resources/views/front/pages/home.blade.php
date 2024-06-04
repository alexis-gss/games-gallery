@extends('front.layout')

@section('title', $staticPageModel->seo_title ?? __('fo_home_title'))
@section('description', $staticPageModel->seo_description ?? __('fo_home_description'))

@section('content')
    <main class="main-home d-flex justify-content-center align-items-center vh-100 mx-md-5 px-md-5 m-0 p-0 py-5">
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
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    {!! $staticPageModel->toSchemaOrg()->toScript() !!}
@endpush
