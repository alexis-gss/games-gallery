@extends('back.layout', ['brParam' => $game])

@section('title', __('crud.meta.edition_model', ['model' => Str::singular(__('models.games'))]))
@section('description', __('crud.meta.edition_model_desc', ['model' => Str::singular(__('models.games'))]))
@section('breadcrumb', request()->route()->getName())

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-3 border-bottom">
    <div class="d-flex flex-row align-items-start">
        <a href="{{ route('bo.games.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
            class="btn btn-primary text-decoration-none m-0"
            data-bs="tooltip"
            data-bs-placement="top"
            title="{{ __('crud.actions_model.list_all', ['model' => __('models.games')]) }}">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        @include('breadcrumbs.breadcrumb-body', ['brParam' => $game])
    </div>
    <div class="mb-2 mb-md-0">
        <form action="{{ route('bo.games.destroy', $game->id) }}"
            method="POST"
            class="confirmDeleteTS">
            @csrf
            @method('DELETE')
            <div class="btn-group" role="group">
                <a href="{{ route('fo.games.specific', $game->slug) }}"
                    class="btn btn-warning"
                    target="_blank"
                    data-bs="tooltip"
                    data-bs-placement="top"
                    title="{{ __('crud.actions_model.show', ['model' => Str::singular(__('models.games'))]) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <a class="btn btn-secondary"
                    href="{{ route('bo.games.duplicate', ['game' => $game->id]) }}"
                    data-bs="tooltip"
                    data-bs-placement="top"
                    title="{{ __('crud.actions_model.duplicate', ['model' => Str::singular(__('models.games'))]) }}">
                    <i class="fa-solid fa-copy"></i>
                </a>
                <button id="formSubmitClone"
                    type="submit"
                    class="btn btn-primary"
                    data-bs="tooltip"
                    data-bs-placement="top"
                    title="{{ __('crud.actions_model.save', ['model' => Str::singular(__('models.games'))]) }}">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
                <button type="submit"
                    class="btn btn-danger"
                    data-bs="tooltip"
                    data-bs-placement="top"
                    title="{{ __('crud.actions_model.delete', ['model' => Str::singular(__('models.games'))]) }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<form action="{{ route('bo.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('back.pages.games.form-inputs')
    <div class="row mt-3">
        <div class="col text-center">
            <button id="formSubmit"
                type="submit"
                class="btn btn-primary"
                data-bs="tooltip"
                data-bs-placement="top"
                title="{{ __('crud.actions_model.save', ['model' => Str::singular(__('models.games'))]) }}">
                <i class="fa-solid fa-floppy-disk"></i>
            </button>
        </div>
    </div>
</form>
@endsection