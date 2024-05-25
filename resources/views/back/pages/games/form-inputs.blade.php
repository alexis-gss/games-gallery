<div class="row">
    {{-- NAME/FOLDER_ID --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-gears"></i>
                {{ __('bo_title_general_informations') }}
            </legend>
            <div class="row mb-3">
                <div class="col-12 col-md-6 form-group">
                    <label class="col-form-label" for="folder_id">
                        <b>{{ __('bo_label_identification') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_name_game') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'name'])'></div>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        type="text" value="{{ old('name', $gameModel->name ?? '') }}"
                        placeholder="{{ __('validation.attributes.name') }}*" required>
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.attributes.name'),
                            'min' => 3,
                            'max' => 255,
                        ]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'name'])
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label class="col-form-label" for="folder_id">
                        <b>{{ __('bo_label_organization') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_folders', ['number' => count($folderModels)]) }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    @php
                        $folderModel = old('folder_id')
                            ? \App\Models\Folder::query()->where('id', old('folder_id'))->first()
                            : $gameModel->folder;
                        if (!is_null($folderModel)) {
                            $folderModel->nameLocale = $folderModel->getTranslation('name', config('app.locale'));
                        }
                        $data = [
                            'id' => 'gameFolder',
                            'name' => 'folder_id',
                            'multiple' => false,
                            'targetClass' => '\App\Models\Folder',
                            'routeName' => 'bo.folders.jsonPaginate',
                            'modelListPaginate' => $folderModels,
                            'modelSelected' => $folderModel,
                            'fieldName' => 'nameLocale',
                            'roundedBorder' => true,
                            'required' => true,
                            'disabled' => false,
                            'placeholder' => __('models.folder') . "*",
                        ];
                    @endphp
                    <div class="search-belongs-to-dropdown" data-json='@json($data)'></div>
                    <small class="text-body-secondary">
                        {{ __('validation.rule.select-single', ['entity' => __('models.folder')]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'folder_id'])
                </div>
            </div>
        </fieldset>
    </div>
    {{-- PICTURE/PICTURE_ALT/PICTURE_TITLE --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-images"></i>
                {{ __('bo_title_visuals') }}
            </legend>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-form-label" for="name">
                        <b>{{ __('bo_label_choose_pictures') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_game_images') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    @php
                        $data = [
                            'id' => 'gamePictures',
                            'name' => 'pictures[]',
                            'width' => 3840,
                            'height' => 2160,
                            'model' => $gameModel,
                            'value' => $gameModel->pictures ?? [],
                            'limit' => [0, 76],
                            'helper' => __('validation.rule.images_label', [
                                'format' => 'JPG/PNG',
                                'width' => 3840,
                                'height' => 2160,
                            ]),
                            'csrf' => csrf_token(),
                            'errors' => $errors->getBag('default')->getMessages(),
                        ];
                    @endphp
                    <div class="images-input" data-json='@json($data)'></div>
                    @include('back.modules.input-error', ['inputName' => 'pictures[]'])
                </div>
            </div>
        </fieldset>
    </div>
    {{-- TAGS --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-tags"></i>
                {{ __('bo_title_organization') }}
            </legend>
            <div class="row mb-3">
                <div class="col-12 form-group">
                    <label class="col-form-label" for="name">
                        <b>{{ str(__('models.tag'))->plural()->ucFirst() }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_tags', ['number' => count($tagModels)]) }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    @php
                        $oldTagModels = old('tags')
                            ? \App\Models\Folder::query()
                                ->whereIn('id', collect(old('tags'))
                                    ->map(function ($tag) {
                                        return $tag['id'];
                                    })->toArray(),
                                )->get()
                            : $gameModel->tags;
                        if (!is_null($oldTagModels)) {
                            $oldTagModels->map(function ($tagModel) {
                                $tagModel->nameLocale = $tagModel->getTranslation('name', config('app.locale'));
                                return $tagModel;
                            });
                        }
                        $data = [
                            'id' => 'gameTags',
                            'name' => 'tags',
                            'fieldName' => 'nameLocale',
                            'multiple' => true,
                            'targetClass' => '\App\Models\Tag',
                            'routeName' => 'bo.tags.jsonPaginate',
                            'modelListPaginate' => $tagModels,
                            'modelSelected' => $oldTagModels,
                            'roundedBorder' => true,
                            'required' => true,
                            'disabled' => false,
                            'placeholder' => __('bo_other_taggable_add'),
                        ];
                    @endphp
                    <div class="search-belongs-to-dropdown" data-json='@json($data)'></div>
                    <small class="text-body-secondary">
                        {{ __('validation.rule.select-multiple', ['entity' => str(__('models.tag'))->plural()]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'tags'])
                </div>
            </div>
        </fieldset>
    </div>
    {{-- PUBLISHED --}}
    <div class="col-12 col-md-6 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-eye"></i>
                {{ __('bo_title_visibility') }}
            </legend>
            <div class="row mb-3">
                <div class="col-12 form-check form-switch">
                    <div class="form-check form-switch">
                        <input class="form-check-input @error('published') is-invalid @enderror"
                            id="flexSwitchCheckDefault" name="published" type="checkbox" value="1" role="button"
                            @checked(old('published', $gameModel->published ?? ''))>
                        <label class="form-check-label" for="flexSwitchCheckDefault" role="button">
                            <b>{{ str(__('validation.custom.publishment'))->ucFirst() }}</b>
                        </label>
                        <br>
                        <small class="form-text text-body-secondary">
                            {{ __('validation.boolean', ['attribute' => __('validation.custom.publishment')]) }}
                        </small>
                    </div>
                    @include('back.modules.input-error', ['inputName' => 'published'])
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12 text-center">
        <p class="fw-bold m-0 p-0">{{ __('crud.other.required_fields') }}</p>
    </div>
</div>
