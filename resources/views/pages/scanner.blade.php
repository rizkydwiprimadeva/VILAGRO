@extends('layouts.app')

@section('title', 'AI Scanner Daun Jagung - VILAGRO')

@section('content')
    <div class="flex flex-col w-full">
        <x-hero-banner
            eyebrow="VILAGRO Vision AI"
            title="Kenali kondisi tanaman, mulai kirim foto."
            description="Gunakan pemindai AI VILAGRO untuk membantu mengenali gejala penyakit pada tanaman jagung."
        />

        @include('sections.scanner-feature')
    </div>
@endsection
