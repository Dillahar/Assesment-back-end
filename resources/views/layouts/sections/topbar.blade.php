@props(['show_logo' => true])
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-none border-bottom py-3">
    <div class="container">
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
            aria-controls="sidebar">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        @if ($show_logo)
            <a class="navbar-brand mx-auto" href="/" rel="tooltip" data-placement="bottom">
                <img src="{{ asset('img/logo/skillage-3d-logo.png') }}" class="navbar-brand-img"
                    style="max-height: 30px;" alt="{{ config('app.name') }}">
            </a>
        @endif
        <!-- Show Only in mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
            <div class="offcanvas-header">
                <!-- User Info -->
                <div class="d-flex flex-column justify-content-between align-items-center w-100">
                    @auth
                        <a href="#" id="iconNavbarSidenav" data-bs-dismiss="offcanvas" aria-label="Close"
                            class="text-decoration-none">
                            <!-- Display user's first name and avatar -->
                            <div class="user-info d-flex align-items-center justify-content-center">
                                @if (empty(auth()->user()->photo))
                                    <div class="avatar avatar-sm rounded-circle bg-info-light border-radius-md p-2">
                                        <h6 class="text-info-light text-uppercase mt-1">{{ auth()->user()->name[0] }}</h6>
                                    </div>
                                @else
                                    <img src="{{ auth()->user()->photo_url }}"
                                        class="avatar avatar-sm rounded-circle shadow-sm">
                                @endif
                                <span class="mx-2">Hi, {{ auth()->user()->first_name }}</span>
                                <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5L0.5 10.5L0.5 0.5L5.5 5.5Z" fill="#797979" />
                                </svg>
                            </div>
                        </a>
                    @endauth

                    <!-- Close Button, positioned on the right side -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-xl-none"></i></button>
                </div>
            </div>


            <div class="offcanvas-body">

                <!-- Navigation -->
                <ul class="nav flex-column">
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'home' ? 'nav-active' : '' }}"
                            aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle nav-text-style {{ Route::currentRouteName() == 'course-list' || Route::currentRouteName() == 'course-detail' ? 'nav-active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Courses
                        </a>
                        <ul class="dropdown-menu multi-column columns-2" aria-labelledby="navbarDropdown">
                            <div class="row">
                                @php
                                    $categories = \App\Models\Category::all();
                                @endphp
                                @foreach ($categories as $cateogry)
                                    <div class="col-sm-6">
                                        <ul class="multi-column-dropdown">
                                            <li><a href="{{ route('course-list', $cateogry->id) }}"
                                                    class="sub-menu-text-style {{ request()->route('category_id') == $cateogry->id ? 'nav-active' : '' }}">{{ $cateogry->name }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'events' ? 'nav-active' : '' }}"
                            aria-current="page" href="{{ route('events') }}">Events</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'home' ? 'nav-active' : '' }}"
                            aria-current="page" href="https://skillageislamic.sch.id">Our School</a>
                    </li>
                    @auth
                    @else
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'login' ? 'nav-active' : '' }}"
                                aria-current="page" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'register' ? 'nav-active' : '' }}"
                                aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
        <!-- Show Only in mobile -->
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ms-auto w-35">
                <li class="nav-item mx-2">
                    <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'home' ? 'nav-active' : '' }}"
                        aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle nav-text-style {{ Route::currentRouteName() == 'course-list' || Route::currentRouteName() == 'course-detail' ? 'nav-active' : '' }}"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Courses
                    </a>
                    <ul class="dropdown-menu multi-column columns-2" aria-labelledby="navbarDropdown">
                        <div class="row">
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $cateogry)
                                <div class="col-sm-6">
                                    <ul class="multi-column-dropdown">
                                        <li><a href="{{ route('course-list', $cateogry->id) }}"
                                                class="sub-menu-text-style {{ request()->route('category_id') == $cateogry->id ? 'nav-active' : '' }}">{{ $cateogry->name }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </ul>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link nav-text-style {{ Route::currentRouteName() == 'events' ? 'nav-active' : '' }}"
                        aria-current="page" href="{{ route('events') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-text-style"
                        aria-current="page" href="https://skillageislamic.sch.id">Our School</a>
                </li>
            </ul>
            @auth
                <div class="d-flex justify-content-end align-items-center">
                    <div class="dropdown ms-2">
                        <a class="nav-link dropdown-toggle align-items-center" href="#" id="profileDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">Hi, {{ auth()->user()->first_name }}</span>
                            @if (empty(auth()->user()['photo']))
                                <div class="avatar avatar-sm rounded-circle bg-info-light border-radius-md p-2 ">
                                    <h6 class="text-info-light text-uppercase mt-1">
                                        {{ auth()->user()->name[0] }}</h6>
                                </div>
                            @else
                                <img src="{{ auth()->user()->photo_url }}"
                                    class="avatar avatar-sm rounded-circle shadow-sm">
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ auth()->user()->is_admin ? route('dashboard') : route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('register') }}" class="btn btn-outline-primary mx-2">Sign Up</a>
                <a href="{{ route('login') }}" class="btn btn-primary mx-2">Sign In</a>
            @endauth
        </div>
    </div>
</nav>