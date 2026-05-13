<x-front-layout>
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight">
                Blog & Berita
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Temukan artikel menarik, tips perjalanan, dan berita terbaru dari AutoRent.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2 mb-12">
                <a href="{{ route('blog') }}" class="px-4 py-2 rounded-full bg-sky-600 text-white font-medium hover:bg-sky-700 transition-colors">
                    Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('blog') }}?category={{ $category }}" class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 font-medium hover:bg-slate-200 transition-colors">
                        {{ $category }}
                    </a>
                @endforeach
            </div>

            @if($posts->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $post)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow h-full flex flex-col">
                            @if($post->featured_image)
                                <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-sm text-sky-600 font-semibold mb-2">{{ $post->category }}</div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-sky-600 transition-colors">{{ $post->title }}</a>
                                </h3>
                                <p class="text-slate-500 mb-4 text-sm flex-grow line-clamp-3">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
                                <div class="flex items-center justify-between text-sm text-slate-400 border-t border-slate-100 pt-4">
                                    <span>{{ $post->author }}</span>
                                    <span>{{ $post->published_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-slate-600 text-lg">Tidak ada artikel yang ditemukan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <p class="text-slate-600 text-lg">Blog kami masih dalam pengembangan.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Subscribe Section -->
    <div class="py-16 bg-gradient-to-r from-sky-600 to-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Dapatkan Update Blog Terbaru</h2>
            <p class="text-sky-100 mb-8">Berlangganan newsletter kami untuk mendapatkan tips perjalanan dan berita terbaru langsung ke email Anda.</p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400" required>
                <button type="submit" class="px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</x-front-layout>
