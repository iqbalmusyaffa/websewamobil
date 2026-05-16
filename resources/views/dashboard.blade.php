<x-front-layout>
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:text-3xl sm:truncate">
                    Halo, {{ $user->name }}! 👋
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Selamat datang di panel kontrol akun AutoRent Anda.
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 gap-3">
                <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                    Sewa Mobil Lagi
                </a>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                    Edit Profil
                </a>
                <a href="{{ route('activity-log') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                    Log Aktivitas
                </a>
            </div>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-2xl flex items-start gap-3">
            <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <h4 class="font-bold">Perhatian</h4>
                <p class="text-sm mt-1">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        @php
            $unpaidPenalties = auth()->user()->penalties()->where('status', 'unpaid')->get();
        @endphp
        @if($unpaidPenalties->isNotEmpty())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-red-800 font-bold text-lg">Tagihan Denda Belum Dibayar</h3>
                    <p class="text-red-700 mt-1 text-sm">Anda memiliki tagihan denda atau kerusakan yang belum diselesaikan. Anda tidak dapat membuat pesanan baru sebelum melunasinya.</p>
                    
                    <div class="mt-4 space-y-3">
                        @foreach($unpaidPenalties as $penalty)
                        <div class="bg-white p-3 rounded-lg border border-red-100 flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-slate-800">{{ $penalty->reason }}</p>
                                @if($penalty->booking_id)
                                    <p class="text-xs text-slate-500 mt-1">Terkait Pesanan: #{{ $penalty->booking_id }}</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-600 text-lg">Rp {{ number_format($penalty->amount, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-500">Hubungi Admin untuk pelunasan</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            <!-- Active Bookings -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-sky-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Pesanan Aktif</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-extrabold text-slate-900">{{ $activeBookingsCount }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3">
                    <div class="text-sm">
                        <a href="{{ route('bookings.index') }}" class="font-medium text-sky-600 hover:text-sky-500 transition-colors">Lihat pesanan</a>
                    </div>
                </div>
            </div>

            <!-- Total Bookings -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-emerald-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Perjalanan Selesai</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-extrabold text-slate-900">{{ $completedBookingsCount }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3">
                    <div class="text-sm text-slate-500">
                        Pengalaman berkendara Anda
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-rose-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Mobil Disimpan</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-extrabold text-slate-900">{{ $wishlistCount }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3">
                    <div class="text-sm">
                        <a href="{{ route('wishlist') }}" class="font-medium text-sky-600 hover:text-sky-500 transition-colors">Lihat wishlist</a>
                    </div>
                </div>
            </div>

            <!-- Rating -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-amber-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Rating Anda</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-extrabold text-slate-900">{{ number_format($averageRating, 1) }}</div>
                                    <span class="text-xs text-slate-500 ml-1">/ 5</span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3">
                    <div class="text-sm text-slate-500">
                        {{ $completedBookingsCount > 0 ? 'Dari ' . $completedBookingsCount . ' perjalanan' : 'Belum ada rating' }}
                    </div>
                </div>
            </div>

            <!-- Wallet -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Saldo Wallet</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-lg font-extrabold text-slate-900">Rp {{ number_format(auth()->user()->wallet_balance ?? 0, 0, ',', '.') }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3 flex justify-between items-center">
                    <div class="text-sm text-slate-500">
                        Bisa dipakai untuk sewa
                    </div>
                    @if(auth()->user()->wallet_balance >= 100000)
                    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'withdraw-modal')" class="text-sm font-medium text-sky-600 hover:text-sky-500">Tarik Saldo</button>
                    @else
                    <button type="button" onclick="alert('Saldo minimal untuk penarikan adalah Rp 100.000')" class="text-sm font-medium text-slate-400 cursor-not-allowed">Tarik Saldo</button>
                    @endif
                </div>
            </div>

            <!-- Savings -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Penghematan</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-lg font-extrabold text-slate-900">Rp {{ number_format($totalSavings, 0, ',', '.') }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3">
                    <div class="text-sm text-slate-500">
                        Dari penggunaan promo
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Section -->
        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 mb-8">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 bg-purple-100 rounded-xl p-3">
                            <svg class="h-8 w-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 5a1 1 0 100 2h6a1 1 0 100-2H7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Verifikasi Identitas</h3>
                            <p class="text-sm text-slate-600 mt-1">Upload KTP dan SIM untuk verifikasi</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($user->document)
                            @if($user->document->status === 'disetujui')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">✓ Terverifikasi</span>
                            @elseif($user->document->status === 'ditolak')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">✗ Ditolak</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">⏳ Pending</span>
                            @endif
                        @endif
                        <a href="{{ route('documents.index') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                            {{ $user->document ? 'Update Dokumen' : 'Upload Dokumen' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- My Reviews Section -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-bold text-slate-900">Ulasan Saya</h3>
                            <p class="text-sm text-slate-500 mt-1">Review yang telah Anda berikan</p>
                        </div>
                    </div>
                    @if($myReviews->isEmpty())
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2h-2.586a1 1 0 00-.707.293l-4 4z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada ulasan</h3>
                            <p class="mt-1 text-sm text-slate-500">Berikan ulasan untuk perjalanan Anda yang sudah selesai</p>
                        </div>
                    @else
                        <ul class="divide-y divide-slate-100">
                            @foreach($myReviews as $review)
                                <li>
                                    <div class="px-6 py-4">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2">
                                                    <p class="font-bold text-slate-900">{{ $review->car->name }}</p>
                                                    <div class="flex items-center gap-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $review->rating)
                                                                <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                                                            @else
                                                                <svg class="w-4 h-4 text-slate-300 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="text-sm text-slate-600 mt-2">{{ $review->comment }}</p>
                                                <p class="text-xs text-slate-500 mt-2">{{ $review->created_at->translatedFormat('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Active Promos Section -->
            <div>
                <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h3 class="text-lg leading-6 font-bold text-slate-900">Promo Aktif</h3>
                        <p class="text-sm text-slate-500 mt-1">Kode promo tersedia hari ini</p>
                    </div>
                    @if($activePromos->isEmpty())
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-slate-900">Tidak ada promo</h3>
                            <p class="mt-1 text-sm text-slate-500">Periksa kembali nanti</p>
                        </div>
                    @else
                        <ul class="divide-y divide-slate-100">
                            @foreach($activePromos as $promo)
                                <li>
                                    <div class="px-6 py-4">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="font-bold text-slate-900 text-sm">{{ $promo->code }}</p>
                                                <p class="text-xs text-slate-600 mt-1">{{ $promo->description }}</p>
                                                <div class="flex items-center gap-2 mt-2">
                                                    @if($promo->type === 'percent')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-800">-{{ $promo->value }}%</span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">-Rp {{ number_format($promo->value, 0, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recommended Cars Section -->
        <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-bold text-slate-900">Rekomendasi Mobil Untuk Anda</h3>
                    <p class="text-sm text-slate-500 mt-1">Mobil-mobil pilihan berdasarkan rating tinggi</p>
                </div>
                <a href="{{ route('cars.index') }}" class="text-sm font-medium text-sky-600 hover:text-sky-500">Lihat Semua</a>
            </div>
            @if($recommendedCars->isEmpty())
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">Tidak ada rekomendasi</h3>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                    @foreach($recommendedCars as $car)
                        <a href="{{ route('cars.show', $car) }}" class="group">
                            <div class="bg-slate-100 rounded-lg overflow-hidden mb-3 h-40 relative">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" src="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=300&q=80' }}" alt="">
                            </div>
                            <p class="font-bold text-slate-900 text-sm group-hover:text-sky-600">{{ $car->name }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="flex items-center gap-1">
                                    @php $rating = $car->reviews_avg_rating ?? 0; @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($rating))
                                            <svg class="w-3 h-3 text-amber-400 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                                        @else
                                            <svg class="w-3 h-3 text-slate-300 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs text-slate-600">{{ number_format($rating, 1) }}</span>
                            </div>
                            <p class="text-sm font-bold text-sky-600 mt-2">Rp {{ number_format($car->price_without_driver ?? 0, 0, ',', '.') }}/hari</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Payment History Section -->
        <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-bold text-slate-900">Riwayat Pembayaran</h3>
                <a href="{{ route('bookings.index') }}" class="text-sm font-medium text-sky-600 hover:text-sky-500">Lihat Semua</a>
            </div>
            @if($recentPayments->isEmpty())
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada pembayaran</h3>
                    <p class="mt-1 text-sm text-slate-500">Pembayaran Anda akan ditampilkan di sini</p>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($recentPayments as $booking)
                        <li>
                            <a href="{{ route('bookings.show', $booking) }}" class="block hover:bg-slate-50 transition-colors">
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-bold text-slate-900">Booking #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        <p class="text-sm text-slate-600 mt-1">{{ $booking->car->name }} · {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                        <div class="mt-1">
                                            @if($booking->payment && $booking->payment->status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">⏳ Pending</span>
                                            @elseif($booking->payment && $booking->payment->status === 'settlement')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">✓ Terbayar</span>
                                            @elseif($booking->payment && $booking->payment->status === 'expire')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">✗ Expired</span>
                                            @elseif($booking->payment && $booking->payment->status === 'cancel')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">✗ Dibatalkan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden mt-8">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-bold text-slate-900">
                    Pesanan Terakhir Anda
                </h3>
                <a href="{{ route('bookings.index') }}" class="text-sm font-medium text-sky-600 hover:text-sky-500">Lihat Semua</a>
            </div>

            @if($recentBookings->isEmpty())
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada pesanan</h3>
                    <p class="mt-1 text-sm text-slate-500">Anda belum pernah menyewa mobil di AutoRent.</p>
                    <div class="mt-6">
                        <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Mulai Sewa Pertama
                        </a>
                    </div>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($recentBookings as $booking)
                        <li>
                            <a href="{{ route('bookings.show', $booking) }}" class="block hover:bg-slate-50 transition-colors">
                                <div class="px-6 py-4 flex items-center">
                                    <div class="min-w-0 flex-1 flex items-center">
                                        <div class="flex-shrink-0 h-16 w-24 relative rounded-md overflow-hidden bg-slate-100">
                                            <img class="h-16 w-24 object-cover" src="{{ $booking->car->image_url ?? 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=300&q=80' }}" alt="">
                                        </div>
                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                                <p class="text-sm font-bold text-sky-600 truncate">{{ $booking->car->name }}</p>
                                                <p class="mt-2 flex items-center text-sm text-slate-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="truncate">{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d M Y') }}</span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-slate-900 font-bold">
                                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-slate-500">
                                                        Booking ID: #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        @if($booking->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">⏳ Menunggu Review</span>
                                        @elseif($booking->status == 'menunggu pembayaran')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">💳 Menunggu Bayar</span>
                                        @elseif($booking->status == 'disetujui')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800">✓ Disetujui</span>
                                        @elseif($booking->status == 'berjalan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">🚗 Sedang Berjalan</span>
                                        @elseif($booking->status == 'selesai')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">✓ Selesai</span>
                                        @elseif($booking->status == 'dibatalkan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">✗ Dibatalkan</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">{{ ucfirst($booking->status) }}</span>
                                        @endif
                                        <svg class="h-5 w-5 text-slate-400 inline ml-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
</x-front-layout>

<!-- Withdraw Modal -->
<x-modal name="withdraw-modal" :show="$errors->has('bank_account_number')">
    <form method="POST" action="{{ route('wallet.withdraw') }}" class="p-6">
        @csrf
        <h2 class="text-lg font-bold text-slate-900 mb-4">Tarik Saldo Wallet</h2>
        <p class="text-sm text-slate-600 mb-6">Penarikan saldo minimal Rp 100.000. Dana akan ditransfer ke rekening Anda dalam waktu 1x24 jam kerja.</p>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nominal Penarikan</label>
                <input type="number" name="amount" min="100000" max="{{ auth()->user()->wallet_balance }}" required
                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Bank (Misal: BCA, Mandiri, BNI)</label>
                <input type="text" name="bank_name" required
                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                @error('bank_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Atas Nama Rekening</label>
                <input type="text" name="account_name" required
                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                @error('account_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Rekening</label>
                <input type="text" name="account_number" required
                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                @error('account_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50">Batal</button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-sky-600 rounded-lg hover:bg-sky-700">Tarik Sekarang</button>
        </div>
    </form>
</x-modal>
