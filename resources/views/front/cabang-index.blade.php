<x-front-layout>
<div class="bg-slate-900 pt-16 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Temukan <span class="text-sky-500">Cabang Kami</span></h1>
        <p class="text-lg text-slate-400 max-w-2xl mx-auto">Kami hadir di berbagai kota besar di Indonesia untuk melayani kebutuhan transportasi Anda dengan kualitas dan standar terbaik.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 mb-20 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($branches as $branch)
        <a href="{{ route('cabang.show', $branch->slug) }}" class="group relative rounded-2xl overflow-hidden shadow-xl bg-white border border-slate-100 flex flex-col hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $branch->getCoverImageUrl() }}" alt="AutoRent {{ $branch->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent opacity-80"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $branch->name }}</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sky-300 text-sm font-semibold group-hover:text-white transition-colors">
                            Lihat Detail Cabang
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                        <div class="flex items-center bg-yellow-400/20 px-2 py-1 rounded-full">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            <span class="text-sm font-bold text-yellow-300">{{ $branch->rating }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-slate-500 text-lg">Tidak ada cabang yang tersedia saat ini.</p>
        </div>
        @endforelse
    </div>
</div>
</x-front-layout>
