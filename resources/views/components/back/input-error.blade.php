@if ($errors->has($inputName))
    <div class="col-12">
        <small class="text-danger">{{ implode(',', $errors->get($inputName)) }}</small>
    </div>
@endif
