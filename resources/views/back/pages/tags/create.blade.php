@extends('back.layout', ['brParam' => $tagModel])

@section('title', __('crud.meta.creation_model', ['model' => __('models.tag')]))
@section('description', __('crud.meta.creation_model_desc', ['model' => __('models.tag')]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
        <div class="d-flex align-items-start flex-row">
            <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                href="{{ route('bo.tags.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                title="{{ __('crud.actions_model.list_all', ['model' => str(__('models.tag'))->plural()]) }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            @include('breadcrumbs.breadcrumb-body', ['brParam' => $tagModel])
        </div>
        <div class="btn-toolbar mb-md-0 mb-2">
            @can('create', $tagModel)
                <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip" data-bs-placement="top"
                    type="submit" title="{{ __('crud.actions_model.save', ['model' => __('models.tag')]) }}">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
            @endcan
        </div>
    </div>
    @can('create', $tagModel)
        <form action="{{ route('bo.tags.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @endcan
        @include('back.pages.tags.form-inputs')
        @can('create', $tagModel)
            <x-back.script-button-clone />
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-primary" id="formSubmit" data-bs-tooltip="tooltip" data-bs-placement="top"
                        type="submit" title="{{ __('crud.actions_model.save', ['model' => __('models.tag')]) }}">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </form>
    @endcan
@endsection
