<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product; // Import the Product model

class LatestReleases extends Component
{
    public function render()
    {
        // Fetch products with category = 'ultimos_lancamentos'
        $products = Product::where('category', 'ultimos_lancamentos')->get();

        return view('livewire.latest-releases', [
            'products' => $products
        ]);
    }
}
