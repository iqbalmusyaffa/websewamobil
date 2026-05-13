<x-front-layout>
<div class="bg-gradient-to-br from-slate-50 via-white to-slate-50 min-h-screen py-8 sm:py-12 lg:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mb-8 sm:mb-12">
            <div class="flex items-center gap-3 sm:gap-4 mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex p-2 bg-white border border-slate-200 rounded-lg text-slate-500 hover:text-sky-600 hover:border-sky-300 hover:shadow-md transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">
                        Pengaturan Profil
                    </h1>
                    <p class="mt-2 text-sm sm:text-base text-slate-600">
                        Kelola informasi akun dan pengaturan keamanan Anda
                    </p>
                </div>
            </div>
            <div class="h-1 w-16 bg-gradient-to-r from-sky-500 to-blue-500 rounded-full"></div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">

            <!-- Sidebar Navigation (Desktop) -->
            <div class="hidden lg:block">
                <div class="sticky top-8 space-y-2">
                    <button onclick="document.getElementById('profile-section').scrollIntoView({behavior: 'smooth'})" class="w-full text-left px-4 py-3 rounded-lg text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition-colors duration-200 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Informasi Profil</span>
                    </button>
                    <button onclick="document.getElementById('password-section').scrollIntoView({behavior: 'smooth'})" class="w-full text-left px-4 py-3 rounded-lg text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition-colors duration-200 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>Keamanan</span>
                    </button>
                    <button onclick="document.getElementById('danger-section').scrollIntoView({behavior: 'smooth'})" class="w-full text-left px-4 py-3 rounded-lg text-slate-700 hover:bg-red-50 hover:text-red-600 font-medium transition-colors duration-200 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        <span>Hapus Akun</span>
                    </button>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="lg:col-span-2 space-y-6 sm:space-y-8">

                <!-- Membership Card & Progress Section -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col lg:flex-row gap-8 items-center lg:items-start">
                        
                        <!-- Physical Membership Card UI and Actions -->
                        <div class="w-full max-w-[340px] shrink-0 flex flex-col">
                            <div id="member-card-element" class="relative w-full aspect-[1.586/1] rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300 {{ auth()->user()->member_tier === 'platinum' ? 'bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 border border-slate-700' : (auth()->user()->member_tier === 'gold' ? 'bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 border border-yellow-300' : (auth()->user()->member_tier === 'silver' ? 'bg-gradient-to-br from-slate-300 via-slate-400 to-slate-500 border border-slate-300' : 'bg-gradient-to-br from-sky-600 via-sky-700 to-blue-800 border border-sky-500')) }}">
                            <!-- Glass/Glare Effect -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/20 to-white/0 transform -skew-x-12 translate-x-10 pointer-events-none"></div>
                            
                            <!-- Pattern Overlay -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,100 L100,0 L100,10 L0,110 Z M0,80 L100,-20 L100,-10 L0,90 Z" fill="currentColor"/></svg>
                            </div>

                            <div class="relative z-10 h-full p-5 flex flex-col justify-between text-white">
                                <!-- Top: Brand & Tier -->
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-6 h-6 bg-white text-{{ auth()->user()->member_tier === 'gold' ? 'yellow-600' : (auth()->user()->member_tier === 'silver' ? 'slate-600' : 'sky-700') }} rounded flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                        </div>
                                        <span class="text-sm font-extrabold tracking-tight">Auto<span class="text-white/80">Rent</span></span>
                                    </div>
                                    <div class="text-xs font-black uppercase tracking-widest px-2 py-0.5 rounded {{ auth()->user()->member_tier === 'platinum' ? 'bg-white/10 text-white' : (auth()->user()->member_tier === 'gold' ? 'bg-black/20 text-yellow-50' : (auth()->user()->member_tier === 'silver' ? 'bg-black/20 text-white' : 'bg-white/20 text-white')) }}">
                                        {{ auth()->user()->member_tier }}
                                    </div>
                                </div>

                                <!-- Middle: Chip & ID -->
                                <div>
                                    <div class="w-10 h-8 rounded bg-gradient-to-br from-yellow-200 to-yellow-400 mb-2 opacity-80 border border-yellow-500/50"></div>
                                    <div class="font-mono text-lg tracking-widest opacity-90 drop-shadow-md">
                                        {{ substr(str_pad(auth()->user()->id, 12, '0', STR_PAD_LEFT), 0, 4) }} 
                                        {{ substr(str_pad(auth()->user()->id, 12, '0', STR_PAD_LEFT), 4, 4) }} 
                                        {{ substr(str_pad(auth()->user()->id, 12, '0', STR_PAD_LEFT), 8, 4) }}
                                    </div>
                                </div>

                                <!-- Bottom: Name & Member Since -->
                                <div class="flex justify-between items-end drop-shadow-md">
                                    <div>
                                        <div class="text-[9px] uppercase tracking-wider opacity-70 mb-0.5">MEMBER NAME</div>
                                        <div class="font-bold text-sm tracking-wide truncate max-w-[180px] uppercase">{{ auth()->user()->name }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[9px] uppercase tracking-wider opacity-70 mb-0.5">VALID THRU</div>
                                        <div class="font-mono text-sm tracking-wide">{{ auth()->user()->member_valid_thru ? auth()->user()->member_valid_thru->format('m/y') : auth()->user()->created_at->addYears(5)->format('m/y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex flex-wrap gap-2 justify-center">
                                <button type="button" onclick="downloadCard('png')" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg font-medium transition-colors flex items-center gap-1 border border-slate-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    PNG
                                </button>
                                <button type="button" onclick="downloadCard('pdf')" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg font-medium transition-colors flex items-center gap-1 border border-slate-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    PDF
                                </button>
                                <form action="{{ route('profile.extend-member-card') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Perpanjang masa aktif kartu selama 5 tahun?')" class="text-xs bg-sky-100 hover:bg-sky-200 text-sky-700 px-3 py-1.5 rounded-lg font-medium transition-colors flex items-center gap-1 border border-sky-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Perpanjang
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info & Progress Details -->
                        <div class="flex-1 w-full space-y-6">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Keanggotaan Anda</h2>
                                <p class="text-slate-500 text-sm mt-1">Kumpulkan poin dari setiap penyewaan untuk mendapatkan diskon dan pelayanan prioritas VIP dari AutoRent.</p>
                            </div>

                            <!-- Points Display -->
                            <div class="flex items-center gap-4 bg-slate-50 border border-slate-100 rounded-xl p-4">
                                <div class="p-3 bg-sky-100 rounded-full">
                                    <svg class="w-6 h-6 text-sky-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Poin Terkumpul</div>
                                    <div class="text-3xl font-black text-slate-800">{{ number_format(auth()->user()->member_points, 0, ',', '.') }} <span class="text-base font-bold text-slate-400">Pts</span></div>
                                </div>
                            </div>

                            <!-- Progress Bar to Next Tier -->
                            @php
                                $currentPoints = auth()->user()->member_points;
                                $nextTier = '';
                                $targetPoints = 0;
                                $progressPercent = 0;

                                if (auth()->user()->member_tier === 'reguler') {
                                    $nextTier = 'Silver';
                                    $targetPoints = 1000;
                                } elseif (auth()->user()->member_tier === 'silver') {
                                    $nextTier = 'Gold';
                                    $targetPoints = 5000;
                                } elseif (auth()->user()->member_tier === 'gold') {
                                    $nextTier = 'Platinum';
                                    $targetPoints = 15000;
                                }

                                if ($targetPoints > 0) {
                                    $progressPercent = min(100, ($currentPoints / $targetPoints) * 100);
                                }
                            @endphp

                            @if($targetPoints > 0)
                            <div class="pt-2">
                                <div class="flex justify-between items-end mb-2">
                                    <span class="text-sm font-medium text-slate-700">Progress menuju <strong class="text-sky-600">{{ $nextTier }}</strong></span>
                                    <span class="text-xs font-bold text-slate-500">{{ number_format($currentPoints, 0, ',', '.') }} / {{ number_format($targetPoints, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3 border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-sky-400 to-blue-500 h-3 rounded-full relative" style="width: {{ $progressPercent }}%">
                                        <div class="absolute top-0 right-0 bottom-0 left-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0tMiAwbDEwIDEwTTEwIDBMLTIgMTBNNiAwbDEwIDEwbS0yLThMMiAxMCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1vcGFjaXR5PSIuMiIvPjwvc3ZnPg==')] opacity-50"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">Kumpulkan <strong class="text-slate-700">{{ number_format(max(0, $targetPoints - $currentPoints), 0, ',', '.') }} Pts</strong> lagi untuk naik kelas!</p>
                            </div>
                            @else
                            <div class="pt-2">
                                <div class="inline-flex items-center gap-2 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg w-full">
                                    <svg class="w-5 h-5 text-yellow-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    <span class="text-sm font-medium">Luar biasa! Anda telah mencapai tingkat keanggotaan tertinggi. Nikmati seluruh layanan VIP kami.</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Point History Section -->
                @php
                    $pointHistories = auth()->user()->pointHistories()->latest()->take(5)->get();
                @endphp
                @if($pointHistories->isNotEmpty())
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-200">
                        <div class="p-3 bg-emerald-100 rounded-lg">
                            <span class="text-xl">📋</span>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Riwayat Poin</h2>
                            <p class="text-sm text-slate-500 mt-1">5 transaksi poin terakhir Anda</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($pointHistories as $history)
                            <div class="flex items-center justify-between p-4 rounded-xl border {{ $history->type === 'earn' ? 'bg-emerald-50 border-emerald-100' : 'bg-red-50 border-red-100' }}">
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">{{ $history->description }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $history->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="font-bold {{ $history->type === 'earn' ? 'text-emerald-600' : 'text-red-500' }}">
                                    {{ $history->type === 'earn' ? '+' : '-' }}{{ number_format($history->amount, 0, ',', '.') }} Pts
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Profile Information Section -->
                <div id="profile-section" class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-200">
                        <div class="p-3 bg-sky-100 rounded-lg">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                                Informasi Profil
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                Perbarui informasi akun Anda
                            </p>
                        </div>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Password Section -->
                <div id="password-section" class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-200">
                        <div class="p-3 bg-amber-100 rounded-lg">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                                Keamanan Akun
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                Perbarui kata sandi Anda
                            </p>
                        </div>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Danger Zone Section -->
                <div id="danger-section" class="bg-red-50 rounded-xl sm:rounded-2xl shadow-sm border border-red-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-red-200">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-red-900">
                                Zona Berbahaya
                            </h2>
                            <p class="text-sm text-red-700 mt-1">
                                Operasi yang tidak dapat dibatalkan
                            </p>
                        </div>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Load html2canvas and jsPDF for downloading card -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    function downloadCard(format) {
        const card = document.getElementById('member-card-element');
        
        // Temporarily remove hover transform for a clean screenshot
        const originalTransform = card.style.transform;
        card.style.transform = 'none';

        html2canvas(card, {
            scale: 3, // High resolution
            useCORS: true,
            backgroundColor: null
        }).then(canvas => {
            // Restore transform
            card.style.transform = originalTransform;

            if (format === 'png') {
                const link = document.createElement('a');
                link.download = 'autorent-member-card.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            } else if (format === 'pdf') {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: [canvas.width, canvas.height]
                });
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, canvas.width, canvas.height);
                pdf.save('autorent-member-card.pdf');
            }
        });
    }
</script>

</x-front-layout>
