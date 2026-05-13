<x-front-layout>
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight">
                Karir di AutoRent
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Bergabunglah dengan tim kami dan jadilah bagian dari revolusi mobilitas di Indonesia.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">
                    Posisi Terbuka
                </h2>
                <p class="mt-4 text-lg text-slate-500">
                    Kami selalu mencari talenta terbaik untuk bergabung bersama kami.
                </p>
            </div>

            @if($jobs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($jobs as $job)
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-lg transition-shadow">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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
                            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $job->title }}</h3>
                            <p class="text-slate-600 mb-2 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $job->location }}
                            </p>
                            <p class="text-slate-600 mb-4 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $job->type }} - {{ $job->work_mode }}
                            </p>
                            <p class="text-slate-500 text-sm mb-6 line-clamp-3">{{ Str::limit(strip_tags($job->description), 120) }}</p>
                            <div class="flex items-center justify-between">
                                @if($job->salary_from && $job->salary_to)
                                    <span class="text-sky-600 font-semibold text-sm">
                                        Rp {{ number_format($job->salary_from, 0, '.', '.') }} - {{ number_format($job->salary_to, 0, '.', '.') }}
                                    </span>
                                @endif
                                <a href="{{ route('career.show', $job->slug) }}" class="text-sky-600 font-semibold hover:text-sky-700 text-sm">
                                    Detail &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-slate-600 text-lg">Tidak ada posisi terbuka saat ini. Silahkan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Why Join Us -->
    <div class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-slate-900 text-center mb-12">Mengapa Bergabung dengan Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="flex justify-center">
                        <svg class="w-12 h-12 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Fleksibel & Inovatif</h3>
                    <p class="mt-2 text-slate-600">Bekerja dengan pendekatan yang inovatif dan fleksibel untuk hasil maksimal.</p>
                </div>
                <div class="text-center">
                    <div class="flex justify-center">
                        <svg class="w-12 h-12 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Kompensasi Kompetitif</h3>
                    <p class="mt-2 text-slate-600">Gaji dan benefit yang kompetitif sesuai dengan standar industri.</p>
                </div>
                <div class="text-center">
                    <div class="flex justify-center">
                        <svg class="w-12 h-12 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Pengembangan Karir</h3>
                    <p class="mt-2 text-slate-600">Kesempatan untuk berkembang dan belajar dari para expert di industri.</p>
                </div>
                <div class="text-center">
                    <div class="flex justify-center">
                        <svg class="w-12 h-12 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2 1m2-1l-2-1m2 1v2.5"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Tim Kolaboratif</h3>
                    <p class="mt-2 text-slate-600">Bekerja dengan tim yang saling mendukung dan bersemangat.</p>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
