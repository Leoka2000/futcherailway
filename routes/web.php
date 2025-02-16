<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/', function () {
    return view('livewire.components.hero');
});

Route::get('/cart/debug/{id}', [ShoppingCartController::class, 'debugImage'])->name('cart.debug');


Route::view('catalogo', 'livewire.components.shopping_cart_component_index')
    ->name('components.shopping_cart_component_index');

Route::view('termos-e-servicos', 'policy')
    ->name('policy');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])->name('components/list-cart');

Route::get('/cart-list', function () {
    return view('cart-list'); // This Blade view will include the Livewire component
})->name('cart-list');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
