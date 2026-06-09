<x-front-layout>
    <!-- Hero Section -->
    <div class="relative w-full flex items-center justify-center overflow-hidden bg-slate-900 pt-32 pb-32">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="Airport Transfer" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-6">
                    Layanan <span class="text-sky-400">Antar Jemput Bandara</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-300 font-light leading-relaxed">
                    Sewa mobil pribadi eksklusif untuk perjalanan dari dan ke bandara (harga sewa per mobil, bukan per kursi). Harga All-In, tanpa biaya tersembunyi, dan garansi tepat waktu.
                </p>
            </div>

            <!-- Search Form Card -->
            <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-6 md:p-8 rounded-3xl shadow-2xl">
                <form action="{{ route('airport-transfer.search') }}" method="GET" class="space-y-6">
                    
                    <!-- Trip Type -->
                    <div class="flex gap-4 mb-2">
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="type" value="to_airport" class="peer sr-only" checked>
                            <div class="px-6 py-3 rounded-full text-sm font-bold bg-slate-800 text-slate-400 border border-slate-700 peer-checked:bg-sky-500 peer-checked:text-white peer-checked:border-sky-400 transition-all shadow-sm">
                                Ke Bandara (Drop-off)
                            </div>
                        </label>
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="type" value="from_airport" class="peer sr-only">
                            <div class="px-6 py-3 rounded-full text-sm font-bold bg-slate-800 text-slate-400 border border-slate-700 peer-checked:bg-sky-500 peer-checked:text-white peer-checked:border-sky-400 transition-all shadow-sm">
                                Dari Bandara (Pick-up)
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Airport Selection -->
                        <div>
                            <label class="block text-sm font-bold text-sky-100 mb-2">Pilih Bandara</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                                <select name="airport_id" required class="block w-full pl-10 pr-3 py-3 border border-slate-700 bg-slate-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                    <option value="" disabled selected>Pilih Bandara Tujuan/Asal</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Date Selection -->
                        <div>
                            <label class="block text-sm font-bold text-sky-100 mb-2">Tanggal Penjemputan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="date" name="pickup_date" required min="{{ date('Y-m-d') }}" class="block w-full pl-10 pr-3 py-3 border border-slate-700 bg-slate-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Zone Selection (API) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Province -->
                        <div>
                            <label class="block text-sm font-bold text-sky-100 mb-2">Pilih Provinsi</label>
                            <div class="relative">
                                <select id="province_id" name="province_id" required class="block w-full px-3 py-3 border border-slate-700 bg-slate-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                    <option value="" disabled selected>Memuat Provinsi...</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- City -->
                        <div>
                            <label class="block text-sm font-bold text-sky-100 mb-2">Pilih Kota/Kabupaten</label>
                            <div class="relative">
                                <select id="city_id" name="city_id" required disabled class="block w-full px-3 py-3 border border-slate-700 bg-slate-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm disabled:opacity-50">
                                    <option value="" disabled selected>Pilih Provinsi Dahulu</option>
                                </select>
                            </div>
                        </div>

                        <!-- District -->
                        <div>
                            <label class="block text-sm font-bold text-sky-100 mb-2">Pilih Kecamatan (Opsional)</label>
                            <div class="relative">
                                <select id="district_id" name="district_id" disabled class="block w-full px-3 py-3 border border-slate-700 bg-slate-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm disabled:opacity-50">
                                    <option value="" disabled selected>Pilih Kota Dahulu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden inputs for names -->
                    <input type="hidden" id="province_name" name="province_name">
                    <input type="hidden" id="city_name" name="city_name">
                    <input type="hidden" id="district_name" name="district_name">

                    <div class="pt-4 text-center">
                        <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center px-10 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-sky-500 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 focus:ring-offset-slate-900 shadow-lg shadow-sky-500/30 transition-all duration-300 transform hover:scale-105">
                            Cari Mobil Tersedia
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Cross-sell Banner -->
            <div class="mt-8 bg-amber-50 border border-amber-100 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4 max-w-4xl mx-auto">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-900 font-bold text-sm">Bepergian sendirian atau mencari harga lebih hemat?</p>
                        <p class="text-slate-500 text-xs mt-0.5">Coba layanan Travel Shuttle kami yang dihitung per kursi.</p>
                    </div>
                </div>
                <a href="{{ route('shuttle.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-lg hover:bg-slate-50 transition-colors whitespace-nowrap shadow-sm">
                    Lihat Travel Shuttle
                </a>
            </div>
        </div>
    </div>

    <!-- Keunggulan Section -->
    <div class="py-20 bg-slate-50 relative -mt-10 z-20 rounded-t-[3rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-sky-100 rounded-2xl flex items-center justify-center mb-6 text-sky-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Garansi Tepat Waktu</h3>
                    <p class="text-slate-500 text-sm">Driver kami akan stand-by di lokasi penjemputan 30 menit sebelum jadwal yang Anda tentukan.</p>
                </div>
                
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Harga Pasti (All-in)</h3>
                    <p class="text-slate-500 text-sm">Tidak ada biaya tersembunyi. Harga sudah termasuk sewa mobil, supir, bbm, tol, dan parkir bandara.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-amber-100 rounded-2xl flex items-center justify-center mb-6 text-amber-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Layanan Meet & Greet</h3>
                    <p class="text-slate-500 text-sm">Untuk penjemputan di bandara, supir kami akan menunggu di pintu kedatangan membawa papan nama Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-20 bg-white relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-900">Pertanyaan yang Sering Diajukan</h2>
                <p class="mt-4 text-lg text-slate-500">Informasi tambahan mengenai layanan Antar Jemput Bandara kami.</p>
            </div>
            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-slate-200 rounded-2xl bg-white overflow-hidden" x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-6 text-left focus:outline-none hover:bg-slate-50 transition-colors">
                        <span class="text-lg font-bold text-slate-900">Apakah layanan ini digabung dengan penumpang lain?</span>
                        <svg class="w-5 h-5 text-slate-500 transform transition-transform duration-300" :class="{'rotate-180': expanded}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="expanded" style="display: none;" x-collapse>
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            <span class="font-semibold text-emerald-600">Tidak.</span> Layanan Antar Jemput Bandara kami bersifat privat dan eksklusif. Anda menyewa 1 mobil penuh untuk kenyamanan dan privasi Anda beserta keluarga atau rombongan. Tidak ada penumpang lain di dalam mobil selain Anda dan supir kami.
                        </div>
                    </div>
                </div>
                <!-- FAQ 2 -->
                <div class="border border-slate-200 rounded-2xl bg-white overflow-hidden" x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-6 text-left focus:outline-none hover:bg-slate-50 transition-colors">
                        <span class="text-lg font-bold text-slate-900">Apakah harganya dihitung per orang atau per mobil?</span>
                        <svg class="w-5 h-5 text-slate-500 transform transition-transform duration-300" :class="{'rotate-180': expanded}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="expanded" style="display: none;" x-collapse>
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            Harga yang tertera pada website adalah <span class="font-semibold text-sky-600">harga per mobil</span>. Anda bisa membawa penumpang hingga batas maksimal kapasitas mobil yang Anda pilih tanpa adanya tambahan biaya per kepala.
                        </div>
                    </div>
                </div>
                <!-- FAQ 3 -->
                <div class="border border-slate-200 rounded-2xl bg-white overflow-hidden" x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-6 text-left focus:outline-none hover:bg-slate-50 transition-colors">
                        <span class="text-lg font-bold text-slate-900">Apa saja yang sudah termasuk dalam harga?</span>
                        <svg class="w-5 h-5 text-slate-500 transform transition-transform duration-300" :class="{'rotate-180': expanded}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="expanded" style="display: none;" x-collapse>
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            Harga yang Anda bayarkan sudah <span class="font-semibold text-slate-900">All-in</span>, mencakup: biaya sewa mobil, jasa supir, bahan bakar minyak (BBM), tarif tol, serta biaya parkir di bandara. Anda tidak perlu memikirkan biaya tambahan lainnya selama perjalanan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province_id');
            const citySelect = document.getElementById('city_id');
            const districtSelect = document.getElementById('district_id');
            const provinceName = document.getElementById('province_name');
            const cityName = document.getElementById('city_name');
            const districtName = document.getElementById('district_name');

            // Fetch Provinces
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(data => {
                    provinceSelect.innerHTML = '<option value="" disabled selected>Pilih Provinsi</option>';
                    data.forEach(province => {
                        provinceSelect.innerHTML += `<option value="${province.id}">${province.name}</option>`;
                    });
                });

            // On Province Change
            provinceSelect.addEventListener('change', function() {
                provinceName.value = this.options[this.selectedIndex].text;
                citySelect.innerHTML = '<option value="" disabled selected>Memuat Kota...</option>';
                citySelect.disabled = true;
                districtSelect.innerHTML = '<option value="" disabled selected>Pilih Kota Dahulu</option>';
                districtSelect.disabled = true;
                districtName.value = '';

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`)
                    .then(response => response.json())
                    .then(data => {
                        citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';
                        data.forEach(city => {
                            citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                        });
                        citySelect.disabled = false;
                    });
            });

            // On City Change
            citySelect.addEventListener('change', function() {
                cityName.value = this.options[this.selectedIndex].text;
                districtSelect.innerHTML = '<option value="" disabled selected>Memuat Kecamatan...</option>';
                districtSelect.disabled = true;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`)
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan (Opsional)</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                        });
                        districtSelect.disabled = false;
                    });
            });

            // On District Change
            districtSelect.addEventListener('change', function() {
                if(this.value) {
                    districtName.value = this.options[this.selectedIndex].text;
                } else {
                    districtName.value = '';
                }
            });
        });
    </script>
    @endpush
</x-front-layout>
