<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AutoRent') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob { animation: blob 7s infinite; }
            .animation-delay-2000 { animation-delay: 2s; }
            .animation-delay-4000 { animation-delay: 4s; }
        </style>
    </head>
    <body class="font-sans text-slate-300 antialiased bg-slate-950 selection:bg-indigo-500/30">
        <div class="min-h-screen flex">
            <!-- Left Side: Image/Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1485291571150-772bcfc10da5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-slate-950/20"></div>
                <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24 text-white w-full h-full">
                    <a href="/" class="mb-12 inline-block transition-transform hover:scale-105 duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </div>
                            <span class="text-3xl font-extrabold tracking-tight">Auto<span class="text-indigo-400">Rent</span></span>
                        </div>
                    </a>
                    <h1 class="text-5xl xl:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                        Drive Your <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-cyan-400">Dreams Today</span>
                    </h1>
                    <p class="text-lg xl:text-xl text-slate-300 max-w-md leading-relaxed">
                        Experience the ultimate comfort and luxury with our premium car rental service. Choose from a wide range of vehicles for any occasion.
                    </p>
                    
                    <div class="mt-12 flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <img class="w-10 h-10 rounded-full border-2 border-slate-950" src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-slate-950" src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-slate-950" src="https://ui-avatars.com/api/?name=Alex+Johnson&background=random" alt="User">
                            <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-white">+1k</div>
                        </div>
                        <p class="text-sm font-medium text-slate-400">Trusted by 1000+ customers</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-24 bg-slate-950 relative overflow-hidden">
                <!-- Decorative blobs -->
                <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

                <div class="w-full max-w-md relative z-10">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <a href="/" class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </div>
                            <span class="text-3xl font-extrabold tracking-tight text-white">Auto<span class="text-indigo-400">Rent</span></span>
                        </a>
                    </div>

                    <div class="bg-slate-900/60 backdrop-blur-2xl p-8 sm:p-10 rounded-3xl shadow-2xl border border-slate-700/50">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
