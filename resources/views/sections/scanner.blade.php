<section class="bg-surface-container py-16 scroll-mt-20" id="ai-scanner">
    <div class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop">
        <div class="bg-surface-container-lowest rounded-3xl p-space-lg md:p-space-xl shadow-xl border border-surface-container-high">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-space-md border-b border-surface-container-high pb-6">
                <div>
                    <div class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md mb-2">
                        <span class="material-symbols-outlined text-[16px]">document_scanner</span>
                        <span>VILAGRO Agri-Vision AI Engine</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary font-bold">
                        Scanner &amp; Diagnostic Tool Daun Jagung
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mt-1">
                        Unggah foto daun, batang, atau tongkol jagung yang bergejala sakit, atau klik salah satu sampel foto uji klinis di bawah untuk simulasi langsung.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-fixed text-primary">
                        <span class="w-2 h-2 rounded-full bg-primary inline-block mr-1.5 animate-pulse"></span>
                        AI Cloud Model Siap Menganalisis
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">

                <div class="lg:col-span-6 flex flex-col space-y-space-md">
                    <div class="relative group">
                        <label class="relative flex flex-col items-center justify-center w-full min-h-[300px] p-6 border-2 border-dashed border-outline-variant hover:border-primary rounded-2xl bg-surface-container-low hover:bg-surface-container transition-all cursor-pointer overflow-hidden text-center" for="corn-image-input">
                            <input accept="image/*" class="hidden" id="corn-image-input" type="file" />

                            <div class="scanner-active-beam hidden" id="scan-laser"></div>

                            <div class="flex flex-col items-center space-y-2" id="upload-prompt">
                                <div class="w-16 h-16 rounded-full bg-primary-fixed text-primary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[34px]">add_a_photo</span>
                                </div>
                                <p class="font-headline-sm text-headline-sm font-bold text-primary">Ambil Foto atau Drag &amp; Drop Gambar</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm">
                                    Format JPG, PNG, atau WEBP. Pastikan pencahayaan cukup dan fokus pada bercak daun atau batang.
                                </p>
                                <div class="mt-2 inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary text-on-primary text-label-md font-semibold shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">upload_file</span>
                                    <span>Pilih Foto dari Galeri / Kamera</span>
                                </div>
                            </div>

                            <div class="hidden relative w-full h-[300px] flex items-center justify-center" id="image-preview-wrapper">
                                <img alt="Preview Daun Jagung" class="w-full h-full object-cover rounded-xl" id="image-preview" src="" />
                                <div class="absolute inset-0 bg-black/20 rounded-xl"></div>
                                <div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-semibold text-primary flex items-center gap-1.5 shadow">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">image</span>
                                    <span id="preview-filename">daun-jagung.jpg</span>
                                </div>
                                <button class="absolute top-3 right-3 bg-surface-container-lowest/90 hover:bg-white text-on-surface p-1.5 rounded-full shadow transition-all" id="btn-reupload" title="Ganti Gambar" type="button">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                            </div>

                            <div class="hidden absolute inset-0 bg-primary/75 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-on-primary p-6 z-30" id="scanning-status">
                                <div class="relative w-14 h-14 mb-3">
                                    <div class="w-14 h-14 rounded-full border-4 border-primary-fixed/30 border-t-secondary animate-spin"></div>
                                    <span class="material-symbols-outlined absolute inset-0 flex items-center justify-center text-secondary text-[24px]">search</span>
                                </div>
                                <p class="font-headline-sm text-headline-sm font-bold" id="scan-progress-text">Memindai Morfologi Daun...</p>
                                <p class="text-xs text-primary-fixed mt-1">Mencocokkan dengan 120.000 citra patologi jagung</p>
                            </div>
                        </label>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-secondary">Uji Coba Cepat (Pilih Sampel Preset):</span>
                            <span class="text-[11px] text-outline">Klik salah satu untuk diagnosa</span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-space-xs">
                            <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="bulai" type="button">
                                <div class="flex items-center justify-between w-full">
                                    <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Penyakit Bulai</span>
                                    <span class="material-symbols-outlined text-[16px] text-secondary">coronavirus</span>
                                </div>
                                <p class="text-[11px] text-on-surface-variant leading-tight">Peronosclerospora (Bercak Kuning Garis)</p>
                                <span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 98.4%</span>
                            </button>

                            <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="busuk" type="button">
                                <div class="flex items-center justify-between w-full">
                                    <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Busuk Batang</span>
                                    <span class="material-symbols-outlined text-[16px] text-secondary">broken_image</span>
                                </div>
                                <p class="text-[11px] text-on-surface-variant leading-tight">Fusarium / Pythium (Lunak Cokelat)</p>
                                <span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 96.8%</span>
                            </button>

                            <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="karat" type="button">
                                <div class="flex items-center justify-between w-full">
                                    <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Karat Daun</span>
                                    <span class="material-symbols-outlined text-[16px] text-secondary">grain</span>
                                </div>
                                <p class="text-[11px] text-on-surface-variant leading-tight">Puccinia sorghi (Pustul Kemerahan)</p>
                                <span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 97.2%</span>
                            </button>

                            <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="ulat" type="button">
                                <div class="flex items-center justify-between w-full">
                                    <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Ulat Grayak</span>
                                    <span class="material-symbols-outlined text-[16px] text-secondary">pest_control</span>
                                </div>
                                <p class="text-[11px] text-on-surface-variant leading-tight">FAW / Spodoptera (Daun Robek Bolong)</p>
                                <span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 99.1%</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-space-sm bg-surface-container rounded-xl flex items-start gap-space-sm text-xs text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px] text-secondary shrink-0 mt-0.5">lightbulb</span>
                        <p>
                            <strong>Tips Pengambilan Foto Terbaik:</strong> Arahkan kamera tegak lurus pada daun yang mengalami gejala dengan jarak 15–30 cm. Hindari pantulan bayangan tebal agar neural network mendeteksi tekstur pustul/klorosis secara presisi.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-6 bg-primary text-on-primary rounded-2xl p-space-lg md:p-space-xl flex flex-col justify-between shadow-xl min-h-[460px]">
                    <div class="space-y-space-md">
                        <div class="flex items-center justify-between pb-space-sm border-b border-on-primary/10">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-secondary-fixed animate-ping"></span>
                                <span class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed font-bold">Laporan Diagnosa AI</span>
                            </div>
                            <span class="px-space-sm py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold" id="result-status-badge">
                                Patogen Terdeteksi
                            </span>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <span class="text-xs text-primary-fixed uppercase tracking-wider">Hasil Identifikasi Utama:</span>
                            <h3 class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-on-primary" id="result-disease-name">
                                Penyakit Bulai Jagung
                            </h3>
                            <p class="text-sm font-serif italic text-secondary-fixed" id="result-pathogen-latin">
                                Peronosclerospora maydis
                            </p>
                        </div>

                        <div class="space-y-1 bg-primary-container/70 p-3 rounded-xl">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-primary-fixed">Tingkat Keyakinan AI (Confidence Score)</span>
                                <span class="text-secondary-fixed font-bold" id="result-confidence-text">98.4%</span>
                            </div>
                            <div class="w-full bg-primary h-2.5 rounded-full overflow-hidden">
                                <div class="bg-secondary-container h-full rounded-full transition-all duration-700" id="result-confidence-bar" style="width: 98.4%;"></div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">troubleshoot</span>
                                Gejala Khas Teridentifikasi:
                            </span>
                            <p class="text-xs md:text-sm text-on-primary-container leading-relaxed bg-primary-container/40 p-3 rounded-xl" id="result-symptoms">
                                Terdapat garis-garis klorotik kuning memanjang sejajar tulang daun. Daun mengalami kerdil, kaku, dan pada pagi hari terlihat serbuk spora putih menyerupai tepung di permukaan bawah daun.
                            </p>
                        </div>

                        <div class="space-y-1.5">
                            <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">medical_services</span>
                                SOP Tindakan Kuratif &amp; Rekomendasi Obat:
                            </span>
                            <div class="text-xs text-on-primary space-y-1.5 bg-primary-container/80 p-3 rounded-xl border border-primary-fixed/20" id="result-treatment">
                                <div class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
                                    <span><strong>Eradikasi Tanaman Terinfeksi:</strong> Cabut dan musnahkan tanaman bergejala sistemik parah agar spora tidak terbawa angin ke petak lain.</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
                                    <span><strong>Fungisida Sistemik:</strong> Aplikasikan fungisida berbahan aktif <em>Metalaksil (Dimetomorf)</em> dosis 2 g/liter air pada tanaman sekitar.</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
                                    <span><strong>Pencegahan Musim Depan:</strong> Gunakan benih bersertifikat tahan bulai seperti varietas VIL-Gold 01 dengan perlakuan benih (seed-treatment).</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-space-md pt-space-sm border-t border-on-primary/10 flex flex-wrap gap-space-sm">
                        <a class="flex-1 inline-flex items-center justify-center gap-1.5 px-space-md py-space-sm rounded-lg bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold hover:bg-secondary-fixed-dim transition-colors shadow" href="#kontak">
                            <span class="material-symbols-outlined text-[18px]">support_agent</span>
                            <span>Konsultasi Resep Agronomis Gratis</span>
                        </a>
                        <button class="inline-flex items-center justify-center gap-1 px-space-md py-space-sm rounded-lg bg-surface-container-lowest text-primary font-label-md text-label-md font-bold hover:bg-surface-container transition-colors" id="btn-save-report" type="button">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            <span>Unduh PDF</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>