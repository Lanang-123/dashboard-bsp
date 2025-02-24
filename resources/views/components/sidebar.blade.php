<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    {{-- <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"> --}}
                    <h3 style="color: rgb(23, 129, 172);font-size:2rem;margin-left:1rem">ADMIN BSP</h3>
                </a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block">
                    <i class="bi bi-x bi-middle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            @foreach ($sidebarItems as $sidebarItem)
                @if (isset($sidebarItem->isTitle) && $sidebarItem->isTitle)
                    <li class="sidebar-title">{{ $sidebarItem->name }}</li>
                @else
                    <li class="sidebar-item
                        {{ (isset($sidebarItem->url) && $sidebarItem->url == $filename) ||
                           (isset($sidebarItem->key) && \Illuminate\Support\Str::startsWith($filename, $sidebarItem->key)) ? 'active' : '' }}
                        {{ (isset($sidebarItem->submenu) && count($sidebarItem->submenu) > 0) ? 'has-sub' : '' }}">
                        <a href="{{ isset($sidebarItem->url) ? route($sidebarItem->url) : '#' }}" class="sidebar-link">
                            <i class="bi bi-{{ $sidebarItem->icon }}"></i>
                            <span>{{ $sidebarItem->name }}</span>
                        </a>
                        @if (isset($sidebarItem->submenu) && count($sidebarItem->submenu) > 0)
                            @php
                                $submenuActive = collect($sidebarItem->submenu)->contains(function($sub) use ($filename, $sidebarItem) {
                                    return isset($sub->url) && $sub->url == $filename ||
                                           (isset($sidebarItem->key) && \Illuminate\Support\Str::startsWith($filename, $sidebarItem->key));
                                });
                            @endphp
                            <ul class="submenu {{ $submenuActive ? 'active' : '' }}">
                                @foreach ($sidebarItem->submenu as $sub)
                                    <li class="submenu-item {{ (isset($sub->url) && $sub->url == $filename) ? 'active' : '' }}">
                                        <a href="{{ $sub->url }}">{{ $sub->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <button class="sidebar-toggler btn x">
        <i data-feather="x"></i>
    </button>
</div>
