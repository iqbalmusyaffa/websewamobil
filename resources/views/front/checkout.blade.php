<x-front-layout>
    <div class="bg-slate-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-slate-900 mb-8 tracking-tight">Formulir Pemesanan</h1>

            <form action="{{ route('checkout.process', $car) }}" method="POST"
                x-data="{
                    startDate: '',
                    endDate: '',
                    withDriver: {{ $car->can_lepas_kunci ? 'false' : 'true' }},
                    priceWithoutDriver: {{ $car->price_without_driver }},
                    priceWithDriver: {{ $car->price_with_driver }},
                    addonPrices: {},
                    promoCode: '',
                    promoValid: null,
                    promoData: null,
                    promoMessage: '',
                    checkingPromo: false,
                    availabilityChecking: false,
                    availabilityData: null,
                    get days() {
                        if (!this.startDate || !this.endDate) return 0;
                        const start = new Date(this.startDate);
                        const end = new Date(this.endDate);
                        // Hitung durasi dalam hitungan 24 jam (pembulatan ke atas)
                        const diffHours = Math.abs(end - start) / (1000 * 60 * 60);
                        // Minimal sewa 1 hari (24 jam)
                        const diffDays = Math.ceil(diffHours / 24);
                        return diffDays > 0 ? diffDays : 1;
                    },
                    get dailyPrice() { return this.withDriver ? this.priceWithDriver : this.priceWithoutDriver; },
                    get basePrice() { return this.days * this.dailyPrice; },
                    get addonTotal() {
                        return Object.values(this.addonPrices).reduce((a, b) => a + b, 0) * this.days;
                    },
                    get discountAmount() {
                        if (!this.promoValid || !this.promoData) return 0;
                        const subtotal = this.basePrice + this.addonTotal;
                        if (subtotal < (this.promoData.min_booking || 0)) return 0;
                        let d = this.promoData.type === 'percent'
                            ? subtotal * (this.promoData.value / 100)
                            : this.promoData.value;
                        if (this.promoData.max_discount) d = Math.min(d, this.promoData.max_discount);
                        return Math.min(d, subtotal);
                    },
                    memberTier: '{{ auth()->user()->member_tier }}',
                    memberPoints: {{ auth()->user()->member_points }},
                    redeemPoints: false,
                    get tierDiscountAmount() {
                        const subtotal = this.basePrice + this.addonTotal;
                        if (this.memberTier === 'platinum') return subtotal * 0.15;
                        if (this.memberTier === 'gold') return subtotal * 0.10;
                        if (this.memberTier === 'silver') return subtotal * 0.05;
                        return 0;
                    },
                    get pointsDiscountAmount() {
                        if (!this.redeemPoints) return 0;
                        const currentTotal = Math.max(0, this.basePrice + this.addonTotal - this.discountAmount - this.tierDiscountAmount);
                        const maxPointsToUse = Math.min(this.memberPoints, Math.floor(currentTotal / 100));
                        return maxPointsToUse * 100;
                    },
                    get totalPrice() { return Math.max(0, this.basePrice + this.addonTotal - this.discountAmount - this.tierDiscountAmount - this.pointsDiscountAmount); },
                    toggleAddon(id, price) {
                        if (this.addonPrices[id] !== undefined) {
                            delete this.addonPrices[id];
                        } else {
                            this.addonPrices[id] = price;
                        }
                        this.addonPrices = { ...this.addonPrices };
                    },
                    isAddonSelected(id) { return this.addonPrices[id] !== undefined; },
                    formatRupiah(n) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n); },
                    async checkPromo() {
                        if (!this.promoCode) return;
                        this.checkingPromo = true;
                        try {
                            const res = await fetch('{{ route('promo.check') }}', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                                body: JSON.stringify({ code: this.promoCode })
                            });
                            const data = await res.json();
                            this.promoValid = data.valid;
                            this.promoData = data.valid ? data : null;
                            this.promoMessage = data.valid ? ('✅ ' + (data.description || 'Kode promo valid!')) : ('❌ ' + data.message);
                        } catch(e) { this.promoMessage = '❌ Gagal memeriksa kode promo.'; }
                        this.checkingPromo = false;
                    },
                    async checkAvailability() {
                        if (!this.startDate || !this.endDate) {
                            this.availabilityData = null;
                            return;
                        }
                        this.availabilityChecking = true;
                        try {
                            const res = await fetch('{{ route('api.check-availability') }}', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                                body: JSON.stringify({ car_id: {{ $car->id }}, start_date: this.startDate, end_date: this.endDate })
                            });
                            const data = await res.json();
                            this.availabilityData = data;
                        } catch(e) {
                            this.availabilityData = { available: false, message: '❌ Gagal mengecek ketersediaan unit.' };
                        }
                        this.availabilityChecking = false;
                    },
                    provinces: [],
                    regencies: [],
                    districts: [],
                    selectedProvinceId: '',
                    selectedProvinceName: '',
                    selectedRegencyId: '',
                    selectedRegencyName: '',
                    selectedDistrictId: '',
                    selectedDistrictName: '',
                    addressDetail: '',
                    get fullAddress() {
                        let parts = [];
                        if (this.addressDetail) parts.push(this.addressDetail);
                        if (this.selectedDistrictName) parts.push('Kec. ' + this.selectedDistrictName);
                        if (this.selectedRegencyName) parts.push(this.selectedRegencyName);
                        if (this.selectedProvinceName) parts.push('Prov. ' + this.selectedProvinceName);
                        return parts.join(', ');
                    },
                    async fetchProvinces() {
                        try {
                            const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                            this.provinces = await res.json();
                        } catch(e) {}
                    },
                    async fetchRegencies() {
                        this.regencies = [];
                        this.districts = [];
                        this.selectedRegencyId = '';
                        this.selectedDistrictId = '';
                        this.selectedRegencyName = '';
                        this.selectedDistrictName = '';
                        if (!this.selectedProvinceId) return;
                        this.selectedProvinceName = this.provinces.find(p => p.id === this.selectedProvinceId)?.name || '';
                        try {
                            const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.selectedProvinceId}.json`);
                            this.regencies = await res.json();
                        } catch(e) {}
                    },
                    async fetchDistricts() {
                        this.districts = [];
                        this.selectedDistrictId = '';
                        this.selectedDistrictName = '';
                        if (!this.selectedRegencyId) return;
                        this.selectedRegencyName = this.regencies.find(r => r.id === this.selectedRegencyId)?.name || '';
                        try {
                            const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.selectedRegencyId}.json`);
                            this.districts = await res.json();
                        } catch(e) {}
                    },
                    updateDistrictName() {
                        this.selectedDistrictName = this.districts.find(d => d.id === this.selectedDistrictId)?.name || '';
                    },
                    init() {
                        this.fetchProvinces();
                    }
                }">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left: Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Car Info -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center gap-5">
                            <img class="h-20 w-28 object-cover rounded-xl" loading="lazy"
                                src="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}"
                                alt="{{ $car->name }}">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-sky-600">{{ $car->brand }}</p>
                                <h2 class="text-2xl font-extrabold text-slate-900">{{ $car->name }}</h2>
                                <p class="text-slate-500 text-sm mt-1">{{ $car->type }} · {{ $car->capacity }} Penumpang · {{ $car->transmission }} · {{ $car->fuel_type ?? 'Bensin' }}</p>
                            </div>
                        </div>

                        <!-- Rental Period -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">📅 Periode Sewa</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-semibold text-slate-700 mb-1">Waktu Mulai</label>
                                    <input type="datetime-local" name="start_date" id="start_date" x-model="startDate" @change="checkAvailability()" required
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                                    @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-semibold text-slate-700 mb-1">Waktu Selesai</label>
                                    <input type="datetime-local" name="end_date" id="end_date" x-model="endDate" @change="checkAvailability()" required
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                                    @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Availability Alert -->
                            <div x-show="availabilityData && !availabilityData.available && startDate && endDate" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <span class="text-red-500 text-lg shrink-0 mt-0.5">⚠️</span>
                                    <div>
                                        <p class="font-bold text-red-900 text-sm mb-2">Semua Unit Tidak Tersedia</p>
                                        <p class="text-red-800 text-sm mb-3">Maaf, semua unit sudah terboking untuk periode yang dipilih. Silakan pilih tanggal alternatif di bawah.</p>

                                        <!-- Suggestions -->
                                        <div x-show="availabilityData.suggestions && availabilityData.suggestions.length > 0" class="mt-3">
                                            <p class="text-red-900 font-semibold text-xs mb-2">💡 Tanggal Alternatif yang Tersedia:</p>
                                            <ul class="space-y-1.5">
                                                <template x-for="suggestion in availabilityData.suggestions" :key="suggestion.start_date">
                                                    <li class="text-red-800 text-xs flex items-center gap-2">
                                                        <span class="inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                                                        <span x-text="suggestion.formatted" class="cursor-pointer hover:underline hover:font-semibold" @click="startDate = suggestion.start_date; endDate = suggestion.end_date; checkAvailability();"></span>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Availability Success -->
                            <div x-show="availabilityData && availabilityData.available && startDate && endDate" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <span class="text-emerald-500 text-lg">✅</span>
                                    <p class="text-emerald-800 font-medium text-sm" x-text="availabilityData.message"></p>
                                </div>
                            </div>

                            <!-- Checking Status -->
                            <div x-show="availabilityChecking && startDate && endDate" x-transition:enter="transition ease-out duration-200" class="mt-4 p-4 bg-sky-50 border-l-4 border-sky-500 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <span class="animate-spin text-sky-500">⏳</span>
                                    <p class="text-sky-800 font-medium text-sm">Memeriksa ketersediaan unit...</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Penjemputan</label>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                                    <div>
                                        <select x-model="selectedProvinceId" @change="fetchRegencies" required class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                                            <option value="" disabled>Pilih Provinsi</option>
                                            <template x-for="prov in provinces" :key="prov.id">
                                                <option :value="prov.id" x-text="prov.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <select x-model="selectedRegencyId" @change="fetchDistricts" :disabled="regencies.length === 0" required class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3 disabled:opacity-50">
                                            <option value="" disabled>Pilih Kabupaten/Kota</option>
                                            <template x-for="reg in regencies" :key="reg.id">
                                                <option :value="reg.id" x-text="reg.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <select x-model="selectedDistrictId" @change="updateDistrictName" :disabled="districts.length === 0" required class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3 disabled:opacity-50">
                                            <option value="" disabled>Pilih Kecamatan</option>
                                            <template x-for="dist in districts" :key="dist.id">
                                                <option :value="dist.id" x-text="dist.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <input type="text" x-model="addressDetail" required
                                        placeholder="Alamat Lengkap (Cth: Jl. Melati No. 5 / Blok A)"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                                </div>

                                <input type="hidden" name="pickup_location" :value="fullAddress">
                                @error('pickup_location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Driver Option -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">🚗 Opsi Sopir</h3>
                            @if(!$car->can_lepas_kunci)
                                <input type="hidden" name="with_driver" value="1">
                                <div class="flex items-center gap-3 p-4 bg-amber-50 rounded-xl border border-amber-200">
                                    <span class="text-amber-500 text-xl">⚠️</span>
                                    <p class="text-sm font-medium text-amber-800">Mobil ini <strong>wajib menggunakan sopir</strong>.</p>
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div @click="withDriver = false" class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition"
                                        :class="!withDriver ? 'border-sky-500 bg-sky-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300'">
                                        <div class="flex-1">
                                            <p class="font-bold text-slate-900">Lepas Kunci</p>
                                            <p class="text-xs text-slate-500">Tanpa sopir, bebas berkelana</p>
                                        </div>
                                        <span class="font-bold text-sky-600 text-sm" x-text="formatRupiah(priceWithoutDriver) + '/hari'"></span>
                                    </div>
                                    <div @click="withDriver = true" class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition"
                                        :class="withDriver ? 'border-sky-500 bg-sky-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300'">
                                        <div class="flex-1">
                                            <p class="font-bold text-slate-900">Dengan Sopir</p>
                                            <p class="text-xs text-slate-500">Santai, aman, tanpa capek</p>
                                        </div>
                                        <span class="font-bold text-sky-600 text-sm" x-text="formatRupiah(priceWithDriver) + '/hari'"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="with_driver" :value="withDriver ? '1' : '0'">
                            @endif
                        </div>

                        <!-- Biaya Tidak Termasuk (Dengan Sopir) -->
                        <div x-show="withDriver" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-amber-50 rounded-2xl shadow-sm border border-amber-200 p-5">
                            <div class="flex gap-3">
                                <span class="text-amber-500 text-lg shrink-0 mt-0.5">⚠️</span>
                                <div>
                                    <h4 class="text-sm font-bold text-amber-900 mb-2">Biaya Tidak Termasuk dalam Harga Sewa Sopir</h4>
                                    <ul class="space-y-1 text-xs text-amber-800">
                                        <li class="flex items-center gap-1.5">• <strong>Uang makan sopir</strong> selama perjalanan</li>
                                        <li class="flex items-center gap-1.5">• <strong>Biaya tol</strong> (jika melewati jalan tol)</li>
                                        <li class="flex items-center gap-1.5">• <strong>Tiket parkir</strong> di seluruh lokasi tujuan</li>
                                        <li class="flex items-center gap-1.5">• <strong>Tiket pelabuhan/penyeberangan</strong> jika antar pulau</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Add-ons -->
                        @if($addons->isNotEmpty())
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">✨ Layanan Tambahan (Opsional)</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($addons as $addon)
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition"
                                    :class="isAddonSelected({{ $addon->id }}) ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'"
                                    @click.prevent="toggleAddon({{ $addon->id }}, {{ $addon->price }})">
                                    <input type="checkbox" name="addons[]" value="{{ $addon->id }}"
                                        :checked="isAddonSelected({{ $addon->id }})" class="sr-only">
                                    <span class="text-2xl">{{ $addon->icon ?? '🔧' }}</span>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-900 text-sm truncate">{{ $addon->name }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ $addon->description }}</p>
                                    </div>
                                    <span class="font-bold text-sky-600 text-sm whitespace-nowrap">+Rp {{ number_format($addon->price, 0, ',', '.') }}/hr</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Points Redemption -->
                        @if(auth()->user()->member_points > 0)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">🌟 Gunakan Poin Member</h3>
                            <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition"
                                :class="redeemPoints ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'">
                                <input type="checkbox" name="redeem_points" value="1" x-model="redeemPoints" class="sr-only">
                                <span class="text-2xl">💎</span>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-slate-900 text-sm truncate">Tukar {{ number_format(auth()->user()->member_points, 0, ',', '.') }} Poin</p>
                                    <p class="text-xs text-slate-500">Maksimal potongan <span x-text="formatRupiah(memberPoints * 100)"></span></p>
                                </div>
                                <span class="font-bold text-emerald-600 text-sm whitespace-nowrap" x-show="redeemPoints" x-text="'-' + formatRupiah(pointsDiscountAmount)"></span>
                            </label>
                        </div>
                        @endif

                        <!-- Promo Code -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">🎟️ Kode Promo</h3>
                            <div class="flex gap-3">
                                <input type="text" name="promo_code" id="promo_code" x-model="promoCode"
                                    placeholder="Masukkan kode promo..."
                                    class="flex-1 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3 uppercase">
                                <button type="button" @click="checkPromo()"
                                    :disabled="checkingPromo || !promoCode"
                                    class="px-5 py-2.5 bg-sky-600 text-white text-sm font-bold rounded-xl hover:bg-sky-700 transition disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
                                    <span x-show="!checkingPromo">Gunakan</span>
                                    <span x-show="checkingPromo">Memeriksa...</span>
                                </button>
                            </div>
                            <p x-show="promoMessage" x-text="promoMessage" class="mt-2 text-sm font-medium"
                                :class="promoValid ? 'text-emerald-600' : 'text-red-500'"></p>
                        </div>
                    </div>

                    <!-- Right: Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-slate-900 rounded-2xl p-6 text-white sticky top-28">
                            <h3 class="text-lg font-bold mb-6 pb-4 border-b border-slate-700">Ringkasan Pesanan</h3>
                            <div class="space-y-3 text-sm mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-400">Durasi</span>
                                    <span class="font-semibold" x-text="days + ' Hari'">0 Hari</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-400">Harga Dasar</span>
                                    <span class="font-semibold" x-text="formatRupiah(basePrice)">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center" x-show="addonTotal > 0">
                                    <span class="text-slate-400">Layanan Tambahan</span>
                                    <span class="font-semibold text-sky-400" x-text="'+ ' + formatRupiah(addonTotal)"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="tierDiscountAmount > 0">
                                    <span class="text-slate-400">Diskon Member VIP</span>
                                    <span class="font-semibold text-emerald-400" x-text="'- ' + formatRupiah(tierDiscountAmount)"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="discountAmount > 0">
                                    <span class="text-slate-400">Diskon Promo</span>
                                    <span class="font-semibold text-emerald-400" x-text="'- ' + formatRupiah(discountAmount)"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="pointsDiscountAmount > 0">
                                    <span class="text-slate-400">Tukar Poin</span>
                                    <span class="font-semibold text-emerald-400" x-text="'- ' + formatRupiah(pointsDiscountAmount)"></span>
                                </div>
                            </div>
                            <div class="border-t border-slate-700 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-white font-bold text-lg">Total</span>
                                    <span class="text-2xl font-extrabold text-sky-400" x-text="formatRupiah(totalPrice)">Rp 0</span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" required class="mt-1 w-4 h-4 rounded border-slate-600 bg-slate-800 text-sky-500 focus:ring-sky-500 focus:ring-offset-slate-900">
                                    <span class="text-xs text-slate-400 leading-relaxed">
                                        Saya setuju dengan <a href="{{ route('terms') }}" class="text-sky-400 hover:underline" target="_blank">Syarat & Ketentuan</a> yang berlaku, termasuk <strong>kewajiban membayar DP</strong> dan <strong>menyiapkan KTP Asli/Identitas Resmi</strong> saat penyerahan kendaraan.
                                    </span>
                                </label>
                            </div>
                            <button type="submit"
                                class="w-full py-4 px-6 bg-sky-600 hover:bg-sky-500 text-white font-bold rounded-xl shadow-lg hover:shadow-sky-600/30 transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                x-bind:disabled="days <= 0">
                                Konfirmasi Pesanan →
                            </button>
                            <p class="text-center text-xs text-slate-500 mt-3">Pembayaran dilakukan di langkah berikutnya</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-front-layout>
