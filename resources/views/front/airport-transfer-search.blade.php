<x-front-layout>
    <div class="bg-slate-50 min-h-screen pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Summary Header -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-1">
                            {{ $request->type == 'to_airport' ? 'Ke Bandara' : 'Dari Bandara' }}
                        </p>
                        <h2 class="text-xl md:text-2xl font-extrabold text-slate-900">
                            @php
                                $locationName = $zone ? $zone->name : ($request->district_name ? $request->district_name . ', ' . $request->city_name : $request->city_name);
                            @endphp
                            @if($request->type == 'to_airport')
                                {{ $locationName }} &rarr; {{ $airport->name }}
                            @else
                                {{ $airport->name }} &rarr; {{ $locationName }}
                            @endif
                        </h2>
                        <p class="text-sm font-medium text-slate-500 mt-1">
                            Jadwal: {{ \Carbon\Carbon::parse($request->pickup_date)->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('airport-transfer') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-bold transition-colors text-sm">
                        Ubah Pencarian
                    </a>
                </div>
            </div>

            <!-- Results -->
            <div class="mb-8">
                <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Pilih Armada</h3>
                <p class="text-slate-500 text-sm">Harga di bawah sudah termasuk (Mobil + Supir + BBM + Tol + Parkir Bandara)</p>
            </div>

            @if($prices->count() > 0)
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($prices as $price)
                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-shadow flex flex-col">
                        <div class="h-48 bg-slate-100 relative overflow-hidden">
                            <img src="{{ $price->car->image_url ?? 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $price->car->name }}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <div class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-slate-900 shadow-sm self-start">
                                    {{ $price->car->brand }}
                                </div>
                                <div class="bg-sky-500 text-white px-3 py-1 rounded-full text-[10px] font-bold shadow-sm border border-sky-400 self-start uppercase tracking-wider">
                                    Mobil Privat
                                </div>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h4 class="text-xl font-bold text-slate-900 mb-4">{{ $price->car->name }}</h4>
                            
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="flex items-center text-sm text-slate-600">
                                    <svg class="w-4 h-4 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Max {{ $price->car->capacity ?? 4 }} Penumpang
                                </div>
                                <div class="flex items-center text-sm text-slate-600">
                                    <svg class="w-4 h-4 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $price->car->luggage_capacity ?? 2 }} Koper
                                </div>
                                <div class="flex items-center text-sm font-bold text-sky-600 col-span-2">
                                    <svg class="w-4 h-4 mr-2 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Layanan Privat 1 Mobil
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Harga Final</p>
                                    @php
                                        $finalPrice = $price->price - ($matchedArea ? $matchedArea->discount_amount : 0);
                                    @endphp
                                    <p class="text-2xl font-extrabold text-sky-600">Rp {{ number_format($finalPrice, 0, ',', '.') }} <span class="text-sm font-medium text-slate-500">/ mobil</span></p>
                                    @if($matchedArea && $matchedArea->discount_amount > 0)
                                        <p class="text-xs text-emerald-500 font-medium">Lebih hemat Rp {{ number_format($matchedArea->discount_amount, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('airport-transfer.checkout', [
                                    'price_id' => $price->id, 
                                    'type' => $request->type, 
                                    'pickup_date' => $request->pickup_date,
                                    'area_id' => $matchedArea ? $matchedArea->id : '',
                                    'province_id' => $request->province_id,
                                    'province_name' => $request->province_name,
                                    'city_id' => $request->city_id,
                                    'city_name' => $request->city_name,
                                    'district_id' => $request->district_id,
                                    'district_name' => $request->district_name,
                                ]) }}" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-sky-600 transition-colors">
                                    Pilih
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Armada Tersedia</h3>
                    <p class="text-slate-500 mb-6">Maaf, kami belum memiliki daftar harga untuk rute dan bandara tersebut. Silakan hubungi admin kami untuk penawaran harga khusus.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center px-6 py-3 bg-emerald-500 text-white font-bold rounded-full hover:bg-emerald-600 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-front-layout>
