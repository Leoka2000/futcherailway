<div>
    {{-- Success Message --}}
    @if (session()->has('success'))
    <x-mary-alert title="Cadastro de envio confirmado, prossiga ao pagamento abaixo" class="alert-success" icon="o-check" shadow />
    <!-- title="{{ session('success')}}" -->

    @endif
    <style>
        /* Change the border and outline colors to yellow when focused */
        input:focus, select {
            outline: 2px solid oklch(var(--wa)) !important;
            outline-offset: 2px !important;
            box-shadow: none !important; /* Remove any default box-shadow */
            border-color: transparent !important;
        }

        input, select {
        border-color: 1px solid oklch(var(--wa))!important; /* Remove the default border */
        outline: none !important; /* Remove the default outline */
    }
    </style>
    @if (session()->has('success'))
    <div class="container"> </div>
    @else
    <form wire:submit.prevent="submit" class="dark:bg-gray-800 dark:border-gray-700 border shadow-lg rounded-lg mt-4 px-5 py-5">
        <p class="text-lg dark:text-gray-200 font-bold text-gray-700">Email para contato</p>
        <x-mary-input id="email" label="E-mail" wire:model.debounce.500ms="email" icon="o-envelope" />
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

        <p class="text-lg font-bold dark:text-gray-200 text-gray-700">Endereço para envio</p>
        <x-mary-input id="first_name"  label="Nome" wire:model.debounce.500ms="first_name" icon="o-user" />
        @error('first_name') <span class="text-red-500" >{{ $message }}</span> @enderror

        <x-mary-input id="last_name" label="Sobrenome" wire:model.debounce.500ms="last_name" icon="o-user" />
        @error('last_name') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-input id="address" label="Endereço" wire:model.debounce.500ms="address" icon="o-map-pin" />
        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-input id="city" label="Cidade" wire:model.debounce.500ms="city" icon="o-map-pin" />
        @error('city') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-select label="Brazilian States" :options="$brazilStates" wire:model="selectedState" />
        @error('selectedState') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-input id="cep" label="CEP" wire:model.debounce.500ms="zipcode" icon="o-map-pin" />
        @error('zipcode') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-input id="phone" label="Telefone" wire:model.debounce.500ms="phone" prefix="+55" />
        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror

        @error('payment_type') <span class="text-red-500">{{ $message }}</span> @enderror

        <x-mary-button label="Registrar cliente" class="btn-warning mt-5" type="submit" spinner="save6" />
    </form>

    @endif
</div>