<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;


class BrasileiraoRelease extends Component
{
    public function render()
    {
        // Fetch products with category = 'ultimos_lancamentos'
        $products = Product::where('category', 'brasileirao_lancamentos')->get();

        return view('livewire.brasileirao-release', [
            'products' => $products
        ]);
    }

    public function placeholderForImage()
    {
        return <<<'HTML'

           <span class="loader">
           <x-mary-loading class="loading-ring" />
           </span>

        HTML;
    }
}
