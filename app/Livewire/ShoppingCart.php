<?php

namespace App\Livewire;

use App\Models\ShoppingCart as ShoppingCartModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Component

{
    public $cartItems;

    public function mount()
    {
        if (Auth::check()) {
            $this->cartItems = ShoppingCartModel::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $this->cartItems = [];
        }

        dd($this->cartItems); // Debugging
    }

    public function render()
    {
        return view('livewire.shopping-cart', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
