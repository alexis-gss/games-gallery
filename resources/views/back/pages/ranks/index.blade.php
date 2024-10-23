@extends('back.layout')

@section('title', __('crud.meta.all_models', ['model' => str(__('models.rank'))->plural()]))
@section('description', __('crud.meta.all_models_list', ['model' => str(__('models.rank'))->plural()]))

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
        @include('breadcrumbs.breadcrumb-body')
    </div>
    <div class="row w-100 mx-auto">
        @can('update', \App\Models\Rank::class)
            <div class="col-12 px-0 form-group">
                <form class="d-flex flex-column flex-sm-row justify-content-center align-items-center input-group flex-row"
                    id="search" action="{{ route('bo.ranks.store') }}" method="POST">
                    <label class="input-group-text w-100 w-sm-fit" for="search-field">
                        <span class="text-truncate">
                            {{ __('crud.search.label', ['elements' => $searchFields]) }}
                        </span>
                    </label>
                    @csrf
                    @php
                        $data = [
                            'id' => 'ranksListInput',
                            'name' => 'ranks',
                            'multiple' => true,
                            'targetClass' => 'App\Models\Game',
                            'routeName' => 'bo.ranks.gamesPaginate',
                            'modelListPaginate' => $gameModels,
                            'modelSelected' => [],
                            'fieldName' => 'name',
                            'roundedBorder' => false,
                            'required' => true,
                            'disabled' => false,
                            'placeholder' => __('bo_other_rank_add'),
                        ];
                    @endphp
                    <div class="form-control w-100 border-0 p-0" id="search-belongs-to-dropdown" data-json='@json($data)'></div>
                    <x-back.input-error inputName="tags"/>
                    <button class="btn btn-primary w-100 w-sm-fit m-0" id="search-ranking-btn" data-bs-tooltip="tooltip" type="submit"
                        title="{{ __('bo_tooltip_ranking_add_game') }}">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            </div>
            <div class="col-12 bg-body-tertiary border rounded-3 p-3 mt-3">
                @php
                    $data = [
                        'id' => 'gamesRanking',
                        'rankModels' => $rankModels,
                    ];
                @endphp
                <div id="games-ranking" data-json='@json($data)'></div>
            </div>
        @endcan
    </div>
@endsection
