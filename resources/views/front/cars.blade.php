<x-front-layout>
    <div class="bg-slate-900 pb-24 pt-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl font-extrabold text-white sm:text-5xl tracking-tight">
                Temukan Kendaraan Impian Anda
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Pilih dari koleksi mobil premium kami untuk perjalanan yang tak terlupakan.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-900">Filter Pencarian</h2>
                        <a href="{{ route('cars.index') }}" class="text-sm text-sky-600 hover:text-sky-700 font-medium">Reset</a>
                    </div>
                    
                    <form action="{{ route('cars.index') }}" method="GET" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-semibold text-slate-700 mb-2">Pencarian</label>
                            <input id="search" name="search" type="text" value="{{ request('search') }}" class="w-full px-4 py-2.5 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Merek atau nama mobil...">
                        </div>

                        <!-- Ketersediaan Tanggal -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">📅 Cek Ketersediaan</label>
                            <div class="space-y-2">
                                <div>
                                    <label for="available_from" class="text-xs text-slate-500 mb-1 block">Tanggal Mulai</label>
                                    <input id="available_from" name="available_from" type="date"
                                        value="{{ request('available_from') }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-3 py-2 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 text-sm">
                                </div>
                                <div>
                                    <label for="available_to" class="text-xs text-slate-500 mb-1 block">Tanggal Selesai</label>
                                    <input id="available_to" name="available_to" type="date"
                                        value="{{ request('available_to') }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-3 py-2 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 text-sm">
                                </div>
                            </div>
                            @if(request('available_from') && request('available_to'))
                            <p class="text-xs text-emerald-600 mt-1 font-medium">✓ Hanya tampil mobil yang tersedia</p>
                            @endif
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-semibold text-slate-700 mb-2">Tipe Mobil</label>
                            <select id="type" name="type" class="w-full px-4 py-2.5 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm">
                                <option value="">Semua Tipe</option>
                                <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                <option value="MPV" {{ request('type') == 'MPV' ? 'selected' : '' }}>MPV</option>
                                <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="Hatchback" {{ request('type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="Minibus" {{ request('type') == 'Minibus' ? 'selected' : '' }}>Minibus</option>
                            </select>
                        </div>

                        <!-- Transmission -->
                        <div>
                            <label for="transmission" class="block text-sm font-semibold text-slate-700 mb-2">Transmisi</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center gap-2 px-3 py-2 rounded-xl border cursor-pointer transition
                                    {{ request('transmission') == 'AT' ? 'border-sky-500 bg-sky-50 text-sky-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                                    <input type="radio" name="transmission" value="AT" {{ request('transmission') == 'AT' ? 'checked' : '' }} class="sr-only">
                                    <span class="text-xs font-bold">⚙️ Matic</span>
                                </label>
                                <label class="flex items-center gap-2 px-3 py-2 rounded-xl border cursor-pointer transition
                                    {{ request('transmission') == 'MT' ? 'border-sky-500 bg-sky-50 text-sky-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                                    <input type="radio" name="transmission" value="MT" {{ request('transmission') == 'MT' ? 'checked' : '' }} class="sr-only">
                                    <span class="text-xs font-bold">🔧 Manual</span>
                                </label>
                            </div>
                        </div>

                        <!-- Bahan Bakar -->
                        <div>
                            <label for="fuel_type" class="block text-sm font-semibold text-slate-700 mb-2">⛽ Bahan Bakar</label>
                            <select id="fuel_type" name="fuel_type" class="w-full px-4 py-2.5 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm">
                                <option value="">Semua BBM</option>
                                <option value="Bensin" {{ request('fuel_type') == 'Bensin' ? 'selected' : '' }}>⛽ Bensin</option>
                                <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>🛢️ Diesel</option>
                                <option value="Hybrid" {{ request('fuel_type') == 'Hybrid' ? 'selected' : '' }}>🌿 Hybrid</option>
                                <option value="Listrik" {{ request('fuel_type') == 'Listrik' ? 'selected' : '' }}>⚡ Listrik</option>
                            </select>
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="capacity" class="block text-sm font-semibold text-slate-700 mb-2">👥 Kapasitas Minimum</label>
                            <select id="capacity" name="capacity" class="w-full px-4 py-2.5 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm">
                                <option value="">Pilih Kapasitas</option>
                                <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2+ Penumpang</option>
                                <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ Penumpang</option>
                                <option value="6" {{ request('capacity') == '6' ? 'selected' : '' }}>6+ Penumpang</option>
                                <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ Penumpang</option>
                            </select>
                        </div>

                        <!-- Rating Minimum -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">⭐ Rating Minimum</label>
                            <div class="flex gap-1">
                                @for($star = 1; $star <= 5; $star++)
                                <label class="flex-1 text-center cursor-pointer">
                                    <input type="radio" name="min_rating" value="{{ $star }}" {{ request('min_rating') == $star ? 'checked' : '' }} class="sr-only">
                                    <span class="block py-1.5 rounded-lg text-lg transition border
                                        {{ request('min_rating') == $star ? 'border-amber-400 bg-amber-50' : 'border-slate-200 bg-slate-50 hover:bg-amber-50' }}">
                                        ⭐
                                    </span>
                                    <span class="text-[10px] text-slate-500 font-medium">{{ $star }}+</span>
                                </label>
                                @endfor
                            </div>
                        </div>

                        <!-- Rentang Harga -->
                        <div x-data="{ priceMin: {{ request('price_min', 0) }}, priceMax: {{ request('price_max', $priceMax ?? 2000000) }}, max: {{ $priceMax ?? 2000000 }} }">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">💰 Rentang Harga /hari</label>
                            <div class="flex items-center gap-2 mb-3 text-xs text-slate-600">
                                <span>Rp <span x-text="new Intl.NumberFormat('id-ID').format(priceMin)"></span></span>
                                <span class="flex-1 text-center text-slate-400">—</span>
                                <span>Rp <span x-text="new Intl.NumberFormat('id-ID').format(priceMax)"></span></span>
                            </div>
                            <input type="range" x-model="priceMin" min="0" :max="max" step="50000"
                                class="w-full h-1.5 bg-slate-200 rounded-lg accent-sky-500 mb-1">
                            <input type="range" x-model="priceMax" min="0" :max="max" step="50000"
                                class="w-full h-1.5 bg-slate-200 rounded-lg accent-sky-500">
                            <input type="hidden" name="price_min" :value="priceMin">
                            <input type="hidden" name="price_max" :value="priceMax">
                        </div>

                        <!-- Sort -->
                        <div>
                            <label for="sort" class="block text-sm font-semibold text-slate-700 mb-2">🔃 Urutkan</label>
                            <select id="sort" name="sort" class="w-full px-4 py-2.5 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm">
                                <option value="">Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>⭐ Rating Tertinggi</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>🔥 Terpopuler</option>
                            </select>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <button type="submit" class="w-full py-3 px-4 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-xl shadow-md shadow-sky-500/30 transition-all transform hover:-translate-y-0.5">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cars Grid -->
            <div class="w-full lg:w-3/4 mt-16 lg:mt-0">
                <div class="mb-6 flex justify-between items-center text-sm text-slate-500">
                    <p>Menampilkan <strong>{{ $cars->total() }}</strong> mobil</p>
                </div>

                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($cars as $car)
                        <div class="bg-white overflow-hidden border border-slate-200 rounded-2xl hover:shadow-xl hover:border-sky-200 transition-all duration-300 group flex flex-col h-full">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $car->name }}">
                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-bold text-slate-900 shadow-sm">
                                    {{ $car->brand }}
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-sky-600 transition-colors leading-tight">{{ $car->name }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 uppercase tracking-wider font-semibold">{{ $car->type ?? 'Premium' }}</p>
                                    </div>
                                    {{-- Badge status & rating --}}
                                    <div class="flex flex-col items-end gap-1 ml-2 shrink-0">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Tersedia
                                        </span>
                                        @php $avgRating = round($car->reviews()->avg('rating') ?? 0, 1); @endphp
                                        @if($avgRating > 0)
                                        <span class="inline-flex items-center gap-0.5 text-[11px] font-bold text-amber-500">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            {{ $avgRating }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 mb-4 flex-1">
                                    <div class="flex items-center text-[11px] sm:text-xs text-slate-600 font-medium truncate">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-400 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        {{ $car->capacity ?? 4 }} Seat
                                    </div>
                                    <div class="flex items-center text-[11px] sm:text-xs text-slate-600 font-medium truncate">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-400 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $car->transmission ?? 'AT' }}
                                    </div>
                                    <div class="flex items-center text-[11px] sm:text-xs text-slate-600 font-medium truncate">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-400 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                        {{ $car->fuel_type ?? 'Bensin' }}
                                    </div>
                                </div>
                                
                                {{-- Blok Harga Dua Opsi --}}
                                <div class="mt-auto pt-3 border-t border-slate-100">
                                    <div class="space-y-1.5 mb-3">
                                        @if($car->can_lepas_kunci)
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500">
                                                <svg class="w-3 h-3 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                                Lepas Kunci
                                            </span>
                                            <span class="text-sm font-extrabold text-sky-600">Rp {{ number_format($car->price_without_driver, 0, ',', '.') }}<span class="text-[10px] font-medium text-slate-400">/hr</span></span>
                                        </div>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-500">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                Dengan Sopir
                                            </span>
                                            <span class="text-sm font-extrabold text-slate-700">Rp {{ number_format($car->price_with_driver, 0, ',', '.') }}<span class="text-[10px] font-medium text-slate-400">/12 jam</span></span>
                                        </div>
                                    </div>
                                    <a href="{{ route('cars.show', $car) }}" class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-sky-600 transition-all duration-200 shadow-sm hover:shadow-sky-500/30 hover:-translate-y-0.5">
                                        Lihat Detail
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-100 shadow-sm">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Tidak Ada Mobil Ditemukan</h3>
                            <p class="text-slate-500">Coba sesuaikan filter pencarian Anda untuk melihat lebih banyak hasil.</p>
                            <a href="{{ route('cars.index') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50">
                                Reset Filter
                            </a>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-10">
                    {{ $cars->links() }}
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
