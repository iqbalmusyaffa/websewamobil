<x-front-layout>
    <!-- Tambahkan skrip Midtrans di head -->
    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @endpush

    <div class="bg-slate-50 py-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900">Selesaikan Pembayaran Anda</h1>
                <p class="mt-2 text-slate-600">Selesaikan pembayaran untuk mengonfirmasi pesanan Anda.</p>
            </div>

            @if(session('error'))
                <div class="mb-8 bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-3 text-sm font-medium text-red-800">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                <div class="p-8 lg:p-10">

                    <!-- Rincian Kendaraan -->
                    <div class="flex flex-col md:flex-row items-center gap-6 pb-8 border-b border-slate-100">
                        <img src="{{ $booking->car->image_url ?? 'https://via.placeholder.com/400x300?text=No+Image' }}" alt="{{ $booking->car->name }}" class="w-full md:w-48 h-32 object-cover rounded-xl bg-slate-100">
                        <div class="flex-1 w-full text-center md:text-left">
                            <span class="inline-block px-3 py-1 rounded-lg text-xs font-bold bg-sky-100 text-sky-700 uppercase tracking-wider mb-2">Order #{{ $booking->id }}</span>
                            <h2 class="text-2xl font-bold text-slate-900">{{ $booking->car->brand }} {{ $booking->car->name }}</h2>
                            <p class="text-slate-500 mt-1">Status: <span class="font-semibold text-amber-500">{{ strtoupper($booking->status) }}</span></p>
                        </div>
                    </div>

                    <!-- Rincian Sewa -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8 border-b border-slate-100">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Informasi Pengambilan</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Lokasi</p>
                                    <p class="font-bold text-slate-900">{{ $booking->pickup_location }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Tanggal Mulai</p>
                                    <p class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->start_date)->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Tanggal Kembali</p>
                                    <p class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->end_date)->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Layanan Sopir</p>
                                    <p class="font-bold text-slate-900">{{ $booking->with_driver ? 'Termasuk Sopir' : 'Lepas Kunci' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4">Rincian Biaya</h3>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_date);
                                    $end = \Carbon\Carbon::parse($booking->end_date);
                                    $days = $start->diffInDays($end) + 1;
                                    $pricePerDay = $booking->with_driver ? $booking->car->price_with_driver : $booking->car->price_without_driver;
                                @endphp
                                <div class="flex justify-between mb-3 text-slate-600">
                                    <span>Harga per hari</span>
                                    <span>Rp {{ number_format($pricePerDay, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between mb-3 text-slate-600">
                                    <span>Durasi Sewa</span>
                                    <span>{{ $days }} Hari</span>
                                </div>
                                <div class="flex justify-between mb-3 text-slate-600">
                                    <span>Biaya Layanan</span>
                                    <span>Gratis</span>
                                </div>
                                <div class="border-t border-slate-200 mt-4 pt-4 flex justify-between items-end">
                                    <span class="text-slate-900 font-bold">Total Pembayaran</span>
                                    <span class="text-3xl font-black text-sky-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="pt-8 border-t border-slate-100" x-data="{
                        method: 'midtrans',
                        selectedBank: 'mandiri',
                        banks: {
                            mandiri: { name: 'Mandiri', number: '1234567890', accountName: 'PT AUTORENT INDONESIA' },
                            bni: { name: 'BNI', number: '0987654321', accountName: 'PT AUTORENT INDONESIA' },
                            bca: { name: 'BCA', number: '1122334455', accountName: 'PT AUTORENT INDONESIA' },
                            bri: { name: 'BRI', number: '5566778899', accountName: 'PT AUTORENT INDONESIA' }
                        },
                        targetTime: {{ \Carbon\Carbon::parse($booking->created_at)->addHours(24)->timestamp * 1000 }},
                        timeLeft: 'Memuat...',
                        timerExpired: false,
                        init() {
                            this.updateTimer();
                            setInterval(() => this.updateTimer(), 1000);
                        },
                        updateTimer() {
                            const now = new Date().getTime();
                            const distance = this.targetTime - now;
                            
                            if (distance < 0) {
                                this.timeLeft = '00:00:00';
                                this.timerExpired = true;
                                return;
                            }
                            
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            this.timeLeft = String(hours).padStart(2, '0') + ':' + 
                                            String(minutes).padStart(2, '0') + ':' + 
                                            String(seconds).padStart(2, '0');
                        }
                    }">
                        @if($booking->status == 'menunggu pembayaran')
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Pilih Metode Pembayaran</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                                <label class="relative border-2 rounded-xl p-4 cursor-pointer hover:bg-slate-50 transition-colors"
                                       :class="method === 'midtrans' ? 'border-sky-500 bg-sky-50/50' : 'border-slate-200'">
                                    <input type="radio" name="method" value="midtrans" x-model="method" class="sr-only">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center" :class="method === 'midtrans' ? 'bg-sky-500 text-white' : 'bg-slate-200 text-slate-400'">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                        </div>
                                        <span class="font-bold text-slate-900">Pembayaran Otomatis</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">VA, GoPay, Kartu Kredit</p>
                                </label>

                                <label class="relative border-2 rounded-xl p-4 cursor-pointer hover:bg-slate-50 transition-colors"
                                       :class="method === 'transfer_manual' ? 'border-sky-500 bg-sky-50/50' : 'border-slate-200'">
                                    <input type="radio" name="method" value="transfer_manual" x-model="method" class="sr-only">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center" :class="method === 'transfer_manual' ? 'bg-sky-500 text-white' : 'bg-slate-200 text-slate-400'">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                        </div>
                                        <span class="font-bold text-slate-900">Transfer Manual</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">Transfer ke rek admin</p>
                                </label>

                                <label class="relative border-2 rounded-xl p-4 cursor-pointer hover:bg-slate-50 transition-colors"
                                       :class="method === 'tunai' ? 'border-sky-500 bg-sky-50/50' : 'border-slate-200'">
                                    <input type="radio" name="method" value="tunai" x-model="method" class="sr-only">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center" :class="method === 'tunai' ? 'bg-sky-500 text-white' : 'bg-slate-200 text-slate-400'">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <span class="font-bold text-slate-900">Bayar Tunai</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">Bayar di lokasi / driver</p>
                                </label>
                            </div>
                        @endif

                        <!-- Transfer Manual Section -->
                        <div x-show="method === 'transfer_manual'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mb-8 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl border-2 border-sky-200 p-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                                <h3 class="text-lg font-bold text-slate-900">📋 Transfer Manual - Pilih Bank</h3>
                                
                                <!-- Countdown Timer Display -->
                                <div class="bg-red-100 text-red-600 px-4 py-2 rounded-lg font-bold flex items-center justify-center gap-2 border border-red-200 shadow-sm" x-show="!timerExpired">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Sisa Waktu:</span>
                                    <span x-text="timeLeft" class="tracking-widest font-mono text-lg"></span>
                                </div>
                                <div class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold flex items-center justify-center gap-2 shadow-sm" x-show="timerExpired">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Waktu Pembayaran Habis</span>
                                </div>
                            </div>

                            <!-- Bank Selection -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                                <template x-for="(bank, code) in banks" :key="code">
                                    <label class="relative border-2 rounded-xl p-4 cursor-pointer transition-all hover:shadow-md"
                                           :class="selectedBank === code ? 'border-sky-500 bg-white shadow-lg' : 'border-slate-200 bg-white/50 hover:border-sky-300'">
                                        <input type="radio" name="selected_bank" :value="code" x-model="selectedBank" class="sr-only">
                                        <div class="flex items-center gap-3">
                                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center"
                                                 :class="selectedBank === code ? 'border-sky-500 bg-sky-500' : 'border-slate-300'">
                                                <svg x-show="selectedBank === code" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900" x-text="bank.name"></p>
                                                <p class="text-xs text-slate-500 font-mono" x-text="bank.number"></p>
                                            </div>
                                        </div>
                                    </label>
                                </template>
                            </div>

                            <!-- Bank Detail Display -->
                            <template x-for="(bank, code) in banks" :key="code">
                                <div x-show="selectedBank === code" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="bg-white rounded-xl border border-sky-200 p-6 mb-6">
                                    <div class="space-y-4">
                                        <!-- Bank Name -->
                                        <div>
                                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Bank</label>
                                            <p class="text-2xl font-bold text-sky-600 mt-1" x-text="bank.name"></p>
                                        </div>

                                        <!-- Account Number -->
                                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nomor Rekening</label>
                                            <div class="flex items-center justify-between gap-3 mt-2">
                                                <p class="text-xl font-bold text-slate-900 font-mono" x-text="bank.number"></p>
                                                <button type="button" onclick="navigator.clipboard.writeText(this.parentElement.querySelector('p').textContent)" class="px-3 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold rounded-lg transition">
                                                    📋 Salin
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Account Name -->
                                        <div>
                                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Atas Nama</label>
                                            <p class="text-lg font-bold text-slate-900 mt-2" x-text="bank.accountName"></p>
                                        </div>

                                        <!-- Amount -->
                                        <div class="bg-emerald-50 p-4 rounded-lg border border-emerald-200">
                                            <label class="text-xs font-bold text-emerald-700 uppercase tracking-widest">Jumlah Transfer</label>
                                            <p class="text-3xl font-black text-emerald-600 mt-2">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                            <p class="text-xs text-emerald-700 mt-2">⚠️ Pastikan jumlah transfer sesuai agar pembayaran terverifikasi otomatis</p>
                                        </div>

                                        <!-- Copy All -->
                                        <button type="button" onclick="const text = 'Bank: ' + this.getAttribute('data-bank') + '\nNomor: ' + this.getAttribute('data-number') + '\nAtas Nama: ' + this.getAttribute('data-name') + '\nJumlah: Rp {{ number_format($booking->total_price, 0, ',', '.') }}'; navigator.clipboard.writeText(text);"
                                                :data-bank="bank.name"
                                                :data-number="bank.number"
                                                :data-name="bank.accountName"
                                                class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-lg transition">
                                            📋 Salin Semua Detail
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Instruction -->
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-8">
                                <p class="text-sm font-medium text-blue-900">
                                    <strong>📝 Cara Pembayaran:</strong><br>
                                    1. Pilih bank di atas sesuai bank Anda<br>
                                    2. Salin nomor rekening dan jumlah transfer<br>
                                    3. Lakukan transfer dari ATM, Mobile Banking, atau Internet Banking<br>
                                    4. Pembayaran akan dikonfirmasi dalam 1x24 jam<br>
                                    5. Jangan lupa sertakan bukti transfer untuk verifikasi lebih cepat
                                </p>
                            </div>

                            <!-- Proof Upload Section -->
                            <h3 class="text-lg font-bold text-slate-900 mb-4">📸 Unggah Bukti Transfer</h3>
                            <p class="text-sm text-slate-600 mb-6">Unggah struk/screenshot bukti transfer untuk mempercepat verifikasi pembayaran</p>

                            <div class="space-y-4">
                                <!-- Upload Image -->
                                <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 hover:border-sky-400 hover:bg-sky-50/30 transition-colors">
                                    <label class="flex flex-col items-center cursor-pointer">
                                        <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm font-bold text-slate-900">📤 Pilih Gambar</span>
                                        <span class="text-xs text-slate-500 mt-1">atau drag & drop</span>
                                        <span class="text-xs text-slate-400 mt-2">PNG, JPG, JPEG (Max 5MB)</span>
                                        <input type="file" name="proof_image" accept="image/*" class="hidden" id="proof_image_input" @change="document.querySelector('#proof_image_name').textContent = this.files[0]?.name || 'Tidak ada file dipilih'">
                                    </label>
                                    <div id="proof_image_name" class="text-xs text-slate-500 mt-3 text-center">Tidak ada file dipilih</div>
                                </div>

                                <!-- Atau -->
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 border-t border-slate-300"></div>
                                    <span class="text-sm font-medium text-slate-500">ATAU</span>
                                    <div class="flex-1 border-t border-slate-300"></div>
                                </div>

                                <!-- Link Input -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-900 mb-2">🔗 Link Bukti Transfer</label>
                                    <input type="url" name="proof_link" placeholder="https://contoh.com/gambar-bukti.jpg" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                    <p class="text-xs text-slate-500 mt-2">Anda bisa upload ke Google Drive, Dropbox, atau imgur lalu share link-nya</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                            <a href="{{ route('bookings.index') }}" class="text-slate-500 hover:text-slate-900 font-medium transition-colors">
                                &larr; Kembali ke Daftar Pesanan
                            </a>

                            @if($booking->status == 'menunggu pembayaran')
                                <!-- Midtrans Button -->
                                @if($booking->snap_token)
                                    <button x-show="method === 'midtrans'" id="pay-button" class="px-8 py-4 bg-slate-900 text-white text-lg font-bold rounded-xl hover:bg-sky-600 transition-colors shadow-lg shadow-slate-900/20 w-full sm:w-auto">
                                        Bayar via Midtrans
                                    </button>
                                @else
                                    <button x-show="method === 'midtrans'" disabled class="px-8 py-4 bg-slate-300 text-slate-500 text-lg font-bold rounded-xl cursor-not-allowed w-full sm:w-auto">
                                        Midtrans Gangguan
                                    </button>
                                @endif

                                <!-- Manual Form -->
                                <form x-show="method !== 'midtrans'" style="display: none;" action="{{ route('payment.manual', $booking) }}" method="POST" enctype="multipart/form-data" class="w-full">
                                    @csrf
                                    <input type="hidden" name="payment_method" :value="method">
                                    <input type="hidden" name="selected_bank" x-model="selectedBank">
                                    <button type="submit" 
                                            :disabled="timerExpired && method === 'transfer_manual'" 
                                            :class="(timerExpired && method === 'transfer_manual') ? 'opacity-50 cursor-not-allowed bg-slate-400' : 'bg-sky-600 hover:bg-sky-700 shadow-sky-600/30'"
                                            class="px-8 py-4 text-white text-lg font-bold rounded-xl transition-colors shadow-lg w-full">
                                        Selesaikan Pesanan
                                    </button>
                                </form>
                            @elseif($booking->status == 'pending')
                                <div class="px-8 py-4 bg-amber-50 text-amber-600 text-lg font-bold rounded-xl border border-amber-200">
                                    Menunggu Konfirmasi Admin
                                </div>
                            @elseif($booking->status == 'disetujui')
                                <div class="px-8 py-4 bg-emerald-50 text-emerald-600 text-lg font-bold rounded-xl border border-emerald-200">
                                    Pembayaran / Pesanan Berhasil
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center text-sm text-slate-500">
                <p>Opsi pembayaran fleksibel disediakan untuk kenyamanan Anda.</p>
            </div>
        </div>
    </div>

    @push('scripts')
    @if($booking->status == 'menunggu pembayaran' && $booking->snap_token)
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $booking->snap_token }}', {
          onSuccess: function(result){
            // Redirect to bookings list on success
            window.location.href = "{{ route('bookings.index') }}";
          },
          onPending: function(result){
            alert("Menunggu pembayaran Anda!"); console.log(result);
          },
          onError: function(result){
            alert("Pembayaran gagal!"); console.log(result);
          },
          onClose: function(){
            console.log('Customer menutup popup tanpa menyelesaikan pembayaran');
          }
        });
      };
    </script>
    @endif
    @endpush
</x-front-layout>
