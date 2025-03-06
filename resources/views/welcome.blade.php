<x-layout>
    <section id="hero" class="h-screen">
        {{-- <img src="{{ asset('storage/img/rentallombok_hero2.jpg') }}" alt="rental lombok hero image"
            class="z-10 absolute object-center object-cover w-full h-full"> --}}
        <img src="{{ asset('storage/img/rentallombok_hero2_small.jpg') }}"
            data-src="{{ asset('storage/img/rentallombok_hero2.jpg') }}" alt="rental lombok hero image"
            class="z-10 absolute object-center object-cover w-full h-full blur-lg transition-all duration-500 ease-in-out"
            onload="if (this.dataset.src && this.src !== this.dataset.src) { 
                this.classList.remove('blur-lg'); 
                this.src = this.dataset.src; 
                this.dataset.src = ''; 
            }">

        <div class="z-20 relative h-screen bg-gradient-to-b from-black/50 to-black/50">
            <div class="container flex items-center">
                <div class="text-center sm:text-left max-w-3xl space-y-8">
                    <h1 class="text-5xl lg:text-7xl font-semibold text-white">{{ __('common.home.hero.title') }}</h1>
                    <p class="text-base lg:text-xl text-white">{{ __('common.home.hero.description') }}</p>
                    <a href="{{ config('common.links.whatsapp.url') }}"
                        class="py-4 px-6 inline-block text-base lg:text-lg rounded-full bg-blue-800 hover:bg-blue-900 transition-all text-white">{{ __('common.common.contact-us') }}
                        :
                        {{ config('common.links.whatsapp.label') }}</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Vehicle Rental --}}
    <section id="vehicle-rental" class="py-12">
        <div class="container">
            <div class="mb-8">
                <h2 class="title">{{ __('common.home.vehicle-rental.title') }}</h2>
                <p class="description">{{ __('common.home.vehicle-rental.description') }}</p>
            </div>
            <div>
                <div class="swiper my-4">
                    <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
                        <div class="card-list swiper-wrapper">
                            @foreach ($vehicles as $vehicle)
                                <div class="swiper-slide">
                                    <x-vehicle-card :vehicle="$vehicle" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>

                        <div class="swiper-slide-button swiper-button-prev">
                            {{-- <x-bi-arrow-left-circle /> --}}
                        </div>
                        <div class="swiper-slide-button swiper-button-next">
                            {{-- <x-bi-arrow-right-circle /> --}}
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('blog') }}"
                        class="py-3 px-6 w-fit rounded-full border-2 border-blue-800 text-blue-800 text-lg font-semibold hover:text-blue-900 hover:border-blue-900 transition-all">{{ __('common.common.view-all') }}</a>
                </div>
                <script>
                    new Swiper(".card-wrapper", {
                        // loop: true,
                        spaceBetween: 16,

                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                            dynamicBullets: true,
                        },

                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        breakpoints: {
                            0: {
                                slidesPerView: 1,
                            },
                            768: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 4,
                            },
                        },
                    })
                </script>
            </div>
        </div>
    </section>
    {{-- Why --}}
    {{-- <section id="why" class="py-12">
        <div class="container">
            <h2>Mengapa Rental Lombok</h2>
        </div>
    </section> --}}
    {{-- Contact --}}
    <section id="contact" class="py-12 bg-blue-800 text-white">
        <div class="container">
            {{-- <h2 class="title">Contact</h2> --}}
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <p class="text-center lg:text-left max-w-xl text-2xl">{{ __('common.home.contact.description') }}</p>
                <a href="{{ config('common.links.whatsapp.url') }}"
                    class="py-4 px-6 border-2 inline-block text-lg rounded-full bg-white transition-all text-blue-500 font-semibold hover:text-blue-800">{{ __('common.common.contact-us') }}</a>
            </div>
        </div>
    </section>
    <section id="blog" class="py-12">
        <div class="container">
            <div class="mb-8">
                <h2 class="title">{{ __('common.home.blog.title') }}</h2>
                <p class="description">{{ __('common.home.blog.description') }}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($blogs as $item)
                    <div class="flex flex-col">
                        <img src="{{ $item->banner ? asset('storage/' . $item->banner) : asset('storage/img/rental_lombok_icon.svg') }}"
                            alt="{{ $item->title }}"
                            class="{{ $item->banner ? 'object-cover' : 'object-contain scale-90' }} h-56 w-full z-40 rounded-lg mb-2">
                        <a href="{{ route('blogs.show', $item->slug) }}" class="grow hover:underline">
                            <h3 class="text-gray-700 my-2 font-semibold text-lg w-fit first-letter:capitalize">
                                {{ Str::limit($item->title, 75) }}</h3>
                        </a>
                        {{-- <a href="{{ route('blogs.show', $item->slug) }}" class="btn !w-fit mt-2">Selengkapnya</a> --}}
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-4">
                <a href="{{ route('blog') }}"
                    class="py-3 px-6 w-fit rounded-full border-2 border-blue-800 text-blue-800 text-lg font-semibold hover:text-blue-900 hover:border-blue-900 transition-all">{{ __('common.common.view-all') }}</a>
            </div>
        </div>
    </section>
</x-layout>
