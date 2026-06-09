<x-front-layout>
    <div class="bg-slate-50 py-12 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-slate-900 mb-8 tracking-tight">Checkout Travel Shuttle</h1>

            <form action="{{ route('shuttle.store', $route->id) }}" method="POST"
                x-data="shuttleCheckout()"
                x-init="initData()">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Forms -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Route Details -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex-1 text-center sm:text-left">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-1">Dari</p>
                                <h2 class="text-2xl font-extrabold text-slate-900">{{ $route->origin_city }}</h2>
                                <p class="text-sky-600 font-medium">{{ \Carbon\Carbon::parse($route->departure_time)->format('H:i') }} WIB</p>
                            </div>
                            <div class="hidden sm:block text-slate-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                            <div class="flex-1 text-center sm:text-right">
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-1">Tujuan</p>
                                <h2 class="text-2xl font-extrabold text-slate-900">{{ $route->destination_city }}</h2>
                                <p class="text-sky-600 font-medium">{{ \Carbon\Carbon::parse($route->arrival_time)->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Travel Date -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">📅 Tanggal Keberangkatan</h3>
                            <input type="date" name="travel_date" required min="{{ date('Y-m-d') }}"
                                x-model="travelDate" @change="checkAvailability()"
                                class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 transition text-sm py-2.5 px-3">
                            @error('travel_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            
                            @if(session('error'))
                            <div class="mt-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-semibold">
                                {{ session('error') }}
                            </div>
                            @endif
                        </div>

                        <!-- Seat Selection -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">💺 Pilih Kursi</h3>
                            
                            <div x-show="!travelDate" class="p-4 bg-amber-50 text-amber-600 rounded-xl text-sm font-semibold border border-amber-100 flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Silakan pilih tanggal keberangkatan terlebih dahulu untuk melihat ketersediaan kursi.
                            </div>

                            <div x-show="travelDate" x-cloak>
                                <div class="flex items-center justify-center gap-6 mb-8 text-xs font-bold text-slate-600">
                                    <div class="flex items-center gap-2"><div class="w-5 h-5 rounded-md border-2 border-slate-200 bg-white"></div> Tersedia</div>
                                    <div class="flex items-center gap-2"><div class="w-5 h-5 rounded-md bg-sky-500 border-2 border-sky-500"></div> Pilihanmu</div>
                                    <div class="flex items-center gap-2"><div class="w-5 h-5 rounded-md bg-slate-200 border-2 border-slate-200"></div> Terisi</div>
                                </div>

                                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 max-w-sm mx-auto shadow-inner relative">
                                    <div class="w-full flex justify-between mb-8 pb-4 border-b-2 border-dashed border-slate-300">
                                        <div class="text-xs font-bold text-slate-500 uppercase tracking-widest bg-slate-200 px-4 py-1.5 rounded-full flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> Sopir
                                        </div>
                                        <div class="text-xs font-bold text-slate-500 uppercase tracking-widest bg-slate-200 px-4 py-1.5 rounded-full">Pintu Masuk</div>
                                    </div>
                                    
                                    <div class="grid grid-cols-3 gap-x-4 gap-y-4 justify-items-center">
                                        <template x-for="i in totalSeats" :key="i">
                                            <!-- Membuat kolom tengah kosong untuk lorong (aisle) -->
                                            <div class="w-full flex justify-center" :class="{'col-start-1': i % 3 === 1, 'col-start-3': i % 3 === 2, 'col-start-2': i % 3 === 0, 'row-auto': true}">
                                                <button type="button"
                                                    @click="toggleSeat(i)"
                                                    :disabled="bookedSeats.includes(i)"
                                                    :class="{
                                                        'bg-slate-200 text-slate-400 border-slate-300 cursor-not-allowed shadow-none': bookedSeats.includes(i),
                                                        'bg-sky-500 text-white border-sky-600 shadow-md transform scale-110 ring-4 ring-sky-100': selectedSeats.includes(i),
                                                        'bg-white text-slate-700 border-slate-300 hover:border-sky-500 hover:text-sky-600 hover:shadow-md': !bookedSeats.includes(i) && !selectedSeats.includes(i)
                                                    }"
                                                    class="h-14 w-14 rounded-t-xl rounded-b-md border-b-4 border-2 font-extrabold text-sm flex items-center justify-center transition-all duration-200"
                                                >
                                                    <span x-text="i"></span>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-between items-center bg-slate-100 p-4 rounded-xl border border-slate-200">
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Sisa Kursi</p>
                                        <p class="text-xl font-extrabold text-emerald-600" x-text="totalSeats - bookedSeats.length"></p>
                                    </div>
                                    <div class="h-8 border-l border-slate-300"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Jumlah Penumpang</p>
                                        <p class="text-xl font-extrabold text-sky-600"><span x-text="selectedSeats.length"></span> Orang</p>
                                    </div>
                                </div>
                                <input type="hidden" name="seat_numbers" :value="JSON.stringify(selectedSeats)">
                                <!-- Add back a hidden quantity input for any old scripts/forms that might need it -->
                                <input type="hidden" name="quantity" :value="selectedSeats.length">
                            </div>
                        </div>

                        <!-- Pickup Location -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">📍 Lokasi Penjemputan ({{ $route->origin_city }})</h3>
                            
                            @if(isset($pickupBranches) && $pickupBranches->isNotEmpty())
                            <div class="flex items-center gap-6 mb-6 p-3 bg-sky-50 rounded-xl border border-sky-100">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" x-model="pickupType" value="address" class="text-sky-600 focus:ring-sky-500 w-4 h-4">
                                    <span class="text-sm font-bold text-slate-700">Jemput di Alamat (Door to Door)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" x-model="pickupType" value="branch" class="text-sky-600 focus:ring-sky-500 w-4 h-4">
                                    <span class="text-sm font-bold text-slate-700">Naik dari Cabang AutoRent</span>
                                </label>
                            </div>

                            <div x-show="pickupType === 'branch'" x-cloak class="mb-4">
                                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Pilih Titik Naik (Cabang)</label>
                                <select x-model="selectedBranchId" :required="pickupType === 'branch'" class="w-full rounded-xl border-slate-200 bg-white focus:ring-sky-500 text-sm font-semibold text-slate-700 shadow-sm">
                                    <option value="">Pilih Cabang AutoRent...</option>
                                    <template x-for="b in pickupBranches" :key="b.id">
                                        <option :value="b.id" x-text="b.name + ' - ' + b.address"></option>
                                    </template>
                                </select>
                            </div>
                            @endif

                            <div x-show="pickupType === 'address'">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                    <select x-model="pProvinceId" @change="fetchRegencies('pickup')" :required="pickupType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm">
                                        <option value="">Pilih Provinsi</option>
                                        <template x-for="p in provinces" :key="p.id">
                                            <option :value="p.id" x-text="p.name"></option>
                                        </template>
                                    </select>
                                    <select x-model="pRegencyId" @change="fetchDistricts('pickup')" :disabled="pRegencies.length===0" :required="pickupType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm disabled:opacity-50">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        <template x-for="r in pRegencies" :key="r.id">
                                            <option :value="r.id" x-text="r.name"></option>
                                        </template>
                                    </select>
                                    <select x-model="pDistrictId" @change="updateDistrictName('pickup')" :disabled="pDistricts.length===0" :required="pickupType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm disabled:opacity-50">
                                        <option value="">Pilih Kecamatan</option>
                                        <template x-for="d in pDistricts" :key="d.id">
                                            <option :value="d.id" x-text="d.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <input type="text" x-model="pDetail" placeholder="Detail Alamat Penjemputan (Jalan, No Rumah)" :required="pickupType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm mb-4">
                                
                                <p class="text-xs font-semibold text-slate-700 mb-2">Tandai di Peta (Opsional)</p>
                                <div id="pickup-map" class="w-full h-64 rounded-xl border border-slate-200 mb-2 z-0 relative"></div>
                            </div>
                            
                            <input type="hidden" name="pickup_address" :value="fullPickupAddress">
                            <input type="hidden" name="pickup_lat" id="pickup_lat">
                            <input type="hidden" name="pickup_lng" id="pickup_lng">
                        </div>

                        <!-- Dropoff Location -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">🏠 Lokasi Pengantaran ({{ $route->destination_city }})</h3>
                            
                            @if(isset($dropoffBranches) && $dropoffBranches->isNotEmpty())
                            <div class="flex items-center gap-6 mb-6 p-3 bg-sky-50 rounded-xl border border-sky-100">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" x-model="dropoffType" value="address" class="text-sky-600 focus:ring-sky-500 w-4 h-4">
                                    <span class="text-sm font-bold text-slate-700">Antar ke Alamat (Door to Door)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" x-model="dropoffType" value="branch" class="text-sky-600 focus:ring-sky-500 w-4 h-4">
                                    <span class="text-sm font-bold text-slate-700">Turun di Cabang AutoRent</span>
                                </label>
                            </div>

                            <div x-show="dropoffType === 'branch'" x-cloak class="mb-4">
                                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Pilih Titik Turun (Cabang)</label>
                                <select x-model="selectedDropoffBranchId" :required="dropoffType === 'branch'" class="w-full rounded-xl border-slate-200 bg-white focus:ring-sky-500 text-sm font-semibold text-slate-700 shadow-sm">
                                    <option value="">Pilih Cabang AutoRent...</option>
                                    <template x-for="b in dropoffBranches" :key="b.id">
                                        <option :value="b.id" x-text="b.name + ' - ' + b.address"></option>
                                    </template>
                                </select>
                            </div>
                            @endif

                            <div x-show="dropoffType === 'address'">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                    <select x-model="dProvinceId" @change="fetchRegencies('dropoff')" :required="dropoffType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm">
                                        <option value="">Pilih Provinsi</option>
                                        <template x-for="p in provinces" :key="p.id">
                                            <option :value="p.id" x-text="p.name"></option>
                                        </template>
                                    </select>
                                    <select x-model="dRegencyId" @change="fetchDistricts('dropoff')" :disabled="dRegencies.length===0" :required="dropoffType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm disabled:opacity-50">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        <template x-for="r in dRegencies" :key="r.id">
                                            <option :value="r.id" x-text="r.name"></option>
                                        </template>
                                    </select>
                                    <select x-model="dDistrictId" @change="updateDistrictName('dropoff')" :disabled="dDistricts.length===0" :required="dropoffType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm disabled:opacity-50">
                                        <option value="">Pilih Kecamatan</option>
                                        <template x-for="d in dDistricts" :key="d.id">
                                            <option :value="d.id" x-text="d.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <input type="text" x-model="dDetail" placeholder="Detail Alamat Pengantaran (Jalan, No Rumah)" :required="dropoffType === 'address'" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:ring-sky-500 text-sm mb-4">
                                
                                <p class="text-xs font-semibold text-slate-700 mb-2">Tandai di Peta (Opsional)</p>
                                <div id="dropoff-map" class="w-full h-64 rounded-xl border border-slate-200 mb-2 z-0 relative"></div>
                            </div>

                            <input type="hidden" name="dropoff_address" :value="fullDropoffAddress">
                            <input type="hidden" name="dropoff_lat" id="dropoff_lat">
                            <input type="hidden" name="dropoff_lng" id="dropoff_lng">
                        </div>

                        <!-- Extra Services -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-base font-bold text-slate-900 mb-4">✨ Layanan Tambahan (Opsional)</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition"
                                    :class="includeSnack ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'">
                                    <input type="checkbox" name="include_snack" value="1" x-model="includeSnack" class="w-4 h-4 text-sky-600 focus:ring-sky-500">
                                    <div class="flex-1">
                                        <p class="font-bold text-slate-900 text-sm">🍪 Snack Box</p>
                                        <p class="text-xs text-slate-500">Snack box premium</p>
                                    </div>
                                    <span class="font-bold text-emerald-600 text-sm">Gratis</span>
                                </label>
                                
                                <div class="flex flex-col gap-3 p-4 rounded-xl border-2 transition" :class="includeMeal ? 'border-sky-500 bg-sky-50' : 'border-slate-200'">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="include_meal" value="1" x-model="includeMeal" @change="if(!includeMeal) { mealUpgrade = false; mealName = ''; }" class="w-4 h-4 text-sky-600 focus:ring-sky-500">
                                        <div class="flex-1">
                                            <p class="font-bold text-slate-900 text-sm">🍱 Servis Makan</p>
                                            <p class="text-xs text-slate-500">Maks. Rp 25.000 (Sudah termasuk minum)</p>
                                        </div>
                                        <span class="font-bold text-emerald-600 text-sm">Gratis</span>
                                    </label>
                                    
                                    <div x-show="includeMeal" x-transition class="pl-7 pt-2 border-t border-slate-200/60 mt-1">
                                        <div class="mb-3">
                                            <select name="meal_name" x-model="mealName" x-show="!mealUpgrade" class="w-full text-sm rounded-lg border-slate-300 focus:ring-sky-500 focus:border-sky-500 bg-white">
                                                <option value="">Pilih Menu (Gratis)...</option>
                                                @foreach($freeMeals as $meal)
                                                <option value="{{ $meal->name }}">{{ $meal->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                            <select name="meal_name" x-model="mealName" x-show="mealUpgrade" class="w-full text-sm rounded-lg border-sky-300 focus:ring-sky-500 focus:border-sky-500 bg-sky-50 text-sky-900 font-medium">
                                                <option value="">Pilih Menu (Premium)...</option>
                                                @foreach($premiumMeals as $meal)
                                                <option value="{{ $meal->name }}">{{ $meal->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="flex items-start gap-3 cursor-pointer group">
                                            <div class="relative flex items-center mt-1">
                                                <input type="checkbox" name="meal_upgrade" value="1" x-model="mealUpgrade" class="w-4 h-4 text-sky-600 focus:ring-sky-500 border-slate-300 rounded">
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-bold text-slate-900 text-sm group-hover:text-sky-600 transition-colors">✨ Upgrade Menu Premium</p>
                                                <p class="text-xs text-slate-500">Pilihan makanan enak & eksklusif</p>
                                            </div>
                                            <span class="font-bold text-sky-600 text-sm">+Rp 30.000</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-slate-900 rounded-2xl p-6 text-white sticky top-28">
                            <h3 class="text-lg font-bold mb-6 pb-4 border-b border-slate-700">Ringkasan Pesanan</h3>
                            <div class="space-y-3 text-sm mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-400">Tiket Dasar (x<span x-text="quantity"></span>)</span>
                                    <span class="font-semibold" x-text="formatRupiah(basePrice * quantity)"></span>
                                </div>
                                <div class="flex justify-between items-center" x-show="includeSnack">
                                    <span class="text-slate-400">Snack Box</span>
                                    <span class="font-semibold text-emerald-400">Gratis</span>
                                </div>
                                <div class="flex justify-between items-center" x-show="includeMeal">
                                    <span class="text-slate-400">Servis Makan</span>
                                    <span class="font-semibold text-emerald-400">Gratis</span>
                                </div>
                                <div class="flex justify-between items-center" x-show="includeMeal && mealUpgrade">
                                    <span class="text-slate-400">Upgrade Menu Premium</span>
                                    <span class="font-semibold text-sky-400">+ Rp 30.000</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-slate-700 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-white font-bold text-lg">Total</span>
                                    <span class="text-2xl font-extrabold text-sky-400" x-text="formatRupiah(totalPrice)"></span>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-4 px-6 bg-sky-600 hover:bg-sky-500 text-white font-bold rounded-xl shadow-lg transition-all">
                                Konfirmasi & Bayar →
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .leaflet-container { z-index: 10 !important; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('shuttleCheckout', () => ({
                travelDate: '',
                totalSeats: {{ $route->total_seats }},
                bookedSeats: [],
                selectedSeats: [],
                includeSnack: true,
                includeMeal: true,
                mealUpgrade: false,
                mealName: '',
                pickupType: 'address',
                selectedBranchId: '',
                pickupBranches: @json($pickupBranches ?? []),
                
                dropoffType: 'address',
                selectedDropoffBranchId: '',
                dropoffBranches: @json($dropoffBranches ?? []),
                
                basePrice: {{ $route->base_price }},
                
                get quantity() {
                    return this.selectedSeats.length;
                },

                toggleSeat(seat) {
                    if (this.bookedSeats.includes(seat)) return;
                    if (this.selectedSeats.includes(seat)) {
                        this.selectedSeats = this.selectedSeats.filter(s => s !== seat);
                    } else {
                        this.selectedSeats.push(seat);
                    }
                },

                async checkAvailability() {
                    if (!this.travelDate) return;
                    this.selectedSeats = [];
                    try {
                        const res = await fetch(`/shuttle/api/booked-seats?route_id={{ $route->id }}&travel_date=${this.travelDate}`);
                        const data = await res.json();
                        this.bookedSeats = data.booked_seats || [];
                    } catch (e) {
                        console.error('Gagal mengambil data kursi terisi');
                    }
                },

                get totalPrice() {
                    let perPerson = this.basePrice;
                    if (this.includeMeal && this.mealUpgrade) {
                        perPerson += 30000;
                    }
                    return perPerson * this.quantity;
                },
                formatRupiah(n) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n);
                },

                // Address logic
                provinces: [],
                
                pProvinceId: '', pProvinceName: '',
                pRegencies: [], pRegencyId: '', pRegencyName: '',
                pDistricts: [], pDistrictId: '', pDistrictName: '',
                pDetail: '',

                dProvinceId: '', dProvinceName: '',
                dRegencies: [], dRegencyId: '', dRegencyName: '',
                dDistricts: [], dDistrictId: '', dDistrictName: '',
                dDetail: '',

                get fullPickupAddress() {
                    if (this.pickupType === 'branch') {
                        if (!this.selectedBranchId) return '';
                        let b = this.pickupBranches.find(br => br.id == this.selectedBranchId);
                        return b ? 'CABANG AUTORENT: ' + b.name + ' - ' + b.address : '';
                    }
                    let parts = [this.pDetail, this.pDistrictName ? 'Kec. ' + this.pDistrictName : '', this.pRegencyName, this.pProvinceName ? 'Prov. ' + this.pProvinceName : ''];
                    return parts.filter(Boolean).join(', ');
                },
                get fullDropoffAddress() {
                    if (this.dropoffType === 'branch') {
                        if (!this.selectedDropoffBranchId) return '';
                        let b = this.dropoffBranches.find(br => br.id == this.selectedDropoffBranchId);
                        return b ? 'CABANG AUTORENT: ' + b.name + ' - ' + b.address : '';
                    }
                    let parts = [this.dDetail, this.dDistrictName ? 'Kec. ' + this.dDistrictName : '', this.dRegencyName, this.dProvinceName ? 'Prov. ' + this.dProvinceName : ''];
                    return parts.filter(Boolean).join(', ');
                },

                async initData() {
                    this.initMaps();
                    try {
                        const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                        this.provinces = await res.json();
                    } catch(e) {}
                },

                async fetchRegencies(type) {
                    let provId = type === 'pickup' ? this.pProvinceId : this.dProvinceId;
                    if (!provId) return;

                    if (type === 'pickup') {
                        this.pProvinceName = this.provinces.find(p => p.id === provId)?.name || '';
                        this.pRegencies = []; this.pDistricts = [];
                        this.pRegencyId = ''; this.pDistrictId = '';
                        this.pRegencyName = ''; this.pDistrictName = '';
                    } else {
                        this.dProvinceName = this.provinces.find(p => p.id === provId)?.name || '';
                        this.dRegencies = []; this.dDistricts = [];
                        this.dRegencyId = ''; this.dDistrictId = '';
                        this.dRegencyName = ''; this.dDistrictName = '';
                    }

                    try {
                        const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`);
                        let data = await res.json();
                        if (type === 'pickup') this.pRegencies = data; else this.dRegencies = data;
                    } catch(e) {}
                },

                async fetchDistricts(type) {
                    let regId = type === 'pickup' ? this.pRegencyId : this.dRegencyId;
                    if (!regId) return;

                    if (type === 'pickup') {
                        this.pRegencyName = this.pRegencies.find(r => r.id === regId)?.name || '';
                        this.pDistricts = []; this.pDistrictId = ''; this.pDistrictName = '';
                    } else {
                        this.dRegencyName = this.dRegencies.find(r => r.id === regId)?.name || '';
                        this.dDistricts = []; this.dDistrictId = ''; this.dDistrictName = '';
                    }

                    try {
                        const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regId}.json`);
                        let data = await res.json();
                        if (type === 'pickup') this.pDistricts = data; else this.dDistricts = data;
                    } catch(e) {}
                },

                updateDistrictName(type) {
                    if (type === 'pickup') {
                        this.pDistrictName = this.pDistricts.find(d => d.id === this.pDistrictId)?.name || '';
                    } else {
                        this.dDistrictName = this.dDistricts.find(d => d.id === this.dDistrictId)?.name || '';
                    }
                },

                initMaps() {
                    // Default center: Indonesia
                    let center = [-2.5489, 118.0149];
                    
                    // Pickup Map
                    let pMap = L.map('pickup-map').setView(center, 5);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(pMap);
                    
                    let pMarker;
                    pMap.on('click', function(e) {
                        let lat = e.latlng.lat;
                        let lng = e.latlng.lng;
                        if(pMarker) {
                            pMarker.setLatLng(e.latlng);
                        } else {
                            pMarker = L.marker(e.latlng).addTo(pMap);
                        }
                        document.getElementById('pickup_lat').value = lat;
                        document.getElementById('pickup_lng').value = lng;
                    });

                    // Dropoff Map
                    let dMap = L.map('dropoff-map').setView(center, 5);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(dMap);
                    
                    let dMarker;
                    dMap.on('click', function(e) {
                        let lat = e.latlng.lat;
                        let lng = e.latlng.lng;
                        if(dMarker) {
                            dMarker.setLatLng(e.latlng);
                        } else {
                            dMarker = L.marker(e.latlng).addTo(dMap);
                        }
                        document.getElementById('dropoff_lat').value = lat;
                        document.getElementById('dropoff_lng').value = lng;
                    });
                    
                    // Fix map rendering inside alpine x-show/tabs if any
                    setTimeout(() => { pMap.invalidateSize(); dMap.invalidateSize(); }, 500);
                }
            }));
        });
    </script>
    @endpush
</x-front-layout>
