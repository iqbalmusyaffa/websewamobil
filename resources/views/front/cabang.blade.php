<x-front-layout>
<!-- HERO BANNER -->
<div class="relative w-full h-96 overflow-hidden bg-slate-900">
    <img src="{{ $branch->getCoverImageUrl() }}" alt="{{ $branch->name }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
    <div class="absolute inset-0 flex items-end">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-12">
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-5xl font-extrabold text-white tracking-tight">{{ $branch->name }}</h1>
                    <p class="text-xl text-sky-300 mt-2">🏪 Cabang {{ $branch->city }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400/20 backdrop-blur-sm px-4 py-3 rounded-xl text-white">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            <div>
                                <div class="text-2xl font-bold">{{ $branch->rating }}</div>
                                <div class="text-sm text-slate-300">({{ $branch->total_reviews }} ulasan)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid lg:grid-cols-3 gap-8 mb-16">

        <!-- MAIN CONTENT -->
        <div class="lg:col-span-2 space-y-8">

            <!-- DESCRIPTION -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Tentang Cabang Kami</h2>
                <p class="text-slate-600 leading-relaxed text-lg">
                    {{ $branch->description }}
                </p>
            </div>

            <!-- GALLERY CAROUSEL -->
            @if(count($branch->getGalleryImages()) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="relative">
                    <div class="h-96 overflow-hidden">
                        <img id="galleryImage" src="{{ $branch->getGalleryImages()[0] }}" alt="Gallery" class="w-full h-full object-cover">
                    </div>

                    <!-- Gallery Navigation -->
                    @if(count($branch->getGalleryImages()) > 1)
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent p-6 flex items-center justify-between">
                        <button onclick="prevGallery()" class="bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <div class="flex gap-2">
                            @foreach($branch->getGalleryImages() as $index => $image)
                            <button onclick="goToGallery({{ $index }})" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-colors gallery-dot @if($index === 0) bg-white @endif"></button>
                            @endforeach
                        </div>
                        <button onclick="nextGallery()" class="bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- FEATURES -->
            @if($branch->features && count($branch->features) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-6">Fasilitas Cabang</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($branch->features as $feature)
                    <div class="flex items-center gap-3 p-4 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-semibold text-slate-700">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- GOOGLE MAPS -->
            @if($branch->maps_url)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="h-96">
                    <iframe src="{{ $branch->maps_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            @endif
        </div>

        <!-- SIDEBAR -->
        <div class="lg:col-span-1">

            <!-- QUICK INFO -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6 sticky top-32">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Informasi Cabang</h3>

                <!-- Location -->
                <div class="mb-6 pb-6 border-b border-slate-200">
                    <div class="flex gap-3 items-start">
                        <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Lokasi</p>
                            <p class="text-sm text-slate-700 leading-relaxed">{{ $branch->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Phone -->
                <div class="mb-6 pb-6 border-b border-slate-200">
                    <div class="flex gap-3 items-start">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Telepon</p>
                            <a href="tel:{{ str_replace(['+', '-', ' '], '', $branch->phone) }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700">{{ $branch->phone }}</a>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                @if($branch->whatsapp)
                <div class="mb-6 pb-6 border-b border-slate-200">
                    <div class="flex gap-3 items-start">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371 0-.57 0-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.364-3.905 6.75-1.896 10.217 1.172 2.017 3.282 3.348 5.612 3.795 1.265.245 2.544.163 3.756-.513l.468-.303 3.588.662.524-3.582-.361-.471c1.57-2.038 2.447-4.59 2.082-7.238-.623-4.503-4.787-7.741-9.514-7.741m0-1.998c5.079 0 9.514 3.947 10.188 8.881.504 3.632-.623 7.21-2.927 9.776l.57 3.899-4.135-.765c-1.24.923-2.924 1.426-4.696 1.426-5.079 0-9.514-3.947-10.188-8.881-.504-3.632.623-7.21 2.927-9.776l-.57-3.899 4.135.765c1.24-.923 2.924-1.426 4.696-1.426Z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">WhatsApp</p>
                            <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $branch->whatsapp) }}" target="_blank" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Hubungi di WhatsApp</a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Hours -->
                <div class="mb-6 pb-6 border-b border-slate-200">
                    @php
                        $hours = $branch->getOperationalHours();
                        $opening = $hours['opening_time'] ?? '08:00';
                        $closing = $hours['closing_time'] ?? '22:00';
                    @endphp
                    <div class="flex gap-3 items-start">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Jam Operasional</p>
                            <p class="text-sm text-slate-700 mb-1"><strong>Senin - Minggu</strong></p>
                            <p class="text-sm text-slate-600">{{ $opening }} - {{ $closing }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-sky-50 rounded-xl p-4 border border-sky-100 text-center">
                        <p class="text-2xl font-bold text-sky-600">{{ $branch->total_vehicles }}</p>
                        <p class="text-xs text-slate-600 mt-1">Jumlah Mobil</p>
                    </div>
                    <div class="bg-amber-50 rounded-xl p-4 border border-amber-100 text-center">
                        <p class="text-2xl font-bold text-amber-600">{{ $branch->total_reviews }}</p>
                        <p class="text-xs text-slate-600 mt-1">Ulasan</p>
                    </div>
                </div>
            </div>

            <!-- CTA BUTTONS -->
            <div class="space-y-3">
                <a href="{{ route('cars.index') }}" class="block w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-6 rounded-xl transition-colors text-center">
                    Lihat Armada
                </a>
                <a href="{{ route('dashboard') }}" class="block w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-6 rounded-xl transition-colors text-center">
                    Booking Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let currentGalleryIndex = 0;
const galleryImages = @json($branch->getGalleryImages());

function updateGallery() {
    document.getElementById('galleryImage').src = galleryImages[currentGalleryIndex];
    document.querySelectorAll('.gallery-dot').forEach((dot, index) => {
        if (index === currentGalleryIndex) {
            dot.classList.add('bg-white');
            dot.classList.remove('bg-white/50');
        } else {
            dot.classList.remove('bg-white');
            dot.classList.add('bg-white/50');
        }
    });
}

function nextGallery() {
    currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
    updateGallery();
}

function prevGallery() {
    currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
    updateGallery();
}

function goToGallery(index) {
    currentGalleryIndex = index;
    updateGallery();
}
</script>
</x-front-layout>
