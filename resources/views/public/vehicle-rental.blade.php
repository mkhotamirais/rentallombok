<x-layout :title="__('common.meta.vehicle-rental.title')" :description="__('common.meta.vehicle-rental.description')">
    <section class="container pt-12">
        <div class="mb-6">
            <h2 class="title">{{ __('common.home.vehicle-rental.title') }}</h2>
            <p class="description">{{ __('common.home.vehicle-rental.description') }}</p>
        </div>
        <form class="border border-gray-500 max-w-lg mx-auto flex rounded-lg overflow-hidden">
            <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                placeholder="{{ __('common.common.search') }}..."
                class="py-2 px-4 w-full focus:outline-blue-500 rounded-l-lg">
            <button type="submit" class="">
                <x-heroicon-o-magnifying-glass class="size-7 text-gray-500 w-10" />
            </button>
        </form>
    </section>
    @if ($search)
        <div class="container py-4">
            <p class="text-xl text-center">
                {{ __('common.common.search-result') }} <span
                    class="text-blue-800 font-semibold italic">"{{ $search }}"</span>
                ( {{ $vehicles->total() }} )
            </p>
        </div>
    @endif
    <section class="py-12">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($vehicles as $vehicle)
                    <x-vehicle-card :vehicle="$vehicle"></x-vehicle-card>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $vehicles->links() }}
            </div>
        </div>
    </section>
</x-layout>
