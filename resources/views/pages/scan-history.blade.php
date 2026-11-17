@extends('layouts.app')

@section('title', 'Riwayat Scan - VILAGRO')

@section('content')
    <x-hero-banner
        eyebrow="Riwayat pemeriksaan"
        title="Riwayat scan tanaman"
        description="Lihat kembali hasil pemeriksaan tanaman yang tersimpan di akun Anda."
    />

    <section class="bg-surface-container-low py-10 md:py-14">
        <div class="mx-auto max-w-4xl px-margin-mobile md:px-margin lg:px-margin-desktop">
            <div class="rounded-3xl border border-surface-container-high bg-white p-5 shadow-sm md:p-8">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wide text-secondary">Pemeriksaan tersimpan</p>
                        <h2 class="mt-1 text-xl font-bold text-primary md:text-2xl">Riwayat scan Anda</h2>
                    </div>
                    <a class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-on-primary hover:bg-primary-container" href="{{ route('scanner') }}">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">document_scanner</span>
                        Buka scanner
                    </a>
                </div>

                <div class="mt-6 divide-y divide-surface-container-high">
                    @forelse ($reports as $report)
                        <article class="flex flex-wrap items-start justify-between gap-4 py-4">
                            <div class="min-w-0">
                                <h3 class="font-semibold text-primary">{{ $report->disease_name }}</h3>
                                <p class="mt-1 text-sm text-on-surface-variant">
                                    {{ $report->created_at->format('d M Y, H:i') }}
                                    @if ($report->confidence !== null)
                                        · Skor model {{ number_format((float) $report->confidence, 1) }}%
                                    @endif
                                </p>
                            </div>
                            <span @class([
                                'rounded-full px-3 py-1 text-xs font-semibold',
                                'bg-error-container text-on-error-container' => $report->status === 'infected',
                                'bg-primary-fixed text-primary' => $report->status === 'healthy',
                                'bg-secondary-fixed text-on-secondary-fixed' => $report->status === 'uncertain',
                                'bg-surface-container-low text-on-surface-variant' => $report->status === 'no_detection' || ! in_array($report->status, ['infected', 'healthy', 'uncertain'], true),
                            ])>
                                {{ match ($report->status) {
                                    'infected' => 'Dugaan penyakit',
                                    'healthy' => 'Tidak terdeteksi gejala',
                                    'uncertain' => 'Belum pasti',
                                    'no_detection' => 'Tidak teridentifikasi',
                                    default => 'Status tidak diketahui',
                                } }}
                            </span>
                        </article>
                    @empty
                        <div class="py-10 text-center">
                            <p class="font-semibold text-primary">Belum ada riwayat scan.</p>
                            <p class="mt-1 text-sm text-on-surface-variant">Hasil pemeriksaan yang tersimpan akan muncul di halaman ini.</p>
                        </div>
                    @endforelse
                </div>

                @if ($reports->hasPages())
                    <div class="mt-5">{{ $reports->links() }}</div>
                @endif
            </div>
        </div>
    </section>
@endsection
