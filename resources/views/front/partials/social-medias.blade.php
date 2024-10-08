<div class="modal fade" id="socialMediasModel" tabindex="-1" aria-labelledby="socialMediasModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title fs-5 title-font-regular">{{ __('fo_share_title') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex d-md-inline-flex flex-column flex-md-row justify-content-center align-items-center w-100">
                    @php
                        $array = [
                            ['name' => __('facebook'), 'link' => sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', url()->current())],
                            ['name' => __('twitter'), 'link' => sprintf('https://twitter.com/intent/tweet?text=%s', url()->current())],
                            ['name' => __('linkedin'), 'link' => sprintf('https://www.linkedin.com/shareArticle?mini=true&url=%s', url()->current())],
                            ['name' => __('telegram'), 'link' => sprintf('https://t.me/share/url?url=%s&text=', url()->current())],
                            ['name' => __('whatsapp'), 'link' => sprintf('https://wa.me/?text=%s', url()->current())],
                        ];
                    @endphp
                    @foreach ($array as $value)
                        <a href="{{ $value['link'] }}" class="btn btn-lg btn-primary mx-1" target="_blank"
                            title="{{ __('fo_tooltip_share_on', ['name' => str($value['name'])->ucFirst()]) }}"
                            data-bs-tooltip="tooltip" role="button">
                            <i class="fa-brands fa-{{ $value['name'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
