<td @class(['text-center align-middle', 'border-0' => $loop->last])>
    @can('changeOrder', $model)
        <div class="d-flex justify-content-center align-items-center">
            <form @class([
                'invisible' =>
                    $loop->last and $models->currentPage() === $models->lastPage(),
            ])
                action="{{ route('bo.' . $routeName . '.change-order', [str($routeName)->singular()->value() => $model, 'direction' => 'down']) }}"
                method="POST">
                @csrf
                @method('PATCH')
                <button data-bs-tooltip="tooltip" type="submit" title="{{ __('crud.other.down') }}" @class([
                    'btn btn-sm btn-outline-secondary me-1',
                    'disabled' =>
                        $loop->last and $models->currentPage() === $models->lastPage(),
                ])>
                    <i class="fas fa-arrow-down"></i>
                </button>
            </form>
            <form @class(['invisible' => $loop->first and $models->onFirstPage()])
                action="{{ route('bo.' . $routeName . '.change-order', [str($routeName)->singular()->value() => $model, 'direction' => 'up']) }}"
                method="POST">
                @csrf
                @method('PATCH')
                <button data-bs-tooltip="tooltip" type="submit" title="{{ __('crud.other.up') }}" @class([
                    'btn btn-sm btn-outline-secondary',
                    'disabled' => $loop->first and $models->onFirstPage(),
                ])>
                    <i class="fas fa-arrow-up"></i>
                </button>
            </form>
        </div>
    @else
        <x-back.user-right />
    @endcan
</td>
