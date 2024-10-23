<script @if (!empty($nonce)) nonce="{{ $nonce }}" @endif>
    if (!window.__SYSTEM) {
        window.__SYSTEM = {};
    }
    window.__SYSTEM._locale = "{{ app()->getLocale() }}";
    window.__SYSTEM._translations = @json(cache(sprintf('translations.%s', app()->getLocale())) ?? []);
    if (!window.__SYSTEM._routes) {
        window.__SYSTEM._routes = {}
    }
    window.__SYSTEM._routes = {
        bo: {
            games: {
                show: "{{ route('bo.games.show', 'ID') }}",
                edit: "{{ route('bo.games.edit', 'ID') }}",
            },
            folders: {
                jsonPaginate: "{{ route('bo.folders.json-paginate') }}",
            },
            pictures: {
                upload: "{{ route('bo.pictures.upload') }}"
            },
            ranks: {
                gamesPaginate: "{{ route('bo.ranks.games-paginate') }}",
                saveOrder: "{{ route('bo.ranks.save-order', 'RANKS') }}",
                destroy: "{{ route('bo.ranks.destroy', 'ID') }}",
            },
            tags: {
                jsonPaginate: "{{ route('bo.tags.json-paginate') }}"
            },
        },
        fo: {
            games: {
                show: "{{ route('fo.games.show', ['slug' => 'SLUG']) }}",
            },
        }
    }
</script>
@stack('scripts')
