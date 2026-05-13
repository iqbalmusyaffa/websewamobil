<div class="space-y-4">
    @if($booking->payment_method === 'transfer_manual')
        @if($booking->proof_image)
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <p class="text-sm font-bold text-slate-700 mb-3">📸 Gambar Bukti Transfer</p>
            <img src="{{ Storage::url($booking->proof_image) }}" alt="Bukti Transfer" class="w-full rounded-lg shadow-md">
            <a href="{{ Storage::url($booking->proof_image) }}" target="_blank" class="text-sky-600 hover:text-sky-700 text-sm mt-3 inline-flex items-center gap-1">
                <span>Buka ukuran penuh</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
        </div>
        @endif

        @if($booking->proof_link)
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <p class="text-sm font-bold text-slate-700 mb-3">🔗 Link Bukti Transfer</p>
            <div class="flex items-center gap-2">
                <code class="flex-1 bg-white px-3 py-2 rounded border border-slate-300 text-sm break-all text-slate-900">{{ $booking->proof_link }}</code>
                <button onclick="navigator.clipboard.writeText('{{ $booking->proof_link }}')" class="px-3 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold rounded transition">
                    📋 Salin
                </button>
            </div>
            <a href="{{ $booking->proof_link }}" target="_blank" class="text-sky-600 hover:text-sky-700 text-sm mt-3 inline-flex items-center gap-1">
                <span>Buka link</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
        </div>
        @endif

        @if(!$booking->proof_image && !$booking->proof_link)
        <div class="bg-amber-50 rounded-lg p-4 border border-amber-200">
            <p class="text-sm text-amber-800">⚠️ Pelanggan belum mengunggah bukti transfer</p>
        </div>
        @endif
    @else
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <p class="text-sm text-slate-600">Bukti transfer hanya tersedia untuk metode pembayaran Transfer Manual.</p>
        </div>
    @endif

    <!-- Metode Pembayaran Info -->
    <div class="border-t border-slate-200 pt-4 mt-4">
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-slate-600 font-semibold">Metode Pembayaran:</p>
                <p class="text-slate-900 font-bold">
                    @if($booking->payment_method === 'transfer_manual')
                        🏦 Transfer Manual
                    @elseif($booking->payment_method === 'tunai')
                        💵 Tunai
                    @else
                        {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}
                    @endif
                </p>
            </div>
            <div>
                <p class="text-slate-600 font-semibold">Jumlah:</p>
                <p class="text-slate-900 font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-slate-600 font-semibold">Status:</p>
                <p class="text-slate-900 font-bold">
                    @switch($booking->status)
                        @case('pending')
                            ⏳ Menunggu Review
                            @break
                        @case('menunggu pembayaran')
                            💳 Menunggu Pembayaran
                            @break
                        @case('disetujui')
                            ✅ Disetujui
                            @break
                        @case('berjalan')
                            🚗 Berjalan
                            @break
                        @case('selesai')
                            ✓ Selesai
                            @break
                        @case('dibatalkan')
                            ✗ Dibatalkan
                            @break
                        @default
                            {{ ucfirst($booking->status) }}
                    @endswitch
                </p>
            </div>
            <div>
                <p class="text-slate-600 font-semibold">Tanggal:</p>
                <p class="text-slate-900 font-bold">{{ $booking->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
