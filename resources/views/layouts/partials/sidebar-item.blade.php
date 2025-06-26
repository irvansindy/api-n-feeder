{{-- @php
    $hasChildren = $menu->children && $menu->children->count() > 0;
    $isActive = Route::currentRouteName() === $menu->route_name;
@endphp

<li class="sidebar-item {{ $hasChildren ? 'mega-dropdown' : '' }}">
    <a class="sidebar-link {{ $hasChildren ? 'has-arrow' : '' }} {{ $isActive ? 'active' : '' }}"
        href="{{ $hasChildren ? 'javascript:void(0)' : (Route::has($menu->route_name) ? route($menu->route_name) : '#') }}"
        aria-expanded="false">

        <span class="rounded-3">
            @if (str_contains($menu->icon, 'solar:'))
                <iconify-icon icon="{{ $menu->icon }}" class="ti"></iconify-icon>
            @else
                <i class="{{ $menu->icon }}"></i>
            @endif
        </span>
        <span class="hide-menu">{{ $menu->name }}</span>
    </a>

    @if ($hasChildren)
        <ul aria-expanded="false" class="collapse first-level">
            @foreach ($menu->children as $child)
                @include('layouts.partials.sidebar-item', ['menu' => $child])
            @endforeach
        </ul>
    @endif
</li> --}}
