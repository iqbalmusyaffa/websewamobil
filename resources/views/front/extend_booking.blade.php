<x-front-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <a href="{{ route('bookings.show', $booking) }}"
               class="inline-flex items-center gap-2 text-sky-400 hover:text-sky-300 mb-8 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Detail Pesanan
            </a>

            {{-- Header Card --}}
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 mb-6 shadow-2xl">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-sky-500/20 flex items-center justify-center text-3xl">🔄</div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-white">Perpanjang Masa Sewa</h1>
                        <p class="text-sky-300 text-sm">Pesanan #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                {{-- Booking Summary --}}
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="bg-white/5 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 uppercase tracking-widest mb-1">Kendaraan</p>
                        <p class="font-bold text-white">{{ $booking->car->brand }} {{ $booking->car->name }}</p>
                    </div>
                    <div class="bg-white/5 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 uppercase tracking-widest mb-1">Berakhir Saat Ini</p>
                        <p class="font-bold text-amber-300">{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                    </div>
                    <div class="bg-white/5 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 uppercase tracking-widest mb-1">Harga / Hari</p>
                        <p class="font-bold text-sky-300">
                            Rp {{ number_format($booking->with_driver ? $booking->car->price_with_driver : $booking->car->price_without_driver, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white/5 rounded-2xl p-4">
                        <p class="text-xs text-slate-400 uppercase tracking-widest mb-1">Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                            {{ $booking->status === 'berjalan' ? 'bg-indigo-500/20 text-indigo-300' : 'bg-emerald-500/20 text-emerald-300' }}">
                            {{ $booking->status === 'berjalan' ? '🚗 Sedang Berjalan' : '✅ Disetujui' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Alert Jika Ada Perpanjangan Sebelumnya --}}
            @if($booking->extensions->isNotEmpty())
            <div class="bg-amber-500/10 border border-amber-500/30 rounded-2xl p-4 mb-6">
                <p class="text-amber-300 font-semibold text-sm mb-2">📋 Riwayat Perpanjangan Sebelumnya</p>
                <div class="space-y-2">
                    @foreach($booking->extensions as $ext)
                    <div class="flex justify-between items-center text-sm text-slate-300">
                        <span>+{{ $ext->extra_days }} hari → s/d {{ $ext->new_end_date->format('d M Y') }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold
                            {{ $ext->status === 'approved' ? 'bg-emerald-500/20 text-emerald-300' : ($ext->status === 'rejected' ? 'bg-red-500/20 text-red-300' : 'bg-amber-500/20 text-amber-300') }}">
                            {{ $ext->status_label }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Alert Errors --}}
            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 rounded-2xl p-4 mb-6 text-red-300 text-sm">
                ❌ {{ session('error') }}
            </div>
            @endif

            {{-- Form Perpanjangan --}}
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-2xl"
                 x-data="{
                    extraDays: 1,
                    dailyRate: {{ $booking->with_driver ? $booking->car->price_with_driver : $booking->car->price_without_driver }},
                    get extraPrice() { return this.extraDays * this.dailyRate; },
                    get newEndDate() {
                        const d = new Date('{{ $booking->end_date->format('Y-m-d') }}');
                        d.setDate(d.getDate() + parseInt(this.extraDays));
                        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
                    },
                    formatRupiah(num) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
                    }
                 }">
                <h2 class="text-lg font-bold text-white mb-6">📝 Form Perpanjangan</h2>

                <form action="{{ route('bookings.extend.process', $booking) }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Pilih Jumlah Hari --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">
                            ⏱️ Tambah Berapa Hari?
                        </label>
                        {{-- Quick Select Buttons --}}
                        <div class="grid grid-cols-4 gap-2 mb-4">
                            @foreach([1, 2, 3, 5, 7, 10, 14, 30] as $d)
                            <button type="button"
                                @click="extraDays = {{ $d }}"
                                :class="extraDays == {{ $d }} ? 'bg-sky-500 text-white border-sky-500' : 'bg-white/5 text-slate-300 border-white/20 hover:bg-white/10'"
                                class="py-2.5 rounded-xl border text-sm font-bold transition-all">
                                {{ $d }}h
                            </button>
                            @endforeach
                        </div>
                        {{-- Manual Input --}}
                        <div class="flex items-center gap-3">
                            <button type="button" @click="if(extraDays > 1) extraDays--"
                                class="w-10 h-10 rounded-xl bg-white/10 text-white font-bold text-lg hover:bg-white/20 transition flex items-center justify-center">−</button>
                            <input type="number" name="extra_days" x-model="extraDays"
                                min="1" max="30"
                                class="flex-1 text-center bg-white/10 border border-white/20 rounded-xl py-2.5 text-white font-bold text-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            <button type="button" @click="if(extraDays < 30) extraDays++"
                                class="w-10 h-10 rounded-xl bg-white/10 text-white font-bold text-lg hover:bg-white/20 transition flex items-center justify-center">+</button>
                        </div>
                        @error('extra_days') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Preview Biaya --}}
                    <div class="bg-gradient-to-r from-sky-500/20 to-blue-500/20 border border-sky-500/30 rounded-2xl p-5">
                        <p class="text-sky-300 font-semibold text-sm mb-4">💰 Estimasi Perpanjangan</p>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-300">Tanggal Berakhir Baru</span>
                                <span class="font-bold text-amber-300" x-text="newEndDate"></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-300">Durasi Perpanjangan</span>
                                <span class="font-bold text-white"><span x-text="extraDays"></span> hari</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-300">Tarif / Hari</span>
                                <span class="font-bold text-white" x-text="formatRupiah(dailyRate)"></span>
                            </div>
                            <div class="border-t border-sky-500/30 pt-3 flex justify-between">
                                <span class="font-bold text-white">Total Biaya Tambahan</span>
                                <span class="text-xl font-extrabold text-emerald-400" x-text="formatRupiah(extraPrice)"></span>
                            </div>
                        </div>
                        <p class="text-xs text-sky-400/70 mt-3 italic">*Estimasi biaya. Pembayaran akan dikonfirmasi oleh admin setelah persetujuan.</p>
                    </div>

                    {{-- Alasan (Opsional) --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">💬 Alasan Perpanjangan (opsional)</label>
                        <textarea name="reason" rows="3"
                            placeholder="Contoh: Perjalanan bisnis diperpanjang, ada acara tambahan, dll."
                            class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:ring-2 focus:ring-sky-500 focus:border-transparent text-sm">{{ old('reason') }}</textarea>
                    </div>

                    {{-- Info --}}
                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4 text-sm text-blue-300">
                        <p class="font-semibold mb-1">ℹ️ Informasi Penting</p>
                        <ul class="space-y-1 text-xs text-blue-400 list-disc list-inside">
                            <li>Perpanjangan perlu disetujui oleh admin terlebih dahulu</li>
                            <li>Ketersediaan unit akan dicek secara otomatis</li>
                            <li>Pembayaran biaya tambahan akan diinformasikan setelah persetujuan</li>
                            <li>Maksimal perpanjangan 30 hari per pengajuan</li>
                        </ul>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-sky-500 to-blue-600 text-white font-extrabold text-lg rounded-2xl hover:from-sky-400 hover:to-blue-500 transition-all shadow-lg shadow-sky-500/30 hover:-translate-y-0.5">
                        🚀 Ajukan Perpanjangan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-front-layout>
