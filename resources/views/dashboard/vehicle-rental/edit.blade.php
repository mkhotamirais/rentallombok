<x-layoutadmin>
    <div class="py-4">
        <h2 class="title">Update Vehicle</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg msg="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Brand Name --}}
            <div class="mb-4">
                <label for="brand_name">Brand Name</label>
                <input type="text" name="brand_name" id="brand_name" value="{{ $vehicle->brand_name }}"
                    class="input @error('brand_name') !ring-red-500 @enderror">
                @error('brand_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Vehicle category --}}
            <div class="mb-4">
                <label for="vehiclecat_id">Category</label>
                <a href="{{ route('vehiclecats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select class="input @error('vehiclecat_id') !ring-red-500 @enderror" name="vehiclecat_id"
                    id="vehiclecat_id">
                    <option value="1">-- Select Category</option>
                    @foreach ($vehicleCategories as $crc)
                        <option value="{{ $crc->id }}" {{ $vehicle->vehiclecat_id == $crc->id ? 'selected' : '' }}>
                            {{ $crc->name }}</option>
                    @endforeach
                </select>
                @error('vehiclecat_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- vehicle price --}}
            <div class="mb-4">
                <label for="rental_price">Rental Price</label>
                <input type="text" name="rental_price" id="rental_price" value="{{ $vehicle->rental_price }}"
                    class="input @error('rental_price') !ring-red-500 @enderror">
                @error('rental_price')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- color --}}
            <div class="mb-4">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" value="{{ $vehicle->color }}"
                    class="input @error('color') !ring-red-500 @enderror">
                @error('color')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- policy --}}
            <div class="mb-4">
                <label for="policy">Policy</label>
                <textarea name="policy" id="policy" cols="30" rows="5"
                    class="input @error('policy') !ring-red-500 @enderror">{{ $vehicle->policy }}</textarea>
                @error('policy')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- information --}}
            <div class="mb-4">
                <label for="information">Information</label>
                <textarea name="information" id="information" cols="30" rows="5"
                    class="input @error('information') !ring-red-500 @enderror">{{ $vehicle->information }}</textarea>
                @error('information')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#policy'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#information'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            {{-- current cover photo if exist --}}
            @if ($vehicle->banner)
                <label>Current banner</label>
                <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $vehicle->banner) }}"
                        alt="{{ $vehicle->brand_name ?? 'vehicle image' }}" width="400" height="400"
                        class="w-full h-full object-cover origin-center">
                </figure>
            @endif

            {{-- banner --}}
            <div class="mb-4">
                <label for="banner">Banner</label>
                <input type="file" name="banner" id="banner"
                    class="input @error('banner') !ring-red-500 @enderror">
                @error('banner')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Save</button>
        </form>
    </div>
    </x-adminlayo>
