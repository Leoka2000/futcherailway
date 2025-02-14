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
    <link rel="stylesheet" href="photoswipe/dist/photoswipe.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles


    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css" rel="stylesheet">
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
            <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>

            @php
            // Decode the JSON string of images into an array
            $images = $product->image;

            // Prepare the slides array for the gallery
            $slides = [];
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    $slides[] = asset('storage/' . $image); // Ensure the path is correct
                }
            }
            @endphp

            @if(!empty($slides))
            <!-- Display the image gallery -->
            <x-mary-image-gallery :images="$slides" class="h-64 rounded-box" />
            @else
            <p>No images available</p>
            @endif


        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />

    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
</body>

</html>