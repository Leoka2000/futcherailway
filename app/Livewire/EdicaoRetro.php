<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product; // Import the Product model

class EdicaoRetro extends Component
{
    public function render()
    {
        // Fetch products with category = 'ultimos_lancamentos'
        $products = Product::where('category', 'edicao_retro')->get();

        return view('livewire.edicao-retro', [
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
