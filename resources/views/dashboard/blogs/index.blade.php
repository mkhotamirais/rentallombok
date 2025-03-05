<x-layoutadmin>
    <div class="py-4">
        <div class="mb-8">
            <h2 class="title">{{ __('common.home.blog.title') }}</h2>
            <p class="description">{{ __('common.home.blog.description') }}</p>
        </div>

        <a href="{{ route('blogs.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add New
            Blog</a>

        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 gap-2 lg:gap-4">
                @foreach ($blogs as $blog)
                    <x-blog-card :item="$blog">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2">
                            {{-- update blog --}}
                            <a href="{{ route('blogs.edit', $blog) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete blog --}}
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-blog-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-layoutadmin>
