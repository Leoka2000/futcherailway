<div>
    <x-app-layout>
        <div class="p-12">
            <div class="flex flex-col items-start max-w-2xl px-4 py-10 mx-auto mt-12 space-y-4 dark:text-gray-300 sm:px-6 lg:px-8">
                <a href="{{route('components.shopping_cart_component_index')}}">
                    <x-mary-button  icon='o-shopping-cart'>Continue Shopping</x-mary-button>
                </a>
                <x-mary-alert title="Your order was successful!" icon="o-check-circle" class="alert-success">
                    Thank you for your purchase. Your order is being processed and you will receive a confirmation email shortly.
                </x-mary-alert>
            </div>
        </div>
    </x-app-layout>
</div>
