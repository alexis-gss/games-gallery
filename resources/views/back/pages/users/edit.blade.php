@extends('back.layout', ['brParam' => $userModel])

@section('title', __('crud.meta.edition_model', ['model' => __('models.user')]))
@section('description', __('crud.meta.edition_model_desc', ['model' => __('models.user')]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3 w-100">
                <div class="d-flex align-items-start flex-row">
                    <a class="btn btn-primary text-decoration-none m-0" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.users.index', ['sort_col' => 'updated_at', 'sort_way' => 'desc']) }}"
                        title="{{ __('crud.actions_model.list_all', ['model' => str(__('models.user'))->plural()]) }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    @include('breadcrumbs.breadcrumb-body', ['brParam' => $userModel])
                </div>
                <div class="btn-group">
                    @can('resetPassword', $userModel)
                        <form class="confirmActionTS"
                            data-sweetalert-message="{{ __('crud.sweetalert.send_email', ['modelName' => sprintf('%s %s', $userModel->first_name, $userModel->last_name)]) }}"
                            data-sweetalert-btn-accept="{{ __('crud.sweetalert.send') }}" data-sweetalert-btn-color="success"
                            method="POST" action="{{ route('bo.password.email', ['email' => $userModel->email]) }}">
                            @csrf
                            <button class="btn btn-light rounded-end-0 w-fit" data-bs-tooltip="tooltip" type="submit"
                                title="{{ str(__('auth.reset_password_send'))->ucfirst() }}">
                                <i class="fa-solid fa-key"></i>
                            </button>
                        </form>
                    @endcan
                    @canAny(['view', 'duplicate', 'update', 'delete'], $userModel)
                        <form class="confirmActionTS"
                            data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => sprintf('%s %s', $userModel->first_name, $userModel->last_name)]) }}"
                            action="{{ route('bo.users.destroy', $userModel) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                @can('isConceptor')
                                    <a class="btn btn-info @can('resetPassword', $userModel) rounded-start-0 @endcan"
                                        data-bs-tooltip="tooltip"
                                        href="{{ route('bo.activity_logs.user', ['user' => $userModel]) }}"
                                        title="{{ str(trans_choice('models.activity_log', 1))->ucfirst() }}">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </a>
                                @endcan
                                @can('view', $userModel)
                                    <a class="btn btn-warning" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        href="{{ route('bo.users.show', ['user' => $userModel]) }}"
                                        title="{{ __('crud.actions_model.show', ['model' => __('models.user')]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endcan
                                @can('duplicate', $userModel)
                                    <a class="btn btn-secondary" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        href="{{ route('bo.users.duplicate', ['user' => $userModel]) }}"
                                        title="{{ __('crud.actions_model.duplicate', ['model' => __('models.user')]) }}">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                @endcan
                                @can('update', $userModel)
                                    <button
                                        class="btn btn-primary @can(['resetPassword', 'duplicate'], $userModel) rounded-start-0 @endcan"
                                        id="formSubmitClone" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                                        title="{{ __('crud.actions_model.save', ['model' => __('models.user')]) }}">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                @endcan
                                @can('delete', $userModel)
                                    <button
                                        class="btn btn-danger @can(['resetPassword', 'duplicate', 'update'], $userModel) rounded-start-0 @endcan"
                                        data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                                        title="{{ __('crud.actions_model.delete', ['model' => __('models.user')]) }}">
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
                    <span class="fw-bold">{{ $userModel->updated_at->isoFormat('LLLL') }}</span>
                </p>
            </div>
        </div>
    </div>
    @can('update', $userModel)
        <form action="{{ route('bo.users.update', $userModel) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        @endcan
        @include('back.pages.users.form-inputs')
        @can('update', $userModel)
            <x-back.script-button-clone />
            <div class="row mt-3">
                <div class="col text-center">
                    <button class="btn btn-primary" id="formSubmit" data-bs-tooltip="tooltip" data-bs-placement="top"
                        type="submit" title="{{ __('crud.actions_model.save', ['model' => __('models.user')]) }}">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
        </form>
    @endcan
@endsection
