@php
    $route = request()->route();
    $routeName = $route->getName();
    $rst = !is_null(request()->rst) || !session()->has("$routeName.sorted");
    $noOrder = !empty($noOrder);
    $noOrder =
        $noOrder ||
        (session()->get("$routeName.sort_col") !== 'order' and
            (session()->has("$routeName.sort_col") or session()->has("$routeName.sort_way")));
    $noOrder = $noOrder || !empty(request()->search);
    $ignore = (isset($ignore) and is_array($ignore)) ? $ignore : [];
@endphp
<thead>
    <tr class="table-col-sorter border-start-0 border-end-0 border-top-0 border-secondary border border-2">
        @foreach ($cols as $col => $colname)
            @php
                $iArgs = ['sort_col' => $col];
                if (request()->search) {
                    $iArgs['search'] = request()->search;
                }
            @endphp
            {{-- NO Sort for order column --}}
            @if ($col === 'order' or in_array($col, $ignore))
                @if ($noOrder and !in_array($col, $ignore))
                    @continue
                @endif
                <th @class([
                    'h-100 text-center',
                    'd-none d-md-table-cell' =>
                        isset($mobileHide) and
                        is_array($mobileHide) and
                        in_array($col, $mobileHide),
                ]) scope="col">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <span class="text-nowrap">{{ $colname }}</span>
                    </div>
                </th>
                @continue
            @endif
            <th @class([
                'h-100 text-center',
                'd-none d-md-table-cell' =>
                    isset($mobileHide) and
                    is_array($mobileHide) and
                    in_array($col, $mobileHide),
            ]) scope="col">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <span class="text-nowrap">
                        {{ $colname }}
                    </span>
                    @if (
                        !session("$routeName.sort_way") or
                            session("$routeName.sort_col") !== $col or
                            session("$routeName.sort_way") === 'desc' and session("$routeName.sort_col") === $col)
                        <a class="btn btn-sm btn-outline-secondary text-decoration-none ms-1" data-bs-tooltip="tooltip"
                            href="{{ request()->fullUrlWithQuery(array_merge($iArgs, ['sort_way' => 'asc', 'rst' => null])) }}"
                            title="{{ __('crud.filter.sort_descending', ['name' => str($colname)->lower()]) }}">
                            <i class="fas fa-arrow-down 2xs"></i>
                        </a>
                    @endif
                    @if (
                        !session("$routeName.sort_way") or
                            session("$routeName.sort_col") !== $col or
                            session("$routeName.sort_way") === 'asc' and session("$routeName.sort_col") === $col)
                        <a class="btn btn-sm btn-outline-secondary text-decoration-none ms-1" data-bs-tooltip="tooltip"
                            href="{{ request()->fullUrlWithQuery(array_merge($iArgs, ['sort_way' => 'desc', 'rst' => null])) }}"
                            title="{{ __('crud.filter.sort_ascending', ['name' => str($colname)->lower()]) }}">
                            <i class="fas fa-arrow-up 2xs"></i>
                        </a>
                    @endif
                </div>
            </th>
        @endforeach
        {{-- Buttons Col --}}
        <th class="text-end" scope="col">
            @if (!$rst)
                <a class="btn btn-sm btn-danger" data-bs-tooltip="tooltip"
                    href="{{ request()->fullUrlWithQuery(['sort_col' => null, 'sort_way' => null, 'rst' => true, 'search' => null]) }}"
                    title="{{ __('crud.filter.sort_delete') }}">
                    <i class="fa fa-eraser"></i>
                </a>
            @else
                <span data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('crud.filter.sort_arrow') }}">
                    <i class="fas fa-question-circle"></i>
                </span>
            @endif
        </th>
    </tr>
</thead>
