<x-front-layout>
    <div class="bg-slate-50 min-h-screen py-12" x-data="{ activeTab: '{{ request('tab', 'cars') }}' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">📋 Riwayat Pesanan</h1>
                    <p class="mt-2 text-slate-500">Pantau status penyewaan kendaraan Anda di sini.</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="mb-6 border-b border-slate-200">
                <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                    <button @click="activeTab = 'cars'" :class="{'border-sky-500 text-sky-600': activeTab === 'cars', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': activeTab !== 'cars'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Sewa Mobil
                    </button>
                    <button @click="activeTab = 'shuttle'" :class="{'border-sky-500 text-sky-600': activeTab === 'shuttle', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': activeTab !== 'shuttle'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Travel Shuttle
                    </button>
                    <button @click="activeTab = 'airport'" :class="{'border-sky-500 text-sky-600': activeTab === 'airport', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': activeTab !== 'airport'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        Antar Jemput Bandara
                    </button>
                </nav>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="ml-3 text-sm font-semibold text-emerald-800">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Cars Tab -->
            <div x-show="activeTab === 'cars'" class="bg-white shadow-xl shadow-slate-200/40 rounded-3xl overflow-hidden border border-slate-100">
                <ul role="list" class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                        <li class="p-6 hover:bg-slate-50 transition-colors">
                            <!-- Status Timeline -->
                            <div class="mb-4 pb-4 border-b border-slate-100">
                                <div class="flex items-center justify-between text-xs mb-3">
                                    <span class="font-bold text-slate-700">Status Pesanan</span>
                                    <span class="text-slate-500">ORDER #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    @php
                                        $statuses = [
                                            'pending' => 'Review',
                                            'menunggu pembayaran' => 'Bayar',
                                            'disetujui' => 'Approve',
                                            'berjalan' => 'Jalan',
                                            'selesai' => 'Selesai',
                                            'dibatalkan' => 'Cancel'
                                        ];
                                        $statusKeys = array_keys($statuses);
                                        $currentIndex = array_search($booking->status, $statusKeys);
                                    @endphp
                                    @foreach($statuses as $status => $label)
                                        @php
                                            $index = array_search($status, $statusKeys);
                                            $isCompleted = $index <= $currentIndex;
                                            $isCurrent = $index === $currentIndex;
                                        @endphp
                                        <div class="flex flex-col items-center flex-1">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-bold
                                                {{ $isCompleted ? 'bg-sky-600' : 'bg-slate-200' }}">
                                                ✓
                                            </div>
                                            <span class="text-xs text-slate-600 mt-1 text-center leading-tight">{{ $label }}</span>
                                        </div>
                                        @if(!$loop->last)
                                        <div class="flex-1 h-0.5 mx-0.5 {{ $isCompleted ? 'bg-sky-600' : 'bg-slate-200' }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main Info -->
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                                <!-- Info Mobil -->
                                <div class="flex items-center gap-4">
                                    <div class="w-24 h-16 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 shadow-sm">
                                        <img src="{{ $booking->car->image_url ?? 'https://via.placeholder.com/150' }}" alt="Car" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-sky-600 uppercase tracking-wider mb-1">{{ $booking->car->brand }}</p>
                                        <h3 class="text-lg font-bold text-slate-900">{{ $booking->car->name }}</h3>
                                        <p class="text-sm text-slate-500 flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Status Badge & Actions -->
                                <div class="flex flex-col items-start lg:items-end gap-3">
                                    @php
                                        $statusClass = match($booking->status) {
                                            'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
                                            'menunggu pembayaran' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'disetujui' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                            'berjalan' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            'selesai' => 'bg-slate-100 text-slate-800 border-slate-200',
                                            'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                                            'pending_review' => 'bg-orange-100 text-orange-800 border-orange-200',
                                            default => 'bg-slate-100 text-slate-800 border-slate-200'
                                        };
                                    @endphp
                                    <div class="flex flex-col items-start lg:items-end gap-2 w-full lg:w-auto">
                                        <div class="flex gap-2 items-center flex-wrap">
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $statusClass }}">
                                                {{ match($booking->status) {
                                                    'pending' => '⏳ ' . $booking->status,
                                                    'menunggu pembayaran' => '💳 ' . $booking->status,
                                                    'disetujui' => '✓ ' . $booking->status,
                                                    'berjalan' => '🚗 ' . $booking->status,
                                                    'selesai' => '✓ ' . $booking->status,
                                                    'dibatalkan' => '✗ ' . $booking->status,
                                                    'pending_review' => '⏳ Review Cancel',
                                                    default => $booking->status
                                                } }}
                                            </span>

                                            <!-- Refund Badge (jika dibatalkan) -->
                                            @if($booking->status === 'dibatalkan' || $booking->status === 'pending_review')
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-green-100 text-green-800">
                                                💰 Rp {{ number_format($booking->refund_amount ?? 0, 0, ',', '.') }}
                                            </span>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-2 flex-wrap">
                                            <a href="{{ route('bookings.show', $booking) }}" class="text-sm font-bold text-slate-600 hover:text-sky-600 bg-white border border-slate-200 px-4 py-2 rounded-lg hover:border-sky-300 transition-colors">
                                                📖 Detail
                                            </a>
                                            @if($booking->status === 'menunggu pembayaran')
                                                <a href="{{ route('payment.show', $booking) }}" class="text-sm font-bold text-white bg-sky-600 hover:bg-sky-700 px-4 py-2 rounded-lg transition-colors">
                                                    💳 Bayar Sekarang
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="lg:mt-2 lg:text-right">
                                        <p class="text-xs text-slate-500 font-medium">Total Pembayaran</p>
                                        <p class="text-xl font-black text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-16 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Pesanan</h3>
                            <p class="text-slate-500 mb-6">Anda belum pernah melakukan penyewaan kendaraan.</p>
                            <a href="{{ route('cars.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-sky-600 shadow-lg transition-colors">
                                🚗 Mulai Sewa Mobil
                            </a>
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Shuttle Tab -->
            <div x-show="activeTab === 'shuttle'" x-cloak class="bg-white shadow-xl shadow-slate-200/40 rounded-3xl overflow-hidden border border-slate-100">
                <ul role="list" class="divide-y divide-slate-100">
                    @forelse($shuttleBookings as $booking)
                        <li class="p-6 hover:bg-slate-50 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                                <div class="flex items-start sm:items-center gap-4 flex-1 min-w-0">
                                    <div class="flex-shrink-0 h-16 w-16 relative rounded-md overflow-hidden bg-sky-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-bold text-slate-900 truncate">{{ $booking->route->origin_city ?? 'Origin' }} - {{ $booking->route->destination_city ?? 'Dest' }}</p>
                                        <p class="mt-1 flex items-center text-sm text-slate-500">
                                            <span class="truncate">Tanggal Berangkat: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($booking->travel_date)->translatedFormat('d M Y') }}</span></span>
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Booking Code: <span class="font-bold text-slate-700">{{ $booking->booking_code }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start sm:items-end gap-3 sm:pl-0">
                                    <div class="text-left sm:text-right">
                                        <p class="text-xs text-slate-500 font-medium">Total Pembayaran</p>
                                        <p class="text-xl font-black text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if($booking->payment_method && in_array($booking->payment_status, ['unpaid', 'pending']))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 uppercase tracking-wider">⏳ Menunggu Review</span>
                                        @elseif(in_array($booking->payment_status, ['unpaid', 'pending']))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 uppercase tracking-wider">💳 Menunggu Bayar</span>
                                        @elseif($booking->payment_status == 'paid')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wider">✓ Lunas</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800 uppercase tracking-wider">{{ ucfirst($booking->payment_status) }}</span>
                                        @endif

                                        <a href="{{ route('shuttle.show', $booking->booking_code) }}" class="text-sm font-bold text-slate-600 hover:text-sky-600 bg-white border border-slate-200 px-3 py-1.5 rounded-lg hover:border-sky-300 transition-colors">
                                            📖 Detail
                                        </a>
                                        @if(in_array($booking->payment_status, ['unpaid', 'pending']) && !$booking->payment_method)
                                            <a href="{{ route('shuttle.payment', $booking->booking_code) }}" class="text-sm font-bold text-white bg-sky-600 hover:bg-sky-700 px-3 py-1.5 rounded-lg transition-colors">
                                                💳 Bayar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-16 text-center">
                            <div class="w-20 h-20 bg-sky-50 rounded-full flex items-center justify-center mx-auto mb-4 text-sky-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Pesanan Travel Shuttle</h3>
                            <p class="text-slate-500 mb-6">Anda belum pernah memesan tiket travel shuttle.</p>
                            <a href="{{ route('shuttle.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-sky-600 hover:bg-sky-700 shadow-lg transition-colors">
                                🚐 Cari Tiket Shuttle
                            </a>
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Airport Tab -->
            <div x-show="activeTab === 'airport'" x-cloak class="bg-white shadow-xl shadow-slate-200/40 rounded-3xl overflow-hidden border border-slate-100">
                <ul role="list" class="divide-y divide-slate-100">
                    @forelse($airportBookings as $booking)
                        <li class="p-6 hover:bg-slate-50 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                                <div class="flex items-start sm:items-center gap-4 flex-1 min-w-0">
                                    <div class="flex-shrink-0 h-16 w-16 relative rounded-md overflow-hidden bg-indigo-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-bold text-slate-900 truncate">{{ $booking->type === 'to_airport' ? 'Ke Bandara' : 'Dari Bandara' }}</p>
                                        <p class="mt-1 flex items-center text-sm text-slate-500">
                                            <span class="truncate">Waktu: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($booking->pickup_date)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($booking->pickup_time)->format('H:i') }}</span></span>
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Booking Code: <span class="font-bold text-slate-700">{{ $booking->booking_code }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start sm:items-end gap-3 sm:pl-0">
                                    <div class="text-left sm:text-right">
                                        <p class="text-xs text-slate-500 font-medium">Total Pembayaran</p>
                                        <p class="text-xl font-black text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if($booking->payment_method && in_array($booking->payment_status, ['unpaid', 'pending']))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 uppercase tracking-wider">⏳ Menunggu Review</span>
                                        @elseif(in_array($booking->payment_status, ['unpaid', 'pending']))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 uppercase tracking-wider">💳 Menunggu Bayar</span>
                                        @elseif($booking->payment_status == 'paid')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wider">✓ Lunas</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800 uppercase tracking-wider">{{ ucfirst($booking->payment_status) }}</span>
                                        @endif

                                        <a href="{{ route('airport-transfer.show', $booking->booking_code) }}" class="text-sm font-bold text-slate-600 hover:text-sky-600 bg-white border border-slate-200 px-3 py-1.5 rounded-lg hover:border-sky-300 transition-colors">
                                            📖 Detail
                                        </a>
                                        @if(in_array($booking->payment_status, ['unpaid', 'pending']) && !$booking->payment_method)
                                            <a href="{{ route('airport-transfer.payment', $booking->booking_code) }}" class="text-sm font-bold text-white bg-sky-600 hover:bg-sky-700 px-3 py-1.5 rounded-lg transition-colors">
                                                💳 Bayar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-16 text-center">
                            <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4 text-indigo-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Pesanan Antar Jemput</h3>
                            <p class="text-slate-500 mb-6">Anda belum pernah memesan layanan antar jemput bandara.</p>
                            <a href="{{ route('airport-transfer') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg transition-colors">
                                ✈️ Pesan Antar Jemput
                            </a>
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</x-front-layout>
