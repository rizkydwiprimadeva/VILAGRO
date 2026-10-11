<header class="fixed inset-x-0 top-0 z-50 border-b border-outline-variant/40 bg-surface/95 shadow-[0_2px_16px_rgba(7,36,23,0.06)] backdrop-blur-xl transition-colors duration-300">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <a class="flex shrink-0 items-center gap-3 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary" href="#hero" aria-label="VILAGRO, kembali ke beranda">
            <img src="{{ asset('images/logo-symbol.png') }}" alt="" class="h-10 w-auto shrink-0 object-contain">
            <span class="flex flex-col">
                <span class="font-headline-sm text-xl font-bold leading-none text-primary">VILAGRO</span>
                <span class="mt-1 font-headline-sm text-[10px] font-semibold uppercase tracking-[0.12em] text-[#527061]">Agri-Vision AI</span>
            </span>
        </a>

        <nav class="hidden items-center gap-0.5 rounded-xl bg-[#f1f4ef] p-1 xl:flex" aria-label="Navigasi utama">
            <a class="rounded-lg px-3 py-2.5 text-base font-medium text-on-surface-variant transition-colors hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary" href="#ai-scanner">AI Scan Penyakit</a>
            <a class="rounded-lg px-3 py-2.5 text-base font-medium text-on-surface-variant transition-colors hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary" href="#ensiklopedia-penyakit">Katalog Penyakit &amp; Hama</a>
            <a class="rounded-lg px-3 py-2.5 text-base font-medium text-on-surface-variant transition-colors hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary" href="#alur-kerja">Panduan Petani</a>
            <a class="rounded-lg px-3 py-2.5 text-base font-medium text-on-surface-variant transition-colors hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary" href="#faq">Konsultasi Agronomis</a>
        </nav>

        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
            <details class="relative xl:hidden">
                <summary class="flex h-10 w-10 cursor-pointer list-none items-center justify-center rounded-lg border border-outline-variant/70 text-primary transition hover:bg-surface-container-low [&::-webkit-details-marker]:hidden" aria-label="Buka navigasi">
                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">menu</span>
                    <span class="sr-only">Navigasi</span>
                </summary>
                <nav class="mobile-nav-panel flex flex-col gap-1 border-y border-outline-variant/50 bg-white py-2 shadow-lg" aria-label="Navigasi utama">
                    <a class="rounded-lg px-3 py-3 text-base font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary" href="#ai-scanner">AI Scan Penyakit</a>
                    <a class="rounded-lg px-3 py-3 text-base font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary" href="#ensiklopedia-penyakit">Katalog Penyakit &amp; Hama</a>
                    <a class="rounded-lg px-3 py-3 text-base font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary" href="#alur-kerja">Panduan Petani</a>
                    <a class="rounded-lg px-3 py-3 text-base font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary" href="#faq">Konsultasi Agronomis</a>
                </nav>
            </details>

            <a class="inline-flex min-h-10 items-center justify-center gap-2 rounded-lg bg-primary px-3 py-2 text-sm font-semibold text-on-primary shadow-[0_2px_8px_rgba(7,36,23,0.12)] transition-colors hover:bg-primary-container sm:px-4" href="#ai-scanner">
                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">document_scanner</span>
                <span class="hidden sm:inline">Mulai Diagnosa Gratis</span>
                <span class="sm:hidden">Diagnosa</span>
            </a>

            @guest
                <div class="hidden h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-primary sm:flex" title="Sistem AI Online" aria-label="Sistem AI online">
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">smart_toy</span>
                </div>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-lg border border-outline-variant/70 text-primary transition hover:bg-surface-container-low" title="Keluar" aria-label="Keluar">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">logout</span>
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>