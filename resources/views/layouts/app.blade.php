<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body class="font-sans antialiased relative">
    <x-mary-theme-toggle class="absolute top-44 right-44" />

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width>

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
   
                <img class='object-cover w-14 h-14 rounded-md' src="{{ asset('logo.png') }}"
                    alt="logo" title="logo" /> 
          

        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>

            <x-mary-button label="Minha conta" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-mary-nav>

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">


            {{-- User --}}
            @if($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-slot:actions>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" type="submit" />
                    </form>
                </x-slot:actions>
            </x-mary-list-item>


            @endif

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Home" icon="o-home" link="###" />
                <x-mary-menu-item title="Messages" icon="o-envelope" link="###" />
                <x-mary-menu-item title="Profile" icon="o-envelope" link="user/profile" />
                <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />


                </x-mary-menu-sub>
                <x-mary-theme-toggle class="btn btn-circle" />


            </x-mary-menu>



        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
</body>

</html>