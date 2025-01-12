@extends('back.layout', ['brParam' => $userModel])

@section('title', __('crud.meta.creation_model', ['model' => __('models.user')]))
@section('description', __('crud.meta.creation_model_desc', ['model' => __('models.user')]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
        <div class="d-flex align-items-start flex-row">
            @can('viewAny', $userModel)
                <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                    href="{{ route('bo.users.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                    title="{{ __('crud.actions_model.list_all', ['model' => str(__('models.user'))->plural()]) }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            @endcan
            <x-breadcrumbs.breadcrumb-body :brParam="$userModel" />
        </div>
        <div class="btn-toolbar mb-md-0 mb-2">
            @can('create', \App\Models\User::class)
                <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip" data-bs-placement="top"
                    type="submit" title="{{ __('crud.actions_model.save', ['model' => __('models.user')]) }}">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
            @endcan
        </div>
    </div>
    @can('create', \App\Models\User::class)
    <form action="{{ route('bo.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @endcan
        <div class="row">
            <x-back.forms.user-inputs :userModel="$userModel" />
            <x-back.end-form action="create" :model="\App\Models\User::class" :modelTranslation="__('models.user')" />
        </div>
        @can('create', \App\Models\User::class)
    </form>
    @endcan
@endsection
