@extends('layouts.app')

@section('title', 'VILAGRO AI - Deteksi Cepat Penyakit & Hama Tanaman Jagung')

@section('content')
    <div class="flex flex-col w-full">
        <div class="relative w-full overflow-hidden">
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
            <div class="absolute top-96 -left-32 w-[500px] h-[500px] bg-primary-fixed/20 rounded-full blur-3xl pointer-events-none -z-10"></div>

            @include('sections.hero')
            @include('sections.corn-detection.scanner')
            @include('sections.encyclopedia')
            @include('sections.workflow')
            @include('sections.testimonials')
            @include('sections.clinic')
            @include('sections.contact')
        </div>
    </div>
@endsection