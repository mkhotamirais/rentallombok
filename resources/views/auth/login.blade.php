<x-layout>
    <section class="h-screen flex items-center justify-center">
        <div class="max-w-lg mx-auto bg-white p-4 sm:p-8 sm:border rounded-lg border-gray-300">
            <h1 class="text-2xl font-semibold mb-6">Login</h1>
            @if (session('error'))
                <x-flash-msg msg="{{ session('error') }}" bg="bg-red-500" />
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- email --}}
                <div class="mb-3">
                    <label for="email" class="label">Email</label>
                    <input type="email" name="email" id="email"
                        class="input @error('email') !border-red-500 @enderror" placeholder="email address"
                        value={{ old('email') }}>
                    @error('email')
                        <p class="text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div x-data="{ showPassword: false }" class="mb-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'"
                            class="input !pr-16 @error('password') !border-red-300 @enderror" name="password"
                            id="password" placeholder="********">
                        <button type="button" x-on:click="showPassword = !showPassword"
                            class="absolute top-1/2 -translate-y-1/2 right-2 text-orange-700 font-semibold"
                            x-text="showPassword ? 'Hide' : 'Show'">
                        </button>
                    </div>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </section>
</x-layout>
