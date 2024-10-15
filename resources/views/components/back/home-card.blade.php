<div class="col-12 col-sm-6 col-md-4 mx-auto mb-3 mb-md-0">
    <div class="card bg-body-tertiary h-100">
        <div class="card-body d-flex flex-column justify-content-between">
            <div class="mb-2">
                <h5 class="fw-bold fst-italic">
                    <i class="{{ $card['icon'] }}"></i>
                    {{ $card['title'] }}
                </h5>
                <p class="card-text">{{ $card['text'] }}</p>
            </div>
            <a href="{{ $card['link'] }}" target="_blank" class="btn btn-sm btn-primary w-fit"
                title="{{ $card['linkTitle'] }}" data-bs-tooltip="tooltip">
                {{ $card['linkText'] }}
                <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
            </a>
        </div>
    </div>
</div>
