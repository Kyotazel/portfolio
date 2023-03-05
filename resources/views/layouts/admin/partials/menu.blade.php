<ul class="navbar-nav" id="navbar-nav">

    @foreach ($categoryMenus as $categoryMenu)
        <li class="menu-title"><i class="ri-more-fill"></i> <span>{{ $categoryMenu->name }}</span></li>
        @foreach ($categoryMenu->menus as $menu)
            @if ($menu->status == 1 and $menu->id_parent == null)
                @if (count($menu->children) != 0)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ $menu->link }}" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="{{ str_replace('#', '', $menu->link) }}">
                            <i class="{{ $menu->icon }}"></i><span>{{ $menu->name }}</span>
                        </a>
                        <div class="collapse menu-dropdown" id="{{ str_replace('#', '', $menu->link) }}">
                            <ul class="nav nav-sm flex-column">
                                @foreach ($menu->children as $children)
                                    <li class="nav-item">
                                        <a href="{{ $children->link }}"
                                            class="nav-link @if (request()->is(str_replace('/', '', $children->link))) active @endif">{{ $children->name }}</a>
                                    </li>
                                @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link menu-link @if (request()->is(str_replace('/', '', $menu->link) . "*")) active @endif"
                            href="{{ $menu->link }}">
                            <i class="{{ $menu->icon }}"></i> <span>{{ $menu->name }}</span>
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    @endforeach

    {{-- <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>

    <li class="nav-item">
        <a class="nav-link menu-link" href="widgets.html">
            <i class="ri-honour-line"></i> <span data-key="t-widgets">Widgets</span>
        </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse"
            role="button" aria-expanded="false" aria-controls="sidebarIcons">
            <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Icons</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarIcons">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="icons-remix.html" class="nav-link" data-key="t-remix">Remix</a>
                </li>
                <li class="nav-item">
                    <a href="icons-boxicons.html" class="nav-link"
                        data-key="t-boxicons">Boxicons</a>
                </li>
        </div>
    </li> --}}
</ul>
