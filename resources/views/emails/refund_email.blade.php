<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="relative font-sans antialiased">
    
    <x-mary-main with-nav full-width>
        <x-slot:content>
            <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
                <div class="w-full max-w-2xl p-4 bg-white shadow-2xl dark:bg-gray-900 sm:p-10 sm:rounded-3xl">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full dark:bg-green-700">
                            <svg class="h-12 w-12 text-green-600 dark:text-green-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                        </div>
                        <h1 class="text-4xl font-extrabold text-gray-800"><strong>Refund Processed<strong></h1>
                        <p class="mt-4 text-lg text-gray-800 dark:text-gray-500">
                            Dear customer,<br />
                            Your refund for order <strong>{{ $orderID }}</strong> has been successfully processed.
                        </p>
                        <p class="mt-4 text-lg text-gray-800 dark:text-gray-300">
                            Refund Reason: <strong>{{ $refundReason }}</strong>
                        </p>
                        <p class="mt-6 text-xl text-blue-600 dark:text-blue-400">
                            The amount will be credited to your original payment method within a few business days.
                        </p>
                        <p class="mt-4 text-sm text-gray-700 dark:text-gray-400">
                            If you have any questions or need further assistance, feel free to contact us at:
                            <a href="mailto:Futche.sports@gmail.com" class="font-medium text-indigo-600 dark:text-indigo-400 underline">
                                Futche.sports@gmail.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <x-footer />
</body>

</html>


