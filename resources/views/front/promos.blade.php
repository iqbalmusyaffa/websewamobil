<x-front-layout>
<div class="bg-slate-900 pt-16 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Promo & Penawaran <span class="text-sky-500">Spesial</span></h1>
        <p class="text-lg text-slate-400 max-w-2xl mx-auto">Gunakan kode promo di bawah ini untuk mendapatkan harga terbaik untuk sewa mobil Anda selanjutnya. Jangan sampai ketinggalan!</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 mb-20 relative z-10">
    @if($promos->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Belum Ada Promo Saat Ini</h2>
            <p class="text-slate-500">Silakan kembali lagi nanti untuk melihat penawaran menarik dari AutoRent.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($promos as $promo)
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:-translate-y-1 transition-all duration-300">
                    <!-- Top section: Discount value -->
                    <div class="bg-gradient-to-br from-sky-500 to-blue-700 p-8 text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-20 h-20 bg-black/10 rounded-full blur-lg group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="relative z-10">
                            @if($promo->type == 'percent')
                                <div class="text-4xl font-extrabold text-white mb-1">{{ (float)$promo->value }}% <span class="text-lg font-medium opacity-80">OFF</span></div>
                                @if($promo->max_discount)
                                    <div class="text-sm text-sky-100">Maks. Rp {{ number_format($promo->max_discount, 0, ',', '.') }}</div>
                                @endif
                            @else
                                <div class="text-3xl font-extrabold text-white mb-1"><span class="text-xl">Rp</span> {{ number_format($promo->value, 0, ',', '.') }}</div>
                                <div class="text-sm text-sky-100">Potongan Langsung</div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bottom section: Details -->
                    <div class="p-6 flex-1 flex flex-col relative bg-white">
                        <!-- Cutout effect -->
                        <div class="absolute top-0 left-0 -mt-3 -ml-3 w-6 h-6 bg-slate-50 rounded-full z-10"></div>
                        <div class="absolute top-0 right-0 -mt-3 -mr-3 w-6 h-6 bg-slate-50 rounded-full z-10"></div>
                        <div class="absolute top-0 left-3 right-3 border-t-2 border-dashed border-slate-200"></div>

                        <h3 class="text-lg font-bold text-slate-800 mb-2 mt-2">{{ $promo->description ?? 'Promo Spesial AutoRent' }}</h3>
                        
                        <ul class="text-sm text-slate-500 space-y-2 mb-6 flex-1">
                            @if($promo->min_booking > 0)
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Min. transaksi Rp {{ number_format($promo->min_booking, 0, ',', '.') }}
                                </li>
                            @endif
                            @if($promo->valid_until)
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Berlaku hingga {{ \Carbon\Carbon::parse($promo->valid_until)->translatedFormat('d M Y') }}
                                </li>
                            @endif
                            @if($promo->quota)
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Kuota terbatas
                                </li>
                            @endif
                        </ul>

                        <div class="mt-auto">
                            <div class="text-xs text-slate-400 font-medium mb-1 uppercase tracking-wider text-center">Kode Promo</div>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 bg-slate-50 border border-slate-200 border-dashed rounded-lg py-3 px-4 text-center">
                                    <span class="font-mono font-bold text-lg text-slate-800 tracking-wider" id="code-{{ $promo->id }}">{{ $promo->code }}</span>
                                </div>
                                <button onclick="copyToClipboard('{{ $promo->code }}')" class="bg-slate-800 hover:bg-slate-700 text-white p-3 rounded-lg transition-colors group/btn" title="Salin Kode">
                                    <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Kode promo ' + text + ' berhasil disalin!');
        }).catch(err => {
            console.error('Failed to copy text: ', err);
        });
    }
</script>
@endpush
</x-front-layout>
