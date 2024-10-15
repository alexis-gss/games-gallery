@extends('back.layout', ['brParam' => $tagModel])

@section('title', __('crud.meta.edition_model', ['model' => __('models.tag')]))
@section('description', __('crud.meta.edition_model_desc', ['model' => __('models.tag')]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3 w-100">
                <div class="d-flex align-items-start flex-row">
                    <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.tags.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                        title="{{ __('crud.actions_model.list_all', ['model' => str(__('models.tag'))->plural()]) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    @include('breadcrumbs.breadcrumb-body', ['brParam' => $tagModel])
                </div>
                @canAny(['view', 'duplicate', 'update', 'delete'], $tagModel)
                    <form class="confirmActionTS"
                        data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => $tagModel->name]) }}"
                        action="{{ route('bo.tags.destroy', $tagModel) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="btn-group" role="group">
                            @can('view', $tagModel)
                                <a class="btn btn-warning" data-bs-tooltip="tooltip" data-bs-placement="top"
                                    href="{{ route('bo.tags.show', ['tag' => $tagModel]) }}"
                                    title="{{ __('crud.actions_model.show', ['model' => __('models.tag')]) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            @endcan
                            @can('duplicate', $tagModel)
                                <a class="btn btn-secondary" data-bs-tooltip="tooltip" data-bs-placement="top"
                                    href="{{ route('bo.tags.duplicate', ['tag' => $tagModel]) }}"
                                    title="{{ __('crud.actions_model.duplicate', ['model' => __('models.tag')]) }}">
                                    <i class="fa-solid fa-copy"></i>
                                </a>
                            @endcan
                            @can('update', $tagModel)
                                <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip"
                                    data-bs-placement="top" type="submit"
                                    title="{{ __('crud.actions_model.save', ['model' => __('models.tag')]) }}">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            @endcan
                            @can('delete', $tagModel)
                                <button class="btn btn-danger" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                                    title="{{ __('crud.actions_model.delete', ['model' => __('models.tag')]) }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endcan
                        </div>
                    </form>
                @endcan
            </div>
        </div>
        <div class="col-12">
            <div class="bg-body-tertiary border rounded-3 p-3">
                <p class="m-0">
                    {{ str(__('validation.attributes.updated_at'))->ucFirst() }}
                    <span class="fw-bold">{{ $tagModel->updated_at->isoFormat('LLLL') }}</span>
                </p>
            </div>
        </div>
    </div>
    @can('update', $tagModel)
        <form action="{{ route('bo.tags.update', $tagModel) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        @endcan
        @include('back.pages.tags.form-inputs')
        @can('update', $tagModel)
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
