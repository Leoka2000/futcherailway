<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('livewire.components.hero');
});

Route::view('catalogo', 'livewire.components.shopping_cart_component_guest')
    ->name('components.shopping_cart_component_guest');

Route::view('termos-e-servicos', 'policy')
    ->name('policy');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
