<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="shell-type" content="web_standard" />
    <title>@yield('title', 'VILAGRO AI - Deteksi Cepat Penyakit & Hama Tanaman Jagung')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-symbol.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-symbol.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-background font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    @include('partials.header')

    <main @class(['w-full min-h-screen bg-background', 'pt-20' => ! request()->routeIs('home')])>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>