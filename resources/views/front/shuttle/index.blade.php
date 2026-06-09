<x-front-layout>
    <!-- Hero Banner -->
    <div class="relative bg-slate-900 overflow-hidden">
        <!-- Background Pattern/Gradient -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-sky-900 to-slate-900 opacity-90"></div>
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-sky-500 rounded-full blur-[80px] opacity-20"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-600 rounded-full blur-[80px] opacity-20"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-sky-500/20 text-sky-300 text-sm font-bold tracking-wider mb-4 border border-sky-500/30 backdrop-blur-sm">
                RUTE ANTAR KOTA
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
                Layanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-400">Travel Shuttle</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto font-medium mb-10">
                Perjalanan antar kota dan akses ke bandara yang nyaman, aman, dan hemat (dihitung per kursi). Nikmati layanan snack gratis dan servis makan di perjalanan Anda.
            </p>

            <!-- Search Form -->
            <div class="max-w-4xl mx-auto bg-white p-3 sm:p-4 rounded-3xl shadow-2xl border border-white/20 backdrop-blur-sm relative z-20">
                <form action="{{ route('shuttle.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" name="origin" value="{{ request('origin') }}" placeholder="Kota Asal" class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 rounded-2xl text-slate-900 font-bold transition-colors">
                    </div>
                    
                    <div class="hidden sm:flex items-center justify-center -mx-4 z-10">
                        <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 border-4 border-white shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                    </div>

                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" name="destination" value="{{ request('destination') }}" placeholder="Kota Tujuan" class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border-transparent focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-200 rounded-2xl text-slate-900 font-bold transition-colors">
                    </div>

                    <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-bold py-3.5 px-8 rounded-2xl shadow-lg shadow-sky-500/30 transition-all flex items-center justify-center sm:w-auto w-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Rute
                    </button>
                    @if(request('origin') || request('destination'))
                    <a href="{{ route('shuttle.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3.5 px-6 rounded-2xl transition-all flex items-center justify-center sm:w-auto w-full" title="Reset Pencarian">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="bg-slate-50 py-16 min-h-screen relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Cross-sell Banner -->
            <div class="mb-8 bg-emerald-50 border border-emerald-100 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4 max-w-7xl mx-auto">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-900 font-bold text-sm">Ingin privasi penuh tanpa digabung penumpang lain?</p>
                        <p class="text-slate-500 text-xs mt-0.5">Gunakan layanan Antar Jemput Bandara Eksklusif (sewa 1 mobil penuh).</p>
                    </div>
                </div>
                <a href="{{ route('airport-transfer') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-lg hover:bg-slate-50 transition-colors whitespace-nowrap shadow-sm">
                    Lihat Sewa Privat
                </a>
            </div>

            <div class="flex flex-wrap justify-center gap-8">
                @forelse($routes as $index => $route)
                <div class="w-full max-w-sm bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col group transform hover:-translate-y-1">
                    <!-- Image Placeholder / Banner -->
                    <div class="h-40 bg-slate-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=800&auto=format&fit=crop" alt="Shuttle Bus" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <span class="bg-sky-500/90 backdrop-blur-sm text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">{{ $route->class_type ?? 'Eksekutif' }}</span>
                            <h3 class="text-xl font-bold drop-shadow-md">{{ $route->origin_city }} ⇌ {{ $route->destination_city }}</h3>
                        </div>
                    </div>
                    
                    <div class="p-6 border-b border-slate-100 bg-gradient-to-br from-sky-50/50 to-white relative">
                        <div class="absolute top-4 right-4 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                            <span>🍪 Snack & Meal</span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-center">
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Keberangkatan</p>
                                <p class="text-xl font-extrabold text-slate-900">{{ $route->origin_city }}</p>
                                <p class="text-sm font-medium text-sky-600">{{ \Carbon\Carbon::parse($route->departure_time)->format('H:i') }} WIB</p>
                            </div>
                            <div class="flex-1 flex flex-col items-center px-4 relative">
                                <div class="w-full border-t-2 border-dashed border-sky-300 absolute top-1/2 -translate-y-1/2"></div>
                                <span class="bg-white p-2 rounded-full relative z-10 text-sky-500 shadow-sm border border-slate-100 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Tujuan</p>
                                <p class="text-xl font-extrabold text-slate-900">{{ $route->destination_city }}</p>
                                <p class="text-sm font-medium text-sky-600">{{ \Carbon\Carbon::parse($route->arrival_time)->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1">
                        <ul class="space-y-3 mb-6 text-sm text-slate-600 flex-1">
                            <li class="flex items-center gap-3">
                                <span class="text-emerald-500">✓</span> Antar Jemput Alamat & Bandara
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-emerald-500">✓</span> Armada Nyaman & Ber-AC
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-emerald-500">✓</span> Opsi Tambahan Snack & Servis Makan
                            </li>
                            <li class="flex items-center gap-3 font-bold text-slate-800">
                                <span class="text-emerald-500">✓</span> Kapasitas: {{ $route->total_seats }} Kursi
                            </li>
                        </ul>
                        
                        <div class="flex flex-col mt-auto pt-4 border-t border-slate-100">
                            <div class="flex items-end justify-between mb-4">
                                <div>
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Harga Tiket</p>
                                    <p class="text-2xl font-extrabold text-sky-600">Rp {{ number_format($route->base_price, 0, ',', '.') }}<span class="text-sm font-medium text-slate-500">/kursi</span></p>
                                </div>
                            </div>
                            <a href="{{ route('shuttle.checkout', $route->id) }}" class="w-full text-center py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white text-sm font-bold rounded-2xl hover:from-sky-400 hover:to-blue-500 transition-all shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 transform group-hover:scale-[1.02]">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-slate-500 text-lg">Belum ada rute shuttle yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-front-layout>
