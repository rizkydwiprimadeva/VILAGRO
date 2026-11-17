@php($hasOverlayHero = request()->routeIs('home'))

<header @class([
    'inset-x-0 top-0 z-50 transition-colors duration-300',
    'absolute border-0 bg-transparent' => $hasOverlayHero,
    'fixed border-b border-outline-variant/40 bg-surface/95 shadow-[0_2px_16px_rgba(7,36,23,0.06)] backdrop-blur-xl' => ! $hasOverlayHero,
])>
    <div @class([
        'mx-auto flex h-16 max-w-7xl items-center justify-between gap-2 px-4 sm:h-20 sm:gap-3 sm:px-6 lg:px-8',
        'mx-3 mt-3 rounded-2xl border border-white/20 bg-primary/25 px-4 shadow-lg shadow-black/10 backdrop-blur-md sm:mx-6 lg:mx-auto lg:mt-0 lg:rounded-none lg:border-0 lg:bg-transparent lg:px-8 lg:shadow-none lg:backdrop-blur-none' => $hasOverlayHero,
    ])>
        <a class="flex shrink-0 items-center gap-1.5 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary sm:gap-2" href="{{ route('home') }}" aria-label="VILAGRO, kembali ke beranda">
            <img src="{{ asset('images/logo-symbol.png') }}" alt="" class="h-11 w-11 shrink-0 object-contain sm:h-12 sm:w-12">
            <span @class(['font-body-lg text-lg font-extrabold leading-none tracking-[-0.035em] sm:text-xl', 'text-white' => $hasOverlayHero, 'text-primary' => ! $hasOverlayHero])>VILAGRO</span>
        </a>

        <nav @class([
            'hidden items-center gap-0.5 rounded-xl p-1 xl:flex',
            'bg-transparent' => $hasOverlayHero,
            'bg-[#f1f4ef]' => ! $hasOverlayHero,
        ]) aria-label="Navigasi utama">
            <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('scanner')]) href="{{ route('scanner') }}">Scanner AI</a>
            <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('farm-map')]) href="{{ route('farm-map') }}">Peta Kebun</a>
            @auth
                <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('notifications.*')]) href="{{ route('notifications.index') }}">Notifikasi</a>
                <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('scan-history.*')]) href="{{ route('scan-history.index') }}">Riwayat Scan</a>
            @endauth
            <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('encyclopedia')]) href="{{ route('encyclopedia') }}">Katalog Penyakit</a>
            <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('guide')]) href="{{ route('guide') }}">Panduan Petani</a>
            <a @class(['rounded-lg px-3 py-2.5 text-base font-medium transition-all duration-200 active:scale-[0.97]', 'text-white/90 hover:bg-white/15 hover:text-white focus-visible:bg-white/20 focus-visible:text-white active:bg-white/20' => $hasOverlayHero, 'text-on-surface-variant hover:bg-white/80 hover:text-primary focus-visible:bg-white focus-visible:text-primary active:bg-white' => ! $hasOverlayHero, 'bg-white text-primary' => request()->routeIs('consultation')]) href="{{ route('consultation') }}">Konsultasi</a>
        </nav>

        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
            <details class="relative order-2 xl:hidden">
                <summary @class(['flex h-10 w-10 cursor-pointer list-none items-center justify-center rounded-xl border transition duration-200 [&::-webkit-details-marker]:hidden', 'border-white/25 bg-white/10 text-white hover:bg-white/20' => $hasOverlayHero, 'border-outline-variant/70 bg-white text-primary hover:bg-surface-container-low' => ! $hasOverlayHero]) aria-label="Buka navigasi">
                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">menu</span>
                    <span class="sr-only">Navigasi</span>
                </summary>
                <nav class="mobile-nav-panel flex flex-col gap-1 rounded-2xl border border-outline-variant/50 bg-white/95 p-2 shadow-xl backdrop-blur-xl" aria-label="Navigasi utama">
                    <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('scanner') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('scanner') }}">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">document_scanner</span>Scanner AI
                    </a>
                    <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('farm-map') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('farm-map') }}">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">map</span>Peta Kebun
                    </a>
                    @auth
                        <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('notifications.*') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('notifications.index') }}">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">notifications</span>Notifikasi
                        </a>
                        <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('scan-history.*') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('scan-history.index') }}">
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">history</span>Riwayat Scan
                        </a>
                    @endauth
                    <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('encyclopedia') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('encyclopedia') }}">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">menu_book</span>Katalog Penyakit
                    </a>
                    <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('guide') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('guide') }}">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">school</span>Panduan Petani
                    </a>
                    <a class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary {{ request()->routeIs('consultation') ? 'bg-surface-container-low text-primary' : '' }}" href="{{ route('consultation') }}">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">support_agent</span>Konsultasi
                    </a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="xl:hidden">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-semibold text-on-surface-variant transition hover:bg-surface-container-low hover:text-primary">
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">logout</span>
                                Keluar
                            </button>
                        </form>
                    @endauth
                </nav>
            </details>

            <a @class(['order-1 inline-flex min-h-9 shrink-0 items-center justify-center whitespace-nowrap rounded-full px-3 py-2 text-[10px] font-extrabold uppercase tracking-[0.08em] transition-all duration-200 active:scale-[0.97] sm:px-5 sm:text-[11px] sm:tracking-[0.12em] xl:order-none', 'bg-[#111111] text-white hover:bg-primary' => $hasOverlayHero, 'bg-primary text-on-primary hover:bg-primary-container' => ! $hasOverlayHero]) href="{{ route('consultation') }}">
                Konsultasi
            </a>

            @guest
                <div class="hidden h-9 w-9 items-center justify-center rounded-full bg-primary-fixed text-primary xl:flex" title="Sistem AI Online" aria-label="Sistem AI online">
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">smart_toy</span>
                </div>
            @else
                <form method="POST" action="{{ route('logout') }}" class="hidden xl:block">
                    @csrf
                    <button type="submit" @class(['flex h-10 w-10 items-center justify-center rounded-lg border transition', 'border-white/40 text-white hover:bg-white/15' => $hasOverlayHero, 'border-outline-variant/70 text-primary hover:bg-surface-container-low' => ! $hasOverlayHero]) title="Keluar" aria-label="Keluar">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">logout</span>
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>