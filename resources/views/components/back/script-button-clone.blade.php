@push('scripts')
    <script nonce="{{ $nonce }}">
        document.addEventListener("DOMContentLoaded", () => {
            const submit = document.getElementById('formSubmit')
            submitClone = document.getElementById('formSubmitClone');
            submitClone.addEventListener('click', (event) => {
                event.preventDefault();
                submit.click('');
            })
        });
    </script>
@endpush
