<x-layoutadmin>
    <div class="container py-4">
        <h2 class="title">Vehicle Category List</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        @if (session('error'))
            <x-flash-msg msg="{{ session('delete') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Add Vehicle Category</h3>
            <form action="{{ route('vehiclecats.store') }}" method="POST" class="">
                @csrf

                <div class="mb-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="input @error('name') !ring-red-500 @enderror">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Create</button>
            </form>
        </div>
        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Vehicle List ({{ $vehiclecats->count() }})</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                @foreach ($vehiclecats as $vehiclecat)
                    <div class="py-2" x-data="{ ubah: false }">
                        <p x-show="!ubah">{{ $vehiclecat->name }}</p>
                        <form x-show="ubah" action="{{ route('vehiclecats.update', $vehiclecat) }}" method="POST"
                            class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" id="name" value="{{ $vehiclecat->name }}"
                                autofocus x-ref="inputUbah" class="w-32" />
                            <button type="submit"
                                class="text-xs bg-green-500 text-white rounded-lg px-2 py-1">simpan</button>
                        </form>
                        <div class="text-xs flex gap-2">
                            <button class="text-green-500"
                                @click="ubah = !ubah; if (ubah) $nextTick(() => $refs.inputUbah.focus())"
                                x-text="ubah ? 'kembali' : 'ubah'"></button> |
                            <form action="{{ route('vehiclecats.destroy', $vehiclecat) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin?')"
                                    class="text-red-500 hover:underline">hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layoutadmin>
