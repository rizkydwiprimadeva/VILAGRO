@extends('layouts.app')

@section('title', 'Notifikasi Petani - VILAGRO')

@section('content')
    <x-hero-banner
        eyebrow="Peringatan lapangan"
        title="Informasi untuk kebun Anda"
        description="Lihat pembaruan penyakit tanaman yang dilaporkan petani di sekitar lokasi kebun."
    />

    <section class="bg-surface-container-low py-10 md:py-14">
        <div class="mx-auto max-w-4xl px-margin-mobile md:px-margin lg:px-margin-desktop">
            <div class="rounded-3xl border border-surface-container-high bg-white p-5 shadow-sm md:p-8">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wide text-secondary">Peringatan lapangan</p>
                        <h2 class="mt-1 text-xl font-bold text-primary md:text-2xl">Notifikasi terbaru</h2>
                    </div>
                    <a class="inline-flex items-center gap-2 rounded-lg border border-outline-variant px-3 py-2 text-sm font-semibold text-primary hover:bg-surface-container-low" href="{{ route('farm-map') }}">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">map</span>
                        Buka peta
                    </a>
                </div>

                <div class="mt-6 divide-y divide-surface-container-high">
                    @forelse ($notifications as $notification)
                        <article class="flex flex-wrap items-start justify-between gap-4 py-4">
                            <div class="flex min-w-0 gap-3">
                                <span class="material-symbols-outlined mt-0.5 text-secondary" aria-hidden="true">warning</span>
                                <div>
                                    <h2 class="font-semibold text-primary">{{ $notification->data['disease_name'] ?? 'Peringatan penyakit tanaman' }}</h2>
                                    <p class="mt-1 text-sm text-on-surface-variant">{{ $notification->data['message'] ?? 'Ada laporan penyakit tanaman di sekitar kebun Anda.' }}</p>
                                    <p class="mt-1 text-xs text-outline">{{ $notification->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @if ($notification->read_at === null)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button class="rounded-lg border border-outline-variant px-3 py-2 text-xs font-semibold text-primary hover:bg-surface-container-low" type="submit">Tandai dibaca</button>
                                </form>
                            @else
                                <span class="rounded-full bg-primary-fixed px-3 py-1 text-xs font-semibold text-primary">Sudah dibaca</span>
                            @endif
                        </article>
                    @empty
                        <p class="py-8 text-center text-sm text-on-surface-variant">Belum ada notifikasi. Atur titik kebun dan preferensi peringatan pada peta kebun.</p>
                    @endforelse
                </div>

                <div class="mt-5">{{ $notifications->links() }}</div>
            </div>
        </div>
    </section>
@endsection
