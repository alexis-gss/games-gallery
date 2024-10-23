<td @class(['text-center align-middle', 'border-0' => $loop->last])>
    @can('changePublished', $model)
        <form action="{{ route('bo.' . $routeName . '.change-published', $model->getRouteKey()) }}" method="POST">
            @csrf
            @method('PATCH')
            <button data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                title="{{ __($model->published ? __('crud.other.unpublish') : __('crud.other.publish')) }}" @class([
                    'btn btn-sm',
                    'btn-primary' => $model->published,
                    'btn-danger' => !$model->published,
                ])>
                <i @class([
                    'fa-solid',
                    'fa-circle-check' => $model->published,
                    'fa-circle-xmark' => !$model->published,
                ])></i>
            </button>
        </form>
    @else
        <x-back.user-right />
    @endcan
</td>
