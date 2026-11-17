<section class="scroll-mt-20 bg-surface-container-low py-14 md:py-20" id="ensiklopedia-penyakit">
    <div class="mx-auto max-w-7xl px-margin-mobile md:px-margin lg:px-margin-desktop">
        <div class="mb-8 flex flex-col gap-6 lg:mb-10 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-tertiary-fixed px-3 py-1.5 text-xs font-extrabold uppercase tracking-wider text-on-tertiary-fixed-variant">
                    <span class="h-2 w-2 rounded-full bg-secondary"></span>
                    Kenali sebelum terlambat
                </span>
                <h2 class="mt-4 font-headline-lg text-3xl font-extrabold tracking-tight text-primary sm:text-4xl">
                    Ensiklopedia ancaman jagung
                </h2>
                <p class="mt-3 max-w-xl text-sm leading-6 text-on-surface-variant sm:text-base">
                    Pilih satu ancaman untuk melihat ringkasan gejala dan fase tanaman yang perlu diperhatikan.
                </p>
            </div>

            <label class="relative block w-full lg:max-w-sm">
                <span class="sr-only">Cari penyakit atau hama</span>
                <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xl text-outline" aria-hidden="true">search</span>
                <input
                    class="w-full rounded-2xl border border-surface-container-high bg-white py-3.5 pl-12 pr-4 text-sm text-on-surface shadow-sm outline-none transition placeholder:text-outline focus:border-primary focus:ring-4 focus:ring-primary/10"
                    id="catalog-search"
                    placeholder="Cari gejala atau nama..."
                    type="search"
                >
            </label>
        </div>

        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2" aria-label="Filter katalog">
                <button class="catalog-filter rounded-full bg-primary px-4 py-2 text-xs font-bold text-white shadow-sm transition hover:-translate-y-0.5" data-filter="all" type="button" aria-pressed="true">Semua</button>
                <button class="catalog-filter rounded-full border border-surface-container-high bg-white px-4 py-2 text-xs font-bold text-on-surface-variant transition hover:-translate-y-0.5 hover:border-primary" data-filter="disease" type="button" aria-pressed="false">Penyakit</button>
                <button class="catalog-filter rounded-full border border-surface-container-high bg-white px-4 py-2 text-xs font-bold text-on-surface-variant transition hover:-translate-y-0.5 hover:border-primary" data-filter="pest" type="button" aria-pressed="false">Hama</button>
            </div>
            <p class="text-xs font-semibold text-outline"><span id="catalog-count">4</span> panduan tersedia</p>
        </div>

        <div class="space-y-3" id="catalog-grid">
            <details class="catalog-card group overflow-hidden rounded-2xl border border-surface-container-high bg-white shadow-sm transition hover:border-primary/20 hover:shadow-md" data-category="disease" data-search="bulai downy mildew peronosclerospora maydis daun kuning putih garis klorotik tanaman kerdil">
                <summary class="flex cursor-pointer list-none items-center gap-4 p-4 marker:hidden sm:gap-5 sm:px-6 sm:py-5">
                    <span class="hidden w-9 shrink-0 font-headline-xl text-2xl font-extrabold text-error/30 sm:block">01</span>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-error-container text-on-error-container">
                        <span class="material-symbols-outlined text-2xl" aria-hidden="true">coronavirus</span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="font-extrabold text-primary sm:text-lg">Penyakit Bulai</span>
                            <span class="rounded-full bg-error-container px-2.5 py-1 text-[10px] font-bold text-on-error-container">Risiko sangat tinggi</span>
                        </span>
                        <span class="mt-1 block text-xs text-on-surface-variant">Penyakit · Jamur Oomycota · <span class="italic">Peronosclerospora maydis</span></span>
                    </span>
                    <span class="hidden shrink-0 items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-[11px] font-semibold text-on-surface-variant md:inline-flex">
                        <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                        HST 10–30
                    </span>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-surface-container-low text-primary transition group-open:rotate-180 group-open:bg-primary group-open:text-white">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">expand_more</span>
                    </span>
                </summary>
                <div class="border-t border-surface-container-high bg-surface-container-low/70 px-4 py-5 sm:px-6 sm:py-6">
                    <div class="grid gap-5 md:grid-cols-[1fr_auto] md:items-end">
                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-secondary">Gejala yang perlu diamati</p>
                            <p class="mt-2 max-w-3xl text-sm leading-6 text-on-surface-variant">Daun menguning keputihan dengan garis memanjang. Tanaman dapat kerdil dan gagal membentuk tongkol.</p>
                            <p class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-on-surface-variant md:hidden">
                                <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                                Fase rentan: HST 10–30
                            </p>
                        </div>
                        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-bold text-white transition hover:bg-primary-container" href="{{ route('scanner') }}#ai-scanner">
                            Scan gejala
                            <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </details>

            <details class="catalog-card group overflow-hidden rounded-2xl border border-surface-container-high bg-white shadow-sm transition hover:border-primary/20 hover:shadow-md" data-category="disease" data-search="busuk batang fusarium verticillioides pythium akar batang cokelat hitam lunak rebah">
                <summary class="flex cursor-pointer list-none items-center gap-4 p-4 marker:hidden sm:gap-5 sm:px-6 sm:py-5">
                    <span class="hidden w-9 shrink-0 font-headline-xl text-2xl font-extrabold text-secondary/40 sm:block">02</span>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-secondary-fixed text-on-secondary-fixed">
                        <span class="material-symbols-outlined text-2xl" aria-hidden="true">spa</span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="font-extrabold text-primary sm:text-lg">Busuk Batang</span>
                            <span class="rounded-full bg-secondary-fixed px-2.5 py-1 text-[10px] font-bold text-on-secondary-fixed">Risiko tinggi</span>
                        </span>
                        <span class="mt-1 block text-xs text-on-surface-variant">Penyakit · Tular tanah · <span class="italic">Fusarium verticillioides / Pythium</span></span>
                    </span>
                    <span class="hidden shrink-0 items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-[11px] font-semibold text-on-surface-variant md:inline-flex">
                        <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                        HST 55–80
                    </span>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-surface-container-low text-primary transition group-open:rotate-180 group-open:bg-primary group-open:text-white">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">expand_more</span>
                    </span>
                </summary>
                <div class="border-t border-surface-container-high bg-surface-container-low/70 px-4 py-5 sm:px-6 sm:py-6">
                    <div class="grid gap-5 md:grid-cols-[1fr_auto] md:items-end">
                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-secondary">Gejala yang perlu diamati</p>
                            <p class="mt-2 max-w-3xl text-sm leading-6 text-on-surface-variant">Batang bagian bawah menjadi lunak dan menghitam. Tanaman dapat berbau asam dan mudah roboh.</p>
                            <p class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-on-surface-variant md:hidden">
                                <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                                Fase rentan: HST 55–80
                            </p>
                        </div>
                        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-bold text-white transition hover:bg-primary-container" href="{{ route('scanner') }}#ai-scanner">
                            Scan gejala
                            <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </details>

            <details class="catalog-card group overflow-hidden rounded-2xl border border-surface-container-high bg-white shadow-sm transition hover:border-primary/20 hover:shadow-md" data-category="disease" data-search="karat daun jagung puccinia sorghi pustul bintik cokelat merah daun">
                <summary class="flex cursor-pointer list-none items-center gap-4 p-4 marker:hidden sm:gap-5 sm:px-6 sm:py-5">
                    <span class="hidden w-9 shrink-0 font-headline-xl text-2xl font-extrabold text-secondary/40 sm:block">03</span>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-tertiary-fixed text-on-tertiary-fixed-variant">
                        <span class="material-symbols-outlined text-2xl" aria-hidden="true">blur_on</span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="font-extrabold text-primary sm:text-lg">Karat Daun Jagung</span>
                            <span class="rounded-full bg-tertiary-fixed px-2.5 py-1 text-[10px] font-bold text-on-tertiary-fixed-variant">Risiko sedang</span>
                        </span>
                        <span class="mt-1 block text-xs text-on-surface-variant">Penyakit · Pucciniales · <span class="italic">Puccinia sorghi</span></span>
                    </span>
                    <span class="hidden shrink-0 items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-[11px] font-semibold text-on-surface-variant md:inline-flex">
                        <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                        HST 40–75
                    </span>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-surface-container-low text-primary transition group-open:rotate-180 group-open:bg-primary group-open:text-white">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">expand_more</span>
                    </span>
                </summary>
                <div class="border-t border-surface-container-high bg-surface-container-low/70 px-4 py-5 sm:px-6 sm:py-6">
                    <div class="grid gap-5 md:grid-cols-[1fr_auto] md:items-end">
                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-secondary">Gejala yang perlu diamati</p>
                            <p class="mt-2 max-w-3xl text-sm leading-6 text-on-surface-variant">Bintik pustul cokelat kemerahan muncul pada permukaan daun dan dapat menghambat fotosintesis.</p>
                            <p class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-on-surface-variant md:hidden">
                                <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                                Fase rentan: HST 40–75
                            </p>
                        </div>
                        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-bold text-white transition hover:bg-primary-container" href="{{ route('scanner') }}#ai-scanner">
                            Scan gejala
                            <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </details>

            <details class="catalog-card group overflow-hidden rounded-2xl border border-surface-container-high bg-white shadow-sm transition hover:border-primary/20 hover:shadow-md" data-category="pest" data-search="ulat grayak fall armyworm faw spodoptera frugiperda hama larva pucuk daun lubang koyak">
                <summary class="flex cursor-pointer list-none items-center gap-4 p-4 marker:hidden sm:gap-5 sm:px-6 sm:py-5">
                    <span class="hidden w-9 shrink-0 font-headline-xl text-2xl font-extrabold text-error/30 sm:block">04</span>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-error-container text-on-error-container">
                        <span class="material-symbols-outlined text-2xl" aria-hidden="true">pest_control</span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="font-extrabold text-primary sm:text-lg">Ulat Grayak (FAW)</span>
                            <span class="rounded-full bg-error-container px-2.5 py-1 text-[10px] font-bold text-on-error-container">Menyebar cepat</span>
                        </span>
                        <span class="mt-1 block text-xs text-on-surface-variant">Hama · Lepidoptera · <span class="italic">Spodoptera frugiperda</span></span>
                    </span>
                    <span class="hidden shrink-0 items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-[11px] font-semibold text-on-surface-variant md:inline-flex">
                        <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                        HST 15–50
                    </span>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-surface-container-low text-primary transition group-open:rotate-180 group-open:bg-primary group-open:text-white">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">expand_more</span>
                    </span>
                </summary>
                <div class="border-t border-surface-container-high bg-surface-container-low/70 px-4 py-5 sm:px-6 sm:py-6">
                    <div class="grid gap-5 md:grid-cols-[1fr_auto] md:items-end">
                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.15em] text-secondary">Gejala yang perlu diamati</p>
                            <p class="mt-2 max-w-3xl text-sm leading-6 text-on-surface-variant">Larva merusak pucuk dan daun muda, meninggalkan lubang koyak serta serbuk gerek kasar.</p>
                            <p class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-on-surface-variant md:hidden">
                                <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>
                                Fase rentan: HST 15–50
                            </p>
                        </div>
                        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-bold text-white transition hover:bg-primary-container" href="{{ route('scanner') }}#ai-scanner">
                            Scan gejala
                            <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </details>
        </div>

        <p class="mt-8 hidden rounded-2xl border border-surface-container-high bg-white px-5 py-6 text-center text-sm font-semibold text-on-surface-variant" id="catalog-empty" role="status">
            Tidak ada panduan yang cocok. Coba kata kunci lain.
        </p>

        <div class="mt-10 flex flex-col items-start justify-between gap-5 rounded-3xl bg-primary p-6 text-white sm:flex-row sm:items-center sm:p-8">
            <div class="flex items-start gap-4">
                <span class="material-symbols-outlined rounded-2xl bg-white/10 p-3 text-2xl text-secondary-fixed" aria-hidden="true">photo_camera</span>
                <div>
                    <h3 class="text-lg font-extrabold">Menemukan gejala di lahan?</h3>
                    <p class="mt-1 max-w-xl text-sm leading-6 text-white/70">Unggah foto tanaman untuk pemeriksaan awal dengan VILAGRO AI.</p>
                </div>
            </div>
            <a class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-secondary-fixed px-5 py-3 text-sm font-extrabold text-on-secondary-fixed transition hover:-translate-y-0.5 hover:bg-white" href="{{ route('scanner') }}#ai-scanner">
                Mulai scan
                <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        const catalogSearch = document.getElementById("catalog-search");
        const catalogFilters = document.querySelectorAll(".catalog-filter");
        const catalogCards = document.querySelectorAll(".catalog-card");
        const catalogCount = document.getElementById("catalog-count");
        const catalogEmpty = document.getElementById("catalog-empty");
        let activeCatalogFilter = "all";

        function updateCatalog() {
            const searchTerm = catalogSearch.value.trim().toLocaleLowerCase("id");
            let visibleCount = 0;

            catalogCards.forEach((card) => {
                const matchesCategory =
                    activeCatalogFilter === "all" ||
                    card.dataset.category === activeCatalogFilter;
                const matchesSearch = card.dataset.search
                    .toLocaleLowerCase("id")
                    .includes(searchTerm);
                const isVisible = matchesCategory && matchesSearch;

                card.classList.toggle("hidden", !isVisible);
                visibleCount += Number(isVisible);
            });

            catalogCount.textContent = String(visibleCount);
            catalogEmpty.classList.toggle("hidden", visibleCount > 0);
        }

        catalogSearch.addEventListener("input", updateCatalog);

        catalogFilters.forEach((filter) => {
            filter.addEventListener("click", () => {
                activeCatalogFilter = filter.dataset.filter;

                catalogFilters.forEach((button) => {
                    const isActive = button === filter;
                    button.setAttribute("aria-pressed", String(isActive));
                    button.classList.toggle("bg-primary", isActive);
                    button.classList.toggle("text-white", isActive);
                    button.classList.toggle("shadow-sm", isActive);
                    button.classList.toggle("bg-white", !isActive);
                    button.classList.toggle("text-on-surface-variant", !isActive);
                });

                updateCatalog();
            });
        });
    </script>
@endpush
