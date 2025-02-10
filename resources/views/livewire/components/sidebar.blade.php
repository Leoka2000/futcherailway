<div>
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
            <x-mary-menu-item title="Início" icon="o-home" link="/" />
            <x-mary-menu-item title="Perfil" icon="o-user" link="{{route('profile.show')}}" />
            <x-mary-menu-item title="Entre em contato" icon="o-chat-bubble-left-right" href="mailto:Futche.sports@gmail.com" />
            <x-mary-menu-item title="Termos de Serviço" icon="o-information-circle" link="{{ route('policy')}}" />
            <x-mary-menu-item title="Camisas" class="text-warning" icon="o-gift" link="{{ route('components.shopping_cart_component_guest')}}" />
        </x-mary-menu>
    </x-slot:sidebar>
</div>