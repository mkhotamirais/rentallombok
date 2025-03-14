@props(['blogs' => [], 'bg' => 'bg-white'])

<section id="blog" class="py-12 {{ $bg }}">
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
