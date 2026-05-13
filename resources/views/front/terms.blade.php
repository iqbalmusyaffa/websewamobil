<x-front-layout>
    <!-- Header -->
    <div class="bg-slate-900 pt-20 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-1/2 -right-1/4 w-full h-full bg-gradient-to-b from-sky-500/20 to-transparent rounded-full blur-3xl transform rotate-12"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight mb-4">
                Syarat & Ketentuan
            </h1>
            <p class="text-lg text-slate-400 max-w-2xl mx-auto">
                Terakhir diperbarui: 11 Mei 2026. Harap baca dengan saksama sebelum menggunakan layanan AutoRent.
            </p>
        </div>
    </div>

    <!-- Content Layout -->
    <div class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{ activeTab: 'umum' }" class="flex flex-col lg:flex-row gap-8 lg:gap-12">

                <!-- Sidebar Nav (Vertical Tabs) -->
                <div class="w-full lg:w-1/4 shrink-0">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-3 sticky top-32">
                        <nav class="space-y-1">
                            <button @click="activeTab = 'umum'" :class="activeTab === 'umum' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'umum' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                1. Ketentuan Umum
                            </button>
                            <button @click="activeTab = 'syarat'" :class="activeTab === 'syarat' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'syarat' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                2. Persyaratan Sewa
                            </button>
                            <button @click="activeTab = 'bayar'" :class="activeTab === 'bayar' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'bayar' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                3. Pembayaran
                            </button>
                            <button @click="activeTab = 'denda'" :class="activeTab === 'denda' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'denda' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                4. Kewajiban & Denda
                            </button>
                            <button @click="activeTab = 'asuransi'" :class="activeTab === 'asuransi' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'asuransi' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                5. Asuransi
                            </button>
                            <button @click="activeTab = 'sopir'" :class="activeTab === 'sopir' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'sopir' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                6. Ketentuan Sopir
                            </button>
                            <button @click="activeTab = 'darurat'" :class="activeTab === 'darurat' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'darurat' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                7. Larangan & Darurat
                            </button>
                            <button @click="activeTab = 'ubah'" :class="activeTab === 'ubah' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'ubah' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                8. Proses & Refund
                            </button>
                            <button @click="activeTab = 'perubahan'" :class="activeTab === 'perubahan' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'" class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0" :class="activeTab === 'perubahan' ? 'text-sky-500' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                9. Perubahan Aturan
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="flex-1">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-12 min-h-[500px]">

                        <!-- 1. Ketentuan Umum -->
                        <div x-show="activeTab === 'umum'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">1. Ketentuan Umum</h2>
                            </div>
                            <div class="prose prose-slate prose-lg max-w-none text-slate-600">
                                <p>Dengan mengakses dan menggunakan situs web AutoRent, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini secara hukum. Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, Anda tidak diperkenankan menggunakan layanan kami.</p>
                                <p>AutoRent berhak menolak memberikan layanan kepada siapa pun dengan alasan keamanan, ketidaksesuaian data identitas, atau indikasi pelanggaran hukum.</p>
                            </div>
                        </div>

                        <!-- 2. Persyaratan Penyewaan -->
                        <div x-show="activeTab === 'syarat'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">2. Persyaratan Penyewaan</h2>
                            </div>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600">Penyewa <strong>lepas kunci (tanpa sopir)</strong> harus berusia minimal <strong>21 tahun</strong> dan memiliki Surat Izin Mengemudi (SIM) yang sah sesuai hukum yang berlaku di Republik Indonesia.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600">Penyewa yang menggunakan <strong>sopir dari AutoRent</strong> diperbolehkan berusia minimal <strong>18 tahun</strong> dengan menyertakan KTP/identitas yang masih berlaku.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600"><strong>Wajib menyiapkan KTP Asli / Dokumen Identitas Resmi lainnya</strong> (seperti Passport) yang masih berlaku saat serah terima kendaraan.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600">Pihak AutoRent berhak menahan kunci atau membatalkan pesanan jika penyewa tidak dapat menunjukkan identitas asli yang sesuai dengan data pemesanan.</p>
                                </div>

                                {{-- Kartu Tol Milik Sendiri --}}
                                <div class="flex gap-4 p-5 bg-emerald-50 rounded-2xl border border-emerald-100">
                                    <div class="shrink-0 mt-1">
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-semibold text-emerald-900 mb-1">🛣️ Penggunaan Kartu Tol (E-Toll) Milik Sendiri</p>
                                        <p class="text-emerald-800 leading-relaxed">Penyewa <strong>diperbolehkan menggunakan kartu e-toll milik pribadi</strong> selama masa sewa, baik untuk paket <strong>Sewa Lepas Kunci</strong> maupun <strong>Sewa dengan Sopir</strong>. Seluruh biaya tol yang timbul selama perjalanan menjadi tanggung jawab penyewa sepenuhnya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Pemesanan dan Pembayaran -->
                        <div x-show="activeTab === 'bayar'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">3. Pemesanan & Pembayaran</h2>
                            </div>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600"><strong>Wajib melakukan pembayaran Uang Muka (DP)</strong> segera setelah pesanan dibuat untuk mengunci jadwal sewa kendaraan. Pesanan tanpa DP dapat dibatalkan secara sepihak oleh admin.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600">Pemesanan dianggap sah apabila pembayaran DP atau pelunasan penuh telah diterima oleh pihak AutoRent.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <p class="text-lg text-slate-600">Sisa pembayaran wajib dilunasi paling lambat saat serah terima kendaraan (jika memilih opsi bayar tunai/di tempat).</p>
                                </div>

                                <!-- Biaya Admin Refund -->
                                <div class="flex gap-4 p-4 bg-amber-50 rounded-2xl border border-amber-200">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                    <div>
                                        <p class="text-lg text-amber-900 font-medium"><strong>Biaya Admin Pembatalan</strong></p>
                                        <p class="text-amber-800 mt-1">Pembatalan yang berhasil disetujui akan dikenakan <strong>biaya admin sebesar Rp 75.000</strong> (untuk proses dan penanganan). Biaya ini dipotong dari jumlah refund yang akan dikirimkan.</p>
                                        <p class="text-sm text-amber-700 mt-2 italic">Contoh: Refund 50% = Rp 1.000.000 - Rp 75.000 admin fee = Rp 925.000</p>
                                    </div>
                                </div>

                                <div class="flex gap-4 p-4 bg-rose-50 rounded-2xl border border-rose-100">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                    <p class="text-lg text-rose-800 font-medium"><strong>Pembatalan kurang dari 3 hari sebelum tanggal pickup</strong> akan mengakibatkan <strong>Uang Muka (DP) hangus</strong> (Refund 0%). Pembatalan pada hari H (hari pengambilan) juga dikenakan 0% refund.</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Kewajiban & Denda (Penalti) -->
                        <div x-show="activeTab === 'denda'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">4. Kewajiban & Denda (Penalti)</h2>
                                    <p class="text-sm text-slate-500 mt-1">Untuk menjaga kenyamanan bersama dan merawat kualitas armada kami.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <!-- Overtime -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Keterlambatan (Overtime)</h4>
                                            <p class="text-slate-600 leading-relaxed">Keterlambatan pengembalian kendaraan akan dikenakan denda sebesar <strong>10% dari harga sewa harian per jam</strong>. Keterlambatan lebih dari 6 jam akan otomatis dihitung sebagai biaya sewa 1 hari penuh.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fuel -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Kebijakan Bahan Bakar</h4>
                                            <p class="text-slate-600 leading-relaxed">Kendaraan harus dikembalikan dengan <strong>kapasitas bahan bakar yang sama</strong> seperti saat diserahkan. Jika kurang, penyewa wajib membayar selisih biaya bahan bakar ditambah biaya jasa pengisian.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Clean -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Kebersihan & Larangan Merokok</h4>
                                            <p class="text-slate-600 leading-relaxed">Dilarang keras <strong>merokok / vaping</strong>, membawa hewan peliharaan, atau membawa barang berbau menyengat (seperti durian) di dalam mobil. Pelanggaran aturan ini akan dikenakan denda pembersihan khusus (detailing) sebesar <strong>Rp 500.000</strong>.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Traffic -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Pelanggaran Lalu Lintas</h4>
                                            <p class="text-slate-600 leading-relaxed">Penyewa bertanggung jawab secara hukum dan finansial secara penuh atas segala <strong>pelanggaran lalu lintas (termasuk tilang elektronik/E-TLE), biaya parkir yang belum dibayar, atau biaya tol</strong> yang terjadi selama masa sewa.</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kartu Tol Milik Sendiri - Detail --}}
                                <div class="bg-emerald-50 p-5 rounded-2xl border border-emerald-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-emerald-200 text-emerald-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-emerald-900 mb-1">Penggunaan Kartu E-Toll Milik Penyewa</h4>
                                            <p class="text-emerald-800 leading-relaxed mb-3">Penyewa <strong>diizinkan membawa dan menggunakan kartu e-toll milik pribadi</strong> selama berkendara, baik pada paket sewa lepas kunci maupun dengan sopir. Ketentuan yang berlaku:</p>
                                            <ul class="space-y-1.5 text-emerald-800 text-sm">
                                                <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold mt-0.5">✓</span> Berlaku untuk paket <strong>Sewa Lepas Kunci</strong> — penyewa bebas menggunakan kartu e-toll pribadi saat mengemudi sendiri.</li>
                                                <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold mt-0.5">✓</span> Berlaku untuk paket <strong>Sewa dengan Sopir</strong> — penyewa dapat menyerahkan kartu e-toll pribadi kepada sopir untuk digunakan di gerbang tol.</li>
                                                <li class="flex items-start gap-2"><span class="text-slate-500 font-bold mt-0.5">!</span> Seluruh <strong>biaya tol menjadi tanggung jawab penyewa</strong>, tidak termasuk dalam harga sewa.</li>
                                                <li class="flex items-start gap-2"><span class="text-slate-500 font-bold mt-0.5">!</span> Pastikan saldo kartu e-toll mencukupi sebelum berangkat untuk menghindari antrean di gerbang tol.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Asuransi & Kecelakaan -->
                        <div x-show="activeTab === 'asuransi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">5. Asuransi & Kecelakaan</h2>
                                    <p class="text-sm text-slate-500 mt-1">Cakupan asuransi, prosedur darurat, dan tanggung jawab kerusakan.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <!-- Asuransi -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Cakupan Asuransi</h4>
                                            <p class="text-slate-600 leading-relaxed">Seluruh armada AutoRent dilindungi oleh asuransi komprehensif (All Risk). Meskipun demikian, penyewa tetap bertanggung jawab atas biaya risiko sendiri <strong>(Own Risk / OR)</strong> yang wajib dibayarkan jika terjadi kecelakaan atau kerusakan, sesuai polis yang disepakati saat penyerahan kunci.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Prosedur Kecelakaan -->
                                <div class="bg-amber-50 p-5 rounded-2xl border border-amber-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-200 text-amber-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-amber-900 mb-2">Prosedur Wajib Saat Kecelakaan</h4>
                                            <p class="text-amber-800 leading-relaxed mb-3">Jika terjadi kecelakaan, penyewa <strong>WAJIB</strong> melakukan langkah berikut secara berurutan:</p>
                                            <ol class="list-decimal list-inside space-y-1.5 text-amber-800">
                                                <li><strong>Jangan memindahkan</strong> kendaraan dari lokasi kejadian.</li>
                                                <li>Hubungi <strong>pihak kepolisian</strong> untuk membuat laporan resmi (BAP).</li>
                                                <li>Segera hubungi <strong>pihak AutoRent</strong> dan kirimkan foto dokumentasi lokasi kejadian.</li>
                                                <li>Jangan melakukan perbaikan sendiri atau membawa ke bengkel tanpa izin AutoRent.</li>
                                            </ol>
                                            <p class="text-amber-800 leading-relaxed mt-3 font-semibold">Kegagalan melaporkan kecelakaan sesuai prosedur di atas akan mengakibatkan <strong>seluruh biaya kerusakan ditanggung penyewa secara penuh tanpa klaim asuransi</strong>.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Kerusakan Akibat Kelalaian -->
                                <div class="bg-rose-50 p-5 rounded-2xl border border-rose-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-rose-200 text-rose-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-rose-900 mb-1">Kerusakan Akibat Kelalaian Penyewa</h4>
                                            <p class="text-rose-800 leading-relaxed">Kerusakan yang disebabkan oleh kelalaian penyewa <strong>TIDAK DITANGGUNG</strong> oleh asuransi dan seluruh biaya perbaikan menjadi tanggung jawab penuh penyewa. Contoh kelalaian meliputi: salah mengisi jenis bahan bakar, menabrak pembatas jalan, sengaja menerobos genangan banjir, menggunakan kendaraan di medan yang tidak sesuai (off-road), atau mengabaikan lampu indikator peringatan di dashboard.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Ketentuan Sopir -->
                        <div x-show="activeTab === 'sopir'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">6. Ketentuan Layanan Sopir</h2>
                                    <p class="text-sm text-slate-500 mt-1">Berlaku untuk penyewaan dengan sopir dari AutoRent.</p>
                                </div>
                            </div>

                            <!-- Biaya Tidak Termasuk -->
                            <div class="bg-amber-50 p-5 rounded-2xl border border-amber-200 shadow-sm mb-4">
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 bg-amber-200 text-amber-700 rounded-full flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-amber-900 mb-2">Biaya Tidak Termasuk dalam Harga Sewa</h4>
                                        <p class="text-amber-800 leading-relaxed mb-3">Harga sewa dengan sopir <strong>belum termasuk</strong> biaya-biaya berikut yang menjadi tanggung jawab penyewa:</p>
                                        <ul class="space-y-1.5 text-amber-800">
                                            <li class="flex items-start gap-2"><span class="font-bold">•</span> <strong>Uang makan sopir</strong> selama perjalanan</li>
                                            <li class="flex items-start gap-2"><span class="font-bold">•</span> <strong>Biaya tol</strong> jika melewati jalan tol</li>
                                            <li class="flex items-start gap-2"><span class="font-bold">•</span> <strong>Tiket parkir</strong> di seluruh lokasi tujuan</li>
                                            <li class="flex items-start gap-2"><span class="font-bold">•</span> <strong>Tiket pelabuhan/penyeberangan</strong> jika perjalanan antar pulau (contoh: Jakarta — Bali)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="grid gap-4">
                                <!-- Jam Kerja -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Jam Kerja Sopir</h4>
                                            <p class="text-slate-600 leading-relaxed">Jam operasional sopir adalah maksimal <strong>12 jam per hari</strong>. Penggunaan di luar jam operasional akan dikenakan biaya lembur sopir sesuai ketentuan yang berlaku.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Penginapan -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Penginapan Sopir</h4>
                                            <p class="text-slate-600 leading-relaxed">Untuk perjalanan luar kota yang memerlukan menginap, sopir diperbolehkan menginap di <strong>villa, hotel, atau penginapan layak</strong> yang disediakan/diizinkan oleh penyewa. Biaya penginapan sopir menjadi tanggung jawab penyewa. <strong>Jika penyewa tidak menyediakan penginapan, maka sopir diperbolehkan tidur di dalam kendaraan.</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hak Sopir -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Hak Sopir AutoRent</h4>
                                            <p class="text-slate-600 leading-relaxed">Sopir AutoRent <strong>berhak menolak</strong> rute atau permintaan yang dianggap membahayakan keselamatan, melanggar hukum, atau berada di luar area layanan. AutoRent juga berhak mengganti sopir sewaktu-waktu demi alasan keamanan dan kenyamanan.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Larangan -->
                                <div class="bg-rose-50 p-5 rounded-2xl border border-rose-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-rose-200 text-rose-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-rose-900 mb-1">Larangan Terhadap Sopir</h4>
                                            <p class="text-rose-800 leading-relaxed">Penyewa <strong>dilarang</strong> menyuruh sopir melanggar aturan lalu lintas, membawa kendaraan ke lokasi terlarang/ilegal, atau memaksa sopir mengemudi dalam kondisi melebihi batas jam kerja (kelelahan) yang dapat membahayakan keselamatan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Larangan & Darurat -->
                        <div x-show="activeTab === 'darurat'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">7. Larangan Keras & Darurat</h2>
                                    <p class="text-sm text-slate-500 mt-1">Ketentuan hukum terkait penggelapan dan kondisi tak terduga.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <!-- Sublease -->
                                <div class="bg-rose-50 p-5 rounded-2xl border border-rose-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-rose-200 text-rose-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-rose-900 mb-1">Larangan Menggadaikan / Dibawa Kabur</h4>
                                            <p class="text-rose-800 leading-relaxed">Penyewa <strong>DILARANG KERAS</strong> menggadaikan, menyewakan kembali (sub-lease), memindahtangankan, atau membawa kabur kendaraan. Pelanggaran atas poin ini dianggap sebagai tindak pidana pencurian/penggelapan aset dan akan <strong>LANGSUNG DIPROSES KE JALUR HUKUM</strong> yang melibatkan pihak kepolisian tanpa ada surat peringatan.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- GPS Tracking -->
                                <div class="bg-indigo-50 p-5 rounded-2xl border border-indigo-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-indigo-200 text-indigo-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-indigo-900 mb-1">Pemantauan GPS 24 Jam & Larangan Sabotase</h4>
                                            <p class="text-indigo-800 leading-relaxed mb-2">Demi keamanan aset, <strong>SELURUH ARMADA AutoRent telah dilengkapi dengan sistem pelacak (GPS Tracker) aktif</strong> yang terpantau secara *real-time* 24/7. Tim keamanan kami berhak mematikan mesin kendaraan dari jarak jauh kapan saja apabila terdeteksi gelagat mencurigakan atau keluar dari area yang diizinkan tanpa konfirmasi.</p>
                                            <p class="text-indigo-800 leading-relaxed font-semibold">Tindakan sengaja merusak, mematikan, atau melepas perangkat GPS dengan niat membawa kabur kendaraan akan langsung dikategorikan sebagai <span class="text-rose-600 font-extrabold uppercase underline">Tindak Pidana Pencurian Berencana</span> dan akan diteruskan ke pihak Kepolisian secara instan tanpa mediasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Force Majeure -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Keadaan Darurat & Mobil Mogok</h4>
                                            <p class="text-slate-600 leading-relaxed">Jika terjadi kerusakan mesin alami di jalan (bukan karena kelalaian penyewa), AutoRent akan berupaya menyediakan <strong>mobil pengganti</strong> yang setara. Jika tidak tersedia, kompensasi maksimal adalah pengembalian sisa uang sewa (refund proporsional).</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Lost & Found -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Barang Bawaan / Tertinggal</h4>
                                            <p class="text-slate-600 leading-relaxed">Penyewa wajib memeriksa seluruh barang bawaan sebelum mengembalikan kendaraan. AutoRent <strong>tidak bertanggung jawab</strong> atas kerusakan atau kehilangan barang berharga yang tertinggal di dalam kendaraan setelah masa sewa berakhir.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Perubahan Syarat & Ketentuan -->
                        <div x-show="activeTab === 'ubah'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">8. Proses & Timeline Refund</h2>
                                    <p class="text-sm text-slate-500 mt-1">Cara pembatalan dan estimasi waktu pengembalian dana.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <!-- Cara Pembatalan -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-2">Cara Membatalkan Booking</h4>
                                            <ol class="list-decimal list-inside space-y-2 text-slate-600">
                                                <li><strong>Via Aplikasi / Dashboard</strong> — Masuk ke "Pesanan Saya" → Pilih pesanan → Klik "Batalkan Pesanan" → Pilih alasan pembatalan → Konfirmasi</li>
                                                <li><strong>Via Customer Service</strong> — Hubungi kami melalui WhatsApp, Email, atau Phone untuk pembatalan manual</li>
                                                <li><strong>Pembatalan Instant</strong> — Pembatalan via aplikasi diproses otomatis dan langsung muncul di status</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline -->
                                <div class="bg-indigo-50 p-5 rounded-2xl border border-indigo-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-indigo-200 text-indigo-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-indigo-900 mb-2">⏱️ Timeline Refund</h4>
                                            <ul class="space-y-2 text-indigo-800 text-sm">
                                                <li class="flex items-start gap-2"><span class="font-bold text-indigo-600 mt-0.5">1.</span> <strong>Pembatalan diterima</strong> — Status booking otomatis berubah menjadi "dibatalkan"</li>
                                                <li class="flex items-start gap-2"><span class="font-bold text-indigo-600 mt-0.5">2.</span> <strong>Verifikasi Admin</strong> — Tim admin akan review pembatalan dalam <strong>1-2 jam</strong> kerja (jam kerja: Senin-Jumat 08:00-18:00 WIB)</li>
                                                <li class="flex items-start gap-2"><span class="font-bold text-indigo-600 mt-0.5">3.</span> <strong>Refund Diproses</strong> — Setelah persetujuan, dana dikembalikan dalam <strong>5-7 hari kerja</strong></li>
                                                <li class="flex items-start gap-2"><span class="font-bold text-indigo-600 mt-0.5">4.</span> <strong>Uang Masuk Rekening</strong> — Tergantung proses bank (biasanya sampai dalam 1-2 hari setelah bank memproses)</li>
                                            </ul>
                                            <p class="text-indigo-700 mt-3 font-semibold italic">💡 Total estimasi: 6-9 hari kerja sejak pembatalan disetujui</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kondisi Khusus -->
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-2">Kondisi Khusus</h4>
                                            <ul class="space-y-2 text-slate-600 text-sm">
                                                <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold mt-0.5">✓</span> <strong>Pembatalan karena kesalahan penyewa</strong> (booking salah tanggal/mobil) — Refund sesuai kebijakan waktu (berlaku normal/3 hari rule)</li>
                                                <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold mt-0.5">✓</span> <strong>Pembatalan karena armada tidak siap</strong> — Refund 100% tanpa potongan (exception)</li>
                                                <li class="flex items-start gap-2"><span class="text-emerald-600 font-bold mt-0.5">✓</span> <strong>Force Majeure</strong> (bencana alam, lockdown, emergency) — Refund 100% setelah approval admin</li>
                                                <li class="flex items-start gap-2"><span class="text-rose-600 font-bold mt-0.5">✗</span> <strong>Pembatalan karena kerusakan kendaraan</strong> — Refund bergantung pada claim asuransi dan tanggung jawab</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ Refund -->
                                <div class="bg-amber-50 p-5 rounded-2xl border border-amber-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 bg-amber-200 text-amber-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-amber-900 mb-2">❓ FAQ Pembatalan & Refund</h4>
                                            <div class="space-y-2 text-sm text-amber-800">
                                                <p><strong>Q: Biaya admin dipotong dari refund atau ditambah?</strong><br>A: Biaya admin <strong>dipotong dari jumlah refund</strong> yang akan dikirimkan ke rekening Anda.</p>
                                                <p><strong>Q: Bagaimana jika refund < Rp 75.000?</strong><br>A: Biaya admin tetap Rp 75.000, sehingga kemungkinan refund bisa 0 atau negatif (kami tidak tarik selisihnya).</p>
                                                <p><strong>Q: Bisa minta refund langsung di tempat?</strong><br>A: Pembatalan di hari yang sama hanya bisa via admin dengan approval. Refund hanya melalui transfer bank ke rekening terdaftar.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 9. Perubahan Aturan -->
                        <div x-show="activeTab === 'perubahan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">9. Perubahan Aturan</h2>
                            </div>
                            <div class="prose prose-slate prose-lg max-w-none text-slate-600">
                                <p>AutoRent berhak penuh untuk memperbarui, memodifikasi, atau mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan sebelumnya.</p>
                                <p>Perubahan akan berlaku efektif segera setelah dipublikasikan secara resmi di halaman ini. Dengan terus menggunakan layanan penyewaan setelah ada perubahan, Anda dianggap memahami dan menyetujui syarat terbaru tersebut.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
