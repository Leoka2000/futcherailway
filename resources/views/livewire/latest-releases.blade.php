<section class="py-20 relative isolate overflow-x-hidden overflow-y-hidden bg-white dark:bg-inherit md:px-0">
  <div class="absolute top-0 left-1/2 -z-10 -translate-x-1/2 blur-[5rem] xl:-top-6 opacity-70 animate-blur-move" aria-hidden="true">
      <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#facc15] to-[#4ade80]"
          style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
      </div>
  </div>

  <h3 class="text-2xl mb-10 font-bold text-left text-gray-700 dark:text-gray-200 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center sm:mx-0 flex items-center gap-2">
    Últimos Lançamentos   
    <span class="inline-flex items-center mt-2 justify-center rounded-md bg-green-50 dark:bg-green-200 px-3 py-2 text-xs font-medium text-green-700 ring-1 ring-green-600/20 dark:ring-green-500 ring-inset">
      Frete grátis em todo Brasil
    </span>
  </h3>

  <div class="px-4 mx-auto sm:px-12 xl:px-5">
    <swiper-container
      pagination="true"
      navigation="true"
      loop="true"
      slides-per-view="3"
      space-between="20"
      breakpoints='{
        "640": { "slidesPerView": 2, "spaceBetween": 10 },
        "768": { "slidesPerView": 3, "spaceBetween": 15 },
        "1024": { "slidesPerView": 4, "spaceBetween": 20 }
      }'
    >

      @foreach($products as $product)
      <swiper-slide>
        <div class="max-w-sm mb-10 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->description }}</p>
               <a href="{{ route('components.shopping_cart_component_index') }}">
                   <x-mary-button icon="o-shopping-bag" Label="Ver mais" class="btn-sm w-full lg:btn" />
               </a>
            </div>
        </div>
      </swiper-slide>
      @endforeach

    </swiper-container>
  </div>

  <style>
    swiper-container {
      width: 100%;
      max-width: 1600px;
      height: auto;
      border-radius: 1rem !important;
    }

    swiper-slide {
      display: flex;
      justify-content: center;
    }

    swiper-slide div {
      width: 100%;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</section>
