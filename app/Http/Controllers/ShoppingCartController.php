<?php

namespace App\Http\Controllers;


use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{

   

    public function index()
{
    $cartItems = ShoppingCart::with(['user', 'product'])->get();

    // Define the Brazilian states
    $brazilStates = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    return view('components.list-cart', compact('cartItems', 'brazilStates'));
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

}


