<div id="{{ $toastId }}" class="toast align-items-center text-bg-white border-0 shadow mb-3" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="d-flex px-3">
        <div class="toast-body d-flex flex-row justify-content-start align-items-center ps-0">
            <i class="fa-solid fa-circle-{{ $likeStatus ? 'check text-success' : 'exclamation text-warning' }} fa-xl me-3"></i>
            <div class="d-flex flex-column justify-content-start align-items-start">
                <p class="m-0">
                    {{ str($likeStatus ? __('fo_toast_like') : __('fo_toast_unlike'))->ucFirst() }}
                </p>
                <small class="text-primary fst-italic">
                    {{ str(__('fo_toast_details', ['picturePlace' => $picturePlace + 1, 'gameName' => $gameName]))->ucFirst() }}
                </small>
            </div>
        </div>
        <button type="button" class="btn-close me-0 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
