<x-layoutadmin>
    <div class="py-4">

        <div class="mb-6">
            <h2 class="title">{{ __('common.home.vehicle-rental.title') }}</h2>
            <p class="description">{{ __('common.home.vehicle-rental.description') }}</p>
        </div>
        <form class="border border-gray-500 max-w-lg mx-auto flex rounded-lg overflow-hidden">
            <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                placeholder="{{ __('common.common.search') }}..."
                class="py-2 px-4 w-full focus:outline-orange-500 rounded-l-lg">
            <button type="submit" class="">
                <x-heroicon-o-magnifying-glass class="size-7 text-gray-500 w-10" />
            </button>
        </form>

        <a href="{{ route('vehicles.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add new</a>

        {{-- Session Messages --}}
        @if (session('delete'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($vehicles as $vehicle)
                    <x-vehicle-card :vehicle="$vehicle">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                            {{-- update vehicle --}}
                            <a href="{{ route('vehicles.edit', $vehicle) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete vehicle --}}
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-vehicle-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $vehicles->links() }}
            </div>
        </div>

    </div>
</x-layoutadmin>
