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
                        Model lokal mengenali busuk batang, hawar daun, dan bulai. Hasil tanpa deteksi tidak berarti tanaman sehat.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-fixed text-primary" id="ai-status-badge">
                        <span class="w-2 h-2 rounded-full bg-primary inline-block mr-1.5 animate-pulse"></span>
                        Model Lokal Siap Menganalisis
                    </span>
                </div>
            </div>

            {{-- FORM WRAPPER --}}
            <form action="{{ route('corn.detect') }}" method="POST" enctype="multipart/form-data" id="corn-detection-form">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">

                    <div class="lg:col-span-6 flex flex-col space-y-space-md">
                        <div class="relative group">
                            <label class="relative flex flex-col items-center justify-center w-full min-h-[300px] p-6 border-2 border-dashed border-outline-variant hover:border-primary rounded-2xl bg-surface-container-low hover:bg-surface-container transition-all cursor-pointer overflow-hidden text-center" for="corn-image-input">
                                <input accept="image/*" class="hidden" id="corn-image-input" name="image" type="file" required />

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
                                    <p class="text-xs text-primary-fixed mt-1">Mencocokkan dengan citra patologi jagung</p>
                                </div>
                            </label>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-secondary">Sampel Uji yang Tersedia:</span>
                                <span class="text-[11px] text-outline">Hasil tetap ditentukan model</span>
                            </div>
                            <div class="grid grid-cols-2 gap-space-xs">
                                <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-class="rotten_stalk" type="button">
                                    <div class="flex items-center justify-between w-full">
                                        <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Busuk Batang</span>
                                        <span class="material-symbols-outlined text-[16px] text-secondary">broken_image</span>
                                    </div>
                                    <p class="text-[11px] text-on-surface-variant leading-tight">Sampel penyakit busuk batang</p>
                                </button>

                                <button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-class="blight" type="button">
                                    <div class="flex items-center justify-between w-full">
                                        <span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Hawar Daun</span>
                                        <span class="material-symbols-outlined text-[16px] text-secondary">grain</span>
                                    </div>
                                    <p class="text-[11px] text-on-surface-variant leading-tight">Sampel penyakit hawar daun</p>
                                </button>
                            </div>
                        </div>

                        <div class="p-space-sm bg-surface-container rounded-xl flex items-start gap-space-sm text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px] text-secondary shrink-0 mt-0.5">lightbulb</span>
                            <p>
                                <strong>Tips Pengambilan Foto Terbaik:</strong> Arahkan kamera tegak lurus pada daun yang mengalami gejala dengan jarak 15–30 cm. Hindari pantulan bayangan tebal agar neural network mendeteksi tekstur pustul/klorosis secara presisi.
                            </p>
                        </div>

                        {{-- Tombol submit utama (muncul saat gambar siap) --}}
                        <button type="submit" id="btn-analyze" 
                                class="hidden w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-primary text-on-primary font-bold text-lg shadow-lg hover:shadow-xl transition-all">
                            <span class="material-symbols-outlined">psychology</span>
                            <span>Analisis Sekarang dengan AI</span>
                        </button>
                    </div>

                    <div class="lg:col-span-6 bg-primary text-on-primary rounded-2xl p-space-lg md:p-space-xl flex flex-col justify-between shadow-xl min-h-[460px]">
                        <div class="space-y-space-md">
                            <div class="flex items-center justify-between pb-space-sm border-b border-on-primary/10">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-secondary-fixed animate-ping"></span>
                                    <span class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed font-bold">Laporan Diagnosa AI</span>
                                </div>
                                <span class="px-space-sm py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold" id="result-status-badge">
                                    Menunggu Input
                                </span>
                            </div>

                            <div class="hidden" id="result-image-wrapper">
                                <img alt="Visualisasi deteksi pada gambar yang diunggah" class="w-full max-h-56 object-contain rounded-xl bg-primary-container/70" id="result-detection-image" src="" />
                            </div>

                            <div class="flex flex-col space-y-1">
                                <span class="text-xs text-primary-fixed uppercase tracking-wider">Hasil Identifikasi Utama:</span>
                                <h3 class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-on-primary" id="result-disease-name">
                                    Belum Ada Analisis
                                </h3>
                                <p class="text-sm font-serif italic text-secondary-fixed" id="result-pathogen-latin">
                                    —
                                </p>
                            </div>

                            <div class="space-y-1 bg-primary-container/70 p-3 rounded-xl">
                                <div class="flex justify-between text-xs font-semibold">
                                    <span class="text-primary-fixed">Skor Deteksi YOLO</span>
                                    <span class="text-secondary-fixed font-bold" id="result-confidence-text">—</span>
                                </div>
                                <div class="w-full bg-primary h-2.5 rounded-full overflow-hidden">
                                    <div class="bg-secondary-container h-full rounded-full transition-all duration-700" id="result-confidence-bar" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">troubleshoot</span>
                                    Gejala Khas Teridentifikasi:
                                </span>
                                <p class="text-xs md:text-sm text-on-primary-container leading-relaxed bg-primary-container/40 p-3 rounded-xl" id="result-symptoms">
                                    Silakan unggah gambar terlebih dahulu untuk melihat hasil analisis AI.
                                </p>
                            </div>

                            <div class="space-y-1.5">
                                <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">medical_services</span>
                                    <span id="result-treatment-title">SOP Tindakan Kuratif &amp; Rekomendasi Obat:</span>
                                </span>
                                <div class="text-xs text-on-primary space-y-1.5 bg-primary-container/80 p-3 rounded-xl border border-primary-fixed/20" id="result-treatment">
                                    <p class="text-on-primary-container italic">Rekomendasi akan muncul setelah analisis.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-space-md pt-space-sm border-t border-on-primary/10 flex flex-wrap gap-space-sm">
                            <a class="flex-1 inline-flex items-center justify-center gap-1.5 px-space-md py-space-sm rounded-lg bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold hover:bg-secondary-fixed-dim transition-colors shadow" href="#kontak">
                                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                                <span>Konsultasi Resep Agronomis Gratis</span>
                            </a>
                            <button class="inline-flex items-center justify-center gap-1 px-space-md py-space-sm rounded-lg bg-surface-container-lowest text-primary font-label-md text-label-md font-bold hover:bg-surface-container transition-colors" id="btn-save-report" type="button" disabled>
                                <span class="material-symbols-outlined text-[18px]">download</span>
                                <span>Unduh PDF</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput        = document.getElementById('corn-image-input');
    const uploadPrompt     = document.getElementById('upload-prompt');
    const previewWrapper   = document.getElementById('image-preview-wrapper');
    const previewImg       = document.getElementById('image-preview');
    const previewFilename  = document.getElementById('preview-filename');
    const btnReupload      = document.getElementById('btn-reupload');
    const btnAnalyze       = document.getElementById('btn-analyze');
    const scanningStatus   = document.getElementById('scanning-status');
    const scanLaser        = document.getElementById('scan-laser');
    const scanProgressText = document.getElementById('scan-progress-text');
    const form             = document.getElementById('corn-detection-form');

    // === Preview gambar setelah dipilih ===
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 10 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 10MB');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (ev) {
            previewImg.src = ev.target.result;
            previewFilename.textContent = file.name;
            uploadPrompt.classList.add('hidden');
            previewWrapper.classList.remove('hidden');
            previewWrapper.classList.add('flex');
            btnAnalyze.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    // === Tombol ganti gambar ===
    btnReupload.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        fileInput.value = '';
        previewImg.src = '';
        uploadPrompt.classList.remove('hidden');
        previewWrapper.classList.add('hidden');
        previewWrapper.classList.remove('flex');
        btnAnalyze.classList.add('hidden');
        resetResultPanel();
    });

    // === Tombol preset (pakai gambar dari public/samples/) ===
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', async function () {
            const className = this.dataset.class;
            const sampleUrl = `/samples/${className}.jpg`;

            try {
                // Ambil file sample via fetch → convert ke File object
                const res = await fetch(sampleUrl);
                if (!res.ok) {
                    alert(`Sample gambar "${className}" belum tersedia di public/samples/`);
                    return;
                }
                const blob = await res.blob();
                const file = new File([blob], `${className}.jpg`, { type: 'image/jpeg' });

                // Set ke input file
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;

                // Trigger preview
                fileInput.dispatchEvent(new Event('change', { bubbles: true }));
            } catch (err) {
                console.error(err);
                alert('Gagal memuat sample. Pastikan folder public/samples/ sudah diisi.');
            }
        });
    });

    // === Submit form → tampilkan animasi scanning ===
    form.addEventListener('submit', function (e) {
        if (!fileInput.files.length) {
            e.preventDefault();
            alert('Silakan pilih gambar terlebih dahulu');
            return;
        }

        // Tampilkan overlay scanning
        scanningStatus.classList.remove('hidden');
        scanLaser.classList.remove('hidden');

        const steps = [
            'Memindai Morfologi Daun...',
            'Mengekstraksi Fitur Warna & Tekstur...',
            'Menjalankan Neural Network YOLOv8...',
            'Mengklasifikasi Patogen...',
            'Menyusun Laporan Diagnosa...'
        ];
        let i = 0;
        setInterval(() => {
            i = (i + 1) % steps.length;
            scanProgressText.textContent = steps[i];
        }, 1200);
    });

    // === Reset panel hasil ===
    function resetResultPanel() {
        document.getElementById('result-disease-name').textContent = 'Belum Ada Analisis';
        document.getElementById('result-pathogen-latin').textContent = '—';
        document.getElementById('result-confidence-text').textContent = '—';
        document.getElementById('result-confidence-bar').style.width = '0%';
        document.getElementById('result-symptoms').textContent = 'Silakan unggah gambar terlebih dahulu untuk melihat hasil analisis AI.';
        document.getElementById('result-treatment').innerHTML = '<p class="text-on-primary-container italic">Rekomendasi akan muncul setelah analisis.</p>';
        document.getElementById('result-image-wrapper').classList.add('hidden');
        document.getElementById('result-detection-image').src = '';
        document.getElementById('result-status-badge').textContent = 'Menunggu Input';
        document.getElementById('result-status-badge').className = 'px-space-sm py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold';
        document.getElementById('btn-save-report').disabled = true;
    }

    // === Auto-scroll ke hasil jika ada session result ===
    @if(session('result'))
        window.location.hash = '#ai-scanner';
    @endif
});
</script>
@endpush

@if(session('result') || isset($result))
    @php $r = $result ?? session('result'); @endphp
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const data = @json($r);
        if (!data || !data.enriched) return;

        const e = data.enriched;
        const d = e.disease;
        const resultImageWrapper = document.getElementById('result-image-wrapper');
        const resultImage = document.getElementById('result-detection-image');
        if (typeof data.image_result === 'string' && data.image_result.startsWith('/results/')) {
            resultImage.src = data.image_result;
            resultImageWrapper.classList.remove('hidden');
        }

        // Update badge status
        const badge = document.getElementById('result-status-badge');
        if (e.status === 'infected') {
            badge.textContent = 'Kandidat Penyakit Terdeteksi';
            badge.className = 'px-space-sm py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold';
        } else if (e.status === 'uncertain') {
            badge.textContent = 'Perlu Foto Ulang';
            badge.className = 'px-space-sm py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-bold';
        } else {
            badge.textContent = 'Belum Teridentifikasi';
            badge.className = 'px-space-sm py-0.5 rounded-full bg-surface-container-lowest text-primary font-label-sm text-label-sm font-bold';
        }

        // Update nama penyakit
        document.getElementById('result-disease-name').textContent = d?.indonesian_name || '—';
        document.getElementById('result-pathogen-latin').textContent = d?.pathogen_latin || '—';

        // Update confidence
        const confidence = e.confidence === null ? null : Number(e.confidence);
        const confidenceText = document.getElementById('result-confidence-text');
        const confidenceBar = document.getElementById('result-confidence-bar');
        confidenceText.textContent = Number.isFinite(confidence) ? `${confidence.toFixed(1)}%` : '—';
        confidenceBar.style.width = Number.isFinite(confidence) ? `${Math.max(0, Math.min(100, confidence))}%` : '0%';

        // Update gejala
        document.getElementById('result-symptoms').textContent = d?.symptoms || '—';

        // Update treatment
        const t = document.getElementById('result-treatment');
        document.getElementById('result-treatment-title').textContent = e.status === 'infected'
            ? 'SOP Tindakan Kuratif & Rekomendasi Obat:'
            : 'Langkah Berikutnya:';
        t.innerHTML = '';
        (d?.treatments || []).forEach(item => {
            const row = document.createElement('div');
            row.className = 'flex items-start gap-2';
            const icon = document.createElement('span');
            icon.className = 'material-symbols-outlined text-[16px] text-secondary-fixed shrink-0';
            icon.textContent = 'check_circle';
            const text = document.createElement('span');
            text.textContent = item;
            row.append(icon, text);
            t.appendChild(row);
        });

        // Aktifkan tombol PDF
        document.getElementById('btn-save-report').disabled = false;

        // Auto-scroll ke panel hasil
        document.getElementById('ai-scanner')?.scrollIntoView({ behavior: 'smooth' });
    });
    </script>
@endif