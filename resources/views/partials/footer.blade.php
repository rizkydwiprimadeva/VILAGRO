<footer class="w-full bg-surface-container-low mt-space-xl border-t border-surface-container-high">
    <div class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-gutter-lg pb-16">

            <div class="lg:col-span-4 flex flex-col space-y-space-md">
                <div class="flex items-center gap-space-sm">
                    <img alt="VILAGRO Logo" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAr6bZWA8qSyF-D1-HEpwS3uACPJ3pz7alpE1ZO9xXZVTxOzD6K7-5RCwLpUUUpvFpaZ2bnKQCzu-vgp26_N7rf4YE4-mUHnn7bMlwqWrleWtLpAJA1GCiPRUwEMbegUNLMge3gKWBj2U3CEN1I9l5UPPkBNdYCKXjWPk5rPAewgSVotj_4y3Ie9CU6BEo5UvxPDdY8D10eaExoUysut1m1uPxOtOU4v0MzDjOcpz8YpJZJKpb6cMzFycTSCUrWYeOXNw" />
                    <div class="flex flex-col leading-none">
                        <span class="font-headline-sm text-headline-sm font-bold tracking-tight text-primary">VILAGRO</span>
                        <span class="text-[10px] font-bold tracking-wider uppercase text-secondary font-headline-sm -mt-0.5">Agri-Vision AI</span>
                    </div>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm leading-relaxed">
                    Platform kecerdasan buatan patologi tanaman jagung nusantara. Mengintegrasikan deteksi Computer Vision, panduan kuratif agronomis teruji, dan ekosistem benih unggul tahan penyakit untuk melindungi panen petani Indonesia.
                </p>
                <div class="flex items-center gap-space-sm pt-space-xs">
                    <div class="w-9 h-9 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary transition-colors cursor-pointer" title="Website Resmi">
                        <span class="material-symbols-outlined text-[18px]">public</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary transition-colors cursor-pointer" title="Bagikan">
                        <span class="material-symbols-outlined text-[18px]">share</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary transition-colors cursor-pointer" title="Buletin Hama">
                        <span class="material-symbols-outlined text-[18px]">rss_feed</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex flex-col space-y-space-md">
                <span class="font-label-lg text-label-lg font-bold text-on-surface tracking-wide uppercase">Fitur AI</span>
                <ul class="space-y-space-sm font-body-sm text-body-sm text-on-surface-variant">
                    <li><a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-primary transition-colors" href="{{ route('scanner') }}">Scanner AI</a></li>
                    <li><a class="hover:text-primary transition-colors" href="{{ route('encyclopedia') }}">Katalog Penyakit</a></li>
                    <li><a class="hover:text-primary transition-colors" href="{{ route('guide') }}">Panduan Petani</a></li>
                    <li><a class="hover:text-primary transition-colors" href="{{ route('consultation') }}">Konsultasi</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3 flex flex-col space-y-space-md">
                <span class="font-label-lg text-label-lg font-bold text-on-surface tracking-wide uppercase">Kontak Laboratorium</span>
                <ul class="space-y-space-sm font-body-sm text-body-sm text-on-surface-variant">
                    <li class="flex items-start gap-space-sm">
                        <span class="material-symbols-outlined text-[18px] text-primary shrink-0 mt-0.5">location_on</span>
                        <span>Kawasan Agritech Agro-Hub Blok B4, Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-[18px] text-primary shrink-0">call</span>
                        <span>+62 811-2345-6789</span>
                    </li>
                    <li class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-[18px] text-primary shrink-0">mail</span>
                        <span>agri-vision@vilagro.co.id</span>
                    </li>
                    <li class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-[18px] text-primary shrink-0">schedule</span>
                        <span>Senin - Sabtu: 07.00 - 18.00 WIB</span>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-3 flex flex-col space-y-space-md">
                <span class="font-label-lg text-label-lg font-bold text-on-surface tracking-wide uppercase">Peringatan Wabah Cuaca</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                    Dapatkan peringatan dini ledakan populasi spora bulai dan ulat grayak di kabupaten Anda berdasarkan pantauan stasiun cuaca agro.
                </p>
                <form class="flex flex-col space-y-space-sm" onsubmit="event.preventDefault(); alert('Terima kasih! Peringatan hama wilayah Anda telah aktif.');">
                    <div class="relative">
                        <input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-lowest text-on-surface placeholder:text-outline text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm border border-surface-container-high" placeholder="Nomor WhatsApp / Email" required="" type="text" />
                    </div>
                    <button class="w-full px-space-md py-space-sm font-label-lg text-label-lg text-on-primary bg-primary hover:bg-primary-container hover:text-on-primary rounded-lg transition-all text-center shadow-sm" type="submit">
                        Aktifkan Peringatan Hama
                    </button>
                </form>
            </div>
        </div>

        <div class="pt-8 border-t border-surface-container-high flex flex-col md:flex-row items-center justify-between gap-space-md font-body-sm text-body-sm text-on-surface-variant">
            <p>© 2026 PT Vilagro Agritech Nusantara. Dilengkapi VILAGRO Agri-Vision AI Engine.</p>
            <div class="flex items-center gap-space-lg">
                <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi Data Citra</a>
                <a class="hover:text-primary transition-colors" href="#">SOP Diagnosis Pertanian</a>
                <a class="hover:text-primary transition-colors" href="#">Validasi Lab Patologi</a>
            </div>
        </div>
    </div>
</footer>