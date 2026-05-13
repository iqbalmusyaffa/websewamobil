<x-front-layout>
    <!-- Hero Section -->
    <div class="relative w-full min-h-[90vh] flex items-center justify-center overflow-hidden bg-slate-900 pt-20 pb-32">
        <!-- Background Video -->
        <div class="absolute inset-0 z-0">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-80">
                <source src="https://videos.pexels.com/video-files/3209300/3209300-uhd_2560_1440_25fps.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-slate-900/60 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
            <!-- Transisi mulus ke bagian bawah -->
            <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-slate-50 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center mt-10">
            <div class="w-full lg:w-3/5 lg:pr-12 text-center lg:text-left">
                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-white/10 backdrop-blur-md text-white border border-white/20 mb-8 shadow-sm">
                    <span class="flex w-2.5 h-2.5 rounded-full bg-sky-400 mr-2.5 animate-pulse"></span>
                    Armada Terbaru 2024 Tersedia
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-md">
                    Standar Baru <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-300 via-sky-400 to-blue-500 drop-shadow-none">Perjalanan Eksklusif</span>
                </h1>
                <p class="mt-4 text-lg md:text-xl text-slate-200 max-w-2xl mx-auto lg:mx-0 mb-10 leading-relaxed font-light drop-shadow">
                    Sewa kendaraan premium dengan mudah dan aman. Baik untuk urusan bisnis, liburan keluarga, atau acara khusus, kami menjamin kenyamanan sempurna di setiap kilometer.
                </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('cars.index') }}" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-full text-slate-900 bg-white hover:bg-sky-50 shadow-lg shadow-white/20 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                                Pesan Sekarang
                            </a>
                            <a href="#about" class="inline-flex justify-center items-center px-8 py-4 border border-white/30 backdrop-blur-sm text-base font-bold rounded-full text-white hover:bg-white/10 transition-all duration-300">
                                Pelajari Lebih Lanjut
                            </a>
                </div>
            </div>
            
            <!-- Quick search/stats card right side -->
            <div class="hidden lg:block w-full lg:w-2/5 mt-12 lg:mt-0 relative">
                <div class="absolute -inset-4 bg-sky-500/20 rounded-[3rem] blur-2xl animate-pulse"></div>
                <div class="relative bg-slate-900/40 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-2xl font-bold text-white mb-8">Mengapa AutoRent?</h3>
                    <ul class="space-y-6">
                        <li class="flex items-center group">
                            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400/20 to-blue-600/20 flex items-center justify-center border border-white/10 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-7 w-7 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-lg font-semibold text-white group-hover:text-sky-300 transition-colors">100% Asuransi Penuh</p>
                                <p class="text-sm text-slate-300">Perjalanan tenang tanpa rasa khawatir.</p>
                            </div>
                        </li>
                        <li class="flex items-center group">
                            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400/20 to-blue-600/20 flex items-center justify-center border border-white/10 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-7 w-7 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-lg font-semibold text-white group-hover:text-sky-300 transition-colors">Dukungan 24/7</p>
                                <p class="text-sm text-slate-300">Tim kami siap membantu kapan saja.</p>
                            </div>
                        </li>
                        <li class="flex items-center group">
                            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400/20 to-blue-600/20 flex items-center justify-center border border-white/10 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-7 w-7 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-lg font-semibold text-white group-hover:text-sky-300 transition-colors">Harga Transparan</p>
                                <p class="text-sm text-slate-300">Tidak ada biaya tersembunyi.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-slate-50 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 py-10 px-8 grid grid-cols-2 gap-8 sm:grid-cols-4 text-center transform -translate-y-6 lg:-translate-y-12 relative z-20">
                <div class="p-4 rounded-3xl hover:bg-sky-50 transition-colors duration-300">
                    <p class="text-4xl md:text-5xl font-extrabold text-sky-600">500+</p>
                    <p class="mt-3 text-xs md:text-sm font-bold text-slate-500 uppercase tracking-wider">Mobil Tersedia</p>
                </div>
                <div class="p-4 rounded-3xl hover:bg-sky-50 transition-colors duration-300">
                    <p class="text-4xl md:text-5xl font-extrabold text-sky-600">10k+</p>
                    <p class="mt-3 text-xs md:text-sm font-bold text-slate-500 uppercase tracking-wider">Pelanggan Puas</p>
                </div>
                <div class="p-4 rounded-3xl hover:bg-sky-50 transition-colors duration-300">
                    <p class="text-4xl md:text-5xl font-extrabold text-sky-600">50+</p>
                    <p class="mt-3 text-xs md:text-sm font-bold text-slate-500 uppercase tracking-wider">Kota Layanan</p>
                </div>
                <div class="p-4 rounded-3xl hover:bg-sky-50 transition-colors duration-300">
                    <p class="text-4xl md:text-5xl font-extrabold text-sky-600">15</p>
                    <p class="mt-3 text-xs md:text-sm font-bold text-slate-500 uppercase tracking-wider">Thn Pengalaman</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Trusted Brands Section -->
    <div class="py-12 bg-white border-b border-slate-100 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs font-black text-slate-400 uppercase tracking-widest mb-8">Pilihan Merek Kendaraan Premium Kami</p>
            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-16 lg:gap-24 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-3xl font-black text-slate-800 tracking-tighter">TOYOTA</span>
                <span class="text-3xl font-black text-slate-800 tracking-tight">HONDA</span>
                <span class="text-3xl font-black text-slate-800 tracking-tighter">BMW</span>
                <span class="text-3xl font-black text-slate-800 tracking-tight">MERCEDES</span>
                <span class="text-3xl font-black text-slate-800 tracking-tighter">HYUNDAI</span>
                <span class="text-3xl font-black text-slate-800 tracking-tight">MITSUBISHI</span>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <div id="about" class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-20 items-center">
                <div class="relative mb-16 lg:mb-0 group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-sky-100 to-blue-50 rounded-[3rem] blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white transform group-hover:-translate-y-2 transition-transform duration-500">
                        <img class="w-full object-cover h-[500px] lg:h-[600px] transform group-hover:scale-105 transition-transform duration-700" src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="About AutoRent Office">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>
                    <!-- Floating badge -->
                    <div class="absolute -bottom-8 -right-8 bg-white p-6 rounded-[2rem] shadow-2xl border border-slate-100 hidden md:block transform group-hover:-translate-y-2 group-hover:-translate-x-2 transition-transform duration-500 z-10">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 bg-gradient-to-br from-sky-100 to-blue-50 rounded-[1.5rem] flex items-center justify-center shadow-inner">
                                <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                            </div>
                            <div>
                                <p class="text-4xl font-extrabold text-slate-900">4.9<span class="text-xl text-slate-400">/5</span></p>
                                <p class="text-sm font-bold text-slate-500 uppercase tracking-wide mt-1">Rating Kepuasan</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-sky-50 text-sky-600 mb-6 border border-sky-100">
                        Tentang AutoRent
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-[1.2]">
                        Mendefinisikan Ulang <span class="text-sky-600">Standar Rental Kendaraan</span>
                    </h2>
                    <p class="mt-6 text-lg text-slate-500 leading-relaxed font-light">
                        Sejak didirikan pada tahun 2009, AutoRent berkomitmen untuk memberikan pengalaman mobilitas terbaik. Kami tidak sekadar menyewakan mobil; kami memberikan solusi transportasi yang dapat diandalkan, nyaman, dan aman untuk setiap langkah perjalanan Anda.
                    </p>
                    
                    <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-lg shadow-slate-100/50 hover:shadow-xl hover:border-sky-100 transition-all duration-300 group">
                            <div class="w-12 h-12 bg-sky-50 rounded-[1rem] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Visi Kami</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Menjadi mitra mobilitas nomor satu di Indonesia dengan pelayanan bertaraf internasional.</p>
                        </div>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-lg shadow-slate-100/50 hover:shadow-xl hover:border-sky-100 transition-all duration-300 group">
                            <div class="w-12 h-12 bg-sky-50 rounded-[1rem] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Misi Kami</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Menyediakan armada berkualitas tinggi yang higienis, aman, dan terjangkau.</p>
                        </div>
                    </div>
                    
                    <div class="mt-10">
                        <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-bold rounded-full hover:bg-sky-600 transition-all duration-300 transform hover:-translate-y-1 shadow-lg shadow-slate-900/20">
                            Baca Cerita Kami Selengkapnya
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Cars -->
    <div id="services" class="py-24 bg-slate-50 relative">
        <!-- Decor -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-sky-50 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-sky-100 text-sky-700 mb-4 border border-sky-200">
                        Koleksi Kendaraan
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">
                        Temukan Mobil yang Tepat
                    </h2>
                    <p class="mt-4 text-xl text-slate-500 font-light">
                        Dari city car yang gesit hingga SUV mewah, armada kami dirawat secara rutin untuk memastikan perjalanan yang mulus.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center px-6 py-3 bg-white border border-slate-200 text-slate-900 font-bold rounded-full hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all duration-300 shadow-sm">
                        Lihat Seluruh Katalog
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($cars as $car)
                    <div class="bg-white overflow-hidden rounded-[2.5rem] shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group flex flex-col h-full border border-slate-100">
                        <div class="relative h-64 overflow-hidden bg-slate-100 m-2.5 rounded-[2rem]">
                            <img class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" src="{{ $car->image_url ?? 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $car->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-slate-900 shadow-sm border border-white/50">
                                {{ $car->brand }}
                            </div>
                            @if($car->averageRating() > 0)
                            <div class="absolute top-4 right-4 bg-amber-400/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold text-slate-900 shadow-sm border border-amber-300/50 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                {{ number_format($car->averageRating(), 1) }}
                            </div>
                            @endif
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-sky-600 transition-colors">{{ $car->name }}</h3>
                                    <p class="text-sm font-medium text-slate-500 mt-1">{{ $car->type ?? 'Premium' }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 py-5 border-y border-slate-100 mb-6 flex-1 bg-slate-50/50 rounded-2xl px-4 mt-2">
                                <div class="flex items-center text-sm font-medium text-slate-600">
                                    <svg class="w-5 h-5 text-sky-500 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    {{ $car->capacity ?? 4 }} Kursi
                                </div>
                                <div class="flex items-center text-sm font-medium text-slate-600">
                                    <svg class="w-5 h-5 text-sky-500 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ ucfirst($car->transmission) ?? 'Otomatis' }}
                                </div>
                                <div class="flex items-center text-sm font-medium text-slate-600">
                                    <svg class="w-5 h-5 text-sky-500 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    {{ $car->fuel_type ?? 'Bensin' }}
                                </div>
                                <div class="flex items-center text-sm font-medium text-slate-600">
                                    <svg class="w-5 h-5 text-sky-500 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    Terlindungi
                                </div>
                            </div>
                            
                            <div class="flex items-end justify-between mt-auto pt-2">
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai dari</p>
                                    <p class="text-2xl font-extrabold text-slate-900">Rp {{ number_format($car->can_lepas_kunci ? $car->price_without_driver : $car->price_with_driver, 0, ',', '.') }}<span class="text-sm font-medium text-slate-500">/hari</span></p>
                                </div>
                                <a href="{{ route('cars.show', $car) }}" class="inline-flex items-center justify-center w-12 h-12 bg-slate-900 text-white rounded-[1rem] hover:bg-sky-600 transition-colors shadow-lg shadow-slate-900/20 group-hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Promo Section -->
    @if(isset($promos) && $promos->count() > 0)
    <div class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-slate-50 to-white pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-rose-50 text-rose-600 mb-4 border border-rose-100">
                        Promo Spesial
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">
                        Penawaran <span class="text-rose-600">Terbaik Bulan Ini</span>
                    </h2>
                </div>
            </div>

            <div class="grid gap-8 grid-cols-1 md:grid-cols-2">
                @foreach($promos as $index => $promo)
                <!-- Promo Card -->
                <div class="{{ $index % 2 == 0 ? 'bg-gradient-to-br from-sky-500 to-blue-700' : 'bg-gradient-to-br from-slate-800 to-slate-900' }} rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden group shadow-2xl {{ $index % 2 == 0 ? 'shadow-sky-900/20' : 'shadow-slate-900/20' }}">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent pointer-events-none"></div>
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 {{ $index % 2 == 0 ? 'bg-white/20' : 'bg-rose-500/20' }} rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    
                    <div class="relative z-10 w-full md:w-5/6">
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-[10px] font-black tracking-widest mb-6 uppercase">KODE: {{ $promo->code }}</span>
                        <h3 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight">
                            @if($promo->type == 'percent')
                                Diskon {{ $promo->value }}%
                            @else
                                Potongan Rp {{ number_format($promo->value, 0, ',', '.') }}
                            @endif
                        </h3>
                        <p class="{{ $index % 2 == 0 ? 'text-sky-100' : 'text-slate-300' }} mb-8 leading-relaxed font-light text-lg">{{ $promo->description ?? 'Gunakan kode promo ini saat melakukan pemesanan kendaraan untuk mendapatkan harga spesial.' }}</p>
                        <a href="{{ route('cars.index') }}" class="inline-flex items-center px-8 py-4 {{ $index % 2 == 0 ? 'bg-white text-sky-700 hover:bg-sky-50' : 'bg-rose-500 text-white hover:bg-rose-600 shadow-rose-500/30' }} font-bold rounded-full transition-colors shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-300">
                            Gunakan Promo <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- How it Works Section -->
    <div class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-sky-100 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-blue-100 rounded-full blur-[100px] opacity-60"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-sky-50 text-sky-600 mb-4 border border-sky-100">
                    Cara Kerja
                </div>
                <h3 class="mt-2 text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">Sewa Mobil Semudah <span class="text-sky-600">1-2-3-4</span></h3>
                <p class="mt-6 text-xl text-slate-500 max-w-2xl mx-auto font-light">Kami menyederhanakan proses penyewaan mobil agar Anda bisa segera menikmati perjalanan tanpa ribet.</p>
            </div>

            <div class="relative">
                <!-- Connecting Line (hidden on mobile) -->
                <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-1 bg-gradient-to-r from-sky-100 via-sky-300 to-sky-100 rounded-full" aria-hidden="true"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                    <!-- Step 1 -->
                    <div class="relative text-center group">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-white rounded-[2rem] flex items-center justify-center relative z-10 shadow-xl shadow-sky-100 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 to-blue-50 rounded-[1.7rem] -z-10"></div>
                            <span class="text-sky-600">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <div class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-black text-lg shadow-lg border-4 border-white">1</div>
                        </div>
                        <h4 class="mt-8 text-xl font-bold text-slate-900">Pilih Mobil</h4>
                        <p class="mt-3 text-sm text-slate-500 leading-relaxed font-light">Jelajahi katalog kami dan temukan mobil yang paling sesuai dengan kebutuhan perjalanan Anda.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative text-center group">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-white rounded-[2rem] flex items-center justify-center relative z-10 shadow-xl shadow-sky-100 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 to-blue-50 rounded-[1.7rem] -z-10"></div>
                            <span class="text-sky-600">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </span>
                            <div class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-black text-lg shadow-lg border-4 border-white">2</div>
                        </div>
                        <h4 class="mt-8 text-xl font-bold text-slate-900">Tentukan Tanggal</h4>
                        <p class="mt-3 text-sm text-slate-500 leading-relaxed font-light">Pilih tanggal pengambilan dan pengembalian, serta lengkapi data pemesanan Anda.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative text-center group">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-white rounded-[2rem] flex items-center justify-center relative z-10 shadow-xl shadow-sky-100 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 to-blue-50 rounded-[1.7rem] -z-10"></div>
                            <span class="text-sky-600">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </span>
                            <div class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-black text-lg shadow-lg border-4 border-white">3</div>
                        </div>
                        <h4 class="mt-8 text-xl font-bold text-slate-900">Pembayaran Aman</h4>
                        <p class="mt-3 text-sm text-slate-500 leading-relaxed font-light">Lakukan pembayaran dengan metode pilihan Anda. Kami mendukung berbagai sistem pembayaran digital.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative text-center group">
                        <div class="w-24 h-24 mx-auto bg-white border-4 border-white rounded-[2rem] flex items-center justify-center relative z-10 shadow-xl shadow-sky-100 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 to-blue-50 rounded-[1.7rem] -z-10"></div>
                            <span class="text-sky-600">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            <div class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-black text-lg shadow-lg border-4 border-white">4</div>
                        </div>
                        <h4 class="mt-8 text-xl font-bold text-slate-900">Mulai Perjalanan</h4>
                        <p class="mt-3 text-sm text-slate-500 leading-relaxed font-light">Ambil mobil di titik yang disepakati atau gunakan layanan antar kendaraan kami ke lokasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mini FAQ Section -->
    <div class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-white text-slate-600 mb-4 border border-slate-200 shadow-sm">
                    FAQ
                </div>
                <h3 class="mt-2 text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">Pertanyaan <span class="text-sky-600">Sering Diajukan</span></h3>
            </div>
            
            <div class="space-y-5" x-data="{selected: null}">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                    <button @click="selected !== 1 ? selected = 1 : selected = null" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800">Apa saja syarat menyewa mobil lepas kunci?</span>
                        <div class="flex-shrink-0 ml-4 w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 transition-colors" :class="{'bg-sky-50 border-sky-100 text-sky-600': selected === 1, 'text-slate-400': selected !== 1}">
                            <svg class="w-5 h-5 transition-transform duration-300 transform" :class="{'rotate-180': selected === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="selected === 1" x-collapse>
                        <div class="px-8 pb-6 text-slate-500 text-base font-light leading-relaxed">
                            Untuk penyewaan lepas kunci, kami membutuhkan KTP asli, SIM A yang masih berlaku, dan dokumen pendukung lainnya sesuai kebijakan kami. Tim kami akan melakukan verifikasi data sebelum serah terima kunci.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                    <button @click="selected !== 2 ? selected = 2 : selected = null" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800">Apakah asuransi sudah termasuk dalam biaya sewa?</span>
                        <div class="flex-shrink-0 ml-4 w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 transition-colors" :class="{'bg-sky-50 border-sky-100 text-sky-600': selected === 2, 'text-slate-400': selected !== 2}">
                            <svg class="w-5 h-5 transition-transform duration-300 transform" :class="{'rotate-180': selected === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="selected === 2" x-collapse>
                        <div class="px-8 pb-6 text-slate-500 text-base font-light leading-relaxed">
                            Ya, seluruh armada kami sudah dilindungi oleh asuransi All Risk (Komprehensif). Namun, terdapat biaya risiko sendiri (Own Risk) jika terjadi klaim asuransi akibat kelalaian pengguna.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                    <button @click="selected !== 3 ? selected = 3 : selected = null" class="flex justify-between items-center w-full px-8 py-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800">Bisakah saya membatalkan atau mengubah jadwal pesanan?</span>
                        <div class="flex-shrink-0 ml-4 w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 transition-colors" :class="{'bg-sky-50 border-sky-100 text-sky-600': selected === 3, 'text-slate-400': selected !== 3}">
                            <svg class="w-5 h-5 transition-transform duration-300 transform" :class="{'rotate-180': selected === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="selected === 3" x-collapse>
                        <div class="px-8 pb-6 text-slate-500 text-base font-light leading-relaxed">
                            Anda dapat mengubah jadwal pesanan selambat-lambatnya 24 jam sebelum waktu pengambilan kendaraan tanpa dikenakan biaya. Pembatalan setelah waktu tersebut dapat dikenakan biaya administrasi sesuai kebijakan yang berlaku.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('faq') }}" class="inline-flex items-center px-8 py-4 bg-white border border-slate-200 text-slate-900 font-bold rounded-full hover:bg-slate-50 hover:border-slate-300 transition-all duration-300 shadow-sm">
                    Lihat Semua FAQ
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-sky-50 text-sky-600 mb-4 border border-sky-100">
                    Testimoni
                </div>
                <h3 class="mt-2 text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900">Apa Kata <span class="text-sky-600">Pelanggan Kami</span></h3>
            </div>

            <div x-data="{
                    activeSlide: 0,
                    slides: [
                        {
                            name: 'Budi Santoso',
                            role: 'Eksekutif Bisnis',
                            img: '11',
                            text: 'Pelayanan luar biasa! Proses booking sangat cepat, mobil diantar tepat waktu dan kondisinya sangat bersih layaknya mobil baru. Sangat direkomendasikan.'
                        },
                        {
                            name: 'Siti Rahmawati',
                            role: 'Ibu Rumah Tangga',
                            img: '5',
                            text: 'Menyewa mobil untuk liburan keluarga di Bali lewat AutoRent adalah keputusan terbaik. Sopirnya ramah, mengerti rute, dan harga sesuai dengan di website.'
                        },
                        {
                            name: 'Andi Wijaya',
                            role: 'Karyawan Swasta',
                            img: '12',
                            text: 'Saya butuh mobil darurat malam hari karena ada urusan mendadak. CS AutoRent sangat responsif, proses 10 menit beres. Benar-benar bisa diandalkan.'
                        },
                        {
                            name: 'Maya Indah',
                            role: 'Travel Blogger',
                            img: '9',
                            text: 'Koleksi mobilnya sangat lengkap dan terawat. Sangat nyaman digunakan untuk perjalanan jarak jauh antar kota. AutoRent selalu menjadi andalan perjalanan saya!'
                        },
                        {
                            name: 'Rizki Aditya',
                            role: 'Pengusaha',
                            img: '8',
                            text: 'Sebagai pengusaha, saya sering membutuhkan kendaraan representatif untuk menemui klien. Layanan AutoRent sangat profesional dan mobilnya premium.'
                        }
                    ],
                    next() { this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1 },
                    prev() { this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1 },
                    init() {
                        setInterval(() => { this.next() }, 5000);
                    }
                }" class="relative max-w-5xl mx-auto">
                
                <div class="overflow-hidden relative rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 bg-slate-50/50">
                    <div class="flex transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)]" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div class="w-full flex-shrink-0">
                                <div class="px-8 py-16 md:px-20 md:py-24 text-center">
                                    <div class="flex justify-center text-amber-400 mb-8 space-x-1">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <p class="text-slate-800 italic mb-12 text-2xl md:text-3xl leading-relaxed font-light" x-text="'&quot;' + slide.text + '&quot;'"></p>
                                    <div class="flex items-center justify-center">
                                        <img class="w-20 h-20 rounded-[1.5rem] object-cover shadow-lg border-2 border-white" :src="'https://i.pravatar.cc/150?img=' + slide.img" :alt="slide.name">
                                        <div class="ml-5 text-left">
                                            <h4 class="text-lg font-extrabold text-slate-900" x-text="slide.name"></h4>
                                            <p class="text-sm font-medium text-sky-600 uppercase tracking-wider mt-1" x-text="slide.role"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button @click="prev()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-6 lg:-translate-x-8 w-14 h-14 rounded-full bg-white shadow-xl border border-slate-100 flex items-center justify-center text-slate-500 hover:text-sky-600 hover:scale-110 focus:outline-none transition-all z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-6 lg:translate-x-8 w-14 h-14 rounded-full bg-white shadow-xl border border-slate-100 flex items-center justify-center text-slate-500 hover:text-sky-600 hover:scale-110 focus:outline-none transition-all z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <!-- Indicators -->
                <div class="flex justify-center mt-10 space-x-3">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index" :class="{'bg-sky-600 w-10': activeSlide === index, 'bg-slate-300 w-3 hover:bg-slate-400': activeSlide !== index}" class="h-3 rounded-full transition-all duration-300 focus:outline-none"></button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Final CTA Banner -->
    <div class="py-12 bg-white pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 relative overflow-hidden rounded-[3rem] shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-sky-600/20 to-blue-600/20 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent pointer-events-none"></div>
                <div class="relative px-6 py-20 sm:px-16 sm:py-24 text-center z-10">
                    <h2 class="text-4xl font-extrabold text-white sm:text-5xl lg:text-6xl tracking-tight">
                        Siap Memulai <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-400">Perjalanan Anda?</span>
                    </h2>
                    <p class="mt-6 text-xl leading-relaxed text-slate-300 max-w-2xl mx-auto font-light">
                        Pilih kendaraan impian Anda sekarang dan nikmati diskon khusus untuk penyewaan pertama. 
                        Mobil siap diantar ke depan pintu Anda hari ini juga.
                    </p>
                    <div class="mt-10 flex justify-center">
                        <a href="{{ route('cars.index') }}" class="inline-flex items-center justify-center px-10 py-5 border border-transparent text-lg font-bold rounded-full text-slate-900 bg-white hover:bg-sky-50 shadow-xl shadow-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            Cari Mobil Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
