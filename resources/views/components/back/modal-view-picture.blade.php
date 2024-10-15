<div class="modal" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1">
    <div class="d-flex justify-content-center align-items-center">
        <div class="modal-dialog modal-xl h-100" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ str(__('models.picture'))->ucFirst() }}
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal" data-bs-tooltip="tooltip" type="button"
                        title="{{ __('bo_other_close') }}" aria-label="{{ __('bo_other_close') }}" />
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="{{ $pictureSrc }}" alt="{{ $pictureAlt }}"
                        title="{{ $pictureTitle }}">
                </div>
            </div>
        </div>
    </div>
</div>
