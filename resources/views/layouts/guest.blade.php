<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="relative font-sans antialiased">
    <div class=" bg-gray-100 dark:bg-gray-950">
        {{ $slot }}
    </div>

    @livewireScripts

    <!-- SCRIPT FOR DARK MODE -->
    <script>
        function toggleTheme() {
            const htmlElement = document.documentElement;
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }


        function applySavedTheme() {
            const savedTheme = localStorage.getItem('theme');
            const htmlElement = document.documentElement;
            if (savedTheme === 'dark') {
                htmlElement.classList.add('dark');
            } else {
                htmlElement.classList.remove('dark');
            }
        }


        applySavedTheme();
        document.getElementById('theme-toggle').addEventListener('click', toggleTheme);
    </script>
    <!-- SCRIPT FOR DARK MODE -->
</body>

</html>