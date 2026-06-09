<x-front-layout>
    <div class="bg-slate-50 min-h-screen pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="javascript:history.back()" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-sky-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Pilihan Mobil
                </a>
            </div>

            <h2 class="text-3xl font-extrabold text-slate-900 mb-8">Detail Pemesanan</h2>

            <form action="{{ route('airport-transfer.store', $price->id) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $request->type }}">
                <input type="hidden" name="pickup_datetime" id="pickup_datetime_hidden" value="">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Form -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Rute Information -->
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Informasi Rute</h3>
                            
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-1">Dari</p>
                                    <p class="text-lg font-bold text-slate-900">
                                        {{ $request->type == 'to_airport' ? $price->airportZone->name : $price->airport->name }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-1">Tujuan</p>
                                    <p class="text-lg font-bold text-slate-900">
                                        {{ $request->type == 'to_airport' ? $price->airport->name : $price->airportZone->name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Penjemputan -->
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Detail Penjemputan</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Jemput</label>
                                    <input type="date" id="input_date" value="{{ $request->pickup_date }}" required class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Jemput</label>
                                    <input type="time" id="input_time" required class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Detail Alamat Penjemputan / Antar
                                </label>
                                @if($request->province_name)
                                <div class="mb-3 p-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-600">
                                    <span class="font-bold">Wilayah:</span> {{ $request->district_name ?? '' }} {{ $request->city_name }}, {{ $request->province_name }}
                                </div>
                                <input type="hidden" name="full_area" value="{{ $request->district_name ?? '' }} {{ $request->city_name }}, {{ $request->province_name }}">
                                <input type="hidden" name="area_id" value="{{ $request->area_id }}">
                                @endif
                                <textarea name="pickup_address" rows="3" required placeholder="Nama jalan, RT/RW, nomor rumah/hotel, patokan spesifik..." class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Penerbangan (Opsional)</label>
                                <input type="text" name="flight_number" placeholder="Cth: GA-123" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500">
                                <p class="text-xs text-slate-500 mt-2">Agar driver dapat melacak jadwal kedatangan/keberangkatan Anda.</p>
                            </div>
                        </div>

                        <!-- Data Penumpang -->
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Data Penumpang</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="customer_name" required value="{{ auth()->check() ? auth()->user()->name : '' }}" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor WhatsApp Aktif</label>
                                    <input type="text" name="customer_phone" required value="{{ auth()->check() ? auth()->user()->phone_number : '' }}" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Tambahan (Opsional)</label>
                                <textarea name="notes" rows="2" placeholder="Cth: Bawa kursi roda, butuh bagasi ekstra besar..." class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-sky-500 focus:border-sky-500"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Summary & Payment -->
                    <div class="space-y-6">
                        <!-- Car Details -->
                        <div class="bg-slate-900 rounded-3xl p-6 shadow-xl border border-slate-800 text-white">
                            <h3 class="text-lg font-bold mb-4">Armada Pilihan</h3>
                            
                            <div class="flex items-center gap-4 mb-6">
                                <img src="{{ $price->car->image_url ?? 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}" class="w-20 h-20 rounded-xl object-cover border border-slate-700">
                                <div>
                                    <p class="text-xs font-bold text-sky-400 uppercase tracking-widest mb-1">{{ $price->car->brand }}</p>
                                    <p class="text-lg font-bold">{{ $price->car->name }}</p>
                                </div>
                            </div>

                            <div class="border-t border-slate-800 pt-4 mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-slate-400">Total Biaya (All-in)</span>
                                    <span class="text-2xl font-extrabold text-white">Rp {{ number_format($price->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-xs text-slate-500 text-right">Termasuk Tol & Parkir</p>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Metode Pembayaran</h3>
                            
                            <div class="space-y-3 mb-6">
                                <label class="flex items-center p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                    <input type="radio" name="payment_method" value="transfer" class="w-4 h-4 text-sky-600 focus:ring-sky-500 border-slate-300">
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-slate-900">Transfer Bank / Virtual Account</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                    <input type="radio" name="payment_method" value="midtrans" class="w-4 h-4 text-sky-600 focus:ring-sky-500 border-slate-300">
                                    <div class="ml-3 flex items-center gap-2">
                                        <span class="block text-sm font-bold text-slate-900">Bayar Online (Midtrans)</span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-sky-100 text-sky-600 uppercase tracking-wider">Otomatis</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                    <input type="radio" name="payment_method" value="whatsapp" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-slate-300" checked>
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-slate-900">Pesan via WhatsApp (Bayar Manual)</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                    <input type="radio" name="payment_method" value="cash" class="w-4 h-4 text-sky-600 focus:ring-sky-500 border-slate-300">
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-slate-900">Tunai (Bayar ke Supir)</span>
                                    </div>
                                </label>
                            </div>

                            <button type="submit" onclick="combineDateTime()" class="w-full py-4 bg-sky-500 hover:bg-sky-600 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 transition-colors">
                                Buat Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function combineDateTime() {
            const date = document.getElementById('input_date').value;
            const time = document.getElementById('input_time').value;
            if(date && time) {
                document.getElementById('pickup_datetime_hidden').value = date + ' ' + time + ':00';
            }
        }
    </script>
</x-front-layout>
