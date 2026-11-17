@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

<section class="scroll-mt-20 bg-surface-container py-12 md:py-16" id="ai-scanner">
    <div class="mx-auto max-w-7xl px-margin-mobile md:px-margin lg:px-margin-desktop">
        <div class="rounded-3xl border border-surface-container-high bg-surface-container-lowest p-space-lg shadow-xl md:p-space-xl">
            <div class="mb-8 flex flex-col gap-space-md border-b border-surface-container-high pb-6 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="mb-2 inline-flex items-center gap-2 rounded-full bg-secondary-fixed px-3 py-1 text-sm font-bold text-on-secondary-fixed">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">document_scanner</span>
                        VILAGRO Agri-Vision
                    </span>
                    <h1 class="font-headline-lg text-3xl font-bold text-primary md:text-4xl">Scan Penyakit Tanaman Jagung</h1>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-on-surface-variant">
                        Foto akan dikirim ke layanan model YOLO untuk dianalisis. Jika model mendeteksi penyakit, laporan disimpan dan petani yang berlangganan dalam radius 5 km akan diberi peringatan.
                    </p>
                </div>
                <a class="inline-flex items-center gap-2 self-start rounded-lg border border-outline-variant px-4 py-2 text-sm font-semibold text-primary transition hover:bg-surface-container-low md:self-auto" href="{{ route('farm-map') }}">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">map</span>
                    Lihat peta kebun
                </a>
            </div>

            @if (session('scan_message'))
                <div class="mb-6 rounded-xl border border-primary-fixed bg-primary-fixed/40 px-4 py-3 text-sm text-primary" role="status">
                    {{ session('scan_message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-error/30 bg-error-container px-4 py-3 text-sm text-on-error-container" role="alert">
                    <p class="font-semibold">Scan belum dapat diproses:</p>
                    <ul class="mt-1 list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('scan_result'))
                @php($scanResult = session('scan_result'))
                <section class="mb-8 rounded-2xl bg-primary p-space-lg text-on-primary md:p-space-xl" aria-live="polite">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wide text-secondary-fixed">Hasil model AI</p>
                            <h2 class="mt-1 text-2xl font-bold">{{ $scanResult['disease_name'] }}</h2>
                            <p class="mt-1 text-sm italic text-secondary-fixed">{{ $scanResult['pathogen_latin'] }}</p>
                        </div>
                        <span @class([
                            'rounded-full px-3 py-1 text-xs font-bold',
                            'bg-error text-on-error' => $scanResult['status'] === 'infected',
                            'bg-secondary-fixed text-on-secondary-fixed' => $scanResult['status'] === 'uncertain',
                            'bg-primary-fixed text-primary' => in_array($scanResult['status'], ['healthy', 'no_detection'], true),
                        ])>
                            {{ match ($scanResult['status']) {
                                'infected' => 'Dugaan penyakit',
                                'uncertain' => 'Belum pasti',
                                'healthy' => 'Tidak terdeteksi gejala',
                                default => 'Tidak teridentifikasi',
                            } }}
                        </span>
                    </div>

                    @if ($scanResult['confidence'] !== null)
                        <p class="mt-3 text-sm">Skor model: <strong>{{ number_format($scanResult['confidence'], 1) }}%</strong></p>
                    @endif
                    <p class="mt-3 text-sm leading-6 text-on-primary-container">{{ $scanResult['symptoms'] }}</p>

                    <div class="mt-5">
                        <h3 class="font-semibold text-secondary-fixed">Langkah yang disarankan</h3>
                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-on-primary-container">
                            @foreach ($scanResult['treatments'] as $treatment)
                                <li>{{ $treatment }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="mt-4 border-t border-on-primary/20 pt-3 text-xs leading-5 text-on-primary-container">
                        Hasil AI adalah pemeriksaan awal, bukan diagnosis pasti. Konfirmasikan tindakan pengendalian dengan petugas pertanian dan selalu ikuti petunjuk label produk.
                    </p>
                </section>
            @endif

            @auth
                <form action="{{ route('corn.detect') }}" method="POST" enctype="multipart/form-data" id="corn-detection-form">
                    @csrf
                    <div class="grid gap-8 lg:grid-cols-2">
                        <div class="space-y-4">
                            <label for="corn-image-input" class="block text-sm font-bold text-primary">Foto tanaman</label>
                            <div class="relative">
                                <input
                                    accept="image/jpeg,image/png,image/webp"
                                    class="sr-only"
                                    id="corn-image-input"
                                    name="image"
                                    required
                                    type="file"
                                >
                                <label for="corn-image-input" class="flex min-h-64 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-2xl border-2 border-dashed border-outline-variant bg-surface-container-low p-6 text-center transition hover:border-primary">
                                    <div id="upload-prompt" class="flex flex-col items-center gap-2">
                                        <span class="material-symbols-outlined text-5xl text-primary" aria-hidden="true">add_a_photo</span>
                                        <span class="font-semibold text-primary">Pilih foto daun, batang, atau tongkol</span>
                                        <span class="text-sm text-on-surface-variant">JPG, PNG, atau WEBP, maksimal 10 MB</span>
                                    </div>
                                    <div id="image-preview-wrapper" class="hidden w-full">
                                        <img id="image-preview" src="" alt="Pratinjau foto tanaman" class="mx-auto max-h-64 rounded-xl object-contain">
                                        <p id="preview-filename" class="mt-2 text-sm font-medium text-primary"></p>
                                    </div>
                                </label>
                            </div>
                            <button id="btn-reupload" class="hidden text-sm font-semibold text-primary underline" type="button">Pilih foto lain</button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h2 class="text-sm font-bold text-primary">Lokasi tanaman yang discan</h2>
                                <p class="mt-1 text-sm text-on-surface-variant">Klik peta, isi koordinat, atau gunakan lokasi perangkat. Titik laporan akan ditampilkan di peta publik tanpa nama Anda dan dipakai untuk mengirim peringatan sekitar.</p>
                            </div>
                            <div
                                class="isolate z-0 h-64 overflow-hidden rounded-2xl border border-outline-variant bg-surface-container-low"
                                data-lat="{{ old('latitude', auth()->user()->farm_latitude) }}"
                                data-lng="{{ old('longitude', auth()->user()->farm_longitude) }}"
                                data-latitude-input="scan-latitude"
                                data-longitude-input="scan-longitude"
                                data-map-mode="picker"
                                id="scan-location-map"
                                role="application"
                                aria-label="Peta untuk memilih lokasi tanaman"
                            ></div>
                            <p id="scan-map-status" class="text-xs text-on-surface-variant" aria-live="polite">
                                Klik peta untuk memilih lokasi. Koordinat kebun tersimpan akan digunakan sebagai pilihan awal.
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="scan-latitude" class="mb-1 block text-xs font-semibold text-on-surface-variant">Latitude</label>
                                    <input id="scan-latitude" name="latitude" type="number" step="any" min="-90" max="90" value="{{ old('latitude', auth()->user()->farm_latitude) }}" required class="w-full rounded-lg border border-outline-variant bg-white px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                </div>
                                <div>
                                    <label for="scan-longitude" class="mb-1 block text-xs font-semibold text-on-surface-variant">Longitude</label>
                                    <input id="scan-longitude" name="longitude" type="number" step="any" min="-180" max="180" value="{{ old('longitude', auth()->user()->farm_longitude) }}" required class="w-full rounded-lg border border-outline-variant bg-white px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                                </div>
                            </div>
                            <button class="inline-flex items-center gap-2 rounded-lg border border-outline-variant px-3 py-2 text-sm font-semibold text-primary transition hover:bg-surface-container-low" data-location-map="scan-location-map" type="button">
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">my_location</span>
                                Gunakan lokasi perangkat
                            </button>
                        </div>
                    </div>

                    <div id="scanning-status" class="mt-6 hidden items-center gap-3 rounded-xl bg-primary-fixed px-4 py-3 text-sm font-semibold text-primary" role="status" aria-live="polite">
                        <span class="h-5 w-5 animate-spin rounded-full border-2 border-primary/30 border-t-primary" aria-hidden="true"></span>
                        <span id="scan-progress-text">Mengirim foto ke model AI...</span>
                    </div>

                    <label class="mt-5 flex max-w-3xl items-start gap-3 text-sm leading-5 text-on-surface-variant">
                        <input class="mt-1 accent-primary" type="checkbox" name="publish_location_consent" value="1" required>
                        <span>Saya memahami bahwa jika model mendeteksi penyakit, titik laporan akan tampil di peta publik tanpa nama atau identitas akun dan digunakan untuk mengirim peringatan kepada petani berlangganan di sekitar.</span>
                    </label>

                    <button id="scan-submit-button" class="mt-5 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 font-bold text-on-primary transition hover:bg-primary-container disabled:cursor-wait disabled:opacity-70 sm:w-auto" type="submit">
                        <span class="material-symbols-outlined" aria-hidden="true">search</span>
                        Analisis dan kirim peringatan
                    </button>
                </form>
            @else
                <div class="rounded-2xl bg-surface-container-low p-6 text-center">
                    <p class="font-semibold text-primary">Masuk untuk menyimpan hasil scan dan memberi peringatan kepada petani sekitar.</p>
                    <div class="mt-4 flex flex-wrap justify-center gap-3">
                        <a class="rounded-lg bg-primary px-5 py-2.5 font-semibold text-on-primary" href="{{ route('login') }}">Masuk</a>
                        <a class="rounded-lg border border-outline-variant px-5 py-2.5 font-semibold text-primary" href="{{ route('register') }}">Buat akun</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush
