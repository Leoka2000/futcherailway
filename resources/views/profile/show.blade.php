<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <a href="{{ route('components.shopping_cart_component_index') }}" 
    x-data="{ loading: false }"
    @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 100)">
     <x-mary-button icon="o-arrow-uturn-left" link="/" class="btn md:w-96 w-full mb-10"> Voltar </x-mary-button>
 </a>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>
    </div>
</x-app-layout>