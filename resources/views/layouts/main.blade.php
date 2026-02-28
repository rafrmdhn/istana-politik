<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Istana Politik</title>

    <!-- Favicon  -->
    <link type="image/png" href="https://fypmedia.id/assets/backoffice/media/logos/FYPLOGO.png" rel="icon">

    <meta property="og:image" content="https://istanapolitik.fypmedia.id/img/logo.png">
    <meta property="og:description" content="Merangkum berita seputar dinamika politik, mulai dari kebijakan daerah, isu internasional, hingga opini.">
    <meta property="og:title" content="Istana Politik">
    <meta property="og:url" content="https://istanapolitik.fypmedia.id/">
    <meta property="og:type" content="website">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/core-style.patched.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Responsive CSS -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z116C021SE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-Z116C021SE');
    </script>
</head>

<body>
    <header class="header-area">
        @include('partials.topbar')

        @include('partials.midbar')

        @include('partials.navbar')
    </header>

    @yield('container')

    @include('partials.footer')

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}"></script>


</body>

</html>
