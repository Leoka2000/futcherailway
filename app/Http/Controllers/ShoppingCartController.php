<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::with(['user', 'product'])->get();
        return view('components.list-cart', compact('cartItems'));
    }
}