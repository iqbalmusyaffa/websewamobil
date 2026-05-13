<x-front-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('career') }}" class="inline-flex items-center text-sky-400 hover:text-sky-300 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Karir
            </a>

            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                @if($job->category === 'Engineering')
                    bg-sky-100 text-sky-800
                @elseif($job->category === 'Customer Success')
                    bg-emerald-100 text-emerald-800
                @elseif($job->category === 'Marketing')
                    bg-purple-100 text-purple-800
                @elseif($job->category === 'Design')
                    bg-pink-100 text-pink-800
                @else
                    bg-blue-100 text-blue-800
                @endif
                mb-4">
                {{ $job->category }}
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4">
                {{ $job->title }}
            </h1>

            <div class="flex flex-col sm:flex-row gap-4 text-slate-300">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                    {{ $job->location }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $job->type }} - {{ $job->work_mode }}
                </div>
                @if($job->salary_from && $job->salary_to)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Rp {{ number_format($job->salary_from, 0, '.', '.') }} - Rp {{ number_format($job->salary_to, 0, '.', '.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Deskripsi Posisi</h2>
                        <div class="prose prose-sm max-w-none text-slate-600">
                            {!! $job->description !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    @if($job->requirements)
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold text-slate-900 mb-6">Persyaratan</h2>
                            <ul class="space-y-3">
                                @foreach($job->requirements as $requirement)
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-sky-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-slate-700">{{ $requirement }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Benefits -->
                    @if($job->benefits)
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold text-slate-900 mb-6">Benefit & Kompensasi</h2>
                            <ul class="space-y-3">
                                @foreach($job->benefits as $benefit)
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-emerald-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-slate-700">{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Apply Card -->
                    <div class="bg-gradient-to-br from-sky-50 to-sky-100 rounded-2xl p-8 border border-sky-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Tertarik dengan Posisi Ini?</h3>
                        <p class="text-slate-700 mb-6">Kirim resume dan portfolio Anda untuk bergabung dengan tim kami.</p>

                        <a href="mailto:careers@autorent.com?subject=Application for {{ $job->title }}"
                           class="block w-full text-center bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 rounded-lg transition-colors mb-4">
                            Lamar Sekarang
                        </a>

                        <p class="text-sm text-slate-600 text-center">
                            atau email <a href="mailto:careers@autorent.com" class="text-sky-600 hover:text-sky-700 font-semibold">careers@autorent.com</a>
                        </p>
                    </div>

                    <!-- Job Info Card -->
                    <div class="mt-8 bg-slate-50 rounded-2xl p-8 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6">Informasi Posisi</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-600 mb-1">Kategori</p>
                                <p class="text-slate-900">{{ $job->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600 mb-1">Tipe Pekerjaan</p>
                                <p class="text-slate-900">{{ $job->type }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600 mb-1">Lokasi</p>
                                <p class="text-slate-900">{{ $job->location }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600 mb-1">Mode Kerja</p>
                                <p class="text-slate-900">{{ $job->work_mode }}</p>
                            </div>
                            @if($job->salary_from && $job->salary_to)
                                <div>
                                    <p class="text-sm font-semibold text-slate-600 mb-1">Salary Range</p>
                                    <p class="text-slate-900">Rp {{ number_format($job->salary_from, 0, '.', '.') }} - Rp {{ number_format($job->salary_to, 0, '.', '.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Share Card -->
                    <div class="mt-8 bg-slate-50 rounded-2xl p-8 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Bagikan Posisi Ini</h3>
                        <div class="flex gap-3">
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('career.show', $job->slug)) }}"
                               target="_blank" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-center transition-colors text-sm">
                                LinkedIn
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('career.show', $job->slug)) }}&text=Check%20this%20job!"
                               target="_blank" class="flex-1 bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 rounded-lg text-center transition-colors text-sm">
                                Twitter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Open Positions -->
    <div class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">Posisi Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($otherJobs as $otherJob)
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 hover:shadow-lg transition-shadow hover:border-sky-300">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($otherJob->category === 'Engineering')
                                bg-sky-100 text-sky-800
                            @elseif($otherJob->category === 'Customer Success')
                                bg-emerald-100 text-emerald-800
                            @elseif($otherJob->category === 'Marketing')
                                bg-purple-100 text-purple-800
                            @elseif($otherJob->category === 'Design')
                                bg-pink-100 text-pink-800
                            @else
                                bg-blue-100 text-blue-800
                            @endif
                            mb-4">
                            {{ $otherJob->category }}
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $otherJob->title }}</h3>
                        <p class="text-slate-600 mb-4 text-sm">{{ $otherJob->location }}</p>
                        <a href="{{ route('career.show', $otherJob->slug) }}" class="text-sky-600 font-semibold hover:text-sky-700 text-sm">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                @empty
                    <p class="text-slate-600">Tidak ada posisi lainnya.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-front-layout>
