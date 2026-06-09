<x-front-layout>
    <div class="bg-slate-50 py-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">Detail Pesanan Antar Jemput</h1>
                    <p class="mt-2 text-slate-600">Rincian perjalanan Anda ke/dari Bandara.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-sky-600 hover:text-sky-700 bg-sky-50 px-4 py-2 rounded-lg">Kembali ke Dashboard</a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                <!-- Header Card -->
                <div class="bg-indigo-600 p-6 sm:p-10 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="text-indigo-200 text-sm font-medium mb-1">Kode Booking</p>
                        <h2 class="text-2xl font-bold tracking-tight">{{ $booking->booking_code }}</h2>
                    </div>
                    <div class="flex gap-2">
                        @if($booking->booking_status == 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-400 text-yellow-900">⏳ Menunggu</span>
                        @elseif($booking->booking_status == 'confirmed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-400 text-green-900">✓ Disetujui</span>
                        @elseif($booking->booking_status == 'completed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-400 text-blue-900">✓ Selesai</span>
                        @elseif($booking->booking_status == 'cancelled')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-400 text-red-900">✗ Dibatalkan</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ ucfirst($booking->booking_status) }}</span>
                        @endif

                        @if($booking->payment_method && in_array($booking->payment_status, ['unpaid', 'pending']))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-400 text-yellow-900">⏳ Menunggu Review</span>
                        @elseif(in_array($booking->payment_status, ['unpaid', 'pending']))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-400 text-amber-900">Belum Lunas</span>
                        @elseif($booking->payment_status == 'paid')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-400 text-emerald-900">Lunas</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ ucfirst($booking->payment_status) }}</span>
                        @endif
                    </div>
                </div>

                <div class="p-6 sm:p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Rute & Waktu -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                            Informasi Jemputan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-10 flex flex-col items-center">
                                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                                    <div class="w-0.5 h-full bg-slate-200 my-1"></div>
                                    <div class="w-3 h-3 bg-slate-400 rounded-full"></div>
                                </div>
                                <div class="flex-1 pb-2">
                                    @if($booking->transfer_type === 'to_airport')
                                    <div class="mb-4">
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Jemput Dari</p>
                                        <p class="font-bold text-slate-900">{{ $booking->pickup_address }}</p>
                                        <p class="text-sm text-slate-600 mt-1">Zona: {{ $booking->airportZone->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Antar Ke</p>
                                        <p class="font-bold text-slate-900">{{ $booking->airport->name }}</p>
                                        <p class="text-sm text-slate-600 mt-1">{{ $booking->airport->code }}</p>
                                    </div>
                                    @else
                                    <div class="mb-4">
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Jemput Dari</p>
                                        <p class="font-bold text-slate-900">{{ $booking->airport->name }}</p>
                                        <p class="text-sm text-slate-600 mt-1">{{ $booking->airport->code }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Antar Ke</p>
                                        <p class="font-bold text-slate-900">{{ $booking->pickup_address }}</p>
                                        <p class="text-sm text-slate-600 mt-1">Zona: {{ $booking->airportZone->name }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 rounded-xl p-4 mt-4 border border-slate-100">
                                <p class="text-sm text-slate-500">Waktu Jemput</p>
                                <p class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->pickup_datetime)->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm font-medium text-indigo-600 mt-1">{{ \Carbon\Carbon::parse($booking->pickup_datetime)->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kendaraan & Penumpang -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Data Penumpang & Armada
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Mobil</span>
                                <span class="font-bold text-slate-900">{{ $booking->vehicle->name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Penumpang Utama</span>
                                <span class="font-bold text-slate-900">{{ $booking->customer_name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Nomor Telepon</span>
                                <span class="font-bold text-slate-900">{{ $booking->customer_phone }}</span>
                            </div>
                            @if($booking->flight_number)
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Nomor Penerbangan</span>
                                <span class="font-bold text-slate-900 uppercase">{{ $booking->flight_number }}</span>
                            </div>
                            @endif
                            @if($booking->notes)
                            <div class="py-3 border-b border-slate-100">
                                <span class="text-slate-600 block mb-1">Catatan Tambahan</span>
                                <span class="text-sm font-medium text-slate-900">{{ $booking->notes }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Harga & Aksi -->
                <div class="bg-slate-50 p-6 sm:p-10 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Total Pembayaran</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                    
                    @if(in_array($booking->payment_status, ['unpaid', 'pending']))
                        <a href="{{ route('airport-transfer.payment', $booking->booking_code) }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all">
                            {{ $booking->payment_method ? 'Lihat Pembayaran' : 'Lanjutkan Pembayaran' }}
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <button onclick="window.print()" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3.5 border border-slate-300 shadow-sm text-base font-medium rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            <svg class="mr-2 -ml-1 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Tiket
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
