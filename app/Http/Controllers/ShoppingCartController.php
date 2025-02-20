<?php

namespace App\Http\Controllers;


use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ShoppingCartController extends Controller
{



    public function index(Request $request)
    {
        $cartItems = ShoppingCart::with(['user', 'product'])->get();

        // TA DANDO ERRO NA BASE DE DADOS, ESTA PASSANDO NUMEROS AO INVES DO REAL NOME DO ESTADO, DESBUGAR DPS
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
            $cartItem->delete();

            return redirect()->back()->with('cart_message', [
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

    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cartItems = ShoppingCart::where('user_id', auth()->id())->with('product')->get();
        $lineItems = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.checkout-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.checkout-cancel', [], true),
        ]);

        // Create the order
        $order = new Order();
        $order->user_id = auth()->id(); // Assign the user ID
        $order->status = 'unpaid';
        $order->save();

        return redirect($session->url);
    }

    public function success(Request $request)
    {

        return view('payment.checkout-success');
    }

    public function cancel(Request $request)
    {
        return view('payment.checkout-cancel');
    }
}
