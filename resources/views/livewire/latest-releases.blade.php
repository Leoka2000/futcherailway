<section class="py-10 px-2">
  <h3 class="text-2xl mb-10 font-bold text-left text-gray-800 dark:text-gray-100 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center sm:mx-0">
    Últimos Lançamentos
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
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 1"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 2"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 3"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 4"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 5"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 6"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 7"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 8"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 9"></swiper-slide>
      <swiper-slide><img src="{{ asset('sample_camisa.png') }}" alt="Image 10"></swiper-slide>
    </swiper-container>
  </div>

  <style>
    swiper-container {
      width: 100%;
      max-width: 1000px;
      height: auto;
      border-radius: 1rem !important;

    }

    swiper-slide img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 1rem !important;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</section>
