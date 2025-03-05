<x-layoutadmin>
    <div class="py-4">
        <h2 class="title">Update Blog</h2>

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blogs.update', $blog) }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- blog title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $blog->title }}"
                    class="input @error('title') !ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog cat --}}
            <div class="mb-4">
                <label for="blogcat_id">Category</label>
                <a href="{{ route('blogcats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select class="input @error('blogcat_id') !ring-red-500 @enderror" name="blogcat_id" id="blogcat_id">
                    <option value="1">-- Select Category</option>
                    @foreach ($blogcats as $blogcat)
                        <option value="{{ $blogcat->id }}" {{ $blog->blogcat_id == $blogcat->id ? 'selected' : '' }}>
                            {{ $blogcat->name }}</option>
                    @endforeach
                </select>
                @error('blogcat_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog content --}}
            <div class="mb-4">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"
                    class="input @error('content') !ring-red-500 @enderror">{{ $blog->content }}</textarea>
                @error('content')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#content'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            {{-- banner --}}
            @if ($blog->banner)
                <label>Current banner</label>
                <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                    <img id="current-image" src="{{ asset('storage/' . $blog->banner) }}"
                        alt="{{ $blog->title ?? 'News Image' }}" width="400" height="400"
                        class="w-full h-full object-cover origin-center">
                </figure>

                {{-- Checkbox untuk menghapus gambar --}}
                <div class="mb-3">
                    <input type="checkbox" name="delete_banner" id="delete_banner" value="1">
                    <label for="delete_banner" class="text-red-500">Delete current image</label>
                </div>
            @endif

            {{-- blog banner --}}
            <div class="mb-3">
                <label for="banner">Banner</label>
                <input type="file" name="banner" id="banner"
                    class="input @error('banner') !ring-red-500 @enderror" onchange="previewImage(event)">
                @error('banner')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div id="preview-container" class="mt-2 hidden">
                    <img id="image-preview" src="" class="w-40 h-auto rounded shadow-md">
                    <button type="button" id="remove-image"
                        class="text-red-500 hover:underline text-sm mt-1">Remove</button>
                </div>
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Save</button>

            <script>
                function previewImage(event) {
                    const input = event.target;
                    const previewContainer = document.getElementById('preview-container');
                    const previewImage = document.getElementById('preview-image');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewContainer.classList.remove('hidden');
                            previewImage.src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const fileInput = document.getElementById("banner");
                    const previewContainer = document.getElementById("preview-container");
                    const imagePreview = document.getElementById("image-preview");
                    const removeButton = document.getElementById("remove-image");

                    fileInput.addEventListener("change", function() {
                        const file = this.files[0];

                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                imagePreview.src = e.target.result;
                                previewContainer.classList.remove("hidden");
                            };

                            reader.readAsDataURL(file);
                        }
                    });

                    removeButton.addEventListener("click", function() {
                        fileInput.value = ""; // Reset file input
                        imagePreview.src = "";
                        previewContainer.classList.add("hidden");
                    });
                });
            </script>
        </form>
    </div>
</x-layoutadmin>
