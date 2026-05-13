<x-front-layout>
    <div class="bg-slate-900 py-16 relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl tracking-tight">
                Peta Situs (Sitemap)
            </h1>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b pb-2">Navigasi Utama</h2>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('cars.index') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Mobil Kami</a></li>
                        <li><a href="{{ route('about') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('faq') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b pb-2">Informasi & Bantuan</h2>
                    <ul class="space-y-4">
                        <li><a href="{{ route('career') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Karir</a></li>
                        <li><a href="{{ route('blog') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Blog & Berita</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Kebijakan Privasi (Privacy)</a></li>
                        <li><a href="{{ route('terms') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Syarat & Ketentuan (Terms)</a></li>
                    </ul>
                </div>
            </div>
            
            @auth
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b pb-2">Akun Saya</h2>
                <ul class="space-y-4">
                    <li><a href="{{ route('bookings.index') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Pesanan Saya</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="text-lg text-sky-600 hover:text-sky-800 transition-colors">Profil</a></li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</x-front-layout>
