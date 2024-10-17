<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! SEO::generate(true) !!}

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KJSMZPRZ');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LDE01BY9T7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LDE01BY9T7');
</script>
    <link id="pagestyle" href="{{ asset('css/app.css?v=19') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/inside.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/landing.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('img/logo/skillage-3d-logo.png') }}" type="image/x-icon" sizes="16x12">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    @stack('styles')

</head>

<body class="g-sidenav-show" id="clx_body">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJSMZPRZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('layouts.sections.topbar')
    @auth
        @include('layouts.sections.sidebar', ['mobile' => true, 'fixed' => false])
    @endauth
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