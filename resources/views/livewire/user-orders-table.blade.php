<div>
    <a href="{{ route('components.shopping_cart_component_index') }}" 
    x-data="{ loading: false }"
    @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
        <x-mary-button icon="o-arrow-uturn-left" link="/" class="btn md:w-96 w-full mb-10"> Back </x-mary-button>
    </a>

    <h1 class="md:text-2xl mb-10 text-xl"><strong>Minhas compras</strong></h1>

    @if(auth()->check() && $orders->isNotEmpty())
        <x-mary-table :headers="$headers" :rows="$orders">
            @scope('cell_quantity', $order)
                <span>{{ $order->quantity }}</span>
            @endscope

            @scope('cell_unit_price', $order)
                <span>${{ $order->unit_price }}</span>
            @endscope

            @scope('cell_status', $order)
                @if ($order->status === 'under_process')
                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">
                        Processando pagamento...
                    </span>
                @else
                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">
                        {{ $order->status }}
                    </span>
                @endif
            @endscope

            @scope('actions', $order)
                <x-mary-button wire:click="openModal" class="my-2" label="Reembolso" spinner />
            @endscope
        </x-mary-table>
    @else
        <p class="text-gray-500 text-center mt-10">Nenhuma roupa disponível.</p>
    @endif

    @if($showModal)
        <div id="crud-modal" class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-opacity-50">
            <x-mary-form wire:submit.prevent="submit" class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <x-mary-errors />
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pedido de reembolso</h3>
                    <x-mary-button wire:click="closeModal" icon="o-x-mark" class="btn-circle btn-sm" />
                </div>
                <div class="p-4">
                    <div class="">
                        <div class="mb-3">
                            <label for="order_hashed_id" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Id do pedido</label>
                            <x-mary-input type="text" id="order_hashed_id" wire:model.defer="order_hashed_id" class="w-full p-2 border rounded-lg dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Digite seu ID do pedido" />
                        </div>
                        <div class="mb-3">
                            <label for="refund_pix_key" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Chave PIX para reembolso</label>
                            <x-mary-input type="text" id="refund_pix_key" wire:model.defer="refund_pix_key" class="w-full p-2 border rounded-lg dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Digite sua chave PIX" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Seu e-mail</label>
                            <x-mary-input type="email" id="email" wire:model.defer="email" class="w-full p-2 border rounded-lg dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Digite seu e-mail" />
                        </div>
                        <div class="mb-3">
                            <label for="refund_reason" class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Motivo do reembolso</label>
                            <x-mary-input type="text" id="refund_reason" wire:model.defer="refund_reason" class="w-full p-2 border rounded-lg dark:border-gray-500 border-gray-300 dark:bg-gray-600 dark:text-white" placeholder="Explique seu motivo" />
                        </div>
                    </div>
                    <x-mary-button label="Enviar pedido" type="submit" spinner="submit" class="w-full py-2" icon="o-paper-airplane"/>
                </div>
            </x-mary-form>
        </div>
    @endif
</div>
