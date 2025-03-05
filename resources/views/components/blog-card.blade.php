@props(['item' => []])

<div class="rounded overflow-hidden sm:flex sm:flex-row sm:gap-6 max-w-3xl">
    <img src="{{ $item->banner ? asset('storage/' . $item->banner) : asset('storage/img/rental_lombok_icon.svg') }}"
        alt="{{ $item->title }}" loading="lazy"
        class="{{ $item->banner ? 'object-cover' : 'object-contain scale-90' }} h-56 sm:h-full w-full sm:w-56 z-40">

    <article class="w-full">
        <a href="{{ route('blogs.show', $item->slug) }}" class="hover:underline">
            <h3 class="text-lg font-semibold first-letter:capitalize mt-4 sm:mt-0 !mb-2">
                {{ Str::words($item->title, 15, '...') }}
            </h3>
        </a>

        <p class="mb-2 text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
        <div class="text-gray-700 grow">{!! Str::limit($item->content, 200) !!}</div>
        <a href="{{ route('blogs.show', $item->slug) }}" class="btn mt-4 w-fit">Selengkapnya</a>
        <div class="mt-2">
            {{ $slot }}
        </div>
    </article>
</div>
