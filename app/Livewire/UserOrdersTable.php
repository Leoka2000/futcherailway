<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrdersTable extends Component
{
    public function render()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('product')->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'product.name', 'label' => 'Product Name'],
            ['key' => 'quantity', 'label' => 'Quantity'],
            ['key' => 'unit_price', 'label' => 'Unit Price'],
            ['key' => 'status', 'label' => 'Status'],
        ];

        return view('livewire.user-orders-table', [
            'orders' => $orders,
            'headers' => $headers,
        ]);
    }
}
