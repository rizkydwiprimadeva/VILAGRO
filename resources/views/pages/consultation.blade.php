@extends('layouts.app')

@section('title', 'Konsultasi Agronomis - VILAGRO')

@section('content')
    <div class="flex flex-col w-full">
        <x-hero-banner
            eyebrow="Pendampingan petani"
            title="Konsultasikan kondisi tanaman"
            description="Temukan jawaban awal dan hubungi pendamping pertanian untuk langkah penanganan yang lebih tepat."
        />
        @include('sections.contact')
    </div>
@endsection
