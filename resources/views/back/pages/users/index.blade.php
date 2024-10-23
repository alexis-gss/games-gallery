@extends('back.layout')

@section('title', __('crud.meta.all_models', ['model' => str(__('models.user'))->plural()]))
@section('description', __('crud.meta.all_models_list', ['model' => str(__('models.user'))->plural()]))

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap pb-3">
        @include('breadcrumbs.breadcrumb-body')
        @can('create', \App\Models\User::class)
            <a class="btn btn-primary float-right" data-bs-tooltip="tooltip" data-bs-placement="top"
                href="{{ route('bo.users.create') }}"
                title="{{ __('crud.actions_model.create', ['model' => __('models.user')]) }}">
                <i class="fa-solid fa-plus"></i>
            </a>
        @endcan
    </div>
    <x-back.search-bar :search="$search" :searchFields="$searchFields" />
    <div class="bg-body-tertiary border rounded-3 p-3 mb-3">
        <div class="table-responsive">
            <table class="table-hover table-fix-action m-0 table">
                @if (count($userModels) > 0)
                    <x-back.table-col-sorter :cols="[
                        'first_name' => str(__('validation.attributes.first_name'))->ucfirst(),
                        'last_name' => str(__('validation.attributes.last_name'))->ucfirst(),
                        'email' => str(__('validation.attributes.email'))->ucfirst(),
                        'role' => str(__('validation.attributes.role'))->ucfirst(),
                        'published' => str(__('validation.custom.publishment'))->ucfirst(),
                        'updated_at' => str(__('validation.attributes.updated_at'))->ucfirst(),
                        'order' => str(__('validation.custom.order'))->ucfirst(),
                    ]" />
                    <tbody>
                        @foreach ($userModels as $userModel)
                            <tr @class([
                                'border-0' => $loop->last,
                                'border-bottom' => !$loop->last,
                            ])>
                                <td @class(['text-center align-middle', 'border-0' => $loop->last])>{{ $userModel->first_name }}</td>
                                <td @class(['text-center align-middle', 'border-0' => $loop->last])>{{ $userModel->last_name }}</td>
                                <td @class(['text-center align-middle', 'border-0' => $loop->last])>
                                    @if (auth('backend')->user()->getRouteKey() === $userModel->getRouteKey() || Gate::check('isConceptor'))
                                        {{ $userModel->email }}
                                    @else
                                        <x-back.user-right />
                                    @endif
                                </td>
                                <td @class(['text-center align-middle', 'border-0' => $loop->last])>
                                    {{ $userModel->role->label() }}
                                </td>
                                <x-back.change-published-status routeName="users" :model="$userModel" :loop="$loop" />
                                <td @class(['text-center align-middle', 'border-0' => $loop->last])>
                                    <span
                                        class="badge rounded-pill text-bg-secondary">{{ $userModel->updated_at->isoFormat('LLLL') }}</span>
                                </td>
                                @php $routeName = request()->route()->getName(); @endphp
                                @if (empty(request()->search) && session()->get("$routeName.sort_col") === 'order')
                                    <x-back.change-model-order routeName="users" :models="$userModels" :model="$userModel" :loop="$loop" />
                                @endif
                                <td @class(['text-end align-middle', 'border-0' => $loop->last])>
                                    <div class="btn-group">
                                        @canAny(['view', 'duplicate', 'update', 'delete', 'resetPassword'], $userModel)
                                            @can('resetPassword', $userModel)
                                                <form class="confirmActionTS"
                                                    data-sweetalert-message="{{ __('crud.sweetalert.send_email', ['modelName' => sprintf('%s %s', $userModel->first_name, $userModel->last_name)]) }}"
                                                    data-sweetalert-btn-accept="{{ __('crud.sweetalert.send') }}"
                                                    data-sweetalert-btn-color="success" method="POST"
                                                    action="{{ route('bo.password.email', ['email' => $userModel->email]) }}">
                                                    @csrf
                                                    <button class="btn btn-sm btn-light @canAny(['view', 'duplicate', 'update', 'delete'], $userModel) rounded-end-0 w-fit @endcan"
                                                        data-bs-tooltip="tooltip" type="submit"
                                                        title="{{ str(__('auth.reset_password_send'))->ucfirst() }}">
                                                        <i class="fa-solid fa-key"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                            @canAny(['view', 'duplicate', 'update', 'delete'], $userModel)
                                                <form class="btn-group confirmActionTS"
                                                    data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => sprintf('%s %s', $userModel->first_name, $userModel->last_name)]) }}"
                                                    action="{{ route('bo.users.destroy', $userModel->getKey()) }}" method="POST"
                                                    novalidate>
                                                    @can('isConceptor')
                                                        <a class="btn btn-sm btn-info" data-bs-tooltip="tooltip"
                                                            href="{{ route('bo.activity_logs.user', ['user' => $userModel]) }}"
                                                            title="{{ str(trans_choice('models.activity_log', 1))->ucfirst() }}">
                                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                                        </a>
                                                    @endcan
                                                    @can('view', $userModel)
                                                        <a class="btn btn-sm btn-warning" data-bs-tooltip="tooltip"
                                                            data-bs-placement="top" href="{{ route('bo.users.show', $userModel) }}"
                                                            title="{{ __('crud.actions_model.show', ['model' => __('models.user')]) }}">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('duplicate', $userModel)
                                                        <a class="btn btn-sm btn-secondary" data-bs-tooltip="tooltip"
                                                            data-bs-placement="top"
                                                            href="{{ route('bo.users.duplicate', $userModel) }}"
                                                            title="{{ __('crud.actions_model.duplicate', ['model' => __('models.user')]) }}">
                                                            <i class="fa-solid fa-copy"></i>
                                                        </a>
                                                    @endcan
                                                    @can('update', $userModel)
                                                        <a class="btn btn-sm btn-primary" data-bs-tooltip="tooltip"
                                                            data-bs-placement="top" href="{{ route('bo.users.edit', $userModel) }}"
                                                            title="{{ __('crud.actions_model.edit', ['model' => __('models.user')]) }}">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete', $userModel)
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" data-bs-tooltip="tooltip"
                                                            data-bs-placement="top" type="submit"
                                                            title="{{ __('crud.actions_model.delete', ['model' => __('models.user')]) }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                </form>
                                            @endcan
                                        @else
                                            <x-back.user-right />
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td class="border-0">{{ __('crud.other.no_model_found', ['model' => __('models.user')]) }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    {{ $userModels->links() }}
@endsection
