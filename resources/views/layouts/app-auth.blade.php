<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $business_profile->brand_name }} - @stack('title', 'Title')</title>

    <link rel="icon" href="{{ Storage::url($business_profile->logo) }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/jquery-selectric/selectric.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/css/components.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    <!-- Other -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="layout-3">

    <div id="app">
        @yield('content')
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/popper.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/tooltip.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/moment.min.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('/') }}assets/stisla/dist/assets/js/page/auth-register.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('/') }}assets/stisla/dist/assets/js/scripts.js"></script>
    <script src="{{ asset('/') }}assets/stisla/dist/assets/js/custom.js"></script>

    @stack('scripts')
</body>

</html>
