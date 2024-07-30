@extends('front.layout', ['brParam' => $gameModel])

@section('title', $gameModel->name ?? __('fo_home_title'))
@section('description', __('fo_description', ['game' => $gameModel->name]) ?? __('fo_home_description'))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <main class="main-page">
        <div class="col-12 py-5">
            <h1 class="title-font-regular position-relative mx-auto mb-3 w-fit px-5 py-1 text-center">
                {{ $gameModel->name }}
                <span class="d-none d-sm-block angles"></span>
            </h1>
            <div
                class="d-flex justify-content-center align-items-center user-select-none w-100 flex-row flex-wrap text-center">
                <div class="rounded-2 shadow">
                    <a class="btn btn-primary text-decoration-none text-white border-0 rounded-2 px-2 py-0"
                        data-bs-tooltip="tooltip" data-bs-placement="top" href="{{ route('fo.games.index') }}"
                        title="{{ __('bo_other_back_home') }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
                <span class="mx-1">-</span>
                <p class="rounded-2 text-white shadow m-0 px-2 py-0"
                    style="background-color:{{ $gameModel->folder->color }}">
                    {{ $gameModel->folder->name }}
                </p>
                @if (count($gameModel->tags) > 0 && $gameModel->tags->contains('published', true))
                    <span class="ms-1">-</span>
                    @foreach ($gameModel->tags->sortBy('name') as $tag)
                        @if ($tag->published)
                            <p class="bg-secondary text-white rounded-2 shadow my-1 ms-1 px-2 py-0">
                                {{ $tag->name }}
                            </p>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="d-flex flex-column flex-sm-row-reverse justify-content-center align-items-center w-100 mt-3 px-1">
                <p class="text-secondary mb-3 ms-sm-5 m-sm-0">
                    <i class="fa-regular fa-eye"></i>
                    {{ sprintf(
                        '%s %s',
                        count($gameModel->visits),
                        count($gameModel->visits) > 1 ? str(__('models.visit'))->plural() : __('models.visit'),
                    ) }}
                </p>
                <p class="text-secondary m-0">
                    <i class="fa-regular fa-clock"></i>
                    {{ $gameModel->published_at->lessThan(Carbon::now()->sub(1, 'day'))
                        ? sprintf('%s %s', str(__('validation.custom.published_at'))->ucFirst(), $gameModel->published_at->isoFormat('LL'))
                        : sprintf('%s %s', str(__('validation.custom.published'))->ucFirst(), $gameModel->published_at->diffForHumans()) }}
                </p>
            </div>
        </div>
        <div class="col-12">
            @php
                $dataGame = [
                    'gameName' => $gameModel->name,
                    'gameSlug' => $gameModel->slug,
                    'gamePictures' => $gamePictures,
                    'ratingModels' => $ratingModels,
                    'relatedGamesViews' => $relatedGamesViews,
                ];
            @endphp
            <div class="game-pictures" data-json='@json($dataGame)'></div>
        </div>
    </main>
@endsection

@push('scripts')
    {!! $gameModel->toSchemaOrg()->toScript() !!}
@endpush
