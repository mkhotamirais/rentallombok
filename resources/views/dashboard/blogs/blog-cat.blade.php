<x-layoutadmin>
    <div class="py-4">
        <h1 class="title">Blog Category</h1>

        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        @if (session('error'))
            <x-flash-msg msg="{{ session('error') }}" bg="bg-red-500"></x-flash-msg>
        @endif

        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Add Category</h3>
            <form action="{{ route('blogcats.store') }}" method="POST" class="max-w-xl">
                @csrf

                <div class="mb-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="input @error('name') !ring-red-500 @enderror">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn">Create</button>
            </form>
        </div>
        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Blog Category List ({{ $blogCats->count() }})</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                @foreach ($blogCats as $blogCat)
                    <div class="py-2" x-data="{ ubah: false }">
                        <p x-show="!ubah">{{ $blogCat->name }}</p>
                        <form x-show="ubah" action="{{ route('blogcats.update', $blogCat) }}" method="POST"
                            class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" id="name" value="{{ $blogCat->name }}" autofocus
                                x-ref="inputUbah" class="w-32" />
                            <button type="submit"
                                class="text-xs bg-green-500 text-white rounded-lg px-2 py-1">simpan</button>
                        </form>
                        <div class="text-xs flex gap-2">
                            <button class="text-green-500"
                                @click="ubah = !ubah; if (ubah) $nextTick(() => $refs.inputUbah.focus())"
                                x-text="ubah ? 'kembali' : 'ubah'"></button> |
                            <form action="{{ route('blogcats.destroy', $blogCat) }}" method="POST">
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
