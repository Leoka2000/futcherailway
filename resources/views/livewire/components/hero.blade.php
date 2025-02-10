<x-guest-layout>
    <section class="px-2 py-20 container relative isolate   bg-white dark:bg-inherit md:px-0">
        <div class="absolute top-0 left-1/2 -z-10 -translate-x-1/2 blur-[5rem] xl:-top-6 opacity-70 animate-blur-move" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#facc15] to-[#4ade80]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        
         
        <style>
            @keyframes blurMove {
                0% {
                    transform: translateX(-50%) translateY(0) scale(1);
                    opacity: 0.7;
                }
                50% {
                    transform: translateX(-55%) translateY(-120px) scale(0.6);
                    opacity: 0.5;
                }
                100% {
                    transform: translateX(-50%) translateY(0) scale(1);
                    opacity: 0.7;
                }
            }
            .animate-blur-move {
                animation: blurMove 8s infinite ease-in-out;
            }
        </style>
        <div class="items-center max-w-6xl px-8 mx-auto xl:px-5">

            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1 class="text-4xl font-extrabold tracking-tight dark:text-gray-200 text-gray-800 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                            <div class="flex justify-start items-center gap-4"><span class="block xl:inline">Futchê</span> <img class="h-10 w-10 mt-1 rounded-full" src="{{asset('bandeira.png')}}" /> </div>
                            <span class="block xl:inline"><span class="text-yellow-400">Seja</span><span class="dark:text-green-500 text-green-600"> Bem</span> <span class="dark:text-red-500 text-red-600">Vindo! </span> </span>
                        </h1>
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">It's never been easier to build beautiful websites that convey your message and tell your story.</p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                            <a href="#_" class="flex items-center w-full px-6 py-3 mb-3 text-lg text-gray-900 dark:bg-yellow-400 bg-yellow-500 rounded-md sm:mb-0 hover:bg-indigo-700 sm:w-auto" data-primary="indigo-600" data-rounded="rounded-md">
                                Try It Free
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                            <a href="#_" class="flex items-center px-6 py-3 text-gray-500 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-gray-600" data-rounded="rounded-md">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full overflow-hidden flex justify-center rounded-md shadow-sm sm:rounded-xl" data-rounded="rounded-xl" data-rounded-max="rounded-full">
                        <img class="object-cover w-60" src="{{asset('logobig.png')}}">
                        <img class="object-cover w-60" src="{{asset('cristiano.png')}}">
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>