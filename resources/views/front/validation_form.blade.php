<x-front-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-sky-100 mb-4">
                <svg class="w-10 h-10 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Validasi Dokumen</h1>
            <p class="mt-2 text-lg text-gray-600">Punya dokumen dari AutoRent? Cek keasliannya di sini.</p>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-2xl border border-gray-200 p-6 sm:p-8">
            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center">
                <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <form action="{{ route('validation.process') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Invoice (Order ID)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">#</span>
                        </div>
                        <input type="text" name="invoice_number" required class="block w-full pl-8 pr-12 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent text-lg" placeholder="Contoh: 00123" value="{{ old('invoice_number') }}">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Masukkan 5 digit nomor invoice yang tertera pada bagian atas kanan PDF kwitansi Anda.</p>
                </div>

                <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                    Validasi Sekarang
                </button>
            </form>
            
            <div class="mt-8 pt-6 border-t border-gray-100">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-900">Atau gunakan kamera HP Anda</h4>
                        <p class="mt-1 text-sm text-gray-500">Anda dapat langsung memindai (Scan) QR Code yang terdapat pada dokumen PDF untuk validasi lebih cepat tanpa perlu mengetik nomor manual.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
