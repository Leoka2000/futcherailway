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
    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Livewire Styles -->
    @livewireStyles
    <style>
        .customcss {
            outline: 2px solid oklch(var(--wa)) !important;
            outline-offset: 2px !important;
            box-shadow: none !important;
            border-radius: 1rem;
            border-color: transparent !important;
        }
        input[type="checkbox"]:checked {
            background-color: oklch(var(--wa)) !important;
        }
    </style>
</head>

<body class="font-sans antialiasedx">
    <x-mary-main with-nav full-width class rounded>
        <x-slot:content>
            <div class="relative z-10" role="dialog" aria-modal="true">
                <div class="fixed inset-0 hidden bg-gray-500/75 transition-opacity md:block" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
                        <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                            <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pt-14 pb-8 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                                <a href="{{ route('components.shopping_cart_component_index') }}" x-data="{ loading: false }" @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
                                    <button x-show="!loading" type="button" class="absolute top-4 right-4 text-yellow-500 border border-yellow-500 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-yellow-600 dark:text-yellow-600 dark:hover:text-white dark:focus:ring-yellow-600 dark:hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                    <button x-show="loading" disabled type="button" class="absolute top-4 right-4 text-yellow-500 border border-yellow-500 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-yellow-600 dark:text-yellow-600 dark:hover:text-white dark:focus:ring-yellow-600 dark:hover:bg-yellow-600">
                                        <svg aria-hidden="true" role="status" class="inline w-6 h-6 text-gray-500 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                </a>
                                <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                                    @php
                                        $images = $product->image;
                                        $slides = [];
                                        if (!empty($images) && is_array($images)) {
                                            foreach ($images as $image) {
                                                $slides[] = [
                                                    'image' => asset('storage/' . $image),
                                                    'description' => $product->description,
                                                ];
                                            }
                                        }
                                    @endphp

                                    @if(!empty($slides))
                                        <!-- PhotoSwipe Gallery -->
                                        <div class="w-full h-screen sm:col-span-4 lg:col-span-5">
                                            <div class="pswp-gallery" id="gallery">
                                                @foreach($slides as $index => $slide)
                                                    <a href="{{ $slide['image'] }}" data-pswp-width="1200" data-pswp-height="800" target="_blank">
                                                        <img src="{{ $slide['image'] }}" alt="{{ $slide['description'] }}" class="w-full h-full min-h-screen rounded-lg bg-gray-100 object-cover">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>No images available</p>
                                    @endif

                                    <!-- Rest of your product details -->
                                    <div class="sm:col-span-8 lg:col-span-7">
                                        <!-- Your existing product details code -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />

    <!-- PhotoSwipe Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lightbox = new PhotoSwipeLightbox({
                gallery: '#gallery',
                children: 'a',
                pswpModule: PhotoSwipe
            });
            lightbox.init();
        });
    </script>
</body>

</html>