@extends('layouts.app')

@section('title', 'Peta Kebun & Penyakit - VILAGRO')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')
    <x-hero-banner
        eyebrow="Pantauan lapangan"
        title="Peta kebun & laporan penyakit"
        description="Pantau laporan penyakit dan kebun berbagi lokasi dalam satu peta interaktif."
    />

    <section class="bg-surface-container-low py-10 md:py-14">
        <div class="mx-auto grid max-w-7xl gap-6 px-margin-mobile md:px-margin lg:grid-cols-[minmax(0,1.5fr)_minmax(18rem,0.8fr)] lg:px-margin-desktop">
            <div class="rounded-3xl border border-surface-container-high bg-white p-4 shadow-sm md:p-6">
                <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wide text-secondary">Pantauan lapangan</p>
                        <h2 class="mt-1 text-xl font-bold text-primary md:text-2xl">Sebaran di sekitar Anda</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-on-surface-variant">
                            Peta menampilkan laporan penyakit 30 hari terakhir dan titik kebun yang pemiliknya setuju untuk berbagi.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3 text-xs font-medium text-on-surface-variant">
                        <span class="inline-flex items-center gap-1"><span class="h-3 w-3 rounded-full bg-error"></span>Laporan penyakit</span>
                        <span class="inline-flex items-center gap-1"><span class="h-3 w-3 rounded-full bg-primary"></span>Kebun berbagi lokasi</span>
                    </div>
                </div>

                <div
                    class="isolate z-0 h-[420px] overflow-hidden rounded-2xl border border-outline-variant bg-surface-container-low"
                    data-lat="{{ auth()->user()?->farm_latitude }}"
                    data-lng="{{ auth()->user()?->farm_longitude }}"
                    data-latitude-input="farm-latitude"
                    data-longitude-input="farm-longitude"
                    data-map-mode="farm"
                    id="farm-map"
                    role="application"
                    aria-label="Peta interaktif laporan penyakit dan kebun"
                ></div>
                <p id="farm-map-status" class="mt-3 text-xs text-on-surface-variant" aria-live="polite">
                    Klik peta untuk memilih atau memperbarui titik kebun Anda.
                </p>
            </div>

            <aside class="space-y-6">
                @auth
                    <form action="{{ route('farm-location.update') }}" method="POST" class="rounded-3xl border border-surface-container-high bg-white p-5 shadow-sm md:p-6">
                        @csrf
                        <h2 class="text-lg font-bold text-primary">Lokasi & pengaturan kebun</h2>
                        <p class="mt-1 text-sm leading-5 text-on-surface-variant">
                            Koordinat disimpan privat untuk pencocokan peringatan. Titik kebun baru ditampilkan jika Anda mengaktifkan pilihan berbagi.
                        </p>

                        @if (session('farm_location_saved'))
                            <p class="mt-4 rounded-lg bg-primary-fixed px-3 py-2 text-sm text-primary" role="status">{{ session('farm_location_saved') }}</p>
                        @endif
                        @if ($errors->any())
                            <div class="mt-4 rounded-lg bg-error-container px-3 py-2 text-sm text-on-error-container" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div>
                                <label for="farm-latitude" class="mb-1 block text-xs font-semibold text-on-surface-variant">Latitude</label>
                                <input id="farm-latitude" name="latitude" type="number" step="any" min="-90" max="90" value="{{ old('latitude', auth()->user()->farm_latitude) }}" required class="w-full rounded-lg border border-outline-variant px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                            </div>
                            <div>
                                <label for="farm-longitude" class="mb-1 block text-xs font-semibold text-on-surface-variant">Longitude</label>
                                <input id="farm-longitude" name="longitude" type="number" step="any" min="-180" max="180" value="{{ old('longitude', auth()->user()->farm_longitude) }}" required class="w-full rounded-lg border border-outline-variant px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                            </div>
                        </div>
                        <button class="mt-3 inline-flex items-center gap-2 rounded-lg border border-outline-variant px-3 py-2 text-sm font-semibold text-primary transition hover:bg-surface-container-low" data-location-map="farm-map" type="button">
                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">my_location</span>
                            Gunakan lokasi perangkat
                        </button>

                        <label class="mt-5 flex items-start gap-3 text-sm leading-5 text-on-surface-variant">
                            <input type="hidden" name="receive_disease_alerts" value="0">
                            <input class="mt-1 accent-primary" type="checkbox" name="receive_disease_alerts" value="1" @checked(old('receive_disease_alerts', auth()->user()->receive_disease_alerts))>
                            <span>Terima notifikasi laporan penyakit dalam radius 5 km dari kebun saya.</span>
                        </label>
                        <label class="mt-3 flex items-start gap-3 text-sm leading-5 text-on-surface-variant">
                            <input type="hidden" name="show_farm_on_map" value="0">
                            <input class="mt-1 accent-primary" type="checkbox" name="show_farm_on_map" value="1" @checked(old('show_farm_on_map', auth()->user()->show_farm_on_map))>
                            <span>Setujui agar titik kebun perkiraan saya tampil di peta publik tanpa nama atau identitas akun.</span>
                        </label>

                        <button class="mt-5 w-full rounded-xl bg-primary px-4 py-3 font-semibold text-on-primary transition hover:bg-primary-container" type="submit">
                            Simpan lokasi dan preferensi
                        </button>
                    </form>
                @else
                    <div class="rounded-3xl border border-surface-container-high bg-white p-5 shadow-sm md:p-6">
                        <h2 class="text-lg font-bold text-primary">Ikut menerima peringatan</h2>
                        <p class="mt-2 text-sm leading-6 text-on-surface-variant">Masuk untuk menyimpan lokasi kebun dan mengaktifkan notifikasi penyakit sekitar.</p>
                        <a class="mt-4 inline-flex rounded-lg bg-primary px-4 py-2.5 font-semibold text-on-primary" href="{{ route('login') }}">Masuk ke VILAGRO</a>
                    </div>
                @endauth

                <div class="rounded-3xl border border-surface-container-high bg-white p-5 shadow-sm md:p-6">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-lg font-bold text-primary">Laporan terdekat</h2>
                        <span class="rounded-full bg-surface-container-low px-2.5 py-1 text-xs font-semibold text-on-surface-variant">{{ $reports->count() }} laporan</span>
                    </div>
                    @forelse ($reports as $report)
                        <article class="border-b border-surface-container-high py-3 last:border-b-0">
                            <h3 class="font-semibold text-primary">{{ $report->disease_name }}</h3>
                            <p class="mt-1 text-xs text-on-surface-variant">
                                {{ $report->created_at->format('d M Y, H:i') }}
                                @if ($report->confidence !== null)
                                    · skor model {{ number_format((float) $report->confidence, 1) }}%
                                @endif
                            </p>
                        </article>
                    @empty
                        <p class="mt-3 text-sm text-on-surface-variant">Belum ada laporan penyakit dalam 30 hari terakhir.</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </section>

    <script>
        window.vilagroFarmMapData = @js($mapData);
    </script>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush
