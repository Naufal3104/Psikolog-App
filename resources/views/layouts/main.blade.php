<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'Psikolog - RSUD Jombang')</title>

    <link rel="icon" href="favicon.ico">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .icon-small {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            color: #1e40af;
            /* Warna ikon badge */
        }
    </style>
    @stack('styles')
</head>

<body x-data="{ darkMode: true, scrollTop: false, sidebarOpen: false, stickyMenu: false, navigationOpen: false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')) ;
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }" style="overflow-x: hidden;">
    <x-layout.navbar />
    <main>
        @yield('content')
    </main>

    <x-layout.footer />

    <button class="xc wf xf ie ld vg sr gh tr g sa ta _a" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false" :class="{ 'uc': scrollTop }">
        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>
    <script>
        feather.replace();
    </script>
    <script defer src="bundle.js"></script>
    @stack('scripts')
</body>

</html>
