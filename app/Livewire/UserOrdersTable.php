<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\RefundOrder;

class UserOrdersTable extends Component
{
    public $order_hashed_id;
    public $email;
    public $refund_reason;
    public $refund_pix_key;
    public $showModal = false;


    protected $rules = [
        'order_hashed_id' => 'required|string',
        'email' => 'required|email',
        'refund_reason' => 'nullable|string',
        'refund_pix_key' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        RefundOrder::create([
            'order_hashed_id' => $this->order_hashed_id,
            'email' => $this->email,
            'refund_reason' => $this->refund_reason,
            'refund_pix_key' => $this->refund_pix_key,
        ]);

        session()->flash('message', 'Refund request submitted successfully.');
        // Reset form fields
        $this->reset(['order_hashed_id', 'email', 'refund_reason', 'refund_pix_key']);

        // Close the modal
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('product')->get();

        $headers = [
            ['key' => 'id', 'label' => 'Código da compra'],
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
