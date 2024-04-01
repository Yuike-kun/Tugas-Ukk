<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('images/RPL.png') }}" alt="halo, ga ke load ya?" style="width: 2.5rem" class="h-auto">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize ">Jurnal Guru</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        @foreach (config()->get('sidebar') as $test)
            @php
                $nav_link = $test['route_name'] != null ? route($test['route_name']) : 'javascript:void(0)';
            @endphp
            @if ($test['header_name'])
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ $test['header_name'] }}</span>
                </li>
            @endif
            <li
                class="menu-item text-capitalize {{ Request::routeIs($test['route_name']) ? 'active' : '' }} {{ $test['has_sub'] == true && in_array(request()->route()->action['as'], $test['sub_active_link'] ?? []) ? 'open' : '' }} ">
                <a href="{{ $nav_link }}"
                    class="menu-link 
                    {{ $test['route_name'] != null ? '' : 'menu-toggle' }}">
                    <i class="menu-icon tf-icons {{ $test['icon'] }} }}"></i>
                    <div>{{ $test['title'] }}</div>
                </a>
                @if ($test['has_sub'] == true && array_key_exists('submenu', $test))
                    <ul class="menu-sub">
                        @foreach ($test['submenu'] as $sub)
                            <li class="menu-item {{ Request::routeIs($sub['route_name']) ? 'active' : '' }}">
                                <a href="{{ $sub['route_name'] != null ? route($sub['route_name']) : 'javascript:void(0)' }}"
                                    class="menu-link">
                                    {{ $sub['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
