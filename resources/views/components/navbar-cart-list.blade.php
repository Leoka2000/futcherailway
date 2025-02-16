<x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a class="cursor-pointer" href="/"><img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}"
                alt="logo" title="logo" /></a>
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="#" class="btn relative" responsive><livewire:shopping-cart-icon /></x-mary-button>
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
            <x-mary-button label="Termos de Serviço" icon="o-information-circle" link="{{ route('policy')}}" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" href="mailto:Futche.sports@gmail.com" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Rastrear pedido" icon="o-map-pin" link="{{route('profile.show')}}" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-mary-nav>
