<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'AutoRent') }} - Sewa Mobil Premium Terpercaya</title>
    <meta name="description" content="AutoRent - Platform sewa mobil premium terpercaya di Indonesia. Armada terawat, harga transparan, layanan 24 jam.">
    <meta property="og:site_name" content="AutoRent">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0284c7">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @stack('head')
</head>
<body class="antialiased bg-slate-50 text-slate-800">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 transition-all duration-300 w-full border-b" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="{'bg-white/95 backdrop-blur-2xl shadow-lg border-slate-200/50': scrolled, 'bg-white/80 backdrop-blur-xl border-slate-200/20 shadow-sm': !scrolled}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20 w-full">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-blue-600 text-white rounded-[0.8rem] flex items-center justify-center shadow-lg shadow-sky-500/30 group-hover:shadow-sky-500/50 group-hover:scale-105 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </div>
                        <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Auto<span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-blue-600">Rent</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('home') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">Beranda</a>
                    <a href="{{ route('cars.index') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('cars.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">Mobil Kami</a>
                    <a href="{{ route('cabang.index') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('cabang.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">Cabang</a>
                    <a href="{{ route('about') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('about') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">Tentang Kami</a>
                    <a href="{{ route('faq') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('faq') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">FAQ</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2.5 rounded-full text-sm font-bold {{ request()->routeIs('contact') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-sky-50 hover:text-sky-600' }} transition-all duration-300">Kontak</a>
                </div>

                <!-- Desktop Auth -->
                <div class="hidden md:flex items-center space-x-3 lg:space-x-4">
                    @auth
                        <a href="{{ route('bookings.index') }}" class="text-sm font-bold text-slate-600 hover:text-sky-600 transition-colors">Pesanan Saya</a>
                        <a href="{{ route('wishlist') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 border border-slate-200 text-slate-600 hover:bg-rose-50 hover:text-rose-500 hover:border-rose-200 shadow-sm hover:shadow-md transition-all duration-300" title="Wishlist">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = ! open" class="flex items-center gap-2 text-sm font-bold text-slate-700 bg-slate-50 px-4 py-2 rounded-full hover:bg-slate-100 transition-all duration-300 focus:outline-none border border-slate-200 shadow-sm hover:shadow-md">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-sky-400 to-blue-500 text-white flex items-center justify-center text-xs">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-2" class="absolute right-0 w-56 mt-3 bg-white border border-slate-100 rounded-2xl shadow-xl py-2 z-50" style="display: none;">
                                <div class="px-4 py-2 border-b border-slate-100 mb-1">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Signed in as</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                @if(Auth::user()->role === 'admin')
                                    <a href="/admin" class="flex items-center px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center px-4 py-2.5 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-sky-600 transition-colors px-3">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-slate-800 to-slate-900 text-white text-sm font-bold rounded-full shadow-lg shadow-slate-900/20 hover:shadow-slate-900/40 hover:-translate-y-0.5 transition-all duration-300">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-600 hover:bg-slate-100 focus:outline-none transition-colors border border-slate-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" x-collapse class="md:hidden mt-2 mb-4 bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/50 overflow-y-auto max-h-[calc(100vh-5rem)]" style="display: none;">
                <div class="px-4 py-6 space-y-2">
                    <a href="{{ route('home') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('home') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">Beranda</a>
                    <a href="{{ route('cars.index') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('cars.*') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">Mobil Kami</a>
                    <a href="{{ route('cabang.index') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('cabang.*') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">Cabang</a>
                    <a href="{{ route('about') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('about') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">Tentang Kami</a>
                    <a href="{{ route('faq') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('faq') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">FAQ</a>
                    <a href="{{ route('contact') }}" class="block px-5 py-3.5 rounded-2xl text-base font-bold {{ request()->routeIs('contact') ? 'text-white bg-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-sky-600' }} transition-all">Kontak</a>
                    
                    <div class="border-t border-slate-100 mt-6 pt-6">
                        @auth
                            <div class="px-5 mb-4 text-sm text-slate-500 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-bold text-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="block text-xs uppercase tracking-wider font-semibold">Masuk sebagai</span>
                                    <span class="font-bold text-slate-800">{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                            @if(Auth::user()->role === 'admin')
                                <a href="/admin" class="flex items-center px-5 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-slate-50 hover:text-sky-600 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Admin Panel
                                </a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="flex items-center px-5 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-slate-50 hover:text-sky-600 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('bookings.index') }}" class="flex items-center px-5 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-slate-50 hover:text-sky-600 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Pesanan Saya
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-5 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-slate-50 hover:text-sky-600 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-5 py-3 rounded-2xl text-base font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Keluar
                                </button>
                            </form>
                        @else
                            <div class="grid grid-cols-1 gap-3 mt-2">
                                <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3.5 border-2 border-slate-200 rounded-2xl text-base font-bold text-slate-700 hover:bg-slate-50 transition-colors">Masuk</a>
                                <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3.5 bg-gradient-to-r from-slate-800 to-slate-900 shadow-lg shadow-slate-900/20 rounded-2xl text-base font-bold text-white hover:bg-slate-800 transition-colors">Daftar</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Mega Footer -->
    <footer id="footer" class="bg-slate-900 pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Newsletter Section -->
            <div class="bg-slate-800/50 rounded-2xl p-8 mb-12 border border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="max-w-xl">
                    <h3 class="text-xl font-bold text-white mb-2">Berlangganan Newsletter Kami</h3>
                    <p class="text-slate-400 text-sm">Dapatkan informasi promo terbaru, penawaran spesial, dan update armada langsung di inbox Anda.</p>
                </div>
                <form class="flex w-full md:w-auto gap-2" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
                    <input type="email" placeholder="Masukkan email Anda" class="w-full md:w-64 bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-white focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors" required>
                    <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-colors whitespace-nowrap">Subscribe</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-12">
                <!-- Brand Info -->
                <div class="space-y-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-sky-600 text-white rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">Auto<span class="text-sky-500">Rent</span></span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Kami menyediakan layanan penyewaan kendaraan premium untuk perjalanan bisnis, liburan keluarga, maupun kebutuhan harian Anda dengan armada yang selalu terawat prima.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-sky-500 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-sky-500 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-sky-500 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Perusahaan -->
                <div>
                    <h3 class="text-sm font-bold text-slate-100 uppercase tracking-wider mb-6">Perusahaan</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('promos.index') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Promo & Penawaran <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/10 text-rose-400 uppercase tracking-wider">Hot</span></a></li>
                        <li><a href="{{ route('career') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Karir <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-500/10 text-emerald-400">Hiring</span></a></li>
                        <li><a href="{{ route('blog') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Blog & Berita</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('validation.form') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Validasi Dokumen</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="text-sm font-bold text-slate-100 uppercase tracking-wider mb-6">Layanan Kami</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('cars.index') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Sewa Harian</a></li>
                        <li><a href="{{ route('cars.index') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Sewa Bulanan</a></li>
                        <li><a href="{{ route('cars.index') }}" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Sewa Lepas Kunci</a></li>
                        <li><a href="#" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">Antar Jemput Bandara</a></li>
                    </ul>
                </div>
                <!-- Kontak -->
                <div>
                    <h3 class="text-sm font-bold text-slate-100 uppercase tracking-wider mb-6">Hubungi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-sky-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm text-slate-400">Jl. Jend. Sudirman Kav. 21, Jakarta Selatan, 12920</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-sky-500 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:hello@autorent.com" class="text-sm text-slate-400 hover:text-sky-400 transition-colors">hello@autorent.com</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-sky-500 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-sm text-slate-400">+62 811-2233-4455</span>
                        </li>
                        <li class="flex items-start pt-2">
                            <svg class="h-5 w-5 text-sky-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="block text-sm text-slate-300 font-medium">Jam Operasional</span>
                                <span class="block text-sm text-slate-400 mt-1">Senin - Minggu: 08.00 - 22.00 WIB</span>
                                <span class="block text-sm text-emerald-400 mt-0.5 font-medium">Layanan Darurat 24 Jam</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 mt-8 flex flex-col lg:flex-row justify-between items-center gap-6">
                <!-- Copyright & Links -->
                <div class="flex flex-col md:flex-row items-center gap-4 md:gap-6">
                    <p class="text-slate-500 text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} AutoRent. All rights reserved.
                    </p>
                    <div class="hidden md:block w-1 h-1 bg-slate-700 rounded-full"></div>
                    <div class="flex space-x-6">
                        <a href="{{ route('privacy') }}" class="text-sm text-slate-500 hover:text-white transition-colors">Privacy</a>
                        <a href="{{ route('terms') }}" class="text-sm text-slate-500 hover:text-white transition-colors">Terms</a>
                        <a href="{{ route('sitemap') }}" class="text-sm text-slate-500 hover:text-white transition-colors">Sitemap</a>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="flex items-center gap-3">
                    <span class="text-xs text-slate-500 mr-2">Pembayaran Aman:</span>
                    <div class="flex gap-2">
                        <!-- BCA -->
                        <div class="w-10 h-7 bg-white rounded flex items-center justify-center px-1">
                            <span class="text-[10px] font-black text-blue-800">BCA</span>
                        </div>
                        <!-- Mandiri -->
                        <div class="w-10 h-7 bg-white rounded flex items-center justify-center px-1">
                            <span class="text-[8px] font-black text-blue-900 leading-none">mandiri</span>
                        </div>
                        <!-- Midtrans -->
                        <div class="w-16 h-7 bg-white rounded flex items-center justify-center px-1">
                            <span class="text-[9px] font-bold text-slate-800">midtrans</span>
                        </div>
                        <!-- QRIS -->
                        <div class="w-10 h-7 bg-white rounded flex items-center justify-center px-1">
                            <span class="text-[10px] font-bold text-red-600">QRIS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281122334455?text=Halo%20AutoRent%2C%20saya%20ingin%20bertanya%20tentang%20sewa%20mobil." target="_blank" rel="noopener"
        class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center transition-all transform hover:scale-110 group"
        title="Chat WhatsApp">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M11.996 2C6.476 2 2 6.477 2 12.002c0 1.77.463 3.43 1.27 4.87L2.05 21.5l4.748-1.24A9.944 9.944 0 0012 21.998c5.523 0 10-4.477 10-9.998C22 6.476 17.521 2 11.996 2z"/>
        </svg>
        <span class="absolute right-16 bg-slate-900 text-white text-xs font-semibold px-3 py-1.5 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">Chat WhatsApp</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{!! session('success') !!}',
                    confirmButtonColor: '#0ea5e9',
                    customClass: {
                        popup: 'rounded-3xl'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{!! session('error') !!}',
                    confirmButtonColor: '#ef4444',
                    customClass: {
                        popup: 'rounded-3xl'
                    }
                });
            @endif
        });

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').catch(() => {});
        }
    </script>
</body>
</html>
