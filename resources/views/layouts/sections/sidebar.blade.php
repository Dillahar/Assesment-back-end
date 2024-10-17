@props(['mobile' => false, 'fixed' => true])
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 @if ($fixed) fixed-left @endif @if ($mobile) d-lg-none @endif"
    id="sidenav-main">
    <div class="sidenav-header ">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="{{ config('app.url') }}">
            <img src="{{ asset('img/logo/skillage-3d-logo.png') }}" class="navbar-brand-img h-100"
                alt="{{ config('app.name') }}">
        </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach (auth()->user()->is_admin ? $menuData['adminMenus'] : $menuData['userMenus'] as $menu)
                @if (isset($menu->separator))
                    <li class="nav-item mt-4 mb-2">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs  text-muted font-weight-bolder opacity-6">
                            {{ $menu->separator }}
                        </h6>
                    </li>
                @else
                    @php
                        $activeClass = null;
                        $currentRouteName = Route::currentRouteName();
                        $linkTo = $menu->link_to ?? [];
                        if (!isset($menu->submenu) && isset($menu->route) && ($currentRouteName == $menu->route || in_array($currentRouteName, $linkTo))) {
                            $activeClass = 'active';
                        }
                    @endphp
                    <li class="nav-item">

                        <a class="nav-link {{ $activeClass }}" href="{{ route($menu->route) }}">

                            {!! $menu->icon !!}
                            <span class="nav-link-text ms-3">{{ $menu->name }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
            <li class="nav-item mb-4">
                <a class="nav-link fw-bolder" href="{{ route('logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-log-out text-danger">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="nav-link-text   text-danger ms-3">Logout</span>
                </a>
            </li>
        </ul>
    </div>

</aside>
