@extends('layouts.app')

@section('title', 'Panduan Petani - VILAGRO')

@section('content')
    <div class="flex flex-col w-full">
        <x-hero-banner
            eyebrow="Panduan lapangan"
            title="Langkah tepat merawat tanaman"
            description="Ikuti panduan praktis untuk memeriksa gejala, memahami hasil, dan menentukan tindak lanjut."
        />
        @include('sections.workflow')
    </div>
@endsection
