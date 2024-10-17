<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! SEO::generate(true) !!}

    <link id="pagestyle" href="{{ asset('css/app.css?v=19') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/inside.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/landing.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/loadingio/ldbutton@v1.0.1/dist/ldbtn.min.css" />
    <link rel="icon" href="{{asset('img/logo/skillage-3d-logo.png')}}" type="image/x-icon" sizes="16x12">
    @stack('styles')

</head>

<body class="g-sidenav-show" id="clx_body">
    <nav class="navbar shadow-none border-bottom  navbar-expand-lg navbar-light  bg-white py-3">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="/" rel="tooltip" data-placement="bottom"
                target="_blank">
                <img src="{{ asset('img/logo/skillage-3d-logo.png') }}" class="navbar-brand-img h-100"
                    style="max-height: 30px;" alt="...">
            </a>
            <ul class="navbar-nav me-auto ms-5 mb-lg-0">
                <li class="nav-item">
                    <a class="my-course align-items-center" href="{{route('user.my-courses')}}"><x-svg.back/> My Course</a>
                </li>
                <!-- Other navigation links can be added here -->
            </ul>
            <div class="d-flex justify-content-end align-items-center d-sm-none">
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
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="main-content mt-1 border-radius-lg">
        <div class="container-fluid">
            <x-forms.alert />
            {{ $slot }}
            @include('layouts.sections.footer', [
                'categories' => \App\Models\Category::all(),
                'sub_categories' => \App\Models\SubCategory::all(),
            ])
        </div>

    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/app.js?v=81') }}"></script>
    <script src="{{ asset('lib/tinymce/tinymce.min.js?v=93') }}"></script>
    @livewireScripts
    <script>
        "use strict"
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        Livewire.on('swal:success', (data) => {
            $('.modal').modal('hide');

            Livewire.dispatch('reset-form');
            Swal.fire(
                'Success!',
                data.message,
                'success'
            )
        });
        Livewire.on('swal:danger', (data) => {
            $('.modal').modal('hide');

            Livewire.dispatch('reset-form');
            Swal.fire(
                'Failed!',
                data.message,
                'danger'
            )
        });

        Livewire.on('swal:confirm', (data) => {
            Swal.fire({
                title: data.title ? data.title : 'Anda yakin ingin?',
                text: data.message ? data.message : 'Anda tidak akan dapat mengembalikan data ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: data.confirmText ? data.confirmText : 'Ya, hapus!',
                cancelButtonText: data.cancelText ? data.cancelText : 'Tidak, batalkan!',
                customClass: {
                    confirmButton: data.confirmClass ? data.confirmClass : 'btn btn-danger me-3',
                    cancelButton: 'btn btn-info'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    Livewire.dispatch(data.dispatch ? data.dispatch : 'delete-data', {
                        id: data.id
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: data.dismissText ? data.dismissText : 'Data tidak dihapus',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });
        })
    </script>
    @stack('scripts')
</body>

</html>
