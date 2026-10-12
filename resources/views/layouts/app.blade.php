<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bapenda Kaltim')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|montserrat:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Template Styles -->
    @stack('styles')
</head>
<body class="antialiased" style="background-color: #0c1e33;">
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Template Scripts -->
    @stack('scripts')
</body>
</html>
