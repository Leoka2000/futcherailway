<div>
    <x-app-layout>
        <div class="p-12">
            <div class="flex flex-col items-start max-w-2xl px-4 py-10 mx-auto mt-12 space-y-4 dark:text-gray-300 sm:px-6 lg:px-8">
                <a href="{{route('components.shopping_cart_component_index')}}">
                    <x-mary-button  icon='o-chevron-left'>Go back to shopping </x-mary-button>
                </a>
                <x-mary-alert title="Your order was canceled" icon="o-exclamation-triangle" class="alert-error">

                </x-mary-alert>


            </div>
        </div>
    </x-app-layout>
</div>