<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component {
    #[Url]
    public string $search = '';

    #[Url]
    public ?int $category_id = 0;
    public array $selected_product_ids = [];

    
    public string $sort = 'updated_at';

    public function clear(): void
    {
        $this->reset();
    }

    public function categories(): Collection
    {
        return Category::withCount('products')->get();
    }

    public function products(): Collection
    {
        return Product::all();
            
    }

    public function productChoices(): array
    {
        return Product::all()->map(fn($product) => [
            'id' => $product->id,
            'name' => $product->name,
        ])->toArray();
    }

    public function with(): array
    {
        return [
            'categories' => $this->categories(),
            'products' => $this->products(),
            'productChoices' => $this->productChoices(),
        ];
    }
}; ?>

<div>
    <style>
        .pb-5>div>div>div {
            font-size: 1rem;
        }

        .bg-base-200>div>div>svg {
            color: black !important;
        }

        #mary0b633c6213a280630d87862878f46b16search {
            border-color: oklch(var(--wa));
            background-color: transparent;
        }

        #mary0b633c6213a280630d87862878f46b16search:focus {
            outline: 2px solid oklch(var(--wa)) !important;
            /* Adjust the thickness as needed */
            outline-offset: 2px !important;
        }

        .selectcustomcss:focus {
            outline: 2px solid oklch(var(--wa)) !important;
            /* Adjust the thickness as needed */
            outline-offset: 2px !important;
        }
    </style>
    <x-mary-header title="Camisas" />

    <x-mary-header size="text-inherit" progress-indicator>
        {{-- SEARCH --}}
        <x-slot:title id="buceta">

            <!-- Replace the input with the choices component -->
            <x-mary-choices
                label="Select Products"
                wire:model.live="selected_product_ids"
                :options="$productChoices"
                placeholder="Digite algo"
                search-function="searchProducts"
                no-result-text="No products found"
                searchable
                multiple
                class="md:w-96 w-full border-warning text-warning" />
        </x-slot:title>

        {{-- SORT --}}
        <x-slot:actions class="mt-7">
            <x-mary-dropdown label="Seleções" class="btn">
                <x-mary-menu-item title="América" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Europa" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Ásia" wire:click.stop=".." spinner="..." />
                <x-mary-menu-item title="África" wire:click.stop="..." spinner="..." />
            </x-mary-dropdown>
            <x-mary-dropdown label="Times Europeus" class="btn">
                <x-mary-menu-item title="Liga Alemã" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Liga Espanhola" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Liga Francesa" wire:click.stop=".." spinner="..." />
                <x-mary-menu-item title="Liga Inglesa" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Liga Italiana" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Outra Liga" wire:click.stop="..." spinner="..." />
            </x-mary-dropdown>
            <x-mary-dropdown label="Times Brasileiros" class="btn">
                <x-mary-menu-item title="Cariocas" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Paulistas" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Sulistas" wire:click.stop=".." spinner="..." />
                <x-mary-menu-item title="Mineiros" wire:click.stop="..." spinner="..." />
                <x-mary-menu-item title="Nordestinos" wire:click.stop="..." spinner="..." />
            </x-mary-dropdown>
        </x-slot:actions>
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        {{-- PRODUCTS LIST --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($products as $product)
            <x-mary-card title="{{ $product->name }}" class="dark:bg-gray-800 bg-gray-50 text-sm relative shadow-md">
               
                <span class="inline-flex items-start gap-1 top-2 left-2 absolute rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-yellow-400 dark:ring-yellow-600 ring-inset"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-[2px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg> 21%</span>

                <x-slot:figure class="relative">
                    @php
                    $imageArray = is_string($product->image) ? json_decode($product->image, true) : $product->image;

                    // Ensure $imageArray is an array before accessing index 0
                    $firstImage = !empty($imageArray) && is_array($imageArray) ? $imageArray[0] : 'default.jpg';
                    @endphp

                    <img src="{{ asset('storage/' . ($product->image[0] ?? 'default.jpg')) }}" class="h-72 w-full" alt="{{ $product->name }}" />
                    <span class="inline-flex  bottom-2 right-2 absolute  items-start rounded-md text-start bg-green-100 px-2 py-1 text-xs gap-1 font-medium dark:text-green-500 text-green-600 ring-1 ring-green-600/20 ring-inset">  <x-mary-icon name="o-truck" /> <span class="mt-[3px]"> FRETE GRÁTIS</span></span>


                </x-slot:figure>
                <div class="mb-1 gap-1">
                    <p class="xl:text-xl font-semibold dark:text-red-600 text-red-500">R$ {{$product->price}} <span class="text-xs mt-1 dark:text-gray-600 text-gray-400  ">  <del>R$ 159.99 <del></span></p>
                </div>
                <div class="flex items-center gap-1">
                    <p class="xl:text-lg">Ou <strong>12x</strong> de <span class="dark:text-red-600 text-red-500 font-semibold">R$ 15,24</span></p>
                </div>
                <x-slot:menu>
                    <x-mary-button icon="o-heart" class="btn-circle btn-sm shadow-md" />
                </x-slot:menu>
                <div>
                <a class ="btn w-full mt-5 btn-warning" href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Ver mais</a>
                </div>
               



            </x-mary-card>
            @empty
            {{-- NO RESULTS--}}
            <x-mary-alert title="Nothing here!" description="Try to remove some filters." icon="o-exclamation-triangle" class="bg-base-100 border-none">
                <x-slot:actions>
                    <x-mary-button label="Clear filters" wire:click="clear" icon="o-x-mark" spinner />
                </x-slot:actions>
            </x-mary-alert>
            @endforelse
        </div>
    </div>

   
</div>