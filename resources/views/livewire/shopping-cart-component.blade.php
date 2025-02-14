<?php

use App\Models\Category;
use App\Models\Product;
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
};
?>

<div >
    <style>
        .pb-5>div>div>div { font-size: 1rem; }
        .customcssbtn {box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px; }
        .bg-base-200>div>div>svg { color: black !important; }
    </style>
   <x-mary-header title="Catálogo" subtitle="É possível aqui encontrar sua próxima paixão ..." separator />

    <x-mary-header size="text-inherit" progress-indicator>
        <x-slot:title>
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
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($products as $product)
            <x-mary-card x-data="{ loading: false }" title="{{ $product->name }}" class="dark:bg-gray-800 bg-gray-50 text-sm relative shadow-md">
                <x-slot:figure class="relative">
                    <img src="{{ asset('storage/' . ($product->image[0] ?? 'default.jpg')) }}" class="h-72 w-full" alt="{{ $product->name }}" />
                </x-slot:figure>
                <div class="mb-1 gap-1">
                    <p class="xl:text-xl font-semibold dark:text-red-600 text-red-500">R$ {{$product->price}}</p>
                </div>
                <div class="flex" x-data="{ loading: false }">
                    <a href="{{ route('product.show', $product->id) }}"
                        x-on:click="loading = true"
                        x-bind:class="{ 'opacity-80 pointer-events-none': loading }"
                        class="btn w-full customcssbtn btn-warning mt-5 flex items-center justify-center">
                        <span x-show="!loading">Ver mais</span>
                        <span>
                        <x-mary-loading x-show="loading" />
                        </span>
                    </a>
                </div>
            </x-mary-card>
            
            @empty
            <x-mary-alert title="Nothing here!" description="Try to remove some filters." icon="o-exclamation-triangle" class="bg-base-100 border-none">
                <x-slot:actions>
                    <x-mary-button label="Clear filters" wire:click="clear" icon="o-x-mark" spinner />
                </x-slot:actions>
            </x-mary-alert>
            @endforelse
        </div>
    </div>
</div>
