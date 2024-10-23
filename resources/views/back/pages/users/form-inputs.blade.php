<div class="row">
    {{-- FIRST_NAME/LAST_NAME/EMAIL/ROLE --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-gears"></i>
                {{ __('bo_title_general_informations') }}
            </legend>
            <div class="row">
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="first_name">
                        <b>{{ __('bo_label_authentification', ['field' => __('validation.attributes.first_name')]) }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_name_user') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'first_name'])'></div>
                    <input class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        name="first_name" type="text" value="{{ old('first_name', $userModel->first_name ?? '') }}"
                        required placeholder="{{ __('validation.attributes.first_name') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.attributes.first_name'),
                            'min' => 3,
                            'max' => 255,
                        ]) }}
                    </small>
                    <x-back.input-error inputName="first_name"/>
                </div>
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="last_name">
                        <b>{{ __('bo_label_authentification', ['field' => __('validation.attributes.last_name')]) }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_name_user') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'last_name'])'></div>
                    <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                        type="text" value="{{ old('last_name', $userModel->last_name ?? '') }}" required
                        placeholder="{{ __('validation.attributes.last_name') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.attributes.last_name'),
                            'min' => 3,
                            'max' => 255,
                        ]) }}
                    </small>
                    <x-back.input-error inputName="last_name"/>
                </div>
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="email">
                        <b>{{ __('bo_label_authentification', ['field' => __('validation.attributes.email')]) }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_email') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'email'])'></div>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        type="text" value="{{ old('email', $userModel->email ?? '') }}" required
                        placeholder="{{ __('validation.attributes.email') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.email', ['attribute' => __('validation.attributes.email')]) }}
                    </small>
                    <x-back.input-error inputName="email"/>
                </div>
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="role">
                        <b>{{ __('bo_label_user_rights') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_role') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                        role="button" required>
                        @foreach (Arr::where(\App\Enums\Users\RoleEnum::toArray(), fn(object $role) => $role->value >= auth('backend')->user()->role->value()) as $associatedModel)
                            <option value="{{ $associatedModel->value }}" @selected((isset($userModel->role) && old('role', $userModel->role->value()) ?? 1) === $associatedModel->value)>
                                {{ str($associatedModel->label)->ucFirst() }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-body-secondary">
                        {{ __('validation.rule.select-single', ['entity' => __('validation.attributes.role')]) }}
                    </small>
                    <x-back.input-error inputName="role"/>
                </div>
            </div>
        </fieldset>
    </div>
    {{-- PICTURE --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-image"></i>
                {{ str(__('bo_title_visuals'))->singular() }}
            </legend>
            <div class="row">
                <div class="col-12 form-group mb-3">
                    @php
                        $data = [
                            'id' => 'userPicture',
                            'name' => 'picture',
                            'value' => $userModel->picture ?? '',
                            'width' => 100,
                            'height' => 100,
                            'showLabels' => true,
                            'required' => true,
                            'preview' => true,
                            'placeholder' => __('validation.attributes.image'),
                            'helper' => __('validation.rule.images_label', [
                                'format' => 'JPG/PNG',
                                'width' => 100,
                                'height' => 100,
                            ]),
                        ];
                    @endphp
                    <div class="image-input" data-json='@json($data)'></div>
                    <x-back.input-error inputName="picture"/>
                </div>
            </div>
        </fieldset>
    </div>
    {{-- PASSWORD/CONFIRMATION_PASSWORD --}}
    <div class="col-12 mb-3">
        <fieldset class="bg-body-tertiary border rounded-3 p-3">
            <legend class="fw-bold fst-italic">
                <i class="fa-solid fa-shield-halved"></i>
                {{ __('bo_title_security') }}
            </legend>
            <div class="row">
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="password">
                        <b>{{ __('bo_label_password') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_password_user') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="input-group d-flex justify-content-center w-100">
                        <input class="form-control @error('password') is-invalid @enderror" id="password"
                            id="password" name="password" type="password" value="{{ old('password') }}"
                            aria-describedby="passwordHelp" placeholder="{{ __('validation.attributes.password') }}"
                            autocomplete="current-password">
                        @php $dataPassword = ['id' => 'password']; @endphp
                        <span class="password-visibility" data-json='@json($dataPassword)'>
                        </span>
                    </div>
                    <small class="text-body-secondary">
                        {{ __('validation.min.string', [
                            'attribute' => __('validation.attributes.password'),
                            'min' => 8,
                        ]) }}&nbsp;{{ __('validation.rule.password_empty') }}
                    </small>
                    <x-back.input-error inputName="password"/>
                </div>
                <div class="col-12 col-md-6 form-group mb-3">
                    <label class="col-form-label" for="password_confirmation">
                        <b>{{ __('bo_label_password_confirm') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="{{ __('bo_tooltip_confirm_password_user') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="input-group d-flex justify-content-center w-100">
                        <input class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" id="password_confirmation" name="password_confirmation"
                            type="password" value="{{ old('password_confirmation') }}"
                            aria-describedby="passwordConfirmationHelp"
                            placeholder="{{ __('validation.attributes.password_confirmation') }}"
                            autocomplete="current-password">
                        @php $dataPassword = ['id' => 'password_confirmation']; @endphp
                        <span class="password-visibility" data-json='@json($dataPassword)'>
                        </span>
                    </div>
                    <small class="text-body-secondary">
                        {{ __('validation.min.string', [
                            'attribute' => __('validation.attributes.password_confirmation'),
                            'min' => 8,
                        ]) }}&nbsp;{{ __('validation.rule.confirmation_label') }}
                    </small>
                    <x-back.input-error inputName="passwordConfirm"/>
                </div>
            </div>
        </fieldset>
    </div>
    {{-- PUBLISHED --}}
    @can('changePublished', $userModel)
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
                                id="flexSwitchCheckDefault" name="published" type="checkbox" value="1"
                                role="button" @checked(old('published', $userModel->published ?? ''))>
                            <label class="form-check-label" for="flexSwitchCheckDefault" role="button">
                                <b>{{ str(__('validation.custom.publishment'))->ucFirst() }}</b>
                            </label>
                            <br>
                            <small class="form-text text-body-secondary">
                                {{ __('validation.boolean', ['attribute' => __('validation.custom.publishment')]) }}
                            </small>
                        </div>
                        <x-back.input-error inputName="published"/>
                    </div>
                </div>
            </fieldset>
        </div>
    @endcan
    <div class="col-12 text-center">
        <p class="fw-bold m-0 p-0">{{ __('crud.other.required_fields') }}</p>
    </div>
</div>
