<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ $title ?? config('app.name')}}
    </title>
    {!! SEO::generate() !!}
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

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LDE01BY9T7');
    </script>
    <link id="pagestyle" href="{{asset("css/app.css?v=7")}}" rel="stylesheet"/>
    <link id="pagestyle" href="{{asset("css/inside.css")}}" rel="stylesheet"/>
    <link id="pagestyle" href="{{asset("css/skillage.css")}}" rel="stylesheet"/>
    <link rel="icon" href="{{asset('img/logo/skillage-3d-logo.png')}}" type="image/x-icon" sizes="16x12">
    @stack("styles")
</head>
<body class="g-sidenav-show">

{{ $slot}}

<script>
    (function(){
        "use strict";
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    })();
</script>
@stack("scripts")
</body>

</html>
