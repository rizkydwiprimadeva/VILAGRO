<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - VILAGRO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#faf9f4] font-[Plus_Jakarta_Sans,sans-serif] text-[#1b2a20]">
<div class="min-h-screen lg:grid lg:grid-cols-[256px_minmax(0,1fr)]">
    <aside class="hidden flex-col border-r border-[#e4e8df] bg-white px-6 py-7 lg:flex">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3" aria-label="VILAGRO dashboard">
            <img src="{{ asset('images/logo-symbol.png') }}" alt="" class="h-10 w-auto shrink-0">
            <span>
                <span class="block font-[Manrope,sans-serif] text-xl font-bold leading-none">VILAGRO</span>
                <span class="mt-1 block text-[10px] font-semibold tracking-[0.12em] text-[#527061]">AGRI VISION AI</span>
            </span>
        </a>

        <nav class="mt-12 space-y-2" aria-label="Navigasi utama">
            <a href="{{ route('dashboard') }}" aria-current="page" class="flex items-center gap-3 rounded-lg bg-[#eaf1eb] px-3 py-3 text-sm font-semibold text-[#04342a]">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('home') }}#ai-scanner" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-[#53665a] transition hover:bg-[#f4f7f4] hover:text-[#04342a]">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">document_scanner</span>
                Diagnosa AI
            </a>
            <a href="{{ route('home') }}#ensiklopedia-penyakit" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-[#53665a] transition hover:bg-[#f4f7f4] hover:text-[#04342a]">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">menu_book</span>
                Katalog penyakit
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm font-medium text-[#53665a] transition hover:bg-[#f4f7f4] hover:text-[#04342a]">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">home</span>
                Beranda
            </a>
        </nav>

        <div class="mt-auto border-t border-[#e8ede9] pt-5">
            <p class="truncate text-sm font-semibold">{{ Auth::user()->name }}</p>
            <p class="mt-1 truncate text-xs text-[#6d7d73]">{{ Auth::user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-[#53665a] transition hover:bg-[#f4f7f4] hover:text-[#04342a]">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="min-w-0">
        <header class="flex items-center justify-between border-b border-[#e4e8df] bg-white px-5 py-4 lg:hidden">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2" aria-label="VILAGRO dashboard">
                <img src="{{ asset('images/logo-symbol.png') }}" alt="" class="h-8 w-auto shrink-0">
                <span class="font-[Manrope,sans-serif] text-lg font-bold">VILAGRO</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-[#53665a] hover:bg-[#f4f7f4]">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">logout</span>
                    Keluar
                </button>
            </form>
        </header>

        <main class="mx-auto max-w-7xl px-5 py-7 sm:px-8 lg:px-10 lg:py-10">
            <div class="mb-8 flex items-center justify-between gap-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.12em] text-[#668071]">Dashboard</p>
                    <h1 class="mt-2 font-[Manrope,sans-serif] text-2xl font-bold sm:text-3xl">Halo, {{ Auth::user()->name }}</h1>
                    <p class="mt-2 text-sm text-[#64756b] sm:text-base">Pantau kondisi tanaman jagung dan mulai pemeriksaan AI.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="hidden lg:block">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 rounded-lg border border-[#dce5de] bg-white px-4 py-2.5 text-sm font-semibold text-[#435b4c] transition hover:border-[#a8bcae] hover:bg-[#f8faf8]">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">logout</span>
                        Keluar
                    </button>
                </form>
            </div>

            <section class="mb-8 overflow-hidden rounded-lg bg-[#04342a] text-white">
                <div class="grid md:grid-cols-[minmax(0,1fr)_210px]">
                    <div class="px-6 py-7 sm:px-8 sm:py-9">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#c0d8c5]">VILAGRO AI · TANAMAN JAGUNG</p>
                        <h2 class="mt-4 max-w-2xl font-[Manrope,sans-serif] text-2xl font-semibold leading-tight sm:text-3xl">Periksa kondisi tanaman lebih awal.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-white/80 sm:text-base">Unggah foto daun, batang, atau tongkol jagung untuk mendapatkan analisis dan panduan penanganan.</p>
                        <a href="{{ route('home') }}#ai-scanner" class="mt-6 inline-flex min-h-12 items-center gap-3 rounded-lg bg-white px-5 py-3 text-sm font-semibold text-[#04342a] transition hover:bg-[#edf4ef]">
                            Mulai diagnosa
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                    <div class="flex items-center border-t border-white/15 px-6 py-5 md:border-l md:border-t-0 md:px-7">
                        <div>
                            <p class="text-xs font-medium text-white/70">Waktu analisis</p>
                            <p class="mt-1 font-[Manrope,sans-serif] text-3xl font-bold">&lt; 3 detik</p>
                            <p class="mt-1 text-xs text-white/70">untuk hasil awal AI</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="grid gap-6 lg:grid-cols-[minmax(0,1.35fr)_minmax(280px,0.9fr)]">
                <section class="rounded-lg border border-[#e2e9e3] bg-white p-5 sm:p-6" aria-labelledby="activity-heading">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 id="activity-heading" class="font-[Manrope,sans-serif] text-lg font-bold">Aktivitas pemeriksaan</h2>
                            <p class="mt-1 text-sm text-[#6b7b71]">Ringkasan pemeriksaan tanaman Anda.</p>
                        </div>
                        <span class="material-symbols-outlined text-[#7a9583]" aria-hidden="true">history</span>
                    </div>
                    <div class="mt-6 rounded-lg border border-dashed border-[#dce5de] bg-[#fafcf9] px-5 py-8 text-center">
                        <span class="material-symbols-outlined text-3xl text-[#82988a]" aria-hidden="true">yard</span>
                        <h3 class="mt-3 text-sm font-semibold text-[#32473a]">Belum ada pemeriksaan</h3>
                        <p class="mx-auto mt-1 max-w-sm text-sm leading-relaxed text-[#718076]">Mulai dengan mengunggah foto tanaman untuk melihat analisis AI pertama Anda.</p>
                        <a href="{{ route('home') }}#ai-scanner" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-[#07513d] hover:underline">
                            Buka AI Scanner
                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </section>

                <section class="rounded-lg border border-[#e2e9e3] bg-white p-5 sm:p-6" aria-labelledby="coverage-heading">
                    <h2 id="coverage-heading" class="font-[Manrope,sans-serif] text-lg font-bold">Cakupan diagnosa</h2>
                    <p class="mt-1 text-sm text-[#6b7b71]">Gangguan tanaman yang tersedia untuk dianalisis.</p>
                    <ul class="mt-5 divide-y divide-[#edf1ed]">
                        <li class="flex items-center gap-3 py-3 text-sm font-medium text-[#34483a]"><span class="h-2 w-2 rounded-full bg-[#6b9b68]"></span>Bulai</li>
                        <li class="flex items-center gap-3 py-3 text-sm font-medium text-[#34483a]"><span class="h-2 w-2 rounded-full bg-[#6b9b68]"></span>Busuk batang</li>
                        <li class="flex items-center gap-3 py-3 text-sm font-medium text-[#34483a]"><span class="h-2 w-2 rounded-full bg-[#6b9b68]"></span>Karat daun</li>
                        <li class="flex items-center gap-3 py-3 text-sm font-medium text-[#34483a]"><span class="h-2 w-2 rounded-full bg-[#6b9b68]"></span>Ulat grayak (FAW)</li>
                    </ul>
                </section>
            </div>
        </main>
    </div>
</div>
</body>
</html>