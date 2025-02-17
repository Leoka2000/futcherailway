<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::with(['user', 'product'])->get();
        return view('components.list-cart', compact('cartItems'));
    }

    protected $casts = [
        'image' => 'array',
    ];

    public function debugImage($id)
    {
        $item = ShoppingCart::with('product')->findOrFail($id);
        dd($item->product->image);
        // dd($item->quantity); assim loga a quantity field of the shoppingcart database
        
    }
   

    public function removeItemFromCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }

            return redirect()->back()->with('success', [
                'title' => 'Item Removed',
                'message' => 'The item has been removed from your cart!',
                'position' => 'top-end',
                'timeout' => 3000,
            ]);
        }

        return redirect()->back()->with('error', [
            'title' => 'Item Not Found',
            'message' => 'This item is not in your cart.',
            'position' => 'top-end',
            'timeout' => 3000,
        ]);
    }
}