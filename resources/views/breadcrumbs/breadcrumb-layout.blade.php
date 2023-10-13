@if (count($breadcrumbs))
<ol class="breadcrumb flex-nowrap @if(!Request::is('bo/*')) w-100 m-0 @else m-0 @endif">
    @foreach ($breadcrumbs as $breadcrumb)
    @if ($breadcrumb->url && !$loop->last)
    <li class="breadcrumb-item d-flex">
        <a class="text-decoration-none @if(Request::is('bo/*')) h2 ps-2 m-0 fw-bold @else py-3 text-white @endif" href="{{ $breadcrumb->url }}">
            {{ $breadcrumb->title }}
        </a>
    </li>
    @else
    <li class="breadcrumb-item btn-games d-flex align-items-center flex-grow-1 active @if(Request::is('bo/*')) h2 m-0 fw-bold @else text-white @endif">
        {{ $breadcrumb->title }}
    </li>
    @endif
    @endforeach
</ol>
@endif
