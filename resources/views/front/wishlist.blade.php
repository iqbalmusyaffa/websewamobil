<x-front-layout>
    <div class="bg-slate-900 py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl tracking-tight">Daftar Wishlist Saya</h1>
            <p class="mt-3 text-lg text-slate-300">Mobil-mobil yang Anda simpan untuk dipesan nanti.</p>
        </div>
    </div>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-emerald-800 font-medium">
                {{ session('success') }}
            </div>
            @endif

            @if($wishlists->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm">
                <p class="text-5xl mb-4">💔</p>
                <h2 class="text-xl font-bold text-slate-900 mb-2">Wishlist Anda Masih Kosong</h2>
                <p class="text-slate-500 mb-6">Telusuri katalog mobil kami dan simpan yang Anda suka!</p>
                <a href="{{ route('cars.index') }}" class="inline-flex items-center px-6 py-3 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 transition-all">
                    Jelajahi Katalog →
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($wishlists as $wl)
                <div class="bg-white overflow-hidden border border-slate-200 rounded-2xl hover:shadow-xl hover:border-sky-200 transition-all duration-300 group flex flex-col">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img loading="lazy" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                            src="{{ $wl->car->image_url ?? 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $wl->car->name }}">
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-slate-900 shadow-sm">
                            {{ $wl->car->brand }}
                        </div>
                        <!-- Remove from wishlist -->
                        <form method="POST" action="{{ route('wishlist.toggle', $wl->car) }}" class="absolute top-3 right-3">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-lg bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition shadow">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </form>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $wl->car->name }}</h3>
                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-4">{{ $wl->car->type }} · {{ $wl->car->capacity }} Penumpang</p>
                        <div class="mt-auto flex items-end justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Mulai dari</p>
                                <p class="text-xl font-extrabold text-slate-900 leading-none">
                                    Rp {{ number_format($wl->car->can_lepas_kunci ? $wl->car->price_without_driver : $wl->car->price_with_driver, 0, ',', '.') }}<span class="text-xs font-semibold text-slate-500">/hari</span>
                                </p>
                            </div>
                            <a href="{{ route('checkout', $wl->car) }}" class="inline-flex items-center px-4 py-2 bg-sky-600 text-white text-xs font-bold rounded-lg hover:bg-sky-700 transition-colors shadow-sm">
                                Pesan →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-front-layout>
