@props(['vehicle' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded-lg overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $vehicle->banner ? asset('storage/' . $vehicle->banner) : asset('storage/img/rental_lombok_icon.svg') }}"
        alt="{{ $vehicle->title ?? 'vehicle banner' }}" class="object-contain object-center w-full bg-gray-100">

    {{-- <x-badge-cat-corner :route="'category-vehicles'" :cat="$vehicle->vehiclecat" /> --}}

    <div class="p-4 flex flex-col grow bg-white">
        <div class="grow mb-2 text-center">
            <a href="{{ route('vehicles.show', $vehicle) }}" class="card-title">
                <h3 class="first-letter:capitalize">
                    {{ Str::words($vehicle->brand_name, 3, '...') }}
                </h3>
            </a>

            <div
                class="capitalize mx-auto border w-fit mb-2 border-blue-500 leading-none px-1 py-[0.15rem] rounded-sm text-blue-900 text-[0.75rem] font-light">
                {{ $vehicle->vehiclecat->name ?? 'halo' }}
            </div>

            <p class="text-lg grow font-semibold mb-2">
                Rp{{ number_format($vehicle->rental_price, 0, ',', '.') }}</p>
        </div>
        <div class="flex justify-center items-center flex-col gap-4">
            <a href="{{ config('common.links.whatsapp.url') }}" class="btn w-fit">
                <x-fab-whatsapp />
                {{ __('common.common.order') }}</a>
            <a href="{{ route('vehicles.show', $vehicle) }}" class="text-orange-500 hover:underline">Detail</a>
        </div>
    </div>

    {{ $slot }}
</div>
