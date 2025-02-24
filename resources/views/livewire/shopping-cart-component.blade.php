<?php
use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {
    public string $selectedCategory = 'todos';

    public function products()
    {
        $query = Product::query();

        if ($this->selectedCategory !== 'todos') {
            $query->where('category', $this->selectedCategory);
        }

        return $query->get();
    }

    public function setFilter($category)
    {
        // Reset all filters before setting the new one
        $this->selectedCategory = $category;
    }

    public function with(): array
    {
        return [
            'products' => $this->products(),
            'selectedCategory' => $this->selectedCategory,
        ];
    }
};
?>

<div >
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
       

        {{-- SORT --}}
        <x-slot:actions class="mt-7">
            <x-mary-dropdown label="Times Europeus" class="btn-sm">
                <x-mary-menu-item value="liga_alema" title="Liga Alemã" wire:click="setFilter('liga_alema')" />
                <x-mary-menu-item value="liga_espanhola" title="Liga Espanhola" wire:click="setFilter('liga_espanhola')" />
                <x-mary-menu-item value="liga_francesa" title="Liga Francesa" wire:click="setFilter('liga_francesa')" />
                <x-mary-menu-item value="liga_inglesa" title="Liga Inglesa" wire:click="setFilter('liga_inglesa')" />
                <x-mary-menu-item value="todos" title="Todos" wire:click="setFilter('todos')" />
            </x-mary-dropdown>
    
            {{-- National Teams --}}
            <x-mary-dropdown label="Seleções" class="btn-sm">
                <x-mary-menu-item value="america" title="América" wire:click="setFilter('america')" />
                <x-mary-menu-item value="europa" title="Europa" wire:click="setFilter('europa')" />
                <x-mary-menu-item value="asia" title="Ásia" wire:click="setFilter('asia')" />
                <x-mary-menu-item value="africa" title="África" wire:click="setFilter('africa')" />
                <x-mary-menu-item value="todos" title="Todos" wire:click="setFilter('todos')" />
            </x-mary-dropdown>
    
            {{-- Brazilian Teams --}}
            <x-mary-dropdown label="Times Brasileiros" class="btn-sm">
                <x-mary-menu-item value="cariocas" title="Cariocas" wire:click="setFilter('cariocas')" />
                <x-mary-menu-item value="paulistas" title="Paulistas" wire:click="setFilter('paulistas')" />
                <x-mary-menu-item value="sulistas" title="Sulistas" wire:click="setFilter('sulistas')" />
                <x-mary-menu-item value="mineiros" title="Mineiros" wire:click="setFilter('mineiros')" />
                <x-mary-menu-item value="nordestinos" title="Nordestinos" wire:click="setFilter('nordestinos')" />
                <x-mary-menu-item value="todos" title="Todos" wire:click="setFilter('todos')" />
            </x-mary-dropdown>
           
        </x-slot:actions>
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        {{-- PRODUCTS LIST --}}
        <div  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <x-mary-card title="{{ $product->name }}">
                <p class="text-lg font-semibold">R$ {{ $product->price }}</p>
                <x-mary-button icon="o-plus" spinner="{{ route('product.show', $product->id) }}" class="btn w-full mt-5 btn-warning" link="{{ route('product.show', $product->id) }}">Ver mais</x-mary-button>
                {{ $product->category }}
            </x-mary-card>
        @endforeach
        </div>
    </div>
   
   
</div>