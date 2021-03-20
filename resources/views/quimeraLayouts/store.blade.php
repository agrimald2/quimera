<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-21R7NFF8B9"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-21R7NFF8B9');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quimera</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Mercado Pago -->
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/quimeraStore.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- <script>
    (function() {
        var ldk = document.createElement('script'); 
        ldk.type = 'text/javascript'; 
        ldk.async = true; 
        ldk.src = 'https://s.cliengo.com/weboptimizer/5f0f9cf43b6953002a3d4876/5f0f9d63e2f723002a86f995.js';
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(ldk, s);
    })();

    </script> --}}
    <style>
        /* #popupIframe, #chatIframe {
            float: left!important;
            right: auto!important;
            width: auto !important;
        }

        #popupIframe, #chatIframe > #pop-up-message {
            margin-right: 15rem;
        } */
    </style>
</body>
</html>

