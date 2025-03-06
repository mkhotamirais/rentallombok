<x-layout :title="Str::words($blog->title, 10, '...')" description="{!! Str::words(strip_tags(html_entity_decode($blog->content)), 25, '...') !!}">
    <section class="py-12">
        <div class="container">
            <div class="flex flex-col lg:flex-row gap-14 items-start">
                <div class="">
                    <div class="mb-8 text-center">
                        <h1 class="first-letter:capitalize text-2xl lg:text-4xl font-semibold leading-snug mb-2">
                            {{ $blog->title }}
                        </h1>
                        <p class="text-gray-500">{{ $blog->created_at->diffForHumans() }}</p>
                    </div>
                    <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/logo/logo-nurul-iman-big.png') }}"
                        alt="{{ $blog->title }}"
                        class="{{ $blog->banner ? 'object-cover' : 'object-contain scale-90' }} w-full">
                    <article class="text-content">{!! $blog->content !!}</article>
                </div>
                <div class="w-64 min-w-full md:min-w-80 sticky top-24 my-4">
                    <h2 class="title !mb-6">Berita Lainnya</h2>
                    <div class="space-y-8">
                        @foreach ($latestBlogs as $blog)
                            <div class="grid grid-cols-3 gap-2">
                                <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/logo/logo-nurul-iman-big.png') }}"
                                    alt="{{ $blog->title }}"
                                    class="{{ $blog->banner ? 'object-cover' : 'object-contain scale-90' }} h-full w-full">
                                <div class="col-span-2">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:underline">
                                        <h3 class="first-letter:capitalize !leading-tight !font-light">
                                            {{ Str::limit($blog->title, 50) }}
                                        </h3>
                                    </a>
                                    <p class="text-sm text-gray-500">{{ $blog->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
