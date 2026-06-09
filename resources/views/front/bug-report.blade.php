<x-front-layout>
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight">
                Laporan Bug
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Temukan masalah pada website atau aplikasi? Laporkan di sini beserta buktinya.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white relative -mt-16 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($bountyProgram)
            <div class="max-w-3xl mx-auto mb-10 relative group">
                <!-- Animated gradient border background -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-500 rounded-3xl blur opacity-30 group-hover:opacity-50 transition duration-500"></div>
                
                <!-- Main Card -->
                <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-8 overflow-hidden shadow-2xl shadow-sky-900/20">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 -mt-16 -mr-16 text-slate-800/30 transform rotate-12 transition-transform group-hover:rotate-45 group-hover:scale-110 duration-700">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                        </svg>
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row gap-6">
                        <!-- Icon Badge -->
                        <div class="shrink-0">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-sky-400 to-blue-600 p-0.5 shadow-lg shadow-sky-500/30">
                                <div class="w-full h-full bg-slate-900 rounded-[14px] flex items-center justify-center">
                                    <svg class="w-8 h-8 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span class="px-3 py-1 text-[10px] uppercase tracking-widest font-bold text-sky-400 bg-sky-400/10 rounded-full border border-sky-400/20">
                                    Program Bug Bounty
                                </span>
                                @if($bountyProgram->start_date)
                                <span class="flex items-center gap-1.5 px-3 py-1 text-[10px] uppercase tracking-widest font-bold text-emerald-400 bg-emerald-400/10 rounded-full border border-emerald-400/20">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Mulai: {{ $bountyProgram->start_date->format('d M Y') }}
                                </span>
                                @endif
                                @if($bountyProgram->end_date)
                                <span class="flex items-center gap-1.5 px-3 py-1 text-[10px] uppercase tracking-widest font-bold text-rose-400 bg-rose-400/10 rounded-full border border-rose-400/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                    Selesai: {{ $bountyProgram->end_date->format('d M Y') }}
                                </span>
                                @endif
                            </div>
                            
                            <h4 class="text-2xl font-extrabold text-white mb-4 tracking-tight">
                                {{ $bountyProgram->title }}
                            </h4>
                            
                            <div class="prose prose-invert prose-sm max-w-none text-slate-300 leading-relaxed mb-6">
                                {!! $bountyProgram->description !!}
                            </div>

                            <!-- Rewards Section -->
                            <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 backdrop-blur-sm">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h5 class="text-sm font-bold text-white tracking-wide">Detail Hadiah / Reward</h5>
                                </div>
                                <div class="prose prose-invert prose-sm prose-amber max-w-none text-slate-400 leading-relaxed">
                                    {!! $bountyProgram->reward_details !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden max-w-3xl mx-auto">
                <div class="p-10 lg:p-16">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Formulir Laporan Bug</h3>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('bug-report.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700">Nama Lengkap (Opsional)</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Budi Santoso">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700">Email (Opsional)</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="budi@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700">Judul Bug / Masalah</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Contoh: Error 500 saat checkout">
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700">Deskripsi Detail</label>
                            <textarea id="description" name="description" rows="5" required class="mt-2 block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors text-sm" placeholder="Jelaskan secara detail langkah-langkah untuk mereproduksi masalah ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="attachments" class="block text-sm font-semibold text-slate-700">Lampiran (Foto, Screenshot, PDF, Dokumen, Kode)</label>
                            <input type="file" name="attachments[]" id="attachments" multiple class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 transition-colors">
                            <p class="mt-1 text-xs text-slate-500">Bisa memilih lebih dari satu file. Maksimal 5MB per file.</p>
                            @error('attachments.*')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-slate-900 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                            Kirim Laporan Bug
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
