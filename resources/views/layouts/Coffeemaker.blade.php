<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9J1SMRXMW8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9J1SMRXMW8');
</script>

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

<body class="bg-gray-100">
    <header>

        @livewire('navigation-dropdown')
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
