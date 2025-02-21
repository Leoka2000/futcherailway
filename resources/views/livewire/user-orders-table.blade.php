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
  

    <!-- Main Modal -->
    <div id="crud-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Create New Product</h3>
                <button id="closeModalBtn" class="text-gray-400 hover:bg-gray-200 rounded-lg text- w-8 h-8 dark:hover:bg-gray-600">
                    &times;
                </button>
            </div>
            <form class="p-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" id="name" class="w-full p-2 border rounded-lg dark:bg-gray-600 dark:text-white" placeholder="Type product name">
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg">Add Product</button>
            </form>
        </div>
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
