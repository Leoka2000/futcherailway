<section class="py-20 relative isolate overflow-x-hidden overflow-y-hidden bg-white dark:bg-inherit md:px-0">
  
   
    <h3 class="text-2xl mb-10 mx-4 font-bold text-left text-gray-700 dark:text-gray-200 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center flex items-center gap-2">
      Edição Retrô 
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
            @php
            $imageArray = is_string($product->image) ? json_decode($product->image, true) : $product->image;
            // Ensure $imageArray is an array before accessing index 0
            $firstImage = !empty($imageArray) && is_array($imageArray) ? $imageArray[0] : 'default.jpg';
            @endphp

<div class="w-full h-auto rounded-md relative">
  <img 
      data-src="{{ asset('storage/' . ($firstImage ?? 'default.jpg')) }}" 
      alt="{{ $product->name }}" 
      class="h-72 w-full rounded-md opacity-0 transition-opacity duration-300"
      loading="lazy"
      id="lazyImage-{{ $product->id }}"
  />

  <!-- Placeholder -->
  <div 
      class="absolute top-0 left-0 w-full h-full flex justify-center items-center rounded-t-md bg-white dark:bg-gray-800 transition-opacity duration-300"
      id="placeholder-{{ $product->id }}"
  >
      <span class="loader">
          <div role="status" class="flex items-center flex-col h-56  w-56 sm:h-72 md:w-56 sm:w-72 justify-center bg-gray-300 rounded-lg sm:rounded-t-lg animate-pulse dark:bg-gray-700">
              <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                  <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                  <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z"/>
              </svg>
              <small class="text-gray-500 dark:text-gray-600">Imagem carregando...</small>
              <span class="sr-only">Loading...</span>
          </div>    
      </span>
  </div>
</div>
              <!-- Card Content -->
              <div class="flex flex-col flex-grow p-5">
                  <!-- Product Name -->
                  <a href="#">
                      <h5 class="text-base font-bold tracking-tight text-gray-900 dark:text-white"> {{ Str::words($product->name,20, '...') }}</h5>
                  </a>
  
                  <!-- Product Description -->
                  <p class="text-sm text-gray-700 dark:text-gray-400 mb-3 line-clamp-2">
                    {{ Str::words(strip_tags($product->description), 2, '...') }}
                </p>
                  <!-- Price -->
                  <div class="mb-1 gap-1">
                    <p class="text-sm  font-semibold dark:text-green-600 text-green-500">R$ {{$product->price}} <span class="text-sm mt-1 dark:text-gray-600 text-gray-400"><del>R$ 159.99</del></span></p>
                  </div>
  
                  <!-- Installment -->
                  <div class="flex items-center text-sm mb-2 gap-1">
                      <p class="text-sm">Ou <strong >12x</strong> de <span class="dark:text-green-600 text-green-500 font-semibold">R$ 15,24</span></p>
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
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            const img = document.getElementById("lazyImage-{{ $product->id }}");
            const placeholder = document.getElementById("placeholder-{{ $product->id }}");
    
            setTimeout(function() {
                // Assign the real image source after the 2-second delay
                img.src = img.getAttribute('data-src');
    
                img.onload = function () {
                    img.classList.add("opacity-100"); // Make image visible
                    placeholder.style.opacity = "0"; // Fade out placeholder
                    setTimeout(() => {
                        placeholder.style.display = "none"; // Hide it completely
                    }, 300);
                };
            }, 2000); // Artificial delay before loading
        });
    </script>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</section>