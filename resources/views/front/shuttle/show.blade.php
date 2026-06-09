<x-front-layout>
    <div class="bg-slate-50 py-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Detail Pesanan Shuttle</h1>
                    <p class="mt-1 sm:mt-2 text-sm sm:text-base text-slate-600">Rincian perjalanan Anda dengan AutoRent Shuttle.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex justify-center w-full sm:w-auto text-sm font-medium text-sky-600 hover:text-sky-700 bg-sky-50 px-4 py-2.5 sm:py-2 rounded-xl sm:rounded-lg">Kembali ke Dashboard</a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                <!-- Header Card -->
                <div class="bg-sky-600 p-6 sm:p-10 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="text-sky-100 text-xs sm:text-sm font-medium mb-1">Kode Booking</p>
                        <h2 class="text-xl sm:text-2xl font-bold tracking-tight">{{ $booking->booking_code }}</h2>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                        @if($booking->status == 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-400 text-yellow-900">⏳ Menunggu</span>
                        @elseif($booking->status == 'confirmed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-400 text-green-900">✓ Disetujui</span>
                        @elseif($booking->status == 'completed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-400 text-blue-900">✓ Selesai</span>
                        @elseif($booking->status == 'cancelled')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-400 text-red-900">✗ Dibatalkan</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">{{ ucfirst($booking->status) }}</span>
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

                <!-- QR Code / Boarding Pass -->
                @if(in_array($booking->status, ['confirmed', 'completed']) || $booking->payment_status == 'paid')
                <div class="p-6 sm:px-10 pb-0 flex flex-col sm:flex-row gap-6 items-center">
                    <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100 flex-shrink-0">
                        {!! QrCode::size(100)->margin(0)->generate(route('shuttle.validate', $booking->booking_code)) !!}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">E-Tiket Boarding Pass</h3>
                        <p class="text-sm text-slate-600">Tunjukkan QR Code ini kepada sopir saat naik ke dalam kendaraan. Simpan atau <em>screenshot</em> halaman ini untuk mempermudah proses <em>boarding</em> tanpa perlu mencetak kertas.</p>
                    </div>
                </div>
                @endif

                <div class="p-6 sm:p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Rute & Waktu -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Informasi Perjalanan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-10 flex flex-col items-center">
                                    <div class="w-3 h-3 bg-sky-500 rounded-full"></div>
                                    <div class="w-0.5 h-full bg-slate-200 my-1"></div>
                                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                                </div>
                                <div class="flex-1 pb-2">
                                    <div class="mb-4">
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Asal</p>
                                        <p class="font-bold text-slate-900">{{ $booking->route->origin_city ?? 'Origin' }}</p>
                                        <p class="text-sm text-slate-600 mt-1">{{ $booking->pickup_address }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Tujuan</p>
                                        <p class="font-bold text-slate-900">{{ $booking->route->destination_city ?? 'Destination' }}</p>
                                        <p class="text-sm text-slate-600 mt-1">{{ $booking->dropoff_address }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 rounded-xl p-4 mt-4 border border-slate-100">
                                <p class="text-sm text-slate-500">Tanggal Keberangkatan</p>
                                <p class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->travel_date)->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm font-medium text-sky-600 mt-1">
                                    Berangkat: {{ \Carbon\Carbon::parse($booking->route->departure_time)->format('H:i') }} WIB <span class="text-slate-400 mx-1">&bull;</span>
                                    Tiba (Est): {{ \Carbon\Carbon::parse($booking->route->arrival_time)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Penumpang & Kursi -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Penumpang & Layanan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Pemesan / Penumpang</span>
                                <div class="text-right">
                                    <span class="font-bold text-slate-900 block">{{ $booking->user->name ?? 'Tamu' }}</span>
                                    <span class="text-sm text-slate-500">{{ $booking->user->phone ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Jumlah Penumpang</span>
                                <span class="font-bold text-slate-900">{{ $booking->quantity }} Orang</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Nomor Kursi</span>
                                <div class="flex gap-1 flex-wrap justify-end">
                                    @php $seats = is_string($booking->seat_numbers) ? json_decode($booking->seat_numbers, true) : $booking->seat_numbers; @endphp
                                    @foreach($seats ?? [] as $seat)
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-100 text-sky-700 font-bold text-sm">{{ $seat }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Snack Tambahan</span>
                                <span class="font-bold text-slate-900">{!! $booking->include_snack ? '<span class="text-emerald-600">Ya</span>' : 'Tidak' !!}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Makan Siang/Malam</span>
                                <span class="font-bold text-slate-900">{!! $booking->include_meal ? '<span class="text-emerald-600">Ya</span>' : 'Tidak' !!}</span>
                            </div>
                            @if($booking->meal_upgrade)
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-slate-600">Paket Makan</span>
                                <span class="font-bold text-slate-900 capitalize">{{ $booking->meal_upgrade }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kendaraan & Pengemudi -->
                <div class="px-6 sm:px-10 pb-6 sm:pb-10">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        Detail Kendaraan & Pengemudi
                    </h3>
                    <div class="bg-slate-50 rounded-2xl border border-slate-100 p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Nama Sopir</p>
                            <p class="font-bold text-slate-900">{{ $booking->driver_name ?? 'Menunggu Penugasan' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Nomor HP Sopir</p>
                            <p class="font-bold text-slate-900">{{ $booking->driver_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Plat Nomor</p>
                            <p class="font-bold text-slate-900">{{ $booking->license_plate ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Warna Kendaraan</p>
                            <p class="font-bold text-slate-900 capitalize">{{ $booking->car_color ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Harga & Aksi -->
                <div class="bg-slate-50 p-6 sm:p-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="w-full md:w-auto border-b border-slate-200 md:border-b-0 pb-4 md:pb-0">
                        <p class="text-sm text-slate-500 mb-1">Total Pembayaran</p>
                        <p class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        @if($booking->payment_method)
                            <p class="text-sm text-slate-500 mt-1">Metode: <span class="font-medium text-slate-700 capitalize">{{ str_replace('_', ' ', $booking->payment_method) }}</span></p>
                        @endif
                    </div>
                    
                    @if(in_array($booking->payment_status, ['unpaid', 'pending']))
                        <a href="{{ route('shuttle.payment', $booking->booking_code) }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 shadow-sm transition-all">
                            {{ $booking->payment_method ? 'Lihat Pembayaran' : 'Lanjutkan Pembayaran' }}
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                            <a href="{{ route('shuttle.print', $booking->booking_code) }}" target="_blank" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3.5 border border-slate-300 shadow-sm text-sm sm:text-base font-medium rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all">
                                <svg class="mr-2 -ml-1 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Struk Thermal (58mm)
                            </a>
                            <a href="{{ route('shuttle.pdf', $booking->booking_code) }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3.5 border border-transparent shadow-sm text-sm sm:text-base font-medium rounded-xl text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all">
                                <svg class="mr-2 -ml-1 w-5 h-5 text-sky-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak Tiket (PDF)
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
