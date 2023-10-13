@php
$route = request()->route();
$routeName = $route->getName();
$rst = !is_null(request()->rst) || !Session::has("$routeName.sorted");
$noOrder = !empty($noOrder);
$noOrder = $noOrder || (Session::get("$routeName.sort_col") !== 'order' and (Session::has("$routeName.sort_col") or Session::has("$routeName.sort_way")));
$noOrder = $noOrder || !empty(request()->search);
$ignore = (isset($ignore) and is_array($ignore)) ? $ignore : [];
@endphp
<tr class="table-col-sorter border border-2 border-start-0 border-end-0 border-top-0 border-secondary">
    @foreach($cols as $col => $colname)
    @php
    $iArgs = ['sort_col' => $col];
    if(request()->search) {
        $iArgs['search'] = request()->search;
    }
    @endphp
    {{-- NO Sort for order column --}}
    @if($col === 'order' or in_array($col, $ignore))
    @if($noOrder and !in_array($col, $ignore)) @continue @endif
    <th scope="col" class="text-center h-100 @if(isset($mobileHide) and is_array($mobileHide) and in_array($col, $mobileHide)) d-none d-md-table-cell @endif">
        <div class="d-flex justify-content-center align-items-center h-100">
            <span class="text-nowrap">{{ $colname }}</span>
        </div>
    </th>
    @continue
    @endif
    <th scope="col" class="text-center h-100 @if(isset($mobileHide) and is_array($mobileHide) and in_array($col, $mobileHide)) d-none d-md-table-cell @endif">
        <div class="d-flex justify-content-center align-items-center h-100">
            <span class="text-nowrap">
                {{ $colname }}
            </span>
            @if(!session("$routeName.sort_way") or session("$routeName.sort_col") !== $col or (session("$routeName.sort_way") === 'desc' and session("$routeName.sort_col") === $col))
            <a class="text-decoration-none ms-1"
                href="{{ request()->fullUrlWithQuery(array_merge($iArgs, ['sort_way' => 'asc', 'rst' => null])) }}">
                <button
                    class="btn btn-sm btn-outline-secondary"
                    title="{{ __('crud.filter.sort_descending', ['name' => Str::of($colname)->lower()]) }}"
                    data-bs="tooltip">
                    <i class="fas fa-arrow-down 2xs"></i>
                </button>
            </a>
            @endif
            @if(!session("$routeName.sort_way") or session("$routeName.sort_col") !== $col or (session("$routeName.sort_way") === 'asc' and session("$routeName.sort_col") === $col))
            <a class="text-decoration-none ms-1"
                href="{{ request()->fullUrlWithQuery(array_merge($iArgs, ['sort_way' => 'desc', 'rst' => null])) }}">
                <button
                    class="btn btn-sm btn-outline-secondary"
                    title="{{ __('crud.filter.sort_ascending', ['name' => Str::of($colname)->lower()]) }}"
                    data-bs="tooltip">
                    <i class="fas fa-arrow-up 2xs"></i>
                </button>
            </a>
            @endif
        </div>
    </th>
    @endforeach
    {{-- Buttons Col --}}
    <th scope="col" class="text-end">
        @if(!$rst)
        <a class="btn btn-sm btn-danger"
            href="{{ request()->fullUrlWithQuery(['sort_col' => null, 'sort_way' => null, 'rst' => true, 'search' => null]) }}"
            data-bs="tooltip"
            title="{{ __('crud.filter.sort_delete') }}">
            <i class="fa fa-eraser"></i>
        </a>
        @else
        <span data-bs="tooltip" data-bs-placement="top" title="{{ __('crud.filter.sort_arrow') }}">
            <i class="fas fa-question-circle"></i>
        </span>
        @endif
    </th>
</tr>
