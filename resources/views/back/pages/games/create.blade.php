@extends('back.layout', ['brParam' => $gameModel])

@section('title', __('crud.meta.creation_model', ['model' => trans_choice('models.game', 1)]))
@section('description', __('crud.meta.creation_model_desc', ['model' => trans_choice('models.game', 1)]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
        <div class="d-flex align-items-start flex-row">
            <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                href="{{ route('bo.games.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                title="{{ __('crud.actions_model.list_all', ['model' => trans_choice('models.game', \INF)]) }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            @include('breadcrumbs.breadcrumb-body', ['brParam' => $gameModel])
        </div>
        <div class="btn-toolbar mb-md-0 mb-2">
            @can('create', $gameModel)
                <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                    title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.game', 1)]) }}">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
            @endcan
        </div>
    </div>
    @can('create', $gameModel)
        <form action="{{ route('bo.games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @endcan
        @include('back.pages.games.form-inputs')
        @can('create', $gameModel)
            <x-back.script-button-clone />
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-primary" id="formSubmit" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                        title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.game', 1)]) }}">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </form>
    @endcan
@endsection
