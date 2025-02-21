<div>
    @php
        $headers = [
            ['key' => 'id', 'label' => 'Código da compra'],

            ['key' => 'quantity', 'label' => 'Quantity'],
            ['key' => 'unit_price', 'label' => 'Unit Price'],
            ['key' => 'status', 'label' => 'Status'],
        ];
    @endphp

    <x-mary-table :headers="$headers" :rows="$orders">

   
    

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
                <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">{{$order->status}}</span>
        @endscope

        {{-- Actions slot --}}
        @scope('actions', $order)
            <x-mary-button class="my-2" label="Pedir reembolso" wire:click="delete({{ $order->id }})" spinner/>
        @endscope

    </x-mary-table>
</div>