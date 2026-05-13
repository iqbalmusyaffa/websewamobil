<x-front-layout>
    <!-- Hero Section -->
    <div class="bg-slate-900 py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-sky-500 rounded-full blur-[100px] opacity-20"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-blue-500 rounded-full blur-[100px] opacity-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-sky-500/10 text-sky-400 text-sm font-semibold tracking-wider mb-4 border border-sky-500/20">TENTANG KAMI</span>
            <h1 class="text-4xl font-extrabold text-white sm:text-6xl tracking-tight mb-6">
                Mengenal <span class="text-sky-400">AutoRent</span>
            </h1>
            <p class="text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
                Kami lebih dari sekadar perusahaan penyewaan mobil. Kami adalah mitra mobilitas tepercaya yang mendedikasikan diri untuk meredefinisi pengalaman perjalanan Anda di seluruh Indonesia.
            </p>
        </div>
    </div>

    <!-- Main Content with Tabs -->
    <div class="bg-slate-50 py-16 min-h-screen" x-data="{ activeTab: 'sejarah' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Tab Navigation -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 bg-slate-200/50 p-2 rounded-2xl mb-12 overflow-x-auto shadow-inner">
                <button @click="activeTab = 'sejarah'" 
                        :class="{ 'bg-white shadow text-sky-600 scale-100': activeTab === 'sejarah', 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 scale-95': activeTab !== 'sejarah' }" 
                        class="flex-1 py-3.5 px-6 rounded-xl text-sm font-bold whitespace-nowrap transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Sejarah & Profil
                </button>
                <button @click="activeTab = 'visimisi'" 
                        :class="{ 'bg-white shadow text-sky-600 scale-100': activeTab === 'visimisi', 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 scale-95': activeTab !== 'visimisi' }" 
                        class="flex-1 py-3.5 px-6 rounded-xl text-sm font-bold whitespace-nowrap transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Visi & Misi
                </button>
                <button @click="activeTab = 'organisasi'" 
                        :class="{ 'bg-white shadow text-sky-600 scale-100': activeTab === 'organisasi', 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 scale-95': activeTab !== 'organisasi' }" 
                        class="flex-1 py-3.5 px-6 rounded-xl text-sm font-bold whitespace-nowrap transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Struktur Organisasi
                </button>
                <button @click="activeTab = 'legalitas'" 
                        :class="{ 'bg-white shadow text-sky-600 scale-100': activeTab === 'legalitas', 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 scale-95': activeTab !== 'legalitas' }" 
                        class="flex-1 py-3.5 px-6 rounded-xl text-sm font-bold whitespace-nowrap transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Legalitas
                </button>
                <button @click="activeTab = 'kontak'" 
                        :class="{ 'bg-white shadow text-sky-600 scale-100': activeTab === 'kontak', 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 scale-95': activeTab !== 'kontak' }" 
                        class="flex-1 py-3.5 px-6 rounded-xl text-sm font-bold whitespace-nowrap transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Lokasi & Kontak
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="relative min-h-[500px]">
                
                <!-- TAB 1: Sejarah & Profil -->
                <div x-show="activeTab === 'sejarah'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="w-full" style="display: none;">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-slate-100">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                            <div>
                                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-6">
                                    Dari Garasi Kecil hingga Jaringan Nasional
                                </h2>
                                <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                                    <p>
                                        Didirikan pada tahun 2009 di sebuah garasi kecil di Jakarta Selatan, AutoRent bermula dengan sebuah mimpi sederhana namun berani: <strong>"Membuat penyewaan mobil senyaman dan setransparan mungkin."</strong>
                                    </p>
                                    <p>
                                        Pada awalnya, kami hanya memiliki 3 unit armada (dua mobil keluarga dan satu city car). Namun, melalui dedikasi tak tergoyahkan terhadap pelayanan pelanggan, armada kami berkembang pesat menjadi lebih dari 500 kendaraan dalam kurun waktu satu dekade.
                                    </p>
                                    <p>
                                        Saat ini, AutoRent telah berekspansi ke lebih dari 5 kota besar di Indonesia. Kami bukan hanya menyewakan kendaraan, melainkan menyewakan ketenangan pikiran, mobilitas tanpa batas, dan pengalaman yang memanjakan setiap penyewa.
                                    </p>
                                </div>
                                
                                <div class="mt-10 grid grid-cols-2 gap-6">
                                    <div class="border-l-4 border-sky-500 pl-4">
                                        <div class="text-3xl font-extrabold text-slate-900">15+</div>
                                        <div class="text-sm font-semibold text-slate-500 mt-1 uppercase tracking-wider">Tahun Pengalaman</div>
                                    </div>
                                    <div class="border-l-4 border-sky-500 pl-4">
                                        <div class="text-3xl font-extrabold text-slate-900">50k+</div>
                                        <div class="text-sm font-semibold text-slate-500 mt-1 uppercase tracking-wider">Pelanggan Puas</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 lg:mt-0 relative">
                                <div class="absolute -inset-4 bg-sky-100 rounded-3xl transform rotate-3"></div>
                                <img class="relative rounded-2xl shadow-lg object-cover h-[500px] w-full" src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Kantor AutoRent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: Visi & Misi -->
                <div x-show="activeTab === 'visimisi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="w-full" style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Visi -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl border border-slate-100 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-sky-50 rounded-full transition-transform duration-700 group-hover:scale-150"></div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center mb-8">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Visi Perusahaan</h3>
                                <p class="text-xl text-slate-600 leading-relaxed">
                                    "Menjadi perusahaan penyedia layanan mobilitas nomor satu di Asia Tenggara yang paling mengerti kebutuhan pelanggan dengan standar pelayanan kelas dunia."
                                </p>
                            </div>
                        </div>

                        <!-- Misi -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl border border-slate-100 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-emerald-50 rounded-full transition-transform duration-700 group-hover:scale-150"></div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-8">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Misi Kami</h3>
                                <ul class="space-y-4 text-lg text-slate-600">
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-emerald-500 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Menyediakan armada yang selalu terawat prima, bersih, dan higienis.
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-emerald-500 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Menerapkan harga yang transparan tanpa biaya tersembunyi.
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-emerald-500 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Mengutamakan keselamatan dan keamanan pelanggan di setiap perjalanan.
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-emerald-500 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Mengembangkan inovasi digital untuk kemudahan pemesanan.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: Struktur Organisasi -->
                <div x-show="activeTab === 'organisasi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="w-full" style="display: none;">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-slate-100 text-center">
                        <div class="mb-12">
                            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-4">Tim di Balik Layar</h2>
                            <p class="text-lg text-slate-500 max-w-2xl mx-auto">Kami didukung oleh para profesional berpengalaman yang mendedikasikan hidupnya untuk melayani mobilitas Anda.</p>
                        </div>
                        
                        <!-- CEO -->
                        <div class="flex flex-col items-center mb-16 relative">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4 relative z-10">
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="CEO" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Budi Santoso</h3>
                            <p class="text-sky-600 font-semibold mb-2">Chief Executive Officer (CEO)</p>
                            <!-- Connecting Line -->
                            <div class="absolute top-32 bottom-0 w-0.5 bg-slate-200 -z-10 h-16"></div>
                        </div>

                        <!-- Managers Grid -->
                        <div class="relative">
                            <!-- Horizontal Line -->
                            <div class="hidden md:block absolute top-0 left-1/4 right-1/4 h-0.5 bg-slate-200"></div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                                <!-- Operation Manager -->
                                <div class="flex flex-col items-center relative">
                                    <div class="hidden md:block absolute -top-8 w-0.5 h-8 bg-slate-200"></div>
                                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="COO" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900">Siti Aminah</h3>
                                    <p class="text-sky-600 font-medium text-sm">Head of Operations</p>
                                </div>
                                
                                <!-- Tech Manager -->
                                <div class="flex flex-col items-center relative">
                                    <div class="hidden md:block absolute -top-8 w-0.5 h-8 bg-slate-200"></div>
                                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="CTO" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900">Reza Pratama</h3>
                                    <p class="text-sky-600 font-medium text-sm">Chief Technology Officer</p>
                                </div>
                                
                                <!-- CS Manager -->
                                <div class="flex flex-col items-center relative">
                                    <div class="hidden md:block absolute -top-8 w-0.5 h-8 bg-slate-200"></div>
                                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Head CS" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900">Diana Putri</h3>
                                    <p class="text-sky-600 font-medium text-sm">Head of Customer Relations</p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Note -->
                        <div class="mt-16 pt-8 border-t border-slate-100">
                            <p class="text-slate-500 italic">Serta didukung oleh lebih dari 200+ mekanik bersertifikat, staf administrasi, dan pengemudi profesional di seluruh cabang AutoRent.</p>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: Legalitas -->
                <div x-show="activeTab === 'legalitas'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="w-full" style="display: none;">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-slate-100">
                        <div class="max-w-3xl mx-auto text-center mb-12">
                            <div class="w-20 h-20 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-4">Izin & Legalitas Perusahaan</h2>
                            <p class="text-lg text-slate-500">AutoRent beroperasi di bawah naungan badan hukum resmi yang tunduk pada peraturan perundang-undangan di Republik Indonesia.</p>
                        </div>

                        <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 max-w-4xl mx-auto">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div class="border-b border-slate-200 pb-4 md:border-b-0 md:pb-0">
                                    <dt class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Perusahaan Hukum</dt>
                                    <dd class="text-lg font-bold text-slate-900">PT. Auto Mobilitas Nusantara</dd>
                                </div>
                                <div class="border-b border-slate-200 pb-4 md:border-b-0 md:pb-0">
                                    <dt class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Nomor Induk Berusaha (NIB)</dt>
                                    <dd class="text-lg font-bold text-slate-900">02200088991234</dd>
                                </div>
                                <div class="border-b border-slate-200 pb-4 md:border-b-0 md:pb-0">
                                    <dt class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Nomor Pokok Wajib Pajak (NPWP)</dt>
                                    <dd class="text-lg font-bold text-slate-900">92.123.456.7-001.000</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Izin Penyelenggaraan Sewa Kendaraan</dt>
                                    <dd class="text-lg font-bold text-slate-900">SK. Menhub No. 123/2010</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div class="mt-12 flex items-center justify-center space-x-8 opacity-60 grayscale hover:grayscale-0 transition-all">
                            <!-- Placeholder logos for certifications (ISO, etc) -->
                            <div class="text-2xl font-black text-slate-400">ISO 9001</div>
                            <div class="text-2xl font-black text-slate-400">CHSE Certified</div>
                            <div class="text-2xl font-black text-slate-400">OJK Registered</div>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: Lokasi & Kontak -->
                <div x-show="activeTab === 'kontak'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="w-full" style="display: none;">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-slate-100">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                            
                            <!-- Contact Info -->
                            <div>
                                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-6">Hubungi Kami</h2>
                                <p class="text-lg text-slate-500 mb-10">Tim kami siap melayani Anda 24/7. Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau butuh bantuan darurat.</p>
                                
                                <div class="space-y-8">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center shrink-0 mr-5">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Kantor Pusat</h4>
                                            <p class="text-slate-600 leading-relaxed">Jl. Sudirman No. 123, Kawasan Bisnis Terpadu<br>Jakarta Selatan, 12190</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center shrink-0 mr-5">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Telepon & WhatsApp</h4>
                                            <p class="text-slate-600 leading-relaxed">+62 812 3456 7890 (Customer Service)<br>+62 21 9876 5432 (Office)</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center shrink-0 mr-5">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-1">Email</h4>
                                            <p class="text-slate-600 leading-relaxed">info@autorent.id<br>support@autorent.id</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-10 pt-8 border-t border-slate-100 flex space-x-4">
                                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 hover:bg-sky-600 hover:text-white flex items-center justify-center transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Maps/Image Placeholder -->
                            <div class="h-[400px] lg:h-[500px] w-full bg-slate-100 rounded-[2rem] overflow-hidden relative shadow-inner border-4 border-slate-50">
                                <!-- Embedding a Google Maps iframe for visual (using a realistic location like Monas area) -->
                                <iframe class="absolute inset-0 w-full h-full" 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126917.4334316986!2d106.75704984242637!3d-6.242502621459529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1715014876543!5m2!1sid!2sid" 
                                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                                
                                <!-- Floating Info Card on top of map -->
                                <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur px-6 py-4 rounded-xl shadow-lg border border-slate-100">
                                    <p class="font-bold text-slate-900 flex items-center mb-1">
                                        <span class="w-3 h-3 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                        Buka Setiap Hari
                                    </p>
                                    <p class="text-sm text-slate-500">Senin - Minggu: 07:00 - 22:00 WIB</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-front-layout>
