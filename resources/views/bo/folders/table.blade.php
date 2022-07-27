<table class="table">
    @if (count($folder->games) > 0)
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('list.games_associated') }} : {{ count($folder->games) }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($folder->games as $game)
                <tr class="list_item">
                    <td class="w-50">{{ $game->name }}</td>
                    @can('isAdmin')
                        <td class="w-50 px-0 ta-end">
                            <a href="{{ route('bo.games.edit', ['game' => $game->id]) }}" class="btn btn-sm btn-primary mx-1"
                                data-bs="tooltip" data-bs-placement="top" title="{{ __('list.edit_game') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg>
                            </a>
                            <form action="{{ route('bo.games.destroy', $game->id) }}" method="POST" class="d-inline"
                                onsubmit="popupDelete(event, 
                                '{{ __('list.are_you_sure') }}', 
                                '{{ __('list.data_lost', ['item' => $game->name]) }}', 
                                '{{ __('list.form_confirm') }}')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" data-bs="tooltip"
                                    data-bs-placement="top" title="{{ __('list.delete_game') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    @else
        <tr>
            <td class="w-25 border-0 p-0 px-2">{{ __('list.no_associated_games') }}</td>
        </tr>
    @endif
</table>
