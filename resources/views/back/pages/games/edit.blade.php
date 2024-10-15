@extends('back.layout', ['brParam' => $gameModel])

@section('title', __('crud.meta.edition_model', ['model' => trans_choice('models.game', 1)]))
@section('description', __('crud.meta.edition_model_desc', ['model' => trans_choice('models.game', 1)]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3 w-100">
                <div class="d-flex align-items-start flex-row">
                    <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.games.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                        title="{{ __('crud.actions_model.list_all', ['model' => trans_choice('models.game', \INF)]) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    @include('breadcrumbs.breadcrumb-body', ['brParam' => $gameModel])
                </div>
                <div class="mb-md-0 mb-2">
                    @canAny(['view', 'duplicate', 'update', 'delete'], $gameModel)
                        <form class="confirmActionTS"
                            data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => $gameModel->name]) }}"
                            action="{{ route('bo.games.destroy', $gameModel) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                @if ($gameModel->published)
                                    <a class="btn btn-info" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        href="{{ route('fo.games.show', $gameModel->slug) }}"
                                        title="{{ __('crud.actions_model.show', ['model' => trans_choice('models.game', 1)]) }}"
                                        target="_blank">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                                @can('view', $gameModel)
                                    <a class="btn btn-warning" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        href="{{ route('bo.games.show', ['game' => $gameModel]) }}"
                                        title="{{ __('crud.actions_model.show', ['model' => trans_choice('models.game', 1)]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endcan
                                @can('duplicate', $gameModel)
                                    <a class="btn btn-secondary" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        href="{{ route('bo.games.duplicate', ['game' => $gameModel]) }}"
                                        title="{{ __('crud.actions_model.duplicate', ['model' => trans_choice('models.game', 1)]) }}">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                @endcan
                                @can('update', $gameModel)
                                    <button class="btn btn-primary" id="formSubmitClone" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" type="submit"
                                        title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.game', 1)]) }}">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                @endcan
                                @can('delete', $gameModel)
                                    <button class="btn btn-danger" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                                        title="{{ __('crud.actions_model.delete', ['model' => trans_choice('models.game', 1)]) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endcan
                            </div>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-body-tertiary border rounded-3 p-3">
                <p class="m-0">
                    {{ str(__('validation.attributes.updated_at'))->ucFirst() }}
                    <span class="fw-bold">{{ $gameModel->updated_at->isoFormat('LLLL') }}</span>
                </p>
            </div>
        </div>
    </div>
    @can('update', $gameModel)
        <form action="{{ route('bo.games.update', $gameModel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        @endcan
        @include('back.pages.games.form-inputs')
        @can('update', $gameModel)
            <x-back.script-button-clone />
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-primary" id="formSubmit" data-bs-tooltip="tooltip" data-bs-placement="top"
                        type="submit"
                        title="{{ __('crud.actions_model.save', ['model' => trans_choice('models.game', 1)]) }}">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </form>
    @endcan
@endsection
