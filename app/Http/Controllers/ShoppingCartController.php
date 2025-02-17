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
    }

    public function removeItemFromCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Find the cart item for the authenticated user and the given product ID
        $cartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();
    
        if ($cartItem) {
            // If the item exists, delete it
            $cartItem->delete();
    
            // Return a success response
            return response()->json([
                'message' => 'Item removed from cart successfully.',
                'cartUpdated' => true,
            ], 200);
        }
    
        // If the item does not exist, return an error message
        return response()->json([
            'message' => 'Item not found in cart.',
            'cartUpdated' => false,
        ], 404);
    }
}
