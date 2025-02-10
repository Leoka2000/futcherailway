<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('livewire.components.hero');
});

Route::view('catalogo', 'livewire.components.shopping_cart_component_guest')
    ->name('components.shopping_cart_component_guest');

Route::view('termos-e-servicos', 'policy')
    ->name('policy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
