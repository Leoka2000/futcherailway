<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $productId;
    

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login');
        }

        // Check if the product is already in the cart
        $existingCartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($existingCartItem) {
            // If the product is already in the cart, increment the quantity
            $existingCartItem->increment('quantity');
        } else {
            // If the product is not in the cart, add it
            ShoppingCart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
                'quantity' => 1,
            ]);
        }

        // Emit an event to update the cart icon or any other UI element
        // $this->emit('cartUpdated');
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
