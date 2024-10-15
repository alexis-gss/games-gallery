<a data-bs-tooltip="tooltip" href="{{ route($routeName) }}"
    title="{{ $title }}"
    role="button" @class([
        'btn btn-outline-primary border-0 text-start w-100 mt-1',
        'fw-bold text-bg-primary active' => request()->routeIs($routeCondition),
        'text-body bg-transparent' => !request()->routeIs($routeCondition),
    ])>
    <i class="fa-solid fa-{{ $icon }}"></i>
    <span class="navigation-label">{{ $label }}</span>
</a>
