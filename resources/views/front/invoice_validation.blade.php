<x-front-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Validasi Dokumen Resmi</h1>
            <p class="mt-2 text-lg text-gray-600">Dokumen yang Anda pindai terdaftar sah di sistem AutoRent.</p>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-2xl border border-gray-200">
            <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-bold text-gray-900">Informasi Pesanan</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 uppercase tracking-wider">
                    Terverifikasi
                </span>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nomor Invoice</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-bold text-sky-600">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-slate-50">
                        <dt class="text-sm font-medium text-gray-500">Nama Pelanggan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-semibold">{{ $booking->user->name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Kendaraan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->car->brand }} {{ $booking->car->name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-slate-50">
                        <dt class="text-sm font-medium text-gray-500">Plat Nomor</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-bold">{{ $booking->carUnit ? $booking->carUnit->license_plate : 'Belum Ditetapkan' }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jadwal Sewa</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-slate-50">
                        <dt class="text-sm font-medium text-gray-500">Status Pesanan</dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2 font-bold uppercase text-indigo-600">
                            {{ str_replace('_', ' ', $booking->status) }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-500">
            Halaman ini adalah bukti validasi resmi dari PT AutoRent Indonesia.<br>Pindai (Scan) QR Code pada dokumen Anda untuk membuka halaman ini.
        </div>
    </div>
</x-front-layout>
