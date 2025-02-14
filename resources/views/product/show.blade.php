<!-- resources/views/product/show.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}" alt="logo" title="logo" />
        </x-slot:brand>
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="#" class="btn relative" responsive><livewire:shopping-cart-icon /></x-mary-button>
            <x-mary-button label="" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn" responsive />
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>
    </x-mary-nav>

    <x-mary-main with-nav full-width>
        <livewire:components.sidebar />
        <x-slot:content>
            <div class="p-4">
                <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                <img src="{{ asset('storage/' . $product->image[0]) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                <p class="text-gray-700 dark:text-gray-300">{{ $product->description }}</p>
                <p class="text-xl font-semibold dark:text-red-600 text-red-500">R$ {{ $product->price }}</p>
            </div>
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
</body>
</html>