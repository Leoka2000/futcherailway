<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased relative">
    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}"
                alt="logo" title="logo" />


        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="#" class="btn relative" responsive><x-mary-badge value="7" class="badge-warning indicator-item absolute -right-2 -top-2" /></x-mary-button>
            <x-mary-button label="" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn" responsive />
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>

    </x-mary-nav>
    <x-mary-nav sticky full-width class="shadow-sm top-20">

        <x-slot:brand>


        <x-mary-input class="border-warning outline-warning">
                    <x-slot:append>
                        <x-mary-button icon="o-magnifying-glass" class="btn-warning rounded-s-none" />
                    </x-slot:append>
                </x-mary-input>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="Termos de Serviço" icon="o-information-circle" link="#" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" link="{{route('profile.show')}}" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Rastrear pedido" icon="o-map-pin" link="{{route('profile.show')}}" class="btn-ghost btn-sm" responsive />

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
               
                <x-mary-menu-item title="Início" icon="o-home" link="###" />
                <x-mary-menu-item title="Perfil" icon="o-user" link="{{route('profile.show')}}"  />
                <x-mary-menu-item title="Entre em contato" icon="o-chat-bubble-left-right" link="###" />
                <x-mary-menu-item title="Termos de Serviço" icon="o-information-circle" link="###" />
                <x-mary-menu-item title="Camisas" class="text-warning" icon="o-gift" link="###" />

            



            </x-mary-menu>



        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            content
        </x-slot:content>

    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />


</body>


</html>