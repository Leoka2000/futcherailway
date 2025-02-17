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

    public function increaseCartQuantity($productId)
    {
        $cartItem = ShoppingCart::where('product_id', $productId)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        }

        return redirect()->back();
    }

    public function decreaseCartQuantity($productId)
    {
        $cartItem = ShoppingCart::where('product_id', $productId)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back();
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
            $cartItem->delete();  // Delete the cart item directly without checking quantity

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
//     koksd<form action="{{ route('cart.debug', ['id' => $item->id]) }}" method="GET">
//     <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
//       Debug Image
//     </button>
//   </form>

//   <form action="{{ route('cart.remove', ['productId' => $item->product_id]) }}" method="POST">
//     @csrf
//     @method('DELETE')
//     <x-mary-button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
//       Remove Item
//     </x-mary-button>
//   </form> PARA DE
}