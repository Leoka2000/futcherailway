<div>
    @php
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'product.name', 'label' => 'Product Name'],
            ['key' => 'quantity', 'label' => 'Quantity'],
            ['key' => 'unit_price', 'label' => 'Unit Price'],
            ['key' => 'status', 'label' => 'Status'],
        ];
    @endphp

    <x-mary-table :headers="$headers" :rows="$orders">

        {{-- Custom cell for product name --}}
        @scope('cell_product.name', $order)
            <strong>{{ $order->product }}</strong>
        @endscope

        {{-- Custom cell for quantity --}}
        @scope('cell_quantity', $order)
            <span>{{ $order->quantity }}</span>
        @endscope

        {{-- Custom cell for unit price --}}
        @scope('cell_unit_price', $order)
            <span>${{ number_format($order->unit_price, 2) }}</span>
        @endscope

        {{-- Custom cell for status --}}
        @scope('cell_status', $order)
            <x-mary-badge :value="$order->status" class="badge-info" />
        @endscope

        {{-- Actions slot --}}
        @scope('actions', $order)
            <x-mary-button icon="o-trash" wire:click="delete({{ $order->id }})" spinner class="btn-sm" />
        @endscope

    </x-mary-table>
</div>