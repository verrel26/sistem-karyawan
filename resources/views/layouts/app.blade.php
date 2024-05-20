<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surau TV | Log in</title>
    @if (auth()->check())
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="hold-transition <?php echo auth()->check() ? 'sidebar-mini' : 'login-page'; ?>">
    @include('header')
    @if (auth()->check())
        <div class="container-scroller">
        {{-- Navbar --}}
           @include('layouts.navbar')

            @yield('container')
    @else
        @yield('container')

    @endif    
        </div>
        @include('footer')
</body>
</html>
