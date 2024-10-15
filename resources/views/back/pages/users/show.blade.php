@extends('back.layout', ['brParam' => $userModel])

@section('title', __('Édition d\'un :model', ['model' => __('models.user')]))
@section('description', __('Édition d\'un :model déjà existant', ['model' => __('models.user')]))
@section('breadcrumb', request()->route()->getName())

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
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
            @canAny(['delete', 'duplicate', 'update'], $userModel)
                <form class="btn-group confirmActionTS"
                    data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => sprintf('%s %s', $userModel->first_name, $userModel->last_name)]) }}"
                    action="{{ route('bo.users.destroy', $userModel->getKey()) }}" method="POST" novalidate>
                    @can('duplicate', $userModel)
                        <a class="btn btn-secondary" data-bs-tooltip="tooltip" data-bs-placement="top"
                            href="{{ route('bo.users.duplicate', $userModel) }}"
                            title="{{ __('crud.actions_model.duplicate', ['model' => __('models.user')]) }}">
                            <i class="fa-solid fa-copy"></i>
                        </a>
                    @endcan
                    @can('update', $userModel)
                        <a class="btn btn-primary" data-bs-tooltip="tooltip" data-bs-placement="top"
                            href="{{ route('bo.users.edit', $userModel) }}"
                            title="{{ __('crud.actions_model.edit', ['model' => __('models.user')]) }}">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    @endcan
                    @can('delete', $userModel)
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                            title="{{ __('crud.actions_model.delete', ['model' => __('models.user')]) }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    @endcan
                </form>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="bg-body-tertiary border rounded-3 p-3 mb-3">
                <legend class="fw-bold fst-italic">
                    <i class="fa-solid fa-gears"></i>
                    {{ __('bo_title_general_informations') }}
                </legend>
                <div class="table-responsive">
                    <table class="table-hover m-0 table">
                        <tbody>
                            <tr>
                                <td class="w-50 rounded-top rounded-end-0 fw-bold text-center align-middle">
                                    {{ str(__('models.user'))->ucFirst() }}
                                </td>
                                <td class="w-50 rounded-top rounded-start-0 text-center align-middle">
                                    {{ $userModel->first_name }}&nbsp;{{ $userModel->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.email'))->ucFirst() }}</td>
                                <td class="w-50 text-center align-middle">
                                    {{ $userModel->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.role'))->ucFirst() }}</td>
                                <td class="w-50 text-center align-middle">
                                    {{ str($userModel->role->label())->ucFirst() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.image'))->ucFirst() }}</td>
                                <td class="w-50 text-center align-middle">
                                    <div class="vstack gap-1">
                                        <div class="hstack justify-content-center">
                                            <p class="m-0">{{ basename($userModel->picture) }}</p>
                                            <button class="btn btn-sm btn-warning ms-1" data-bs-toggle="modal"
                                                data-bs-target="#ModalViewPicture">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        <x-back.modal-view-picture id="ModalViewPicture" :pictureAlt="$userModel->picture_alt"
                                            :pictureTitle="$userModel->picture_title" :pictureSrc="asset($userModel->picture)" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.custom.published_at'))->ucFirst() }}
                                </td>
                                <td class="w-50 text-center align-middle">
                                    <span @class([
                                        'badge rounded-pill text-bg-secondary' => $userModel->published,
                                        'fst-italic' => !$userModel->published,
                                    ])>
                                        {{ $userModel->published
                                            ? str($userModel->created_at->isoFormat('LLLL'))->ucFirst()
                                            : __('bo_other_model_not_published', [
                                                'model' => str(__('models.user'))->ucFirst(),
                                            ]) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.created_at'))->ucFirst() }}</td>
                                <td class="w-50 text-center align-middle">
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ str($userModel->created_at->isoFormat('LLLL'))->ucFirst() }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-0">
                                <td class="w-50 fw-bold border-0 text-center align-middle">
                                    {{ str(__('validation.attributes.updated_at'))->ucFirst() }}</td>
                                <td class="w-50 border-0 text-center align-middle">
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ str($userModel->updated_at->isoFormat('LLLL'))->ucFirst() }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
