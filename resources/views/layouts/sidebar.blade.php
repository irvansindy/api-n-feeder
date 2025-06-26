<aside class="left-sidebar with-horizontal">
    <div>
        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                @foreach ($sidebarMenus as $group => $menus)

                    @foreach ($sidebarMenus as $menu)
                        @if ($menu)
                            @include('layouts.partials.sidebar-item', ['menu' => $menu])
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
