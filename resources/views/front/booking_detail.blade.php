<x-front-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{
        showCancelModal: false,
        totalPrice: {{ $booking->total_price }},
        daysUntilPickup: {{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(now()) }},
        updateRefundEstimate() {
            const category = document.querySelector('[name=cancel_category]')?.value;
            const percentage = this.calculateRefundPercentage(category);
            const amount = Math.floor((this.totalPrice * percentage) / 100);
            document.getElementById('estimate-percentage').textContent = percentage + '%';
            document.getElementById('estimate-amount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        },
        calculateRefundPercentage(category) {
            const days = this.daysUntilPickup;
            switch(category) {
                case 'exception':
                case 'force_majeure':
                    return 100;
                case 'damage':
                    return 50;
                case 'normal':
                    if (days > 7) return 100;
                    if (days >= 3) return 50;
                    return 0;
                default:
                    return 0;
            }
        }
    }">
        <!-- Header & Status -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Detail Pesanan #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 gap-3">
                @php
                    $color = match ($booking->status) {
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'menunggu pembayaran' => 'bg-blue-100 text-blue-800',
                        'disetujui' => 'bg-green-100 text-green-800',
                        'berjalan' => 'bg-indigo-100 text-indigo-800',
                        'selesai' => 'bg-gray-100 text-gray-800',
                        'dibatalkan' => 'bg-red-100 text-red-800',
                        'pending_review' => 'bg-orange-100 text-orange-800',
                        default => 'bg-gray-100 text-gray-800'
                    };
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                    {{ match ($booking->status) {
    'pending' => '⏳ Menunggu Review',
    'menunggu pembayaran' => '💳 Menunggu Bayar',
    'disetujui' => '✅ Disetujui',
    'berjalan' => '🚗 Sedang Berjalan',
    'selesai' => '✓ Selesai',
    'dibatalkan' => '✗ Dibatalkan',
    'pending_review' => '⏳ Review Pembatalan',
    default => ucfirst($booking->status)
} }}
                </span>

                <a href="{{ route('bookings.invoice', $booking) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border border-sky-300 text-sky-700 bg-white hover:bg-sky-50 transition">
                    🖨️ Cetak Invoice
                </a>

                @if(in_array($booking->status, ['disetujui', 'pending', 'menunggu pembayaran']) && $booking->canCancel())
                    <button @click="showCancelModal = true"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border border-red-300 text-red-700 bg-white hover:bg-red-50 transition">
                        ✕ Batalkan
                    </button>
                @endif

                @if($booking->canExtend())
                    <a href="{{ route('bookings.extend', $booking) }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg border border-emerald-300 text-emerald-700 bg-white hover:bg-emerald-50 transition">
                        🔄 Perpanjang Sewa
                    </a>
                @endif
            </div>
        </div>

        <!-- Status Timeline -->
        <div class="bg-white shadow-sm rounded-xl p-6 mb-8 border border-slate-100">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Status Pesanan</h3>
            <div class="flex items-center justify-between text-xs">
                @php
                    $statuses = [
                        'pending' => 'Review',
                        'menunggu pembayaran' => 'Bayar',
                        'disetujui' => 'Approve',
                        'berjalan' => 'Jalan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Cancel'
                    ];
                    $statusOrder = array_keys($statuses);
                    $currentStatusIndex = array_search($booking->status, $statusOrder);
                @endphp
                @foreach($statuses as $status => $label)
                    @php
                        $statusIndex = array_search($status, $statusOrder);
                        $isCompleted = $currentStatusIndex !== false && $statusIndex <= $currentStatusIndex;
                        $nextStatusIndex = $statusIndex + 1;
                        $isNextCompleted = $currentStatusIndex !== false && $nextStatusIndex <= $currentStatusIndex;
                    @endphp
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs
                                {{ $isCompleted ? 'bg-sky-600' : 'bg-slate-200' }}">
                            ✓
                        </div>
                        <span class="mt-1 text-slate-600">{{ $label }}</span>
                    </div>
                    @if(!$loop->last)
                        <div class="flex-1 h-0.5 mx-1 {{ $isNextCompleted ? 'bg-sky-600' : 'bg-slate-200' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Informasi Mobil -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 border border-slate-100">
            <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-slate-200">
                <h3 class="text-lg leading-6 font-bold text-gray-900">🚗 Informasi Mobil</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipe Mobil</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-semibold">
                            {{ $booking->car->brand }} {{ $booking->car->name }}</dd>
                    </div>
                    @if($booking->car_unit_id)
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Plat Nomor & Warna</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <span
                                    class="inline-block bg-sky-100 text-sky-800 px-3 py-1 rounded-lg font-bold mr-2">{{ $booking->carUnit->license_plate }}</span>
                                <span class="text-gray-600">({{ $booking->carUnit->color }})</span>
                            </dd>
                        </div>
                    @else
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Plat Nomor & Warna</dt>
                            <dd class="mt-1 text-sm text-gray-500 italic sm:mt-0 sm:col-span-2">⏳ Akan ditambahkan setelah
                                admin approve pesanan.</dd>
                        </div>
                    @endif

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Spesifikasi Kendaraan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg border border-slate-200">
                                <div>
                                    <span
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tahun</span>
                                    <span
                                        class="font-bold text-slate-900">{{ $booking->carUnit ? $booking->carUnit->year : ($booking->car->year ?? '-') }}</span>
                                </div>
                                @if($booking->car_unit_id)
                                    <div>
                                        <span
                                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Odometer</span>
                                        <span
                                            class="font-bold text-slate-900">{{ $booking->carUnit->current_odometer !== null ? number_format($booking->carUnit->current_odometer, 0, ',', '.') . ' Km' : 'Belum Tercatat' }}</span>
                                    </div>
                                @endif
                                <div>
                                    <span
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Bahan
                                        Bakar</span>
                                    <span class="font-bold text-slate-900">{{ $booking->car->fuel_type ?? '-' }}</span>
                                </div>
                                <div>
                                    <span
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Transmisi</span>
                                    <span
                                        class="font-bold text-slate-900">{{ $booking->car->transmission ?? '-' }}</span>
                                </div>
                                <div>
                                    <span
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Kapasitas</span>
                                    <span class="font-bold text-slate-900">{{ $booking->car->seats ?? '-' }}
                                        Orang</span>
                                </div>
                            </div>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 uppercase font-bold text-sky-600">
                            {{ str_replace('_', ' ', $booking->payment_method ?? 'Belum Dipilih') }}</dd>
                    </div>

                    <!-- Bank Details for Transfer Manual -->
                    @if($booking->payment_method === 'transfer_manual')
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Detail Transfer</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @php
                                    $bankDetails = [
                                        'mandiri' => ['name' => 'Mandiri', 'number' => '1234567890', 'accountName' => 'PT AUTORENT INDONESIA'],
                                        'bni' => ['name' => 'BNI', 'number' => '0987654321', 'accountName' => 'PT AUTORENT INDONESIA'],
                                        'bca' => ['name' => 'BCA', 'number' => '1122334455', 'accountName' => 'PT AUTORENT INDONESIA'],
                                        'bri' => ['name' => 'BRI', 'number' => '5566778899', 'accountName' => 'PT AUTORENT INDONESIA'],
                                    ];
                                    $selectedBank = $bankDetails['mandiri'];
                                @endphp
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-2">
                                    <div class="space-y-2 text-sm">
                                        <p><strong>🏦 Bank:</strong> {{ $selectedBank['name'] }}</p>
                                        <p><strong>🔢 Nomor Rekening:</strong> <code
                                                class="bg-white px-2 py-1 rounded font-mono text-xs">{{ $selectedBank['number'] }}</code>
                                        </p>
                                        <p><strong>👤 Atas Nama:</strong> {{ $selectedBank['accountName'] }}</p>
                                        <p><strong>💰 Jumlah Transfer:</strong> <span class="font-bold text-emerald-600">Rp
                                                {{ number_format($booking->total_price, 0, ',', '.') }}</span></p>
                                    </div>
                                </div>
                            </dd>
                        </div>

                        <!-- Transfer Proof -->
                        @if($booking->payment_method === 'transfer_manual' && ($booking->proof_image || $booking->proof_link))
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Bukti Transfer</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="space-y-3">
                                        @if($booking->proof_image)
                                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                                <p class="text-xs font-bold text-slate-600 mb-2">📸 Gambar Bukti</p>
                                                <img src="{{ Storage::url($booking->proof_image) }}" alt="Bukti Transfer"
                                                    class="max-w-xs rounded-lg shadow-sm">
                                                <a href="{{ Storage::url($booking->proof_image) }}" target="_blank"
                                                    class="text-sky-600 hover:text-sky-700 text-xs mt-2 inline-block">Buka gambar
                                                    ukuran penuh →</a>
                                            </div>
                                        @endif

                                        @if($booking->proof_link)
                                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                                <p class="text-xs font-bold text-slate-600 mb-2">🔗 Link Bukti</p>
                                                <a href="{{ $booking->proof_link }}" target="_blank"
                                                    class="text-sky-600 hover:text-sky-700 break-all text-sm">{{ $booking->proof_link }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </dd>
                            </div>
                        @endif
                    @endif
                </dl>
            </div>
        </div>

        <!-- Informasi Sewa -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 border border-slate-100">
            <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-slate-200">
                <h3 class="text-lg leading-6 font-bold text-gray-900">📅 Informasi Sewa</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal & Durasi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <strong>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</strong> s/d
                            <strong>{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</strong>
                            <br><span
                                class="text-slate-600">({{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) + 1 }}
                                Hari)</span>
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Mode Pengambilan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($booking->pickup_mode === 'pickup_branch')
                                <span
                                    class="inline-block bg-sky-100 text-sky-800 px-3 py-1 rounded-lg text-sm font-semibold mb-2">🏢
                                    Ambil di Cabang</span>
                                @if($booking->branch)
                                    <div class="mt-1 text-sm text-slate-700">
                                        <p class="font-semibold">{{ $booking->branch->name }}</p>
                                        <p class="text-slate-500">📍 {{ $booking->branch->address }}</p>
                                        @if($booking->branch->phone)
                                            <p class="text-sky-600">📞 {{ $booking->branch->phone }}</p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <span
                                    class="inline-block bg-emerald-100 text-emerald-800 px-3 py-1 rounded-lg text-sm font-semibold mb-2">🏠
                                    Antar ke Alamat</span>
                                <p class="text-sm text-slate-700 mt-1">
                                    {{ $booking->delivery_address ?? $booking->pickup_location }}</p>
                            @endif
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Opsi Layanan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($booking->with_driver)
                                <span
                                    class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-lg text-sm font-medium">👤
                                    Dengan Sopir</span>
                            @else
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-sm font-medium">🔑
                                    Lepas Kunci</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- INFO SOPIR (BARU) -->
        @if($booking->with_driver && $booking->driver)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 border border-slate-100">
                <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-slate-200">
                    <h3 class="text-lg leading-6 font-bold text-gray-900">👤 Informasi Sopir</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Nama Sopir</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-semibold">
                                {{ $booking->driver->name }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="tel:{{ $booking->driver->phone }}"
                                    class="text-sky-600 hover:text-sky-700 font-semibold">
                                    📞 {{ $booking->driver->phone }}
                                </a>
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Status Sopir</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if($booking->driver->status === 'available')
                                    <span
                                        class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-lg text-sm font-medium">✓
                                        Tersedia</span>
                                @elseif($booking->driver->status === 'busy')
                                    <span
                                        class="inline-block bg-orange-100 text-orange-800 px-3 py-1 rounded-lg text-sm font-medium">🚗
                                        Sedang Mengantar</span>
                                @else
                                    <span
                                        class="inline-block bg-slate-100 text-slate-800 px-3 py-1 rounded-lg text-sm font-medium">📴
                                        Libur</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endif

        <!-- BANTUAN & LAPORAN (BARU) -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8 border border-slate-100">
            <div class="px-4 py-5 sm:px-6 bg-rose-50 border-b border-rose-100 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-bold text-rose-900">🚨 Pusat Bantuan & Laporan</h3>
                <span class="text-xs font-semibold text-rose-700 bg-rose-100 px-2 py-1 rounded-full">Layanan 24
                    Jam</span>
            </div>
            <div class="px-4 py-5 sm:p-6 grid md:grid-cols-2 gap-4">
                <!-- Komplain Pelayanan -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex gap-4">
                    <div class="text-3xl shrink-0">🗣️</div>
                    <div>
                        <h4 class="font-bold text-amber-900 mb-1">Komplain Pelayanan</h4>
                        <p class="text-sm text-amber-800 mb-3">Sopir tidak ramah, mobil kurang bersih, fasilitas kurang,
                            atau kendala pelayanan lainnya.</p>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20AutoRent,%20saya%20ingin%20menyampaikan%20komplain%20pelayanan%20terkait%20pesanan%20%23{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}.%0A%0AKendala%20yang%20dialami:%20..."
                            target="_blank"
                            class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-lg bg-amber-500 text-white hover:bg-amber-600 transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.393.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.129.332.202.043.073.043.423-.101.827z">
                                </path>
                            </svg>
                            Komplain via WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Darurat / Kecelakaan -->
                <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 flex gap-4">
                    <div class="text-3xl shrink-0">⚠️</div>
                    <div>
                        <h4 class="font-bold text-rose-900 mb-1">Darurat & Kecelakaan</h4>
                        <p class="text-sm text-rose-800 mb-3">Mobil mogok di jalan, terjadi kecelakaan, atau kondisi
                            darurat bencana alam.</p>
                        <a href="https://wa.me/6281234567890?text=URGENT%20AutoRent!%20Saya%20mengalami%20keadaan%20darurat%20pada%20pesanan%20%23{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}.%0A%0AJenis%20Darurat%20(Kecelakaan/Mogok/Bencana):%20...%0ALokasi%20Saat%20Ini:%20...%0AKondisi%20Penumpang:%20..."
                            target="_blank"
                            class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-lg bg-rose-600 text-white hover:bg-rose-700 transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            Lapor Darurat Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEBIJAKAN PEMBATALAN (BARU) -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 shadow-sm rounded-xl p-6 mb-8 border border-blue-100">
            <h3 class="text-lg font-bold text-blue-900 mb-4">📋 Kebijakan Pembatalan & Refund</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Deadline Cancel -->
                <div class="bg-white rounded-lg p-4 border border-blue-100">
                    <div class="flex items-start gap-3">
                        <div class="text-2xl">⏰</div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-slate-900 mb-1">Deadline Pembatalan</h4>
                            @php
                                $deadline = $booking->getCancelDeadline();
                                $canCancel = $booking->canCancel();
                            @endphp
                            <p class="text-sm text-slate-600 mb-2">
                                Harus dibatalkan sebelum: <strong>{{ $deadline->format('d M Y H:i') }}</strong>
                            </p>
                            @if($canCancel)
                                <span
                                    class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">✓
                                    Masih bisa dibatalkan</span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">✗
                                    Sudah lewat deadline</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Refund Info -->
                <div class="bg-white rounded-lg p-4 border border-blue-100">
                    <div class="flex items-start gap-3">
                        <div class="text-2xl">💰</div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-slate-900 mb-2">Estimasi Refund</h4>
                            <div class="space-y-1 text-sm text-slate-600">
                                <div>Rp {{ number_format($booking->total_price, 0, ',', '.') }} × <strong
                                        id="refund-percentage">0</strong>% = <strong id="refund-amount">Rp 0</strong>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">Bergantung kategori pembatalan Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refund Policy Details -->
            <div class="mt-4 bg-white rounded-lg p-4 border border-blue-100">
                <p class="text-sm font-semibold text-slate-900 mb-3">Rincian Kebijakan Refund:</p>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li class="flex items-start gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span><strong>&gt; 7 hari sebelum pickup:</strong> Refund <strong>100%</strong></span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-600 font-bold">~</span>
                        <span><strong>3-7 hari sebelum pickup:</strong> Refund <strong>50%</strong></span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-600 font-bold">✗</span>
                        <span><strong>&lt; 3 hari sebelum pickup:</strong> Refund <strong>0%</strong> (tidak ada
                            refund)</span>
                    </li>
                    <li class="flex items-start gap-2 mt-3 pt-3 border-t border-slate-200">
                        <span class="text-sky-600 font-bold">⭐</span>
                        <span><strong>Exception (Alasan Rental):</strong> Refund <strong>100%</strong> (armada kurang,
                            sopir kurang, service jelek)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-purple-600 font-bold">⭐</span>
                        <span><strong>Force Majeure:</strong> Refund <strong>100%</strong> (bencana alam, situasi
                            emergency)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- REFUND STATUS (jika sudah dibatalkan) -->
        @if($booking->status === 'dibatalkan' || $booking->status === 'pending_review')
                <div
                    class="bg-white shadow-sm rounded-xl p-6 mb-8 border-l-4 {{ $booking->status === 'dibatalkan' ? 'border-l-red-500' : 'border-l-orange-500' }} border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">📊 Status Pembatalan & Refund</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Refund Details -->
                        <div>
                            <h4 class="font-semibold text-slate-700 mb-3">Rincian Pembatalan</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between py-2 border-b border-slate-200">
                                    <span class="text-slate-600">Kategori</span>
                                    <span class="font-semibold text-slate-900">
                                        {{ match ($booking->cancel_category) {
                'exception' => '🏢 Exception (Pihak Rental)',
                'force_majeure' => '🌪️ Force Majeure',
                'damage' => '💔 Kerusakan/Damage',
                'normal' => '👤 Normal (Customer)',
                default => '❓ ' . $booking->cancel_category
            } }}
                                    </span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-slate-200">
                                    <span class="text-slate-600">Persentase Refund</span>
                                    <span class="font-bold text-sky-600 text-lg">{{ $booking->refund_percentage ?? 0 }}%</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-slate-200">
                                    <span class="text-slate-600">Jumlah Refund</span>
                                    <span class="font-bold text-green-600 text-lg">Rp
                                        {{ number_format($booking->refund_amount ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-slate-600">Metode Refund</span>
                                    <span
                                        class="font-semibold">{{ $booking->refund_method === 'wallet_credit' ? '💳 Wallet Credit' : '🏦 Transfer Bank' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <h4 class="font-semibold text-slate-700 mb-3">Status Proses</h4>
                            <div class="space-y-3">
                                @if($booking->status === 'pending_review')
                                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                        <p class="text-orange-800 font-semibold mb-1">⏳ Menunggu Review Admin</p>
                                        <p class="text-sm text-orange-700">Pembatalan Anda sedang dalam proses review. Admin akan
                                            mengkonfirmasi dalam 1-2 jam kerja.</p>
                                    </div>
                                @elseif($booking->status === 'dibatalkan')
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <p class="text-green-800 font-semibold mb-1">✓ Pembatalan Disetujui</p>
                                        <p class="text-sm text-green-700">Refund akan diproses dalam
                                            {{ $booking->refund_method === 'wallet_credit' ? '1-24 jam' : '1-3 hari kerja' }}.</p>
                                    </div>
                                @endif

                                @if($booking->cancelled_reason)
                                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                        <p class="text-sm font-semibold text-slate-700 mb-2">Alasan Pembatalan:</p>
                                        <p class="text-sm text-slate-600">{{ $booking->cancelled_reason }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        @endif

        <!-- EXTENSION HISTORY -->
        @if($booking->extensions && $booking->extensions->isNotEmpty())
            <div class="bg-white shadow-sm border border-slate-100 rounded-xl mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-sky-50 flex justify-between items-center">
                    <h3 class="text-base font-bold text-sky-900">🔄 Riwayat Perpanjangan Sewa</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach($booking->extensions as $ext)
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Tambah {{ $ext->extra_days }} Hari</p>
                                <p class="text-xs text-slate-500 mt-1">Sampai dengan {{ $ext->new_end_date->format('d M Y') }}
                                </p>
                                @if($ext->reason)
                                    <p class="text-xs text-slate-500 mt-1 italic">Alasan: {{ $ext->reason }}</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-slate-900">Rp
                                    {{ number_format($ext->extra_price, 0, ',', '.') }}</p>
                                <p
                                    class="text-xs mt-1 font-semibold
                                    {{ $ext->status === 'approved' ? 'text-emerald-600' : ($ext->status === 'rejected' ? 'text-red-600' : 'text-amber-500') }}">
                                    {{ $ext->status_label }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Addons & Promo & Deposit Summary -->
        @if($booking->addons->isNotEmpty() || $booking->discount_amount > 0 || $booking->deposit_amount > 0)
            <div class="bg-white shadow-sm border border-slate-100 rounded-xl mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h3 class="text-base font-bold text-slate-900">💰 Rincian Tambahan & Potongan</h3>
                </div>
                <div class="px-6 py-4 space-y-3 text-sm">
                    @if($booking->addons->isNotEmpty())
                        <div>
                            <p class="font-semibold text-slate-700 mb-2">Layanan Tambahan:</p>
                            @foreach($booking->addons as $addon)
                                <div class="flex justify-between text-slate-600 py-1">
                                    <span>{{ $addon->icon ?? '' }} {{ $addon->name }}</span>
                                    <span>Rp {{ number_format($addon->pivot->price, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($booking->discount_amount > 0)
                        <div
                            class="flex justify-between text-emerald-600 font-semibold pt-2 {{ $booking->addons->isNotEmpty() ? 'border-t border-slate-100' : '' }}">
                            <span>🎟️ Diskon Promo {{ $booking->promoCode?->code }}</span>
                            <span>- Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if($booking->deposit_amount > 0)
                        <div
                            class="flex justify-between text-slate-600 font-semibold pt-2 {{ ($booking->addons->isNotEmpty() || $booking->discount_amount > 0) ? 'border-t border-slate-100' : '' }}">
                            <span>🛡️ Uang Deposit (Jaminan)</span>
                            <span>Rp {{ number_format($booking->deposit_amount, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1 italic">*Uang deposit akan dikembalikan 100% setelah unit kembali
                            dengan aman.</p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Total Tagihan -->
        <div class="bg-gradient-to-r from-sky-500 to-sky-600 shadow-lg overflow-hidden rounded-xl mb-8 text-white">
            <div class="px-6 py-6 border-b border-sky-400">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg leading-6 font-bold opacity-90">💳 Total Tagihan Sewa</h3>
                    <span class="text-2xl font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>

                @if($booking->dp_amount > 0)
                    <div class="flex justify-between items-center mb-2 text-sky-100 text-sm">
                        <span>Sudah Dibayar (DP)</span>
                        <span class="font-semibold">- Rp {{ number_format($booking->dp_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-sky-400 mt-2">
                        <div>
                            <span class="text-lg font-bold">Sisa Pembayaran</span>
                            <p class="text-xs text-sky-100 opacity-80 mt-1">Harus dilunasi sebelum pengambilan unit</p>
                        </div>
                        <span class="text-4xl font-extrabold text-yellow-300">Rp
                            {{ number_format(max(0, $booking->total_price - $booking->dp_amount), 0, ',', '.') }}</span>
                    </div>
                @else
                    <div class="flex justify-between items-center pt-4 border-t border-sky-400 mt-2">
                        <div>
                            <span class="text-lg font-bold">Yang Harus Dibayar</span>
                            <p class="text-xs text-sky-100 opacity-80 mt-1">Harga akhir yang harus dilunasi</p>
                        </div>
                        <span class="text-4xl font-extrabold text-yellow-300">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>

            @if($booking->status === 'menunggu pembayaran')
                <div class="border-t border-sky-400 px-6 py-5 text-center bg-sky-500 bg-opacity-50">
                    <p class="text-sky-100 mb-4 font-medium">Silakan selesaikan pembayaran untuk mengkonfirmasi pesanan
                        Anda.</p>
                    <a href="{{ route('payment.show', $booking) }}"
                        class="inline-flex items-center px-6 py-3 border border-white text-base font-bold rounded-xl shadow-sm text-sky-600 bg-white hover:bg-slate-100 transition-colors">
                        💳 Bayar Sekarang →
                    </a>
                </div>
            @elseif($booking->status === 'pending')
                <div class="border-t border-sky-400 px-6 py-5 text-center bg-sky-500 bg-opacity-50">
                    <p class="text-sky-100 font-medium">⏳ Pesanan Anda sedang direview oleh Admin. Mohon tunggu.</p>
                </div>
            @endif
        </div>

        <!-- Review Form -->
        @if($booking->status === 'selesai')
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
                @if($booking->review)
                    <h3 class="text-lg font-bold text-slate-900 mb-4">⭐ Ulasan & Kuesioner Anda</h3>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <!-- Kuesioner Cabang -->
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-3">🏢 Layanan Cabang</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Kualitas Pelayanan</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                class="text-lg {{ $i <= ($booking->review->service_rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Keramahan Staf</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                class="text-lg {{ $i <= ($booking->review->friendliness_rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kuesioner Kendaraan -->
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-3">🚗 Kondisi Kendaraan</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Kebersihan</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                class="text-lg {{ $i <= ($booking->review->cleanliness_rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Kenyamanan</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                class="text-lg {{ $i <= ($booking->review->comfort_rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Kondisi Mesin</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                class="text-lg {{ $i <= ($booking->review->car_condition_rating ?? 0) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <h4 class="font-bold text-slate-800 mb-2">Penilaian Umum Keseluruhan</h4>
                        <div class="flex items-center gap-1 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $booking->review->rating ? 'text-amber-400' : 'text-slate-200' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-600">{{ $booking->review->comment ?? 'Tidak ada komentar.' }}</p>
                    </div>
                @else
                        <h3 class="text-lg font-bold text-slate-900 mb-1">📋 Kuesioner & Ulasan Pengalaman Anda</h3>
                        <p class="text-slate-500 text-sm mb-5">Feedback Anda sangat berarti untuk meningkatkan kualitas layanan
                            AutoRent ke depannya.</p>

                        @if(session('success'))
                            <div
                                class="mb-4 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 text-emerald-800 text-sm font-medium">
                                {{ session('success') }}</div>
                        @endif

                        <form action="{{ route('bookings.review', $booking) }}" method="POST" x-data="{ 
                                rating: 0, hovered: 0,
                                service_rating: 0, hovered_service: 0,
                                friendliness_rating: 0, hovered_friendliness: 0,
                                cleanliness_rating: 0, hovered_cleanliness: 0,
                                comfort_rating: 0, hovered_comfort: 0,
                                car_condition_rating: 0, hovered_condition: 0
                            }">
                            @csrf

                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <!-- Kuesioner Cabang -->
                                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                                    <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">🏢 Layanan Cabang</h4>

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Kualitas Pelayanan</label>
                                        <div class="flex gap-1">
                                            @for($star = 1; $star <= 5; $star++)
                                                <button type="button" @mouseenter="hovered_service = {{ $star }}"
                                                    @mouseleave="hovered_service = 0" @click="service_rating = {{ $star }}"
                                                    class="text-2xl transition-transform hover:scale-110 focus:outline-none">
                                                    <span
                                                        :class="(hovered_service >= {{ $star }} || service_rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="service_rating"
                                            :value="service_rating > 0 ? service_rating : ''">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Keramahan Staf</label>
                                        <div class="flex gap-1">
                                            @for($star = 1; $star <= 5; $star++)
                                                <button type="button" @mouseenter="hovered_friendliness = {{ $star }}"
                                                    @mouseleave="hovered_friendliness = 0" @click="friendliness_rating = {{ $star }}"
                                                    class="text-2xl transition-transform hover:scale-110 focus:outline-none">
                                                    <span
                                                        :class="(hovered_friendliness >= {{ $star }} || friendliness_rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="friendliness_rating"
                                            :value="friendliness_rating > 0 ? friendliness_rating : ''">
                                    </div>
                                </div>

                                <!-- Kuesioner Kendaraan -->
                                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                                    <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">🚗 Kendaraan</h4>

                                    <div class="mb-4 flex justify-between items-center">
                                        <label class="block text-sm font-semibold text-slate-700">Kebersihan</label>
                                        <div class="flex gap-1">
                                            @for($star = 1; $star <= 5; $star++)
                                                <button type="button" @mouseenter="hovered_cleanliness = {{ $star }}"
                                                    @mouseleave="hovered_cleanliness = 0" @click="cleanliness_rating = {{ $star }}"
                                                    class="text-2xl transition-transform hover:scale-110 focus:outline-none">
                                                    <span
                                                        :class="(hovered_cleanliness >= {{ $star }} || cleanliness_rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="cleanliness_rating"
                                            :value="cleanliness_rating > 0 ? cleanliness_rating : ''">
                                    </div>

                                    <div class="mb-4 flex justify-between items-center">
                                        <label class="block text-sm font-semibold text-slate-700">Kenyamanan</label>
                                        <div class="flex gap-1">
                                            @for($star = 1; $star <= 5; $star++)
                                                <button type="button" @mouseenter="hovered_comfort = {{ $star }}"
                                                    @mouseleave="hovered_comfort = 0" @click="comfort_rating = {{ $star }}"
                                                    class="text-2xl transition-transform hover:scale-110 focus:outline-none">
                                                    <span
                                                        :class="(hovered_comfort >= {{ $star }} || comfort_rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="comfort_rating"
                                            :value="comfort_rating > 0 ? comfort_rating : ''">
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <label class="block text-sm font-semibold text-slate-700">Kondisi Mesin</label>
                                        <div class="flex gap-1">
                                            @for($star = 1; $star <= 5; $star++)
                                                <button type="button" @mouseenter="hovered_condition = {{ $star }}"
                                                    @mouseleave="hovered_condition = 0" @click="car_condition_rating = {{ $star }}"
                                                    class="text-2xl transition-transform hover:scale-110 focus:outline-none">
                                                    <span
                                                        :class="(hovered_condition >= {{ $star }} || car_condition_rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="car_condition_rating"
                                            :value="car_condition_rating > 0 ? car_condition_rating : ''">
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-slate-200 pt-6">
                                <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">⭐ Penilaian Umum & Komentar</h4>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Rating Keseluruhan <span
                                            class="text-red-500">*</span></label>
                                    <div class="flex gap-2">
                                        @for($star = 1; $star <= 5; $star++)
                                            <button type="button" @mouseenter="hovered = {{ $star }}" @mouseleave="hovered = 0"
                                                @click="rating = {{ $star }}"
                                                class="text-3xl transition-transform hover:scale-110 focus:outline-none">
                                                <span
                                                    :class="(hovered >= {{ $star }} || rating >= {{ $star }}) ? 'text-amber-400' : 'text-slate-200'">★</span>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" :value="rating">
                                    @error('rating') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Komentar / Ulasan</label>
                                    <textarea name="comment" rows="3"
                                        placeholder="Ceritakan pengalaman Anda secara keseluruhan menyewa di AutoRent..."
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-3 px-4"></textarea>
                                    @error('comment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <button type="submit" :disabled="rating === 0"
                                class="px-6 py-3 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 transition disabled:opacity-50 disabled:cursor-not-allowed w-full md:w-auto">
                                Kirim Kuesioner & Ulasan
                            </button>
                        </form>
                    </div>
                @endif
        @endif
    </div>

    <!-- CANCEL BOOKING MODAL (BARU) -->
    <div x-show="showCancelModal" x-transition
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="display: none;"
        @keydown.escape="showCancelModal = false">
        <div x-show="showCancelModal" x-transition
            class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
            style="display: none;">
            <!-- Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-6 border-b border-red-400 flex justify-between items-center">
                <h2 class="text-xl font-bold">Batalkan Pesanan</h2>
                <button @click="showCancelModal = false"
                    class="text-2xl leading-none opacity-70 hover:opacity-100">&times;</button>
            </div>

            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <!-- Cancel Category Selection -->
                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">📌 Kategori Pembatalan <span
                            class="text-red-500">*</span></label>
                    <select name="cancel_category" x-on:change="updateRefundEstimate()"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="normal">👤 Normal (Customer minta cancel)</option>
                        <option value="exception">🏢 Exception (Pihak Rental: armada kurang, sopir kurang, service
                            jelek)</option>
                        <option value="force_majeure">🌪️ Force Majeure (Bencana alam, situasi emergency)</option>
                        <option value="damage">💔 Kerusakan/Damage (Ada kerusakan pada armada)</option>
                    </select>
                    @error('cancel_category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Damage Fields (visible only if category = damage) -->
                <div x-show="document.querySelector('[name=cancel_category]')?.value === 'damage'"
                    class="border-l-4 border-orange-400 bg-orange-50 p-4 rounded-lg space-y-3" style="display: none;">
                    <h4 class="font-semibold text-orange-900">💔 Informasi Kerusakan</h4>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_customer_fault"
                                class="w-4 h-4 border-slate-300 rounded focus:ring-2 focus:ring-red-500">
                            <span class="text-sm font-medium text-slate-700">Kerusakan disebabkan oleh customer
                                (saya)</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="insurance_claimed"
                                class="w-4 h-4 border-slate-300 rounded focus:ring-2 focus:ring-red-500">
                            <span class="text-sm font-medium text-slate-700">Asuransi sudah diklaim</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Kerusakan</label>
                        <textarea name="damage_description" rows="3" placeholder="Jelaskan kerusakan yang terjadi..."
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"></textarea>
                    </div>
                </div>

                <!-- Reason -->
                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">💬 Alasan Pembatalan <span
                            class="text-red-500">*</span></label>
                    <textarea name="cancelled_reason" rows="3" placeholder="Jelaskan alasan Anda membatalkan pesanan..."
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        required></textarea>
                    @error('cancelled_reason') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Refund Method -->
                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">💰 Metode Pengembalian Dana <span
                            class="text-red-500">*</span></label>
                    <div class="grid md:grid-cols-2 gap-3">
                        <label
                            class="flex items-center gap-3 p-3 border border-slate-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                            <input type="radio" name="refund_method" value="bank_transfer"
                                class="w-4 h-4 border-slate-300" checked>
                            <div>
                                <p class="font-semibold text-slate-900">🏦 Transfer Bank</p>
                                <p class="text-xs text-slate-600">1-3 hari kerja</p>
                            </div>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 border border-slate-300 rounded-lg cursor-pointer hover:bg-green-50 transition">
                            <input type="radio" name="refund_method" value="wallet_credit"
                                class="w-4 h-4 border-slate-300">
                            <div>
                                <p class="font-semibold text-slate-900">💳 Wallet Credit</p>
                                <p class="text-xs text-slate-600">Instant (bisa dipakai lagi)</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Refund Preview -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-bold text-slate-900 mb-3">📊 Estimasi Refund</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Total Tagihan</span>
                            <span class="font-semibold">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Persentase Refund</span>
                            <span id="estimate-percentage" class="font-semibold text-red-600">0%</span>
                        </div>
                        <div class="border-t border-blue-200 pt-2 flex justify-between">
                            <span class="font-bold text-slate-900">Jumlah Refund</span>
                            <span class="text-lg font-bold text-green-600" id="estimate-amount">Rp 0</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 mt-3 italic">💡 Estimasi berdasarkan kebijakan pembatalan. Jumlah
                        final bisa berubah setelah review admin.</p>
                </div>

                <!-- Deadline Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <p class="text-sm text-yellow-900">
                        <strong>⏰ Deadline Pembatalan:</strong>
                        <br>{{ $booking->getCancelDeadline()->format('d M Y H:i') }}
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t border-slate-200">
                    <button type="button" @click="showCancelModal = false"
                        class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 font-bold rounded-lg hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition">
                        ✓ Batalkan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-front-layout>