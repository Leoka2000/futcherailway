<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;

class RemoveFromCart extends Component
{
    use Toast;

    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function removeFromCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                // Decrease the quantity by 1
                $cartItem->decrement('quantity');
            } else {
                // Remove the item from the cart
                $cartItem->delete();
            }

            // Trigger a success toast notification
            $this->success(
                'Product removed from cart!',
                'The item has been removed from your shopping cart.',
                position: 'toast-top toast-end',
                timeout: 3000
            );

            // Dispatch an event to update the cart UI
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        return view('livewire.remove-from-cart');
    }
}