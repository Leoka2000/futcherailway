<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\RefundOrder;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class UserOrdersTable extends Component
{
    use Toast, WithPagination;

    public $order_hashed_id;
    public $email;
    public $refund_reason;
    public $refund_pix_key;
    public $showModal = false;

    protected $rules = [
        'order_hashed_id' => 'required|string',
        'email' => 'required|email',
        'refund_reason' => 'required|string',
        'refund_pix_key' => 'required|string',
    ];

    public function mount()
    {
        // Fetch orders from the database or any other source
        $this->orders = $this->fetchOrders();
    }
    public function fetchOrders()
    {
        // Example: Fetch orders from the database
        return Order::where('user_id', auth()->id())->get()->toArray();
    }
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
        $this->reset(['order_hashed_id', 'email', 'refund_reason', 'refund_pix_key']);
        $this->showModal = false;
        $this->success('Obrigado pela mensagem!', 'Entraremos em contato em breve!', 'toast-top toast-end', 10000);
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
        $orders = $user ? $user->orders()->with('product')->get() : collect();

        if (!$user) {
            $orders = collect([
                (object) ['id' => '-', 'quantity' => '-', 'unit_price' => '-', 'status' => '-']
            ]);
        }

        $headers = [
            ['key' => 'id', 'label' => 'Código da compra'],
            ['key' => 'quantity', 'label' => 'Quantity'],
            ['key' => 'unit_price', 'label' => 'Unit Price'],
            ['key' => 'status', 'label' => 'Status'],
        ];

        return view('livewire.user-orders-table', [
            'orders' => $orders,
            'headers' => $headers,
            'isGuest' => !$user
        ]);
    }
}
