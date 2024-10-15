@extends('back.layout', ['brParam' => $gameModel])

@section('title', __('Édition d\'un :model', ['model' => trans_choice('models.game', 1)]))
@section('description', __('Édition d\'un :model déjà existant', ['model' => trans_choice('models.game', 1)]))
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
        @canAny(['duplicate', 'update', 'delete'], $gameModel)
            <form class="btn-group confirmActionTS"
                data-sweetalert-message="{{ __('crud.sweetalert.delete_element', ['modelName' => $gameModel->name]) }}"
                action="{{ route('bo.games.destroy', $gameModel) }}" method="POST" novalidate>
                @if ($gameModel->published)
                    <a class="btn btn-info" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('fo.games.show', $gameModel->slug) }}"
                        title="{{ __('crud.actions_model.show', ['model' => trans_choice('models.game', 1)]) }}"
                        target="_blank">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                @endif
                @can('duplicate', $gameModel)
                    <a class="btn btn-secondary" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.games.duplicate', ['game' => $gameModel]) }}"
                        title="{{ __('crud.actions_model.duplicate', ['model' => trans_choice('models.game', 1)]) }}">
                        <i class="fa-solid fa-copy"></i>
                    </a>
                @endcan
                @can('update', $gameModel)
                    <a class="btn btn-primary" data-bs-tooltip="tooltip" data-bs-placement="top"
                        href="{{ route('bo.games.edit', ['game' => $gameModel]) }}"
                        title="{{ __('crud.actions_model.edit', ['model' => trans_choice('models.game', 1)]) }}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                @endcan
                @can('delete', $gameModel)
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                        title="{{ __('crud.actions_model.delete', ['model' => trans_choice('models.game', 1)]) }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </form>
        @endcan
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
                                    {{ str(__('validation.attributes.name'))->ucFirst() }}
                                </td>
                                <td class="w-50 rounded-top rounded-start-0 text-center align-middle">
                                    {{ $gameModel->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('models.folder'))->ucFirst() }}
                                </td>
                                <td class="w-50 text-center align-middle">
                                    @if ($gameModel->folder->mandatory)
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            @foreach (config('app.locales') as $locale)
                                                <span @class([
                                                    'fst-italic text-body-secondary' =>
                                                        $locale !== config('app.fallback_locale'),
                                                ])>
                                                    {{ $gameModel->folder->getTranslation('name', $locale) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        {{ $gameModel->folder->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.image'))->ucFirst()->plural() }}
                                </td>
                                <td class="w-50 text-center align-middle">
                                    <div class="vstack gap-1 scrollable-images">
                                        @if (count($gameModel->pictures))
                                            @foreach ($gameModel->pictures as $key => $picture)
                                                <div class="hstack justify-content-center">
                                                    <p class="m-0">{{ sprintf('%s.webp', $picture->uuid) }}</p>
                                                    <button class="btn btn-sm btn-warning ms-1" data-bs-toggle="modal"
                                                        data-bs-target="#ModalViewPicture{{ $key }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </div>
                                                <x-back.modal-view-picture id="ModalViewPicture{{ $key }}" :pictureAlt="$picture->label"
                                                    :pictureTitle="str(__('models.picture'))->ucFirst()"
                                                    :pictureSrc="sprintf(
                                                        '%s/storage/pictures/%s/%s.webp',
                                                        config('app.url'),
                                                        $gameModel->slug,
                                                        $picture->uuid,
                                                    )" />
                                            @endforeach
                                        @else
                                            {{ __('bo_other_number_images', ['number' => 0]) }}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.custom.published_at'))->ucFirst() }}
                                </td>
                                <td class="w-50 text-center align-middle">
                                    <span @class([
                                        'badge rounded-pill text-bg-secondary' => $gameModel->published,
                                        'fst-italic' => !$gameModel->published,
                                    ])>
                                        {{ $gameModel->published
                                            ? str($gameModel->created_at->isoFormat('LLLL'))->ucFirst()
                                            : __('bo_other_model_not_published', [
                                                'model' => str(trans_choice('models.game', 1))->ucFirst(),
                                            ]) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-bold text-center align-middle">
                                    {{ str(__('validation.attributes.created_at'))->ucFirst() }}</td>
                                <td class="w-50 text-center align-middle">
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ str($gameModel->created_at->isoFormat('LLLL'))->ucFirst() }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-0">
                                <td class="w-50 fw-bold border-0 text-center align-middle">
                                    {{ str(__('validation.attributes.updated_at'))->ucFirst() }}</td>
                                <td class="w-50 border-0 text-center align-middle">
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ str($gameModel->updated_at->isoFormat('LLLL'))->ucFirst() }}
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
