{{-- resources/views/fitur/video.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video - Psikolog - RSUD Jombang</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('styles')
</head>

<body
    x-data="{ darkMode: true, scrollTop: false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
        $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
    "
    x-on:scroll.window="scrollTop = (window.pageYOffset > 300)"
    :class="{ 'b eh': darkMode }"
>
    <x-layout.navbar />
    <main></main>
    <x-layout.footer />

    <script defer src="{{ asset('bundle.js') }}"></script>
    @stack('scripts')
</body>

