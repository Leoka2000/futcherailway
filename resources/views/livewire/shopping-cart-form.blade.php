<div>
    {{-- Success Message --}}
    @if (session()->has('success'))
        <x-mary-alert title="Cadastro de envio confirmado, prossiga ao pagamento à direita" class="alert-success" icon="o-check" shadow />
    @endif
    <style>
        /* Remove the default border and outline for all inputs */
        input, select {
            border: 1px solid oklch(var(--wa)) !important; /* Ensure the border is transparent */
            outline: none !important; /* Remove the default outline */
        }
        div > .flex > .border-primary {
            border: 1px solid oklch(var(--wa)) !important
        }

        /* Apply yellow outline only on focus */
        input:focus {
            outline: 2px solid oklch(var(--wa)) !important; /* Yellow outline */
            outline-offset: 2px !important; /* Add offset for better visibility */
            box-shadow: none !important; /* Remove any default box-shadow */
            border-color: transparent !important; /* Ensure no border is shown */
        }
    </style> 
    @if (!session()->has('success'))
        <form wire:submit.prevent="submit" class="dark:bg-gray-800 dark:border-gray-700 border shadow-lg rounded-lg mt-5 p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Full-width Email Row -->
                <div class="md:col-span-2">
                    <p class="text-lg dark:text-gray-200 font-bold text-gray-700">Email para contato e informações de entrega</p>
                    <x-mary-input id="email" label="E-mail" wire:model.debounce.500ms="email" icon="o-envelope" />
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- First Name & Last Name Row -->
                <div>
                    <x-mary-input id="first_name" label="Nome" wire:model.debounce.500ms="first_name" icon="o-user" />
                    @error('first_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-mary-input id="last_name" label="Sobrenome" wire:model.debounce.500ms="last_name" icon="o-user" />
                    @error('last_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Address & City Row -->
                <div>
                    <x-mary-input id="address" label="Endereço" wire:model.debounce.500ms="address" icon="o-map-pin" />
                    @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-mary-input id="city" label="Cidade" wire:model.debounce.500ms="city" icon="o-map-pin" />
                    @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- State & CEP Row -->
                <div>
                    <x-mary-select label="Estados do Brasil" :options="$brazilStates" wire:model="selectedState" />
                    @error('selectedState') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-mary-input id="cep" label="CEP" wire:model.debounce.500ms="zipcode" icon="o-map-pin" />
                    @error('zipcode') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Full-width Phone & Submit Button Row -->
                <div class="md:col-span-2">
                    <x-mary-input id="phone" label="Telefone" wire:model.debounce.500ms="phone" prefix="+55" />
                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <x-mary-button label="Registrar cliente" class="btn-warning mt-5" type="submit" spinner="save6" />
                </div>
            </div>
        </form>
    @endif
</div>




