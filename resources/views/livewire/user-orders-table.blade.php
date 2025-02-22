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
        @scope('cell_quantity', $order)
            <span>{{ $order->quantity }}</span>
        @endscope

        @scope('cell_unit_price', $order)
            <span>${{ number_format($order->unit_price, 2) }}</span>
        @endscope

        @scope('cell_status', $order)
            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">{{$order->status}}</span>
        @endscope

        @scope('actions', $order)
        <x-mary-button class="openModalBtn my-2" label="Reembolso" spinner/>
        @endscope
    </x-mary-table>

    <!-- Button to Open Modal -->
  
    <style>
        #order_hashed_id:focus,
        #refund_pix_key:focus,
        #refund_reason:focus 
        {
            outline: 2px solid oklch(var(--wa)) !important;
            outline-offset: 2px !important;
            box-shadow: none !important;
            /* Remove any default box-shadow */
            border-color: transparent !important;
  
            /* Ensure no border color is applied */
        }
       
        
        
      
    </style>
    <!-- Main Modal -->
    <div id="crud-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-opacity-50">
        <x-mary-form  wire:submit.prevent="submit" class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-700">
            
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pedido de reembolso</h3>
                <x-mary-button id="closeModalBtn" t..-ype="submit" icon="o-x-mark" class="btn-circle btn-sm" />
            </div>
            <div class="p-4">
                <div class="mb-4">
                <label for="order_hashed_id" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Id of the order</label>
                <x-mary-input type="text" id="order_hashed_id" wire:model.debounce.500ms="order_hashed_id"  class="w-full p-2 border rounded-lg mb-4 dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Type your order ID" />

                <label for="refund_pix_key" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Chave pix para lhe enviarmos o reembolso</label>
                <x-mary-input type="text" id="refund_pix_key" wire:model.debounce.500ms="refund_pix_key"   class="w-full p-2 border rounded-lg mb-4  dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Type your pix key" />
                
                <label for="email" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Seu email para contatármos-lhe/label>
                <x-mary-input type="email" id="email" wire:model.debounce.500ms="email"   class="w-full p-2 border rounded-lg mb-4  dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Type your pix key" />

                <label for="refund_reason" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Please explain your reason for refund</label>
                <x-mary-input type="text" id="refund_reason" wire:model.debounce.500ms="refund_reason" class="w-full p-2 border rounded-lg dark:border-gray-500 mb-4  border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Explain your reasonings" />
                </div>
                <x-mary-button label="Enviar pedido" type="submit" spinner="submit" class="w-full py-2" icon="o-paper-airplane"/>
            </div>
        </x-mary-form>
    </div>
</div>

<script>
   document.querySelectorAll('[id="openModalBtn"]').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('crud-modal').classList.remove('hidden');
    });
});

document.getElementById('closeModalBtn').addEventListener('click', function () {
    document.getElementById('crud-modal').classList.add('hidden');
});

document.querySelectorAll('.openModalBtn').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('crud-modal').classList.remove('hidden');
    });
});
</script>
