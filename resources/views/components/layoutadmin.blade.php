<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}"> --}}
    <title>Rental Lombok Dashboard</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/rental_lombok_icon.svg') }}">

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
    <header class="h-16 border-b border-gray-300 sticky top-0 bg-white z-50">
        <div class="container h-full">
            <div class="flex h-full items-center gap-2">
                <div x-data="{ open: false }" class="flex">
                    <button x-on:click="open = !open" :class="open ? 'rotate-180' : ''"
                        class="text-gray-400 transition-all cursor-pointer">
                        <x-heroicon-s-bars-3 x-show="!open" class="size-8" />
                        <x-heroicon-s-x-mark x-show="open" class="size-8" />
                    </button>
                    <div x-on:click="open = false" :class="open ? 'visible opacity-100' : 'invisible opacity-0'"
                        class="fixed inset-0 z-50 bg-black/50 transition-all duration-300">
                        <div x-on:click="e => e.stopPropagation()" :class="open ? 'translate-x-0' : '-translate-x-full'"
                            class="max-w-72 h-full bg-white transition-all duration-200 p-8">
                            <x-logo />
                            <nav class="flex flex-col">
                                @foreach (config('common.dashboard-menu') as $menu)
                                    <a href="{{ $menu['url'] }}"
                                        class="{{ request()->is(trim($menu['url'], '/')) ? 'text-orange-500' : '' }} text-gray-600 hover:text-orange-500 border-b border-gray-500 transition py-3">{{ $menu['label'] }}</a>
                                @endforeach
                            </nav>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn !py-2 w-full mt-8">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <x-logo />

            </div>
        </div>
    </header>
    {{-- main --}}
    <main class="grow container">{{ $slot }}</main>
    {{-- footer --}}
    <footer class="border-t border-gray-300">
        <div class="container">
            <p class="text-sm py-4">Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}"
                    class="text-orange-500 hover:underline">RentalLombok</a></p>
        </div>
    </footer>
</body>

</html>
