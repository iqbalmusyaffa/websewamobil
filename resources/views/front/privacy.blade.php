<x-front-layout>
    <!-- Header -->
    <div class="bg-slate-900 pt-20 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-1/2 -left-1/4 w-full h-full bg-gradient-to-b from-sky-500/20 to-transparent rounded-full blur-3xl transform -rotate-12">
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight mb-4">
                Kebijakan Privasi
            </h1>
            <p class="text-lg text-slate-400 max-w-2xl mx-auto">
                Terakhir diperbarui: 9 Mei 2026. Komitmen kami dalam menjaga kerahasiaan dan keamanan data pribadi Anda.
            </p>
        </div>
    </div>

    <!-- Content Layout -->
    <div class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{ activeTab: 'intro' }" class="flex flex-col lg:flex-row gap-8 lg:gap-12">

                <!-- Sidebar Nav (Vertical Tabs) -->
                <div class="w-full lg:w-1/4 shrink-0">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-3 sticky top-32">
                        <nav class="space-y-1">
                            <button @click="activeTab = 'intro'"
                                :class="activeTab === 'intro' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'intro' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                1. Pendahuluan
                            </button>
                            <button @click="activeTab = 'kumpul'"
                                :class="activeTab === 'kumpul' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'kumpul' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                2. Data yang Dikumpulkan
                            </button>
                            <button @click="activeTab = 'guna'"
                                :class="activeTab === 'guna' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'guna' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                3. Penggunaan Data
                            </button>
                            <button @click="activeTab = 'aman'"
                                :class="activeTab === 'aman' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'aman' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                4. Keamanan & GPS
                            </button>
                            <button @click="activeTab = 'berbagi'"
                                :class="activeTab === 'berbagi' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'berbagi' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                5. Berbagi Data & Hak Anda
                            </button>
                            <button @click="activeTab = 'kontak'"
                                :class="activeTab === 'kontak' ? 'bg-sky-50 text-sky-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-4 py-3 text-sm rounded-2xl transition-all duration-200 text-left">
                                <svg class="w-5 h-5 mr-3 shrink-0"
                                    :class="activeTab === 'kontak' ? 'text-sky-500' : 'text-slate-400'" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                6. Hubungi Kami
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="flex-1">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-12 min-h-[500px]">

                        <!-- 1. Pendahuluan -->
                        <div x-show="activeTab === 'intro'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">1. Pendahuluan</h2>
                            </div>
                            <div class="prose prose-slate prose-lg max-w-none text-slate-600">
                                <p>Selamat datang di AutoRent. Kami sangat menghargai privasi Anda dan berkomitmen penuh
                                    untuk melindungi data pribadi Anda.</p>
                                <p>Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan,
                                    menyimpan, dan melindungi informasi pribadi Anda ketika Anda mengakses situs web
                                    kami atau menggunakan layanan penyewaan kendaraan kami. Dengan menggunakan layanan
                                    AutoRent, Anda menyetujui praktik yang dijelaskan dalam kebijakan ini.</p>
                            </div>
                        </div>

                        <!-- 2. Data yang Dikumpulkan -->
                        <div x-show="activeTab === 'kumpul'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">2. Data yang Kami Kumpulkan</h2>
                                    <p class="text-sm text-slate-500 mt-1">Informasi yang kami perlukan untuk melayani
                                        Anda.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Data Identitas Resmi</h4>
                                            <p class="text-slate-600 leading-relaxed">Mencakup nama lengkap, nomor
                                                KTP/Passport, nomor Surat Izin Mengemudi (SIM), tempat tanggal lahir,
                                                dan foto identitas yang diunggah atau diserahkan saat proses verifikasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Data Kontak & Alamat</h4>
                                            <p class="text-slate-600 leading-relaxed">Mencakup alamat email aktif, nomor
                                                telepon/WhatsApp, alamat rumah domisili, serta alamat penagihan untuk
                                                keperluan invoice.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Data Transaksi Pembayaran
                                            </h4>
                                            <p class="text-slate-600 leading-relaxed">Mencakup riwayat pemesanan, metode
                                                pembayaran yang digunakan (Midtrans/Transfer Bank), dan status pelunasan
                                                tagihan. Kami tidak menyimpan detail kartu kredit Anda secara langsung
                                                di server kami.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Cookies & Data Teknis
                                                Perangkat</h4>
                                            <p class="text-slate-600 leading-relaxed">Saat mengakses website, sistem
                                                kami otomatis mengumpulkan data teknis seperti alamat IP, jenis browser,
                                                lokasi estimasi, dan data <em>Cookies</em> untuk meningkatkan performa
                                                website dan menjaga sesi login Anda tetap aman.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Penggunaan Data -->
                        <div x-show="activeTab === 'guna'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">3. Penggunaan Data</h2>
                            </div>
                            <div class="space-y-6">
                                <p class="text-lg text-slate-600 mb-6">Kami hanya menggunakan data Anda untuk tujuan
                                    yang sah secara hukum, terutama untuk:</p>

                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></div>
                                    <p class="text-lg text-slate-600"><strong>Pelaksanaan Kontrak Sewa:</strong>
                                        Memproses pesanan Anda, mengatur jadwal pengambilan, dan memvalidasi identitas
                                        penyewa demi keamanan aset kendaraan.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></div>
                                    <p class="text-lg text-slate-600"><strong>Layanan Pelanggan:</strong> Menghubungi
                                        Anda terkait pemesanan, mengirimkan invoice, atau memberikan dukungan teknis
                                        jika terjadi kendala (darurat) di jalan.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="shrink-0 mt-1"><svg class="w-6 h-6 text-emerald-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></div>
                                    <p class="text-lg text-slate-600"><strong>Kepatuhan Hukum:</strong> Mematuhi
                                        kewajiban hukum, seperti melaporkan tindak pidana penggelapan atau penipuan
                                        kepada pihak yang berwajib.</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Keamanan & GPS -->
                        <div x-show="activeTab === 'aman'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">4. Keamanan Data & Pelacakan GPS
                                    </h2>
                                    <p class="text-sm text-slate-500 mt-1">Perlindungan informasi dan pelacakan armada
                                        kami.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Perlindungan Server &
                                                Akses</h4>
                                            <p class="text-slate-600 leading-relaxed">Sistem AutoRent menggunakan
                                                enkripsi standar industri. Kami telah menerapkan langkah keamanan ketat
                                                untuk mencegah data pribadi Anda hilang, disalahgunakan, atau diakses
                                                oleh pihak yang tidak berwenang.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-indigo-50 p-5 rounded-2xl border border-indigo-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-indigo-200 text-indigo-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-indigo-900 mb-1">Pengumpulan Data Lokasi
                                                (GPS Tracker)</h4>
                                            <p class="text-indigo-800 leading-relaxed"><strong>PENTING:</strong> Kami
                                                mengumpulkan data lokasi <em>real-time</em> dari kendaraan sewa melalui
                                                perangkat GPS Tracker. Data ini digunakan secara eksklusif untuk
                                                perlindungan aset, memastikan kendaraan tetap berada di zona yang
                                                diizinkan, dan mencegah tindak pidana penggelapan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Berbagi Data & Hak Anda -->
                        <div x-show="activeTab === 'berbagi'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-slate-900">5. Berbagi Data & Hak Pengguna
                                    </h2>
                                    <p class="text-sm text-slate-500 mt-1">Transparansi pihak ketiga dan kendali penuh
                                        atas data Anda.</p>
                                </div>
                            </div>

                            <div class="grid gap-4 mt-8">
                                <div class="bg-amber-50 p-5 rounded-2xl border border-amber-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-amber-200 text-amber-700 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-amber-900 mb-2">Pembagian Data ke Pihak
                                                Ketiga</h4>
                                            <p class="text-amber-800 leading-relaxed mb-3">AutoRent <strong>TIDAK PERNAH
                                                    MENJUAL</strong> data pelanggan ke pihak mana pun. Namun, kami
                                                membagikan data spesifik hanya kepada pihak berwenang berikut untuk
                                                kelancaran layanan:</p>
                                            <ul class="space-y-1.5 text-amber-800 text-sm">
                                                <li class="flex items-start gap-2"><span
                                                        class="font-bold mt-0.5">•</span> <strong>Gateway Pembayaran
                                                        (Midtrans):</strong> Memproses transaksi keuangan secara aman
                                                    dan terenkripsi.</li>
                                                <li class="flex items-start gap-2"><span
                                                        class="font-bold mt-0.5">•</span> <strong>Pihak
                                                        Asuransi:</strong> Membantu proses investigasi jika terjadi
                                                    klaim kerusakan/kecelakaan.</li>
                                                <li class="flex items-start gap-2"><span
                                                        class="font-bold mt-0.5">•</span> <strong>Kepolisian / Aparat
                                                        Hukum:</strong> Jika terdapat laporan tilang (E-TLE), indikasi
                                                    pencurian, atau tindak pidana lainnya yang melibatkan kendaraan
                                                    sewa.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Hak Privasi Pengguna (User
                                                Rights)</h4>
                                            <p class="text-slate-600 leading-relaxed">Anda memiliki hak penuh atas data
                                                Anda. Anda berhak meminta untuk <strong>mengakses, mengedit,
                                                    memperbarui, atau meminta penghapusan permanen akun beserta foto
                                                    identitas (KTP/SIM)</strong> dari server AutoRent kapan saja, selama
                                                Anda tidak sedang dalam masa penyewaan aktif atau sedang terlibat dalam
                                                investigasi masalah hukum/tunggakan pembayaran.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Hubungi Kami -->
                        <div x-show="activeTab === 'kontak'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-extrabold text-slate-900">6. Hubungi Kami</h2>
                            </div>

                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                                <p class="text-lg text-slate-600 mb-6">Jika Anda memiliki pertanyaan tentang Kebijakan
                                    Privasi ini, kekhawatiran tentang data Anda, atau ingin meminta penghapusan data,
                                    silakan hubungi tim kami melalui:</p>

                                <div class="space-y-4">
                                    <a href="mailto:privacy@autorent.com"
                                        class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-slate-100">
                                        <div
                                            class="w-10 h-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-slate-500 font-medium">Email Privasi Data</p>
                                            <p class="text-lg font-bold text-slate-900">privacy@autorent.com</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>