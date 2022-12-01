<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'COffeemaker') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/css.css') }}"> --}}
    @yield('css')
    @livewireStyles
    <!-- Scripts -->

</head>

<body class="bg-gray-300">
    <header>
    </header>
    <div class="containner mx-auto">
        @yield('body')
    </div>
    @stack('modals')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    @stack('js')


</body>

</html>
