<?php
use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {
    public string $selectedCategory = 'todos';
    public string $searchTerm = ''; // Search input

    public function products()
    {
        $query = Product::query();

        // Apply category filter
        if ($this->selectedCategory !== 'todos') {
            $query->where('category', $this->selectedCategory);
        }

        // Apply search filter for product name
        if (!empty($this->searchTerm)) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        return $query->get();
    }

    public function setFilter($category)
    {
        $this->searchTerm = ''; // Clear search term when category changes
        $this->selectedCategory = $category;
    }

    public function searchMulti($search)
    {
        $this->searchTerm = $search; // Update search term dynamically
    }

    public function with(): array
    {
        return [
            'products' => $this->products(),
            'selectedCategory' => $this->selectedCategory,
            'searchTerm' => $this->searchTerm
        ];
    }
};
?>

<div  x-data="{ searchTerm: @entangle('searchTerm') }">
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

        .end-8 {
        display: none;

        }
        .outline-none {
           width:5rem;
           border-radius: 0.5rem;
           border-color:transparent;

        }
    </style>
    <x-mary-header title="Camisas" />

    <x-mary-header size="text-inherit" progress-indicator>
        {{-- SEARCH --}}
       
        <x-slot:title>
            <x-mary-choices
                label="Search for Products"
                placeholder="Type to search..."
                search-function="searchMulti"
                no-result-text="Ops! Nothing found..."
                searchable
                class="md:w-96 w-full border-warning text-warning" 
                x-model="searchTerm"
                wire:model="searchTerm" />
        </x-slot:title>

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
        <div  x-data="{ loading: false }"  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <x-mary-card title="{{ $product->name }}">
                <p class="text-lg font-semibold">R$ {{ $product->price }}</p>
                <button 
                x-bind:class="{'cursor-not-allowed opacity-50': loading}" 
                x-on:click.prevent="loading = true; window.location.href = '{{ route('product.show', $product->id) }}';"
                class="btn w-full mt-5 btn-warning"
                :disabled="loading"
            >
                <span x-show="!loading">Ver mais</span>
                <x-mary-loading class="text-gray-700 dark:text-gray-400" x-show="loading" />
            </button>
                {{ $product->category }}
            </x-mary-card>
        @endforeach
        </div>
    </div>
   
   
</div>