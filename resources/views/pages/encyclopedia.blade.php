@extends('layouts.app')

@section('title', 'Katalog Penyakit & Hama Jagung - VILAGRO')

@section('content')
    <div class="flex w-full flex-col">
        <x-hero-banner
            eyebrow="Pusat pengetahuan"
            title="Kenali penyakit dan hama jagung"
            description="Lihat gambar gejala, pelajari tingkat risiko, dan temukan langkah awal untuk melindungi tanaman."
        />
        @include('sections.encyclopedia-cards')
    </div>
@endsection
