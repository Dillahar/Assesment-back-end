<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    <link id="pagestyle" href="{{ asset('css/app.css?v=546') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{asset("css/inside.css")}}" rel="stylesheet"/>
    <link rel="icon" href="{{asset('img/logo/skillage-3d-logo.png')}}" type="image/x-icon" sizes="16x12">
    @stack('styles')

</head>

<body class="g-sidenav-show bg-gray-100" id="clx_body">
    @include('layouts.sections.topbar', ['show_logo' => false])
    @include('layouts.sections.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id=""
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0"></h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid mt-4">
            <x-forms.alert />
            {{ $slot }}
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
