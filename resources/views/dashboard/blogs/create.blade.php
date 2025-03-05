<x-layoutadmin>
    <div class="py-4">
        <h2 class="title">Create New Blog</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf

            {{-- blog title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                    <option value="{{ null }}">-- Select Category</option>
                    @foreach ($blogCategories as $bc)
                        <option value="{{ $bc->id }}">{{ $bc->name }}</option>
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
                    class="input @error('content') !ring-red-500 @enderror">{{ old('content') }}</textarea>
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
            <div class="mb-4">
                <label for="banner">Banner</label>
                <input type="file" name="banner" id="banner"
                    class="input @error('banner') !ring-red-500 @enderror">
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
            <button type="submit" class="btn">Create</button>

            <script>
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
