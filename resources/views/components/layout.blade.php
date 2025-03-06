@props(['title' => __('common.meta.home.title'), 'description' => __('common.meta.home.description')])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/favicon.ico') }}">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    {{-- header --}}
    <header class="bg-white h-18 z-50 sticky top-0 w-full shadow-md">
        <div class="container">
            <div class="h-full flex items-center justify-between">
                <x-logo />
                {{-- desktop nav --}}
                <div class="hidden lg:flex items-center w-full justify-end gap-6">

                    <nav class="flex">
                        @foreach (__('common.menu') as $menu)
                            <a href="{{ $menu['url'] }}"
                                class="px-3 transition font-bold {{ request()->is(trim($menu['url'], '/')) ? 'text-blue-800' : 'text-gray-700 hover:text-blue-800' }}">
                                {{ $menu['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <x-socials />
                </div>

                {{-- lang --}}
                <div x-data="{ openLang: false }" class="w-full lg:w-auto flex justify-end lg:w-auto mr-2 lg:mr-0">
                    <div class="group relative font-semibold ml-4 lg:ml-6">
                        <button x-on:click="openLang = !openLang" type="button"
                            class="flex items-center gap-1 text-gray-700">
                            <span>{{ session('locale') === 'en' ? 'EN' : 'ID' }}</span>
                            <x-heroicon-s-chevron-down class="size-4 group-hover:rotate-180 transition-all" />
                        </button>
                        <div x-cloak x-on:click.outside="openLang = false" x-show="openLang"
                            class="absolute left-0 top-full w-full border border-gray-300 bg-white p-2 space-y-2">
                            @if (session('locale') == 'id')
                                <a href="{{ route('locale', 'en') }}" class="hover:text-blue-800">EN</a>
                            @else
                                <a href="{{ route('locale', 'id') }}" class="hover:text-blue-800">ID</a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- mobile nav --}}
                <div x-cloak x-data="{ open: false }" class="flex lg:hidden">
                    <button x-on:click="open = !open" :class="open ? 'rotate-180' : ''"
                        class="text-gray-700 transition-all cursor-pointer">
                        <x-heroicon-s-bars-3 x-show="!open" class="size-8" />
                        <x-heroicon-s-x-mark x-show="open" class="size-8" />
                    </button>
                    <div x-on:click="open = false" :class="open ? 'visible opacity-100' : 'invisible opacity-0'"
                        class="fixed inset-0 z-50 bg-black/50 transition-all duration-300">
                        <div x-on:click="e => e.stopPropagation()" :class="open ? 'translate-x-0' : '-translate-x-full'"
                            class="max-w-72 h-full bg-white transition-all duration-200 p-8">
                            <x-logo />
                            <div class="border-l-2 border-blue-800 my-8 pl-4">
                                <x-socials />
                            </div>
                            <nav class="flex flex-col">
                                @foreach (__('common.menu') as $menu)
                                    <a href="{{ $menu['url'] }}"
                                        class="{{ request()->is(trim($menu['url'], '/')) ? 'text-blue-800' : '' }} text-gray-600 hover:text-blue-800 border-b border-gray-500 transition py-3">{{ $menu['label'] }}</a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header>

    {{-- main --}}
    <main class="grow">{{ $slot }}</main>

    <div class="fixed bottom-4 lg:bottom-8 right-4 lg:right-8 !z-50">
        <a href="{{ config('common.links.whatsapp.url') }}" class="text-green-600">
            <x-fab-square-whatsapp class="size-14" />
        </a>
    </div>

    {{-- footer --}}
    <footer class="border-t border-gray-300">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pt-12 pb-6">
                <div class="space-y-4">
                    <div class="w-fit">
                        <x-logo />
                    </div>
                    <address>
                        {{ config('common.address') }}
                    </address>
                </div>
                <div>
                    <h3 class="footer-title">{{ __('common.footer.links.name') }}</h3>
                    <nav class="flex flex-col">
                        @foreach (__('common.menu') as $menu)
                            <a href="{{ $menu['url'] }}"
                                class="text-gray-600 hover:text-blue-800 transition w-fit py-1">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <h3 class="footer-title">{{ __('common.footer.other-links.name') }}</h3>
                    <nav class="flex flex-col">
                        @foreach (__('common.footer.other-links.menu') as $menu)
                            <a href="{{ $menu['url'] }}"
                                class="text-gray-600 hover:text-blue-800 transition w-fit py-1">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <h3 class="footer-title">{{ __('common.common.contact-us') }}</h3>
                    <nav>
                        <a href="{{ config('common.links.whatsapp.url') }}"
                            class="py-1 flex items-center gap-2 text-gray-600 hover:text-blue-800 transition">
                            <x-fab-square-whatsapp />
                            <span>{{ config('common.links.whatsapp.label') }}</span>
                        </a>
                        <a href="{{ config('common.links.instagram.url') }}"
                            class="py-1 flex items-center gap-2 text-gray-600 hover:text-blue-800 transition">
                            <x-fab-square-instagram />
                            <span>{{ config('common.links.instagram.label') }}</span>
                        </a>
                        <a href="{{ config('common.links.facebook.url') }}"
                            class="py-1 flex items-center gap-2 text-gray-600 hover:text-blue-800 transition">
                            <x-fab-facebook />
                            <span>{{ config('common.links.facebook.label') }}</span>
                        </a>
                    </nav>
                </div>
            </div>
            <hr class="text-gray-300" />
            <p class="text-sm py-4">Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}"
                    class="text-blue-800 hover:underline">RentalLombok</a></p>
        </div>
    </footer>
</body>

</html>
