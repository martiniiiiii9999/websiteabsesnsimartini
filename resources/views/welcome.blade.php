<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Absensi Digital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .animate-fade-in-up {
                animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                opacity: 0;
                transform: translateY(20px);
            }
            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; }
            
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="antialiased bg-white text-slate-900 selection:bg-black selection:text-white overflow-x-hidden">

        <!-- Grid Pattern Element -->
        <div class="fixed inset-0 z-[-1] bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>

        <!-- Navbar -->
        <nav class="w-full py-6 px-6 sm:px-12 flex justify-between items-center max-w-7xl mx-auto z-10 relative">
            <div class="flex items-center space-x-2.5">
                <div class="bg-slate-900 text-white p-2 rounded-xl shadow-lg shadow-slate-900/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">Absensi<span class="text-slate-500">App</span></span>
            </div>

            <div class="flex items-center gap-4 sm:gap-8">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-full transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-full transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Daftar Gratis
                        </a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col items-center justify-start px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto w-full pt-20 sm:pt-32 pb-24 text-center z-10 relative">
            
            <!-- Badge -->
            <div class="animate-fade-in-up inline-flex items-center px-4 py-1.5 rounded-full bg-white border border-slate-200 text-slate-600 text-xs sm:text-sm font-semibold mb-10 shadow-[0_2px_10px_-2px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow cursor-default select-none">
                <span class="flex h-2 w-2 rounded-full bg-blue-500 mr-2.5 animate-pulse"></span>
                Sistem Absensi v2.0 Telah Rilis
            </div>

            <!-- Hero Headline -->
            <h1 class="animate-fade-in-up delay-100 text-5xl sm:text-7xl lg:text-8xl font-black tracking-tighter text-slate-900 mb-8 leading-[0.95] sm:leading-[1]">
                Kelola Kehadiran <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600">Lebih Profesional.</span>
            </h1>

            <!-- Subheadline -->
            <p class="animate-fade-in-up delay-200 text-lg sm:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed mb-12 font-medium">
                Solusi pencatatan kehadiran modern untuk tim yang dinamis. Pantau produktivitas, kelola jadwal, dan rekap laporan dalam satu klik.
            </p>

            <!-- Buttons -->
            <div class="animate-fade-in-up delay-300 flex flex-col sm:flex-row gap-4 w-full justify-center items-center mb-16">
                @auth
                    <a href="{{ route('absensi.index') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-black text-white font-bold rounded-full transition-all shadow-xl hover:shadow-2xl hover:shadow-slate-900/20 transform hover:-translate-y-1 text-base">
                        Mulai Absen
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-black text-white font-bold rounded-full transition-all shadow-xl hover:shadow-2xl hover:shadow-slate-900/20 transform hover:-translate-y-1 text-base">
                        Mulai Sekarang
                    </a>
                    <a href="#demo" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-slate-900 border border-slate-200 font-bold rounded-full transition-all shadow-sm hover:shadow-md text-base">
                        Pelajari Fitur
                    </a>
                @endauth
            </div>

            <!-- Stats / Social Proof -->
            <div class="animate-fade-in-up delay-300 pt-8 border-t border-slate-100 w-full max-w-2xl">
                <div class="flex flex-wrap justify-center gap-8 sm:gap-16 text-sm font-semibold text-slate-500">
                    <div class="flex items-center gap-2.5">
                       <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                       </div>
                        <span>100+ Karyawan Terdaftar</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="p-1.5 bg-purple-50 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <span>Laporan Real-time</span>
                    </div>
                </div>
            </div>

        </main>
    </body>
</html>
