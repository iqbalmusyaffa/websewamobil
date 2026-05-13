<x-front-layout>
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight">
                Hubungi Kami
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Kami siap membantu Anda 24 jam sehari, 7 hari seminggu.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white relative -mt-16 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    
                    <!-- Contact Info -->
                    <div class="bg-slate-50 p-10 lg:p-16">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Informasi Kontak</h3>
                        <p class="text-slate-600 mb-10">Punya pertanyaan seputar sewa, kemitraan, atau ingin memberikan masukan? Jangan ragu untuk menghubungi kami melalui kanal di bawah ini.</p>
                        
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-sky-100 text-sky-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-slate-900">Alamat Kantor</h4>
                                    <p class="mt-1 text-slate-600">Jl. Sudirman No. 123, Kebayoran Baru<br>Jakarta Selatan, 12190</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-sky-100 text-sky-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-slate-900">Telepon / WhatsApp</h4>
                                    <p class="mt-1 text-slate-600">+62 811-2233-4455<br>Tersedia 24 Jam</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-sky-100 text-sky-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-slate-900">Email</h4>
                                    <p class="mt-1 text-slate-600">cs@autorent.id<br>partners@autorent.id</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="p-10 lg:p-16">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Kirim Pesan</h3>
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Budi Santoso">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                                <input type="email" name="email" id="email" class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="budi@example.com">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-slate-700">Pesan Anda</label>
                                <textarea id="message" name="message" rows="4" class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>

                            <button type="button" onclick="alert('Ini adalah contoh form. Fitur pengiriman pesan akan diintegrasikan dengan sistem email backend.')" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-slate-900 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
