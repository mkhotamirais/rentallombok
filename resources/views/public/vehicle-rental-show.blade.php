<x-layout :title="__('common.meta.vehicle-rental-show.title.0') .
    $vehicle->brand_name .
    __('common.meta.vehicle-rental-show.title.1')" :description="__('common.meta.vehicle-rental-show.description.0') .
    $vehicle->brand_name .
    __('common.meta.vehicle-rental-show.description.1')">
    <section class="lg:max-w-6xl lg:mx-auto px-0 sm:px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 min-h-[20vh]">
            <div class="h-auto">
                <img src="{{ $vehicle->banner ? asset('storage/' . $vehicle->banner) : asset('storage/svg/panorama_icon.svg') }}"
                    alt="{{ $vehicle->title ?? 'vehicle banner' }}"
                    class="object-contain object-top w-full h-full rrounded-none sm:rounded-lg" />
            </div>

            <div class="flex flex-col px-4 space-y-6 leading-relaxed">
                {{-- title --}}
                <div class="">
                    <h2 class="text-2xl font-medium capitalize mb-2">{{ $vehicle->brand_name }}</h2>
                    <p class="text-2xl mb-4 font-semibold">Rp{{ number_format($vehicle->rental_price, 0, ',', '.') }}
                    </p>

                    <p class="border-l-2 pl-2 border-orange-500 capitalize">
                        {{ $vehicle->vehiclecat->name }}</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('common.common.policy') }}
                        <i class="font-bold first-letter:capitalize">{{ $vehicle->vehiclecat->name }}</i>
                    </h3>
                    <div class="text-content">{!! $vehicle->policy !!}</div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">{{ __('common.common.information') }}</h3>
                    <div class="text-content">{!! $vehicle->information !!}</div>
                </div>
                <a href="{{ config('common.links.whatsapp.url') }}" class="btn w-fit">
                    <x-fab-whatsapp />
                    {{ __('common.common.order') }}</a>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="flex justify-between items-center py-2 mt-4 mb-2">
            <h2 class="text-2xl font-semibold">{{ __('common.common.others') }}</h2>
            <a href="{{ route('vehicle-rental') }}" class="text-blue-800 hover:text-blue-900 transition-all">
                <x-heroicon-c-arrow-right class="size-7" />
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4 mb-8">
            @foreach ($otherVehicles as $vehicle)
                <x-vehicle-card :vehicle="$vehicle"></x-vehicle-card>
            @endforeach
        </div>
    </section>
</x-layout>
