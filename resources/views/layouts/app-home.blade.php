<!doctype html>
<html class="loading scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $business_profile->brand_name }} - @stack('title', 'Title')" />
    <meta property="og:description" content="Undangan digital, rayakan momen berharga dengan cara yang lebih modern dan mudah." />
    <meta property="og:image" content="{{ Storage::url($business_profile->logo) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <title>{{ $business_profile->brand_name }} - @stack('title', 'Title')</title>

    <link rel="icon" href="{{ Storage::url($business_profile->logo) }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ Storage::url($business_profile->logo) }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <link href="{{ asset('/') }}assets/jm-homepage2/dist/assets/fortawesome/fontawesome-free/css/all.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/jm-homepage2/dist/assets/aos/dist/aos.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/jm-homepage2/dist/assets/fancyapps/ui/dist/fancybox/fancybox.css" rel="stylesheet" />
    <script src="{{ asset('/') }}assets/jm-homepage2/dist/assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link href="{{ asset('/') }}assets/jm-homepage2/dist/assets/tailwind-output.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/jm-homepage2/dist/assets/costume-style.css" rel="stylesheet" />
    {{-- <link href="{{ asset('/') }}assets/tailwind/cdn-tailwind.min.css" rel="stylesheet" /> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-worksans">

    <x-layouts.home.navbar />
    @yield('content')
    <x-layouts.home.footer :contacts="$contacts" />

    <!-- Tombol Scroll Up Down-->
    <button id="scrollUp" class="scroll-button fixed bottom-32 right-4 bg-blue-600 text-white rounded-full p-3 shadow-lg hidden opacity-75 hover:opacity-100 transition-opacity duration-200">
        <i class="fas fa-arrow-up"></i>
    </button>
    <button id="scrollDown" class="scroll-button fixed bottom-20 right-4 bg-blue-600 text-white rounded-full p-3 shadow-lg hidden opacity-75 hover:opacity-100 transition-opacity duration-200">
        <i class="fas fa-arrow-down"></i>
    </button>

    <script src="{{ asset('/') }}assets/jm-homepage2/dist/assets/aos/dist/aos.js"></script>
    <script src="{{ asset('/') }}assets/jm-homepage2/dist/assets/fancyapps/ui/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{ asset('/') }}assets/jm-homepage2/dist/assets/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/jm-homepage2/dist/assets/costume-script.js"></script>

    @stack('scripts')
</body>

</html>
