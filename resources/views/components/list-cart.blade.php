<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link rel="icon" type="image/png" href="{{asset('logo.png')}}">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles
</head>


<body>
 {{-- nao remova este navbar pois o codigo esta muito ruim e por algum motivo que nao tenho tempo e tbm preguica nao alterarei. Apenas o deixe ai --}}
  <x-navbar-cart-list /> 
  
  <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

          <div class="space-y-6">
            @forelse($cartItems as $item)
            @php
            $productImages = is_array($item->product->image) ? $item->product->image : [];
            $firstImage = !empty($productImages) ? $productImages[0] : 'default-image.png'; // Provide a fallback image
            @endphp
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
              <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                <a href="#" class="shrink-0 md:order-1">
                  <img class="h-24 w-24" src="{{ Storage::url($firstImage) }}" alt="{{ $item->product->name }}" />
                </a>
                <label for="counter-input-{{ $item->id }}" class="sr-only">Choose quantity:</label>
                <div class="flex items-center justify-between md:order-3 md:justify-end">
                  <div class="flex items-center">
                    <form action="{{ route('cart.decrease', ['productId' => $item->product_id]) }}" method="POST" x-data="{ loading: false }">
                      @csrf
                      @method('POST')
                      <a
                        type="submit"
                        class=""
                        :disabled="loading"
                        @click.prevent="
            loading = true;
            setTimeout(() => {
                $el.closest('form').submit();
            }, 500);
        ">
                        <span x-show="!loading">
                          <x-mary-button icon="o-minus" class="btn-circle text-red-500 dark:red-400 btn-sm" />
                        </span>
                        <span x-show="loading">
                          <x-mary-button class="btn-circle relative text-green-500 dark:green-400 btn-sm"><x-mary-loading class="dark:text-gray-500 text-gray-500" /> </x-mary-button>
                        </span>
                      </a>
                    </form>
                    <x-mary-input style="width: 50px!important;" readonly type="text" id="counter-input-{{ $item->id }}" data-input-counter class=" btn-sm shrink-0 border-0 bg-transparent mx-2 text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{ $item->quantity }}" />
                    <form action="{{ route('cart.increase', ['productId' => $item->product_id]) }}" method="POST" x-data="{ loading: false }">
                      @csrf
                      @method('POST')
                      <a
                        type="submit"
                        class=""
                        :disabled="loading"
                        @click.prevent="
            loading = true;
            setTimeout(() => {
                $el.closest('form').submit();
            }, 300);
        ">
                        <span x-show="!loading">
                          <x-mary-button icon="o-plus" class="btn-circle text-green-500 dark:green-400 btn-sm" />
                        </span>
                        <span x-show="loading">
                          <x-mary-button class="btn-circle relative text-green-500 dark:green-400 btn-sm"><x-mary-loading class="dark:text-gray-500 text-gray-400" /> </x-mary-button>
                        </span>
                      </a>
                    </form>
                    
                  </div>
                  <div class="text-end md:order-4 md:w-32">
                    <p class="text-base font-bold text-gray-900 dark:text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                  </div>
                </div>

                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                  <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item->product->name }}</a>

                  <div class="flex items-center gap-4">
                    


                    <form action="{{ route('cart.remove', ['productId' => $item->product_id]) }}" method="POST" x-data="{ loading: false }" class=>
                      @csrf
                      @method('DELETE')
                      <a
                        type="submit"
                        class=""
                        :disabled="loading"
                        @click.prevent="
            loading = true;
            setTimeout(() => {
                $el.closest('form').submit();
            }, 300);
        "> <span x-show="!loading">
                          <x-mary-button type="submit" icon="o-trash" class="btn-sm btn-circle  text-red-500 dark:red-400 inline-flex  ">
                          </x-mary-button>
                        </span>
                        <span x-show="loading">
                          <x-mary-button type="submit" class="btn-sm btn-circle relative text-red-500 dark:text-red-400 inline-flex ">
                            <x-mary-loading class="dark:text-gray-500 text-gray-400" />
                          </x-mary-button>
                        </span>
                        
                      </a>
                      
                    </form>
                    <form x-data="{ loading: false }"
                    x-on:submit.prevent="loading = true; setTimeout(() => $el.submit(), 300)"
                    action="{{ route('cart.updateSize', ['productId' => $item->product_id]) }}" 
                    method="POST" 
                    class="w-full">
                  @csrf
                  @method('PUT')   
                  <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                  <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                          <div class="flex items-center ps-3">
                              <input id="size-p-{{ $item->id }}" type="radio" value="P" name="size" class="w-4 h-4 text-yellow-500 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ $item->size == 'P' ? 'checked' : '' }}>
                              <label for="size-p-{{ $item->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">P</label>
                          </div>
                      </li>
                      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                          <div class="flex items-center ps-3">
                              <input id="size-m-{{ $item->id }}" type="radio" value="M" name="size" class="w-4 h-4 text-yellow-500 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ $item->size == 'M' ? 'checked' : '' }}>
                              <label for="size-m-{{ $item->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">M</label>
                          </div>
                      </li>
                      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                          <div class="flex items-center ps-3">
                              <input id="size-g-{{ $item->id }}" type="radio" value="G" name="size" class="w-4 h-4 text-yellow-500 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ $item->size == 'G' ? 'checked' : '' }}>
                              <label for="size-g-{{ $item->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">G</label>
                          </div>
                      </li>
                      <li class="w-full dark:border-gray-600">
                          <div class="flex items-center ps-3">
                              <input id="size-gg-{{ $item->id }}" type="radio" value="GG" name="size" class="w-4 h-4 text-yellow-500 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ $item->size == 'GG' ? 'checked' : '' }}>
                              <label for="size-gg-{{ $item->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">GG</label>
                          </div>
                        
                      </li>
                      <li class="w-28 border-b  sm:border-b-0">
                        <div >
                          <x-mary-button type="submit" 
                          class="btn btn-warning btn-outline relative w-full text-sm" 
                          x-bind:disabled="loading">
            
                      <span x-show="!loading">Salvar</span>
                      <span x-show="loading"><x-mary-loading class="dark:text-gray-500 text-gray-400 absolute top-[11px] left-[5px]"/></span>
                   
                    </x-mary-button>
                        </div>
                    </li>
                     
                    
                  </ul>
              
                  
                       

              
              </form>
                </div>
              </div>
              </div>
            </div>

            @empty
            <div class="rounded-lg border items-center flex flex-col gap-1 border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">

<x-mary-icon name="o-x-mark" class="w-12 h-12 bg-gray-200 text-gray-400 dark:bg-gray-700 darktext-gray-500 p-2 rounded-full" />
              <p class="text-center text-gray-900 dark:text-white">Your cart is empty.</p>

              
            
            @endforelse
          </div>
          <h2 class="text-xl font-semibold mt-6 mb-6 text-gray-900 dark:text-white sm:text-2xl">Informações de entrega</h2>
          @livewire('shopping-cart-form', ['brazilStates' => $brazilStates])

        </div>

        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
          <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

            <div class="space-y-4">
              <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                  <dd class="text-base font-medium text-green-600">-$299.00</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store Pickup</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                </dl>
              </div>

              <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                @php
                $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
                @endphp
                <dd style="border:transparent!important;" class="text-base font-bold text-gray-900 dark:text-white">${{number_format($totalPrice, 2) }}</dd>
              </dl>
            </div>
            <div class="flex-inline  items-center flex space-x-1 xl:gap-2 gap-3 my-1">
              <img src="{{asset('mastercard.svg')}}" alt="MasterCard" class="h-5 border border-gray-200 dark:border-gray-600 shadow-sm rounded-md p-1 px-2">
              <img src="{{asset('visa.png')}}" alt="Visa" class="h-5 p-[4px] border border-gray-200 dark:border-gray-600  shadow-sm rounded-md ">
            </div>
            <a href="{{route('checkout')}}"><x-mary-button icon="o-credit-card" type="submit" spinner="checkout"  class="w-full mt-3"> Checkout with card </x-mary-button></a>
            <div class="flex items-center justify-center gap-2">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
              <a title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700  hover:no-underline dark:text-primary-500">
                Continue with pix
                <img src="{{asset('pix.png')}}" alt="Pix" class="h-7 border border-gray-200 dark:border-gray-600  shadow-sm rounded-md -p-36">
              </a>
            </div>
           
            @auth
            <div x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
     
    <x-mary-button @click="modalOpen=true" class="btn w-full">
      <img src="{{ asset('pix.png') }}"  alt="Pix" class="h-12 shadow-sm rounded-md p-1"> Checkout with Pix
    </x-mary-button>
    @else
    <x-mary-button href="{{ route('login') }}" class="btn w-full">
      <img src="{{ asset('pix.png') }}" alt="Pix" class="h-12 shadow-sm rounded-md p-1"> Login to Checkout
  </x-mary-button> 
@endif
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="modalOpen=false" 
                class="absolute inset-0 w-full h-full bg-white dark:bg-gray-900 backdrop-blur-sm bg-opacity-70 dark:bg-opacity-70"></div>
            <div x-show="modalOpen"
                x-trap.inert.noscroll="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-white dark:bg-gray-800 border shadow-lg px-7 border-neutral-200 dark:border-gray-700 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Valor a ser pago: {{number_format($totalPrice, 2) }} BRL</h3>
                    <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 dark:text-gray-400 rounded-full hover:text-gray-800 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                    </button>
                </div>
                <div class="relative flex flex-col items-center justify-center gap-2 pb-8">
                   <img class="rounded-lg shadow-xl" src="{{asset('piximage.png')}}" />
                   
                   <p class="mt-2 text-gray-800 dark:text-gray-300">Ou use nossa chave pix:<strong>51995271903</strong></p>
                   <p class="mt-2 text-gray-800 dark:text-gray-300">Após o pagamento, clique no botão "Já paguei" e receberás brevemente um email com a confirmação</p>
                </div>
                <div class="flex flex-col-reverse gap-1 sm:flex-row sm:justify-end sm:space-x-2">
                    <x-mary-button @click="modalOpen=false" type="button" class="">Voltar</x-mary-button>
                    <form action="{{ route('markAsPaid') }}" method="POST">
                      @csrf
                      <x-mary-button class="btn btn-success" type="submit">Já paguei</x-mary-button>
                  </form>

                </div>
            </div>
        </div>
    </template>
</div>

      

            <div class="flex items-center justify-center gap-2">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
              <a href="{{route('components.shopping_cart_component_index')}}" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                Continue Shopping
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
              </a>
            </div>
          </div>

          <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <form class="space-y-4">
              <div>
                <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Do you have a voucher or gift card? </label>
                <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-200 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" required />
              </div>
              <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply Code</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
  {{-- TOAST area --}}
  <x-mary-toast />
  @livewireScripts
</body>




</html>