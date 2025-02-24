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
    <a href="{{ route('components.shopping_cart_component_index') }}" 
    x-data="{ loading: false }"
    @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
    <x-mary-button icon="o-arrow-uturn-left" link="/" class="btn md:w-96 w-full mb-10 "> Back </x-mary-button >
{{--  --}}

                             
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
                <x-mary-menu-item  @click.stop  value="liga_alema" title="Liga Alemã" wire:click="setFilter('liga_alema')" wire:click.stop="setFilter('liga_alema')" spinner="setFilter('liga_alema')" />
                <x-mary-menu-item  @click.stop  value="liga_espanhola" title="Liga Espanhola" wire:click="setFilter('liga_espanhola')" spinner="setFilter('liga_espanhola')" />
                <x-mary-menu-item   @click.stop value="liga_francesa" title="Liga Francesa" wire:click="setFilter('liga_francesa')" spinner="setFilter('liga_francesa')" />
                <x-mary-menu-item  @click.stop  value="liga_inglesa" title="Liga Inglesa" wire:click="setFilter('liga_inglesa')" spinner="setFilter('liga_inglesa')" />
                <x-mary-menu-item  @click.stop  value="todos" title="Todos" wire:click="setFilter('todos')" spinner="setFilter('todos')" />
            </x-mary-dropdown>
        
            {{-- National Teams --}}
            <x-mary-dropdown label="Seleções" class="btn-sm">
                <x-mary-menu-item @click.stop value="america" title="América" wire:click="setFilter('america')" spinner="setFilter('america')" />
                <x-mary-menu-item  @click.stop  value="europa" title="Europa" wire:click="setFilter('europa')" spinner="setFilter('europa')" />
                <x-mary-menu-item  @click.stop  value="asia" title="Ásia" wire:click="setFilter('asia')" spinner="setFilter('asia')" />
                <x-mary-menu-item  @click.stop  value="africa" title="África" wire:click="setFilter('africa')" spinner="setFilter('africa')" />
                <x-mary-menu-item  @click.stop  value="todos" title="Todos" wire:click="setFilter('todos')" spinner="setFilter('todos')" />
            </x-mary-dropdown>
        
            {{-- Brazilian Teams --}}
            <x-mary-dropdown label="Times Brasileiros" class="btn-sm">
                <x-mary-menu-item  @click.stop  value="cariocas" title="Cariocas" wire:click="setFilter('cariocas')" spinner="setFilter('cariocas')" />
                <x-mary-menu-item  @click.stop  value="paulistas" title="Paulistas" wire:click="setFilter('paulistas')" spinner="setFilter('paulistas')" />
                <x-mary-menu-item  @click.stop  value="sulistas" title="Sulistas" wire:click="setFilter('sulistas')" spinner="setFilter('sulistas')" />
                <x-mary-menu-item  @click.stop  value="mineiros" title="Mineiros" wire:click="setFilter('mineiros')" spinner="setFilter('mineiros')" />
                <x-mary-menu-item  @click.stop  value="nordestinos" title="Nordestinos" wire:click="setFilter('nordestinos')" spinner="setFilter('nordestinos')" />
                <x-mary-menu-item  @click.stop  value="todos" title="Todos" wire:click="setFilter('todos')" spinner="setFilter('todos')" />
            </x-mary-dropdown>
        </x-slot:actions>
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        {{-- PRODUCTS LIST --}}
        <div x-data  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"  >
        @forelse($products as $product)
        <x-mary-card wire:key="product-{{ $product->id }}" title="{{ $product->name }}" class="dark:bg-gray-800 bg-gray-50 text-sm relative shadow-md">
           
            <span class="inline-flex items-start gap-1 top-2 left-2 absolute rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-yellow-400 dark:ring-yellow-600 ring-inset"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mt-[2px]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                </svg> 21%</span>

                <x-slot:figure class="relative">
                    <div x-data="{ loaded: false }" class="w-full h-auto rounded-md relative">
                        <!-- Loading Placeholder -->
                        <div 
                            x-show="!loaded" 
                            class="absolute inset-0 flex items-center justify-center bg-gray-200 animate-pulse rounded-md"
                        >
                        <div class="flex items-center justify-center h-full w-full mb-4 bg-gray-300 rounded-sm dark:bg-gray-700">
                            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"/>
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                            </svg>
                        </div>
                        </div>
                
                    
           
                        <div x-data="{ loaded: false }" class="w-full h-auto rounded-md relative">
                            <img 
                            src="{{ asset($product->image[0] ?? 'sample_img.jpg') }}" 
                            alt="Product Image" 
                            class="w-full h-auto rounded-md transition-opacity duration-300"
                            x-data="{ loaded: false }"
                            x-on:load="loaded = true"
                            x-bind:class="loaded ? 'opacity-100' : 'opacity-0'"
                            loading="lazy"
                        />
                        </div>
                
                        <!-- Badge -->
                        <span 
                            class="inline-flex bottom-2 right-2 absolute items-start rounded-md text-start bg-green-100 px-2 py-1 text-xs gap-1 font-medium dark:text-green-500 text-green-600 ring-1 ring-green-600/20 ring-inset"
                            x-bind:class="loaded ? 'block' : 'hidden'"
                        >  
                            <x-mary-icon name="o-truck" /> 
                            <span class="mt-[3px]"> FRETE GRÁTIS</span>
                        </span>
                    </div>
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
            <div   >
                <button 
                    x-data="{ loading: false }" 
                    x-bind:class="{'cursor-not-allowed opacity-50': loading}" 
                    x-on:click.prevent="loading = true; window.location.href = '{{ route('product.show', $product->id) }}';"
                    class="btn w-full mt-5 outline-warning"
                    :disabled="loading"
                >
                    <span x-show="!loading">Ver mais</span>
                    <x-mary-loading class="text-gray-700 dark:text-gray-400" x-show="loading" />
                </button>
                {{$product->category}}
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



