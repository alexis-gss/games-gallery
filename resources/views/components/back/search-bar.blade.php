<form class="d-flex align-items-center justify-content-center flex-column flex-sm-row input-group pb-3" id="search"
    action="{{ request()->url() }}" enctype="multipart/form-data">
    <label class="input-group-text w-100 w-sm-fit" for="search-field">
        <span class="text-truncate">
            {{ __('crud.search.label', ['elements' => $searchFields]) }}
        </span>
    </label>
    <input class="form-control w-100" id="search-field" name="search" type="text" value="{{ old('search', $search ?? '') }}"
        placeholder="{{ __('crud.search.keywords') }}">
    <div class="d-flex justify-content-center align-items-center input-group w-100 w-sm-fit">
        <button class="btn btn-primary w-50 w-sm-fit" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
            title="{{ __('crud.search.apply_search') }}">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a class="btn btn-danger w-50 w-sm-fit m-0" data-bs-tooltip="tooltip" data-bs-placement="top" href="{{ request()->url() }}"
            title="{{ __('crud.search.remove_search') }}">
            <i class="fa-solid fa-delete-left"></i>
        </a>
    </div>
</form>
