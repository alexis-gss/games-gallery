@extends('back.layout', ['brParam' => $staticPageModel])

@section('title', __('crud.meta.edition_model', ['model' => trans_choice('models.static_page', 1)]))
@section('description', __('crud.meta.edition_model_desc', ['model' => trans_choice('models.static_page', 1)]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3 w-100">
                <div class="d-flex align-items-start flex-row">
                    <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.static_pages.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                        title="{{ __('crud.actions_model.list_all', ['model' => trans_choice('models.static_page', \INF)]) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    @include('breadcrumbs.breadcrumb-body', ['brParam' => $staticPageModel])
                </div>
                <div class="btn-group">
                    @can('view', $staticPageModel)
                        <a class="btn btn-warning" data-bs-tooltip="tooltip" data-bs-placement="top"
                            href="{{ route('bo.static_pages.show', ['static_page' => $staticPageModel]) }}"
                            title="{{ __('crud.actions_model.show', ['model' => trans_choice('models.static_page', 1)]) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    @endcan
                    @canAny('update', $staticPageModel)
                        <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.static_page', 1)]) }}">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-body-tertiary border rounded-3 p-3">
                <p class="m-0">
                    {{ str(__('validation.attributes.updated_at'))->ucFirst() }}
                    <span class="fw-bold">{{ $staticPageModel->updated_at->isoFormat('LLLL') }}</span>
                </p>
            </div>
        </div>
    </div>
    @can('update', $staticPageModel)
        <form action="{{ route('bo.static_pages.update', $staticPageModel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        @endcan
        @include('back.pages.static_pages.form-inputs')
        @can('update', $staticPageModel)
            <x-back.script-button-clone />
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-primary" id="formSubmit" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                        title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.static_page', 1)]) }}">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </form>
    @endcan
@endsection
