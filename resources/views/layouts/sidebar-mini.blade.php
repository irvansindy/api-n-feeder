<aside class="side-mini-panel with-vertical">
    <div class="iconbar">
        <div>
            <div class="mini-nav">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                    </a>
                </div>
                <ul class="mini-nav-ul" data-simplebar>
                    @foreach ($sidebarMenus as $groupKey => $menus)
                        <li class="mini-nav-item" id="mini-{{ $loop->iteration }}">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="right" data-bs-title="{{ $groupKey ?? 'Menu' }}">
                                <iconify-icon icon="{{ $menus->first()->icon ?? 'solar:layers-line-duotone' }}"class="fs-7"></iconify-icon>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebarmenu">
                <div class="brand-logo d-flex align-items-center nav-logo">
                    <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo" />
                    </a>
                </div>

                @foreach ($sidebarMenus as $groupKey => $menus)
                    <nav class="sidebar-nav" id="menu-right-mini-{{ $loop->iteration }}" data-simplebar>
                        <ul class="sidebar-menu" id="sidebarnav">
                            <li class="nav-small-cap">
                                <span class="hide-menu">{{ $groupKey ?? 'Menu' }}</span>
                            </li>

                            @foreach ($menus as $menu)
                                @if ($menu->children->isNotEmpty())
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false">
                                            <iconify-icon
                                                icon="{{ $menu->icon ?? 'solar:menu-dots-line-duotone' }}"></iconify-icon>
                                            <span class="hide-menu">{{ $menu->name }}</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            @foreach ($menu->children as $child)
                                                <li class="sidebar-item">
                                                    <a href="{{ route($child->url_name) }}" class="sidebar-link">
                                                        <i class="ti ti-circle"></i>
                                                        <span class="hide-menu">{{ $child->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="{{ route($menu->url_name) }}">
                                            <iconify-icon
                                                icon="{{ $menu->icon ?? 'solar:dot-line-duotone' }}"></iconify-icon>
                                            <span class="hide-menu">{{ $menu->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                @endforeach
            </div>
        </div>
    </div>
</aside>
