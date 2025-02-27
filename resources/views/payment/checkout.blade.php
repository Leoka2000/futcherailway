<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight dark:text-gray-300">
            {{ __('Checkout') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 dark:text-gray-300 lg:px-8">
        <x-mary-button icon='o-chevron-left' >Voltar </x-mary-button>
    
        </div>
    </div>
</x-app-layout>