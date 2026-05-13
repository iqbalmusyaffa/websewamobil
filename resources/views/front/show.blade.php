<x-front-layout>
    @push('head')
    <meta name="description" content="Sewa {{ $car->brand }} {{ $car->name }} - {{ $car->type }} {{ $car->capacity }} penumpang mulai Rp {{ number_format($car->can_lepas_kunci ? $car->price_without_driver : $car->price_with_driver, 0, ',', '.') }}/hari. AutoRent - Platform sewa mobil terpercaya.">
    <meta property="og:title" content="{{ $car->brand }} {{ $car->name }} | AutoRent">
    <meta property="og:description" content="Sewa {{ $car->name }} mulai Rp {{ number_format($car->can_lepas_kunci ? $car->price_without_driver : $car->price_with_driver, 0, ',', '.') }}/hari. Armada terawat, harga transparan.">
    <meta property="og:image" content="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800' }}">
    @endpush

    <div class="bg-slate-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <nav class="flex text-sm text-slate-500 mb-8 font-medium">
                <a href="{{ route('home') }}" class="hover:text-sky-600 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('cars.index') }}" class="hover:text-sky-600 transition-colors">Katalog</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900">{{ $car->brand }} {{ $car->name }}</span>
            </nav>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">

                    <!-- Car Image -->
                    <div class="relative h-96 lg:h-full bg-slate-100 p-8 flex items-center justify-center">
                        <img loading="lazy" class="w-full h-auto object-contain max-h-[500px] drop-shadow-2xl hover:scale-105 transition-transform duration-500"
                            src="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80' }}"
                            alt="{{ $car->name }}">
                        <div class="absolute top-6 left-6 flex space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-white text-slate-900 shadow-sm uppercase tracking-wider">
                                {{ $car->type ?? 'Premium' }}
                            </span>
                            @if($car->capacity > 4)
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-sky-100 text-sky-700 shadow-sm uppercase tracking-wider">
                                Family Car
                            </span>
                            @endif
                        </div>
                        <!-- Wishlist Button -->
                        @auth
                        <form method="POST" action="{{ route('wishlist.toggle', $car) }}" class="absolute top-6 right-6">
                            @csrf
                            <button type="submit" class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md transition-all
                                {{ $isWishlisted ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-white text-slate-400 hover:text-red-500 hover:border-red-200' }} border border-transparent">
                                <svg class="w-5 h-5" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </form>
                        @endauth
                    </div>

                    <!-- Car Details -->
                    <div class="p-8 lg:p-12 flex flex-col justify-between">
                        <div>
                            <div class="mb-2">
                                <h2 class="text-sm font-bold text-sky-600 uppercase tracking-widest">{{ $car->brand }}</h2>
                                <h1 class="text-4xl font-extrabold text-slate-900 mt-1">{{ $car->name }}</h1>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center mt-4 mb-8">
                                <div class="flex text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-slate-500 font-medium">
                                    {{ $avgRating > 0 ? $avgRating : 'Belum ada' }} ({{ $reviews->count() }} Ulasan)
                                </span>
                            </div>

                            <p class="text-slate-600 mb-8 leading-relaxed text-lg">{{ $car->description ?? 'Mobil nyaman, terawat dengan standar tinggi, dan siap menemani perjalanan Anda.' }}</p>

                            <!-- Spesifikasi -->
                            <div class="mb-10">
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Spesifikasi Utama</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="flex items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 mr-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 font-medium">Kapasitas</p>
                                            <p class="font-bold text-slate-900">{{ $car->capacity ?? 4 }} Penumpang</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 mr-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 font-medium">Transmisi</p>
                                            <p class="font-bold text-slate-900">{{ $car->transmission ?? 'AT/MT' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 mr-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 font-medium">Bahan Bakar</p>
                                            <p class="font-bold text-slate-900">{{ $car->fuel_type ?? 'Bensin' }}</p>
                                        </div>
                                    </div>
                                    @if($car->year)
                                    <div class="flex items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 mr-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 font-medium">Tahun</p>
                                            <p class="font-bold text-slate-900">{{ $car->year }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($car->luggage)
                                    <div class="flex items-center p-4 bg-slate-50 rounded-xl border border-slate-100">
                                        <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 mr-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 font-medium">Bagasi</p>
                                            <p class="font-bold text-slate-900">{{ $car->luggage }} Koper</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if($car->features && count($car->features) > 0)
                            <!-- Fitur -->
                            <div class="mb-10">
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Fasilitas Tambahan</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($car->features as $feature)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-sky-50 text-sky-700 border border-sky-100">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ $feature }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Harga -->
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Paket Harga Harian</h3>
                                <div class="space-y-3">
                                    @if($car->can_lepas_kunci)
                                    <div class="flex justify-between items-center p-5 border-2 border-slate-100 rounded-xl bg-white hover:border-sky-200 transition-colors">
                                        <div>
                                            <span class="font-bold text-slate-900 block">Sewa Lepas Kunci</span>
                                            <span class="text-xs text-slate-500">Tanpa sopir, bebas biaya lembur sopir</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-2xl font-black text-sky-600 block leading-none">Rp {{ number_format($car->price_without_driver, 0, ',', '.') }}</span>
                                            <span class="text-xs font-semibold text-slate-400">/ hari (24 Jam)</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="flex justify-between items-center p-5 border-2 border-slate-100 rounded-xl bg-white hover:border-sky-200 transition-colors">
                                        <div>
                                            <span class="font-bold text-slate-900 block">Dengan Sopir Profesional</span>
                                            <span class="text-xs text-slate-500">Bebas capek, termasuk uang makan sopir</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-2xl font-black text-sky-600 block leading-none">Rp {{ number_format($car->price_with_driver, 0, ',', '.') }}</span>
                                            <span class="text-xs font-semibold text-slate-400">/ 12 Jam</span>
                                        </div>
                                    </div>
                                    <!-- Info Biaya Tidak Termasuk -->
                                    <div class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-100">
                                        <p class="text-xs font-semibold text-amber-800 mb-1.5">⚠️ Harga sopir belum termasuk:</p>
                                        <div class="grid grid-cols-2 gap-1 text-xs text-amber-700">
                                            <span>• Uang makan sopir</span>
                                            <span>• Biaya tol</span>
                                            <span>• Tiket parkir</span>
                                            <span>• Tiket pelabuhan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Persyaratan Sewa -->
                            <div class="mt-8 bg-sky-50/50 rounded-xl p-5 border border-sky-100">
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Persyaratan Sewa
                                </h3>
                                <ul class="space-y-2 text-sm text-slate-700">
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span><strong>Wajib DP (Uang Muka)</strong> setelah pesanan dibuat untuk mengunci kendaraan.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>Menyiapkan <strong>KTP Asli / SIM</strong> (Dokumen Identitas resmi) yang masih berlaku saat penyerahan kunci.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div class="mt-10 pt-8 border-t border-slate-100">
                            <a href="{{ route('checkout', $car) }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-slate-900 hover:bg-sky-600 shadow-xl shadow-slate-900/20 hover:shadow-sky-600/30 transition-all transform hover:-translate-y-0.5">
                                Pesan Kendaraan Ini
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-12">
                <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Ulasan Pelanggan</h2>
                @if($reviews->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-100 p-10 text-center">
                    <p class="text-4xl mb-3">⭐</p>
                    <p class="text-slate-500 font-medium">Belum ada ulasan untuk mobil ini. Jadilah yang pertama!</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($reviews as $review)
                    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center font-bold text-sky-700">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">{{ $review->user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- STICKY BOOKING BAR — hanya tampil di mobile (< lg)        --}}
    {{-- ========================================================= --}}
    @php
        $bestPrice = $car->can_lepas_kunci ? $car->price_without_driver : $car->price_with_driver;
        $bestLabel = $car->can_lepas_kunci ? 'Lepas Kunci / hari' : 'Dengan Sopir / 12 jam';
    @endphp
    <div class="fixed bottom-0 left-0 right-0 z-50 lg:hidden"
         x-data="{ visible: false }"
         x-init="
             window.addEventListener('scroll', () => {
                 visible = window.scrollY > 300;
             });
         "
         x-show="visible"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-full opacity-0">
        <div class="bg-white/95 backdrop-blur-md border-t border-slate-200 shadow-2xl shadow-slate-900/20 px-4 py-3 safe-area-inset-bottom pr-20">
            <div class="flex items-center justify-between gap-4">
                {{-- Info Harga --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Mulai dari</span>
                        @if($avgRating > 0)
                        <span class="inline-flex items-center gap-0.5 text-[11px] font-bold text-amber-500">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            {{ $avgRating }}
                        </span>
                        @endif
                    </div>
                    <div class="flex items-baseline gap-1 flex-wrap">
                        <span class="text-2xl font-black text-slate-900 leading-none">Rp {{ number_format($bestPrice, 0, ',', '.') }}</span>
                        <span class="text-xs font-semibold text-slate-500">/ {{ $car->can_lepas_kunci ? 'hari' : '12 jam' }}</span>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $bestLabel }}</p>
                </div>

                {{-- Tombol CTA --}}
                <div class="flex flex-col gap-2 shrink-0">
                    <a href="{{ route('checkout', $car) }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-sky-600/30 transition-all active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-front-layout>
