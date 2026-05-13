<x-front-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('blog') }}" class="inline-flex items-center text-sky-400 hover:text-sky-300 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Blog
            </a>

            <div class="inline-block px-4 py-2 rounded-full text-sm font-medium bg-sky-600 text-white mb-4">
                {{ $post->category }}
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-slate-300 text-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $post->published_at->format('d F Y') }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $post->author }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ $post->views }} views
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($post->featured_image)
        <div class="h-96 overflow-hidden">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <!-- Main Content -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Article Content -->
                <div class="lg:col-span-2">
                    <article class="prose prose-sm max-w-none prose-headings:font-bold prose-headings:text-slate-900 prose-a:text-sky-600 hover:prose-a:text-sky-700 prose-img:rounded-lg">
                        {!! $post->content !!}
                    </article>

                    <!-- Share Section -->
                    <div class="mt-12 pt-8 border-t border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Bagikan Artikel Ini</h3>
                        <div class="flex gap-3">
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}"
                               target="_blank" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                                LinkedIn
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text=Check%20this%20article%21%20{{ urlencode($post->title) }}"
                               target="_blank" class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-white font-semibold rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7.75.75 7.75.75"/>
                                </svg>
                                Twitter
                            </a>
                            <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(route('blog.show', $post->slug)) }}"
                               class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-semibold rounded-lg transition-colors inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Author Card -->
                    <div class="bg-gradient-to-br from-sky-50 to-sky-100 rounded-2xl p-6 border border-sky-200 sticky top-24 mb-8">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Tentang Penulis</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-sky-600 flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($post->author, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $post->author }}</p>
                                <p class="text-sm text-slate-600">AutoRent Team</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700">{{ $post->author }} adalah bagian dari tim kami yang berdedikasi untuk memberikan tips dan informasi terbaik tentang dunia otomotif dan perjalanan.</p>
                    </div>

                    <!-- Related Posts -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Artikel Terkait</h3>
                        <div class="space-y-4">
                            @forelse($relatedPosts as $relatedPost)
                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block group">
                                    <h4 class="font-semibold text-slate-900 group-hover:text-sky-600 transition-colors line-clamp-2 text-sm">
                                        {{ $relatedPost->title }}
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-1">{{ $relatedPost->published_at->format('d M Y') }}</p>
                                </a>
                                @if(!$loop->last)
                                    <hr class="border-slate-200">
                                @endif
                            @empty
                                <p class="text-sm text-slate-600">Tidak ada artikel terkait.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 mt-8">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Kategori Lainnya</h3>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                                <a href="{{ route('blog') }}?category={{ $category }}"
                                   class="block px-3 py-2 rounded-lg bg-white hover:bg-sky-100 text-slate-700 hover:text-sky-700 transition-colors text-sm font-medium">
                                    {{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="py-16 bg-gradient-to-r from-sky-600 to-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Berlangganan Newsletter</h2>
            <p class="text-sky-100 mb-8">Dapatkan artikel terbaru dan tips eksklusif langsung ke email Anda setiap minggu.</p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400" required>
                <button type="submit" class="px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg transition-colors whitespace-nowrap">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</x-front-layout>
