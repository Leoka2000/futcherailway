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

    #[Url]
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
        return Product::query()
            ->with(['category'])
            ->when($this->category_id, fn(Builder $q) => $q->where('category_id', $this->category_id))
            ->where('name', 'like', "%$this->search%")
            ->take(10)
            ->latest($this->sort)
            ->get();
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
            <x-mary-card title="{{ $product->name }}" class="dark:bg-gray-800 text-sm relative shadow-md">
                <p class="top-2 left-2 px-2 py-1 absolute rounded-badge text-sm text-gray-900 bg-warning flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg>
                    21%
                </p>

                <x-slot:figure class="relative">
                    @php
                    $imageArray = is_string($product->image) ? json_decode($product->image, true) : $product->image;

                    // Ensure $imageArray is an array before accessing index 0
                    $firstImage = !empty($imageArray) && is_array($imageArray) ? $imageArray[0] : 'default.jpg';
                    @endphp

                    <img src="{{ asset('storage/' . ($product->image[0] ?? 'default.jpg')) }}" class="h-72 w-full" alt="{{ $product->name }}" />

                    <p class="px-4 py-1 bottom-2 right-2 absolute  rounded-badge text-xs text-gray-100 bg-green-600 flex items-center justify-center gap-1">
                        <x-mary-icon name="o-truck" />
                        FRETE GRÁTIS
                    </p>

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

                <div class="mt-5">
                    <x-mary-button label="Ver mais" icon="o-eye" class="btn-warning w-full shadow-md" />

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