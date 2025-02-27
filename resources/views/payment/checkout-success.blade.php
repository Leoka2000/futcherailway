<div>
    <x-app-layout>
        <div class="p-12">
            <div class="flex flex-col items-start max-w-2xl px-4 py-10 mx-auto mt-12 space-y-4 dark:text-gray-300 sm:px-6 lg:px-8">
                <a href="{{route('components.shopping_cart_component_index')}}">
                    <x-mary-button  icon='o-shopping-cart'>Continue comprando</x-mary-button>
                </a>
                <x-mary-alert title="Your order was successful!" icon="o-check-circle" class="alert-success">
                    Obrigado pela sua compra. Seu pedido está sendo processado e você receberá um e-mail de confirmação em breve.
                </x-mary-alert>
            </div>
        </div>
    </x-app-layout>
</div>
