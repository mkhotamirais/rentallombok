<x-layout :title="__('common.meta.blogs.title')" :description="__('common.meta.blogs.description')">
    <section class="container mt-24">
        <div class="mb-6">
            <h2 class="title">{{ __('common.home.blog.title') }}</h2>
            <p class="description">{{ __('common.home.blog.description') }}</p>
        </div>
        <form class="border border-gray-500 max-w-lg mx-auto flex rounded-lg overflow-hidden">
            <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                placeholder="{{ __('common.common.search') }}..."
                class="py-2 px-4 w-full focus:outline-orange-500 rounded-l-lg">
            <button type="submit" class="">
                <x-heroicon-o-magnifying-glass class="size-7 text-gray-500 w-10" />
            </button>
        </form>
    </section>
    @if ($search)
        <div class="container py-4">
            <p class="text-xl text-center">
                {{ __('common.common.search-result') }} <span
                    class="text-orange-500 font-semibold italic">"{{ $search }}"</span>
                ( {{ $blogs->total() }} )
            </p>
        </div>
    @endif
    <section class="py-12">
        <div class="container">
            <article class="grid grid-cols-1 gap-8 max-w-3xl mx-auto">
                @foreach ($blogs as $item)
                    <x-blog-card :item="$item"></x-blog-card>
                @endforeach
            </article>
            <div class="max-w-3xl mx-auto mt-8">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
</x-layout>
