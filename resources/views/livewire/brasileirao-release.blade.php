<section class="py-20 relative isolate overflow-x-hidden overflow-y-hidden bg-white dark:bg-inherit md:px-0">


  <h3 class="text-2xl mb-10 mx-4 font-bold text-left text-gray-700 dark:text-gray-200 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center flex items-center gap-2">
    Lançamentos Brasileirão
    <span class="inline-flex items-center mx-1 justify-center rounded-md bg-green-50 dark:bg-green-200 px-3 py-2 text-xs font-medium text-green-700 ring-1 ring-green-600/20 dark:ring-green-500 ring-inset">
      Frete grátis em todo Brasil.
    </span>
  </h3>

  <div class="px-4 mx-auto sm:px-12 xl:px-5">
      <swiper-container
          pagination="true"
          navigation="true"
          loop="true"
          slides-per-view="1"
          space-between="20"
          breakpoints='{
              "480": { "slidesPerView": 1, "spaceBetween": 10 },
              "640": { "slidesPerView": 2, "spaceBetween": 10 },
              "768": { "slidesPerView": 3, "spaceBetween": 15 },
              "1024": { "slidesPerView": 4, "spaceBetween": 20 },
              "1280": { "slidesPerView": 5, "spaceBetween": 20 },
              "1536": { "slidesPerView": 6, "spaceBetween": 20 }
          }'
      >
          @foreach($products as $product)
          <swiper-slide class="mb-10">
              <!-- Card Container -->
              <div class="xl:h-full h-auto flex flex-col bg-white border border-gray-200  rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                  <!-- Image -->
                  <a href="#">
                      <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
                  </a>

                  <!-- Card Content -->
                  <div class="flex flex-col flex-grow p-5">
                      <!-- Product Name -->
                      <a href="#">
                          <h5 class="mb-2 xl:text-base text-sm font-bold tracking-tight text-gray-900 dark:text-white"> {{ Str::words($product->name, 20, '...') }}</h5>
                      </a>

                      <!-- Product Description -->
                      <p class="text-sm text-gray-700 dark:text-gray-400 line-clamp-2">
                        {{ Str::words(strip_tags($product->description), 2, '...') }}
                    </p>
                      <!-- Price -->
                      <div class="mb-1 gap-1">
                          <p class="text-sm font-semibold dark:text-green-600 text-green-500">R$ {{$product->price}} <span class="text-xs mt-1 dark:text-gray-600 text-gray-400"><del>R$ 159.99</del></span></p>
                      </div>

                      <!-- Installment -->
                      <div class="flex items-center text-sm mb-2 gap-1">
                          <p class="text-sm">Ou <strong>12x</strong> de <span class="dark:text-green-600 text-green-500 text-sm font-semibold">R$ 15,24</span></p>
                      </div>

                      <!-- Button -->
                      <a href="{{ route('components.shopping_cart_component_index') }}"
                         class="relative"
                         x-data="{ loading: false }"
                         @click.prevent="
                             loading = true;
                             setTimeout(() => {
                                 window.location.href = $el.getAttribute('href');
                             }, 800); 
                         ">
                         <span x-show="!loading">
                             <x-mary-button icon="o-shopping-bag" label="Ver mais" class="btn-sm w-full lg:btn" />
                         </span>
                         <span x-show="loading">
                             <x-mary-button class="btn-ghost btn-md relative">
                                 <x-mary-loading class="dark:text-gray-500 text-gray-500" />
                             </x-mary-button>
                         </span>
                      </a>
                  </div>
              </div>
          </swiper-slide>
          @endforeach
      </swiper-container>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</section>