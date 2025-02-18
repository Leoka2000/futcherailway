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
  @php
  $brazilStates = [
  [
  'id' => 1,
  'name' => 'Acre',
  'abbreviation' => 'AC'
  ],
  [
  'id' => 2,
  'name' => 'Alagoas',
  'abbreviation' => 'AL'
  ],
  [
  'id' => 3,
  'name' => 'Amapá',
  'abbreviation' => 'AP'
  ],
  [
  'id' => 4,
  'name' => 'Amazonas',
  'abbreviation' => 'AM'
  ],
  [
  'id' => 5,
  'name' => 'Bahia',
  'abbreviation' => 'BA'
  ],
  [
  'id' => 6,
  'name' => 'Ceará',
  'abbreviation' => 'CE'
  ],
  [
  'id' => 7,
  'name' => 'Distrito Federal',
  'abbreviation' => 'DF'
  ],
  [
  'id' => 8,
  'name' => 'Espírito Santo',
  'abbreviation' => 'ES'
  ],
  [
  'id' => 9,
  'name' => 'Goiás',
  'abbreviation' => 'GO'
  ],
  [
  'id' => 10,
  'name' => 'Maranhão',
  'abbreviation' => 'MA'
  ],
  [
  'id' => 11,
  'name' => 'Mato Grosso',
  'abbreviation' => 'MT'
  ],
  [
  'id' => 12,
  'name' => 'Mato Grosso do Sul',
  'abbreviation' => 'MS'
  ],
  [
  'id' => 13,
  'name' => 'Minas Gerais',
  'abbreviation' => 'MG'
  ],
  [
  'id' => 14,
  'name' => 'Pará',
  'abbreviation' => 'PA'
  ],
  [
  'id' => 15,
  'name' => 'Paraíba',
  'abbreviation' => 'PB'
  ],
  [
  'id' => 16,
  'name' => 'Paraná',
  'abbreviation' => 'PR'
  ],
  [
  'id' => 17,
  'name' => 'Pernambuco',
  'abbreviation' => 'PE'
  ],
  [
  'id' => 18,
  'name' => 'Piauí',
  'abbreviation' => 'PI'
  ],
  [
  'id' => 19,
  'name' => 'Rio de Janeiro',
  'abbreviation' => 'RJ'
  ],
  [
  'id' => 20,
  'name' => 'Rio Grande do Norte',
  'abbreviation' => 'RN'
  ],
  [
  'id' => 21,
  'name' => 'Rio Grande do Sul',
  'abbreviation' => 'RS'
  ],
  [
  'id' => 22,
  'name' => 'Rondônia',
  'abbreviation' => 'RO'
  ],
  [
  'id' => 23,
  'name' => 'Roraima',
  'abbreviation' => 'RR'
  ],
  [
  'id' => 24,
  'name' => 'Santa Catarina',
  'abbreviation' => 'SC'
  ],
  [
  'id' => 25,
  'name' => 'São Paulo',
  'abbreviation' => 'SP'
  ],
  [
  'id' => 26,
  'name' => 'Sergipe',
  'abbreviation' => 'SE'
  ],
  [
  'id' => 27,
  'name' => 'Tocantins',
  'abbreviation' => 'TO'
  ]
  ];
  @endphp

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
                    <input type="text" id="counter-input-{{ $item->id }}" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{ $item->quantity }}" required />
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
            }, 500);
        ">
                        <span x-show="!loading">
                          <x-mary-button icon="o-plus" class="btn-circle text-green-500 dark:green-400 btn-sm" />
                        </span>
                        <span x-show="loading">
                          <x-mary-button class="btn-circle relative text-green-500 dark:green-400 btn-sm"><x-mary-loading class="dark:text-gray-500 text-gray-500" /> </x-mary-button>
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
                    <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                      <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                      </svg>
                      Add to Favorites
                    </button>


                    <form action="{{ route('cart.remove', ['productId' => $item->product_id]) }}" method="POST" x-data="{ loading: false }">
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
            }, 500);
        "> <span x-show="!loading">
                          <x-mary-button type="submit" icon="o-trash" class="btn-sm btn-circle  text-red-500 dark:red-400 inline-flex  ">
                          </x-mary-button>
                        </span>
                        <span x-show="loading">
                          <x-mary-button type="submit" class="btn-sm btn-circle  text-red-500 dark:red-400 inline-flex ">
                            <x-mary-loading class="dark:text-gray-600 text-gray-700" />
                          </x-mary-button>
                        </span>
                      </a>
                    </form>

                  </div>
                </div>
              </div>
            </div>

            @empty
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
              <p class="text-center text-gray-900 dark:text-white">Your cart is empty.</p>
            </div>
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
                <dd class="text-base font-bold text-gray-900 dark:text-white">${{number_format($totalPrice, 2) }}</dd>
              </dl>
            </div>

            <a href="#" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Checkout</a>

            <div class="flex items-center justify-center gap-2">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
              <a href="#" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
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