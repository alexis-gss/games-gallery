<div class="row">
    <div class="col-12 border-bottom mb-3">
        <fieldset class="p-3">
            <legend>{{ __('bo_title_general_informations') }}</legend>
            <div class="row mb-3">
                <div class="col-12 col-md-6 form-group">
                    <label class="col-form-label" for="folder_id">
                        <b>{{ __('bo_label_seo_title') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_SEO_title_page') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'seo_title'])'></div>
                    <input class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title"
                        value="{{ old('seo_title', $staticPageModel->seo_title ?? '') }}" type="text"
                        placeholder="{{ __('validation.custom.seo_title') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.custom.seo_title'),
                            'min' => 3,
                            'max' => 70,
                        ]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'seo_title'])
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label class="col-form-label" for="folder_id">
                        <b>{{ __('bo_label_seo_description') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_SEO_description_page') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'seo_description'])'></div>
                    <input class="form-control @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description"
                        value="{{ old('seo_description', $staticPageModel->seo_description ?? '') }}" type="text"
                        placeholder="{{ __('validation.custom.seo_description') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.custom.seo_description'),
                            'min' => 50,
                            'max' => 160,
                        ]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'seo_description'])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6 form-group">
                    <label class="col-form-label" for="folder_id">
                        <b>{{ __('bo_label_identification') }}</b>
                        <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('bo_tooltip_title_page') }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </span>
                    </label>
                    <div class="word-counter" data-json='@json(['id' => 'title'])'></div>
                    <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" type="text"
                        value="{{ old('title', $staticPageModel->title ?? '') }}" placeholder="{{ __('validation.attributes.title') }}">
                    <small class="text-body-secondary">
                        {{ __('validation.between.string', [
                            'attribute' => __('validation.attributes.title'),
                            'min' => 3,
                            'max' => 255,
                        ]) }}
                    </small>
                    @include('back.modules.input-error', ['inputName' => 'title'])
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="row">
    <div class="col text-center">
        <p><b>{{ __('* Champs obligatoires') }}</b></p>
    </div>
</div>