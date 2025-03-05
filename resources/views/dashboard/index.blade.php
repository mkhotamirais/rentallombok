<x-layoutadmin>
    <div class="py-4">
        <section>
            <h2 class="title">Dashboard</h2>
            <p class="text-lg text-center">Selamat datang {{ Auth::user()->name }}</p>
        </section>
        <section class="max-w-xl mx-auto">
            <div class="flex flex-col gap-2 mt-8">
                @foreach (config('common.dashboard-menu') as $menu)
                    <a href="{{ $menu['url'] }}"
                        class="{{ request()->is(trim($menu['url'], '/')) ? 'text-orange-500' : '' }} btn">{{ $menu['label'] }}</a>
                @endforeach
            </div>
        </section>
    </div>
</x-layoutadmin>
