<!DOCTYPE html>

<html class="scroll-smooth" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="web_standard" name="shell-type"/>
<title>VILAGRO AI - Deteksi Cepat Penyakit &amp; Hama Tanaman Jagung Berbasis Computer Vision</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo-symbol.png') }}"/>
<link rel="apple-touch-icon" href="{{ asset('images/logo-symbol.png') }}"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- TAILWIND CSS VIA CDN WITH PLUGINS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- TAILWIND DESIGN SYSTEM THEME CONFIG -->
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "on-secondary": "#ffffff",
            "on-surface-variant": "#424843",
            "primary-fixed-dim": "#aeceb9",
            "primary": "#072417",
            "surface-tint": "#486554",
            "surface-dim": "#dbdad5",
            "inverse-primary": "#aeceb9",
            "on-tertiary-fixed-variant": "#234f34",
            "error-container": "#ffdad6",
            "outline-variant": "#c2c8c2",
            "on-primary-container": "#85a490",
            "tertiary": "#002511",
            "tertiary-container": "#0e3c23",
            "surface-variant": "#e4e2dd",
            "secondary-container": "#fea619",
            "surface": "#fbf9f4",
            "on-error-container": "#93000a",
            "on-tertiary": "#ffffff",
            "surface-container-high": "#eae8e3",
            "on-primary": "#ffffff",
            "on-tertiary-fixed": "#00210f",
            "on-secondary-container": "#684000",
            "surface-container-lowest": "#ffffff",
            "on-background": "#1b1c19",
            "secondary-fixed": "#ffddb8",
            "on-secondary-fixed-variant": "#653e00",
            "tertiary-fixed": "#bdeec9",
            "primary-fixed": "#caead4",
            "surface-container-low": "#f5f3ee",
            "tertiary-fixed-dim": "#a2d2ae",
            "outline": "#727973",
            "on-secondary-fixed": "#2a1700",
            "primary-container": "#1e3a2b",
            "surface-bright": "#fbf9f4",
            "error": "#ba1a1a",
            "inverse-on-surface": "#f2f1ec",
            "on-primary-fixed": "#042013",
            "secondary-fixed-dim": "#ffb95f",
            "background": "#fbf9f4",
            "surface-container": "#f0eee9",
            "surface-container-highest": "#e4e2dd",
            "inverse-surface": "#30312e",
            "on-error": "#ffffff",
            "on-surface": "#1b1c19",
            "on-primary-fixed-variant": "#304d3d",
            "secondary": "#855300",
            "on-tertiary-container": "#79a786"
          },
          borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          spacing: {
            "gutter-lg": "1.5rem",
            "space-xs": "0.25rem",
            "space-lg": "1.25rem",
            "margin-desktop": "1.5rem",
            "margin": "1.25rem",
            "gutter-sm": "0.75rem",
            "gutter": "1rem",
            "space-md": "0.75rem",
            "margin-mobile": "0.875rem",
            "space-xl": "1.5rem",
            "space-sm": "0.5rem"
          },
          fontFamily: {
            "headline-lg": ["Manrope"],
            "headline-lg-mobile": ["Manrope"],
            "body-lg": ["Plus Jakarta Sans"],
            "label-sm": ["Manrope"],
            "body-sm": ["Plus Jakarta Sans"],
            "headline-xl": ["Manrope"],
            "headline-sm": ["Manrope"],
            "body-md": ["Plus Jakarta Sans"],
            "headline-md": ["Manrope"],
            "label-lg": ["Manrope"],
            "label-md": ["Manrope"],
            "headline-xl-mobile": ["Manrope"]
          },
          fontSize: {
            "headline-lg": ["2.5rem", { lineHeight: "3rem", letterSpacing: "-0.02em", fontWeight: "700" }],
            "headline-lg-mobile": ["1.75rem", { lineHeight: "2.25rem", letterSpacing: "-0.015em", fontWeight: "700" }],
            "body-lg": ["1.125rem", { lineHeight: "1.75rem", fontWeight: "400" }],
            "label-sm": ["0.6875rem", { lineHeight: "0.875rem", letterSpacing: "0.06em", fontWeight: "600" }],
            "body-sm": ["0.875rem", { lineHeight: "1.375rem", fontWeight: "400" }],
            "headline-xl": ["3.5rem", { lineHeight: "4rem", letterSpacing: "-0.03em", fontWeight: "700" }],
            "headline-sm": ["1.25rem", { lineHeight: "1.75rem", letterSpacing: "-0.01em", fontWeight: "600" }],
            "body-md": ["1rem", { lineHeight: "1.5rem", fontWeight: "400" }],
            "headline-md": ["1.75rem", { lineHeight: "2.25rem", letterSpacing: "-0.015em", fontWeight: "600" }],
            "label-lg": ["0.875rem", { lineHeight: "1.25rem", letterSpacing: "0.02em", fontWeight: "600" }],
            "label-md": ["0.75rem", { lineHeight: "1rem", letterSpacing: "0.04em", fontWeight: "600" }],
            "headline-xl-mobile": ["2.25rem", { lineHeight: "2.75rem", letterSpacing: "-0.02em", fontWeight: "700" }]
          }
        }
      }
    };
  </script>
<!-- MODULAR STYLES: Easy to copy into resources/css/app.css -->
<style>
    @layer base {
      html, body {
        margin: 0;
        padding: 0;
      }
      body {
        overscroll-behavior: none;
      }
      main > :first-child {
        margin-top: 0 !important;
      }
      main > :last-child {
        margin-bottom: 0 !important;
      }
    }
    ::-webkit-scrollbar {
      display: none;
    }

    /* AI Scanning Line Animation Effect */
    @keyframes scanAnimation {
      0% { top: 0%; opacity: 0.85; }
      50% { top: 90%; opacity: 1; }
      100% { top: 0%; opacity: 0.85; }
    }
    .scanner-active-beam {
      position: absolute;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, transparent 0%, #fea619 30%, #caead4 50%, #fea619 70%, transparent 100%);
      box-shadow: 0 0 15px 3px rgba(254, 166, 25, 0.7), 0 0 30px rgba(72, 101, 84, 0.4);
      animation: scanAnimation 2.2s infinite ease-in-out;
      z-index: 25;
    }
    .scan-grid-overlay {
      background-size: 24px 24px;
      background-image: 
        linear-gradient(to right, rgba(7, 36, 23, 0.06) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(7, 36, 23, 0.06) 1px, transparent 1px);
    }
    .pulse-radar {
      animation: radarPing 2.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes radarPing {
      75%, 100% {
        transform: scale(1.6);
        opacity: 0;
      }
    }

    main section:not(#hero):not(#simple-benefits) {
      display: none !important;
    }

    body {
      background: #f7f5f1;
    }
  </style>
</head>
<body class="bg-[#f7f5f1] font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">
<!-- ========================================================================= -->
<!-- HEADER / NAVIGATION (Blade partial: resources/views/partials/header.blade.php) -->
<!-- ========================================================================= -->

<!-- ========================================================================= -->
<!-- MAIN CONTENT CONTAINER -->
<!-- ========================================================================= -->
<main class="w-full pt-14 bg-background min-h-screen">
<div class="flex flex-col w-full">
<!-- ======================================================================== -->
<!-- 1. HERO SECTION (Simplified for older farmer audience) -->
<!-- ======================================================================== -->
<section class="relative max-w-6xl mx-auto px-4 py-6 md:px-6 lg:px-8 md:py-10" id="hero">
<div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
<div class="flex flex-col">
<p class="text-xs font-bold uppercase tracking-[0.14em] text-secondary">AI untuk pertanian</p>

<h1 class="mt-3 max-w-xl text-4xl font-extrabold leading-[0.96] tracking-[-0.06em] text-primary md:text-6xl">
Deteksi penyakit jagung lebih cepat dan lebih mudah
</h1>

<p class="mt-5 max-w-lg text-base leading-relaxed text-on-surface-variant md:text-lg">
Cukup ambil foto daun, lalu lihat hasil diagnosa dan langkah penanganan yang jelas dalam hitungan detik.
</p>

<div class="mt-6 flex flex-wrap items-center gap-3">
<a class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-on-primary shadow-sm transition hover:bg-primary-container" href="#ai-scanner">
<span class="material-symbols-outlined text-[18px]">photo_camera</span>
<span>Scan tanaman</span>
</a>
</div>

<div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-on-surface-variant">
<div class="flex items-center gap-2 rounded-full bg-white px-3 py-2 shadow-sm ring-1 ring-surface-container-high">
<span class="material-symbols-outlined text-[18px] text-secondary" style="font-variation-settings: 'FILL' 1;">verified</span>
<span class="font-semibold text-on-surface">98.4% akurat</span>
</div>
<div class="flex items-center gap-2 rounded-full bg-white px-3 py-2 shadow-sm ring-1 ring-surface-container-high">
<span class="material-symbols-outlined text-[18px] text-secondary" style="font-variation-settings: 'FILL' 1;">flash_on</span>
<span class="font-semibold text-on-surface">Hasil cepat</span>
</div>
</div>
</div>

<div class="relative mt-2 lg:mt-0">
<div class="overflow-hidden rounded-[30px] border border-[#e7e1d7] bg-white shadow-[0_22px_40px_rgba(23,32,24,0.06)]">
<img class="h-[300px] w-full object-cover md:h-[390px]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoDrtX1133LbY1YD3ukd9U2GYlo_rcGoa-rBQp4Ty-QTzDLD5h_5nQnqCMM4rZI7q0hreyuUV-uXelZ0YchOh5Q3CVT776LG8qtIqkt9wPkjF9Xbh2IC1cydOlGnMn04cwRbWyLenAFCnjx8P5VntotuPK61Bl3UPgw7F0iDuCqLPYjQ1701J0DM3itBIBx5fykpJfqYtkEP3pJ-JuUL484ltmtEA_dkhMCwSYtUtVMH68rVKpHtia" alt="Penyakit jagung" />

<div class="bg-[#f1eee7] p-4">
<p class="text-sm text-on-surface-variant">Deteksi gejala tanaman</p>
<p class="mt-1 text-lg font-semibold text-primary">Bulai terdeteksi di area daun</p>
</div>
</div>
</div>
</div>
</section>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Kasus Terselesaikan</p>
<p class="font-headline-sm text-headline-sm font-bold text-primary">48.200+ Daun Jagung</p>
</div>
</div>
</div>
</div>
<!-- KEY AI BENCHMARK STATS ROW -->
<div class="mt-space-xl grid grid-cols-2 md:grid-cols-4 gap-gutter-sm bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm border border-surface-container-high">
<div class="flex flex-col space-y-1 p-space-sm">
<span class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-primary">98.4%</span>
<span class="font-label-md text-label-md text-on-surface-variant">Tingkat Presisi AI</span>
<span class="font-body-sm text-body-sm text-outline">Standar verifikasi patologis</span>
</div>
<div class="flex flex-col space-y-1 p-space-sm">
<span class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-secondary">&lt; 3 Detik</span>
<span class="font-label-md text-label-md text-on-surface-variant">Kecepatan Inferensi</span>
<span class="font-body-sm text-body-sm text-outline">Realtime via browser &amp; HP</span>
</div>
<div class="flex flex-col space-y-1 p-space-sm">
<span class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-primary">4 Utama</span>
<span class="font-label-md text-label-md text-on-surface-variant">Patogen Kritis Jagung</span>
<span class="font-body-sm text-body-sm text-outline">Bulai, Busuk, Karat, &amp; FAW</span>
</div>
<div class="flex flex-col space-y-1 p-space-sm">
<span class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-secondary">100% Gratis</span>
<span class="font-label-md text-label-md text-on-surface-variant">Untuk Petani Binaan</span>
<span class="font-body-sm text-body-sm text-outline">Didukung jaringan agronomis</span>
</div>
</div>
</section>

<section class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8 pb-10" id="simple-benefits">
  <div class="rounded-3xl border border-surface-container-high bg-surface-container-lowest p-6 md:p-8 shadow-sm">
    <div class="mb-6 text-center">
      <p class="text-sm font-bold uppercase tracking-[0.12em] text-secondary">Kenapa petani memilih VILAGRO</p>
      <h2 class="mt-2 text-2xl md:text-3xl font-extrabold text-primary">Mudah, cepat, dan jelas</h2>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <div class="rounded-2xl border border-[#e7e1d7] bg-[#faf7f2] p-5 shadow-sm">
        <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
          <span class="material-symbols-outlined text-[22px]">photo_camera</span>
        </div>
        <h3 class="text-lg font-bold text-primary">Foto saja</h3>
        <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Cukup ambil foto daun yang tampak tidak normal.</p>
      </div>

      <div class="rounded-2xl border border-[#e7e1d7] bg-[#faf7f2] p-5 shadow-sm">
        <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-[#f1e4bb] text-[#725100]">
          <span class="material-symbols-outlined text-[22px]">search</span>
        </div>
        <h3 class="text-lg font-bold text-primary">Hasil cepat</h3>
        <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">AI membantu mengenali gejala utama dengan cepat.</p>
      </div>

      <div class="rounded-2xl border border-[#e7e1d7] bg-[#faf7f2] p-5 shadow-sm">
        <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-[#dfeee5] text-primary">
          <span class="material-symbols-outlined text-[22px]">medication</span>
        </div>
        <h3 class="text-lg font-bold text-primary">Saran jelas</h3>
        <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Dapatkan langkah penanganan yang sederhana dan tepat.</p>
      </div>
    </div>
  </div>
</section>
<!-- ========================================================================= -->
<!-- 2. CORE FEATURE: INTERACTIVE AI PHOTO SCANNER & DIAGNOSTIC TOOL -->
<!-- (Section replaced with simplified overview to keep the landing uncluttered) -->
<!-- ========================================================================= -->
<section class="bg-surface-container py-10 scroll-mt-20" id="ai-scanner">
<div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
<div class="bg-surface-container-lowest rounded-3xl p-space-lg md:p-space-xl shadow-xl border border-surface-container-high">
<!-- Section Header -->
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
                    Unggah foto daun, batang, atau tongkol jagung yang bergejala sakit, atau klik salah satu sampel foto uji klinis di bawah untuk simulasi langsung.
                  </p>
</div>
<div class="flex items-center gap-2">
<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-fixed text-primary">
<span class="w-2 h-2 rounded-full bg-primary inline-block mr-1.5 animate-pulse"></span>
                    AI Cloud Model Siap Menganalisis
                  </span>
</div>
</div>
<!-- Main Diagnostic Grid (Interactive Scanner + AI Result Card) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
<!-- Left Column: Upload Box + Preset Samples -->
<div class="lg:col-span-6 flex flex-col space-y-space-md">
<!-- Interactive Drag & Drop Box -->
<div class="relative group">
<label class="relative flex flex-col items-center justify-center w-full min-h-[300px] p-6 border-2 border-dashed border-outline-variant hover:border-primary rounded-2xl bg-surface-container-low hover:bg-surface-container transition-all cursor-pointer overflow-hidden text-center" for="corn-image-input">
<!-- Hidden real file input -->
<input accept="image/*" class="hidden" id="corn-image-input" type="file"/>
<!-- Simulated Scan Overlay (Laser line when scanning) -->
<div class="scanner-active-beam hidden" id="scan-laser"></div>
<!-- Default Upload Prompt -->
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
<!-- Image Preview Container (Hidden initially) -->
<div class="hidden relative w-full h-[300px] flex items-center justify-center" id="image-preview-wrapper">
<img alt="Preview Daun Jagung" class="w-full h-full object-cover rounded-xl" id="image-preview" src=""/>
<div class="absolute inset-0 bg-black/20 rounded-xl"></div>
<div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-semibold text-primary flex items-center gap-1.5 shadow">
<span class="material-symbols-outlined text-[16px] text-secondary">image</span>
<span id="preview-filename">daun-jagung.jpg</span>
</div>
<button class="absolute top-3 right-3 bg-surface-container-lowest/90 hover:bg-white text-on-surface p-1.5 rounded-full shadow transition-all" id="btn-reupload" title="Ganti Gambar" type="button">
<span class="material-symbols-outlined text-[18px]">close</span>
</button>
</div>
<!-- Scanning Loader Overlay -->
<div class="hidden absolute inset-0 bg-primary/75 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-on-primary p-6 z-30" id="scanning-status">
<div class="relative w-14 h-14 mb-3">
<div class="w-14 h-14 rounded-full border-4 border-primary-fixed/30 border-t-secondary animate-spin"></div>
<span class="material-symbols-outlined absolute inset-0 flex items-center justify-center text-secondary text-[24px]">search</span>
</div>
<p class="font-headline-sm text-headline-sm font-bold" id="scan-progress-text">Memindai Morfologi Daun...</p>
<p class="text-xs text-primary-fixed mt-1">Mencocokkan dengan 120.000 citra patologi jagung</p>
</div>
</label>
</div>
<!-- 1-CLICK PRESET BUTTONS FOR IMMEDIATE DEMO -->
<div>
<div class="flex items-center justify-between mb-2">
<span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-secondary">Uji Coba Cepat (Pilih Sampel Preset):</span>
<span class="text-[11px] text-outline">Klik salah satu untuk diagnosa</span>
</div>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-space-xs">
<!-- Preset 1: Bulai -->
<button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="bulai" type="button">
<div class="flex items-center justify-between w-full">
<span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Penyakit Bulai</span>
<span class="material-symbols-outlined text-[16px] text-secondary">coronavirus</span>
</div>
<p class="text-[11px] text-on-surface-variant leading-tight">Peronosclerospora (Bercak Kuning Garis)</p>
<span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 98.4%</span>
</button>
<!-- Preset 2: Busuk Batang -->
<button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="busuk" type="button">
<div class="flex items-center justify-between w-full">
<span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Busuk Batang</span>
<span class="material-symbols-outlined text-[16px] text-secondary">broken_image</span>
</div>
<p class="text-[11px] text-on-surface-variant leading-tight">Fusarium / Pythium (Lunak Cokelat)</p>
<span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 96.8%</span>
</button>
<!-- Preset 3: Karat Daun -->
<button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="karat" type="button">
<div class="flex items-center justify-between w-full">
<span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Karat Daun</span>
<span class="material-symbols-outlined text-[16px] text-secondary">grain</span>
</div>
<p class="text-[11px] text-on-surface-variant leading-tight">Puccinia sorghi (Pustul Kemerahan)</p>
<span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 97.2%</span>
</button>
<!-- Preset 4: Ulat Grayak -->
<button class="preset-btn p-2 rounded-xl border border-surface-container-highest hover:border-secondary bg-surface-container-low hover:bg-surface-container text-left transition-all group flex flex-col justify-between h-24" data-preset="ulat" type="button">
<div class="flex items-center justify-between w-full">
<span class="font-label-sm text-label-sm font-bold text-primary group-hover:text-secondary truncate">Ulat Grayak</span>
<span class="material-symbols-outlined text-[16px] text-secondary">pest_control</span>
</div>
<p class="text-[11px] text-on-surface-variant leading-tight">FAW / Spodoptera (Daun Robek Bolong)</p>
<span class="text-[10px] font-semibold text-secondary-container bg-surface-container-highest px-1.5 py-0.5 rounded self-start">Akurasi 99.1%</span>
</button>
</div>
</div>
<!-- Tips Pengambilan Foto -->
<div class="p-space-sm bg-surface-container rounded-xl flex items-start gap-space-sm text-xs text-on-surface-variant">
<span class="material-symbols-outlined text-[20px] text-secondary shrink-0 mt-0.5">lightbulb</span>
<p>
<strong>Tips Pengambilan Foto Terbaik:</strong> Arahkan kamera tegak lurus pada daun yang mengalami gejala dengan jarak 15–30 cm. Hindari pantulan bayangan tebal agar neural network mendeteksi tekstur pustul/klorosis secara presisi.
                    </p>
</div>
</div>
<!-- Right Column: Interactive AI Diagnostic Result Card -->
<div class="lg:col-span-6 bg-primary text-on-primary rounded-2xl p-space-lg md:p-space-xl flex flex-col justify-between shadow-xl min-h-[460px]">
<!-- Card Header Status -->
<div class="space-y-space-md">
<div class="flex items-center justify-between pb-space-sm border-b border-on-primary/10">
<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-secondary-fixed animate-ping"></span>
<span class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed font-bold">Laporan Diagnosa AI</span>
</div>
<span class="px-space-sm py-0.5 rounded-full bg-error text-on-error font-label-sm text-label-sm font-bold" id="result-status-badge">
                        Patogen Terdeteksi
                      </span>
</div>
<!-- Disease Name & Confidence Score -->
<div class="flex flex-col space-y-1">
<span class="text-xs text-primary-fixed uppercase tracking-wider">Hasil Identifikasi Utama:</span>
<h3 class="font-headline-lg text-headline-md md:text-headline-lg font-extrabold text-on-primary" id="result-disease-name">
                        Penyakit Bulai Jagung
                      </h3>
<p class="text-sm font-serif italic text-secondary-fixed" id="result-pathogen-latin">
                        Peronosclerospora maydis
                      </p>
</div>
<!-- Confidence Progress Bar -->
<div class="space-y-1 bg-primary-container/70 p-3 rounded-xl">
<div class="flex justify-between text-xs font-semibold">
<span class="text-primary-fixed">Tingkat Keyakinan AI (Confidence Score)</span>
<span class="text-secondary-fixed font-bold" id="result-confidence-text">98.4%</span>
</div>
<div class="w-full bg-primary h-2.5 rounded-full overflow-hidden">
<div class="bg-secondary-container h-full rounded-full transition-all duration-700" id="result-confidence-bar" style="width: 98.4%;"></div>
</div>
</div>
<!-- Identified Symptoms -->
<div class="space-y-1">
<span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">troubleshoot</span>
                        Gejala Khas Teridentifikasi:
                      </span>
<p class="text-xs md:text-sm text-on-primary-container leading-relaxed bg-primary-container/40 p-3 rounded-xl" id="result-symptoms">
                        Terdapat garis-garis klorotik kuning memanjang sejajar tulang daun. Daun mengalami kerdil, kaku, dan pada pagi hari terlihat serbuk spora putih menyerupai tepung di permukaan bawah daun.
                      </p>
</div>
<!-- Recommended SOP & Treatment -->
<div class="space-y-1.5">
<span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">medical_services</span>
                        SOP Tindakan Kuratif &amp; Rekomendasi Obat:
                      </span>
<div class="text-xs text-on-primary space-y-1.5 bg-primary-container/80 p-3 rounded-xl border border-primary-fixed/20" id="result-treatment">
<div class="flex items-start gap-2">
<span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
<span><strong>Eradikasi Tanaman Terinfeksi:</strong> Cabut dan musnahkan tanaman bergejala sistemik parah agar spora tidak terbawa angin ke petak lain.</span>
</div>
<div class="flex items-start gap-2">
<span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
<span><strong>Fungisida Sistemik:</strong> Aplikasikan fungisida berbahan aktif <em>Metalaksil (Dimetomorf)</em> dosis 2 g/liter air pada tanaman sekitar.</span>
</div>
<div class="flex items-start gap-2">
<span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
<span><strong>Pencegahan Musim Depan:</strong> Gunakan benih bersertifikat tahan bulai seperti varietas VIL-Gold 01 dengan perlakuan benih (seed-treatment).</span>
</div>
</div>
</div>
</div>
<!-- CTAs inside diagnostic box -->
<div class="mt-space-md pt-space-sm border-t border-on-primary/10 flex flex-wrap gap-space-sm">
<a class="flex-1 inline-flex items-center justify-center gap-1.5 px-space-md py-space-sm rounded-lg bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-bold hover:bg-secondary-fixed-dim transition-colors shadow" href="#kontak">
<span class="material-symbols-outlined text-[18px]">support_agent</span>
<span>Konsultasi Resep Agronomis Gratis</span>
</a>
<button class="inline-flex items-center justify-center gap-1 px-space-md py-space-sm rounded-lg bg-surface-container-lowest text-primary font-label-md text-label-md font-bold hover:bg-surface-container transition-colors" id="btn-save-report" type="button">
<span class="material-symbols-outlined text-[18px]">download</span>
<span>Unduh PDF</span>
</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================================================= -->
<!-- 3. ENSIKLOPEDIA 4 ANCAMAN UTAMA JAGUNG (Visual Pathogen Encyclopedia) -->
<!-- ========================================================================= -->
<section class="scroll-mt-20 bg-surface-container-low py-16 md:py-20" id="ensiklopedia-penyakit">
<div class="mx-auto max-w-7xl px-margin-mobile md:px-margin lg:px-margin-desktop">
<div class="mb-9 flex flex-col gap-5 md:mb-12 md:flex-row md:items-end md:justify-between">
<div class="max-w-2xl">
<span class="inline-flex items-center gap-2 rounded-full bg-tertiary-fixed px-3 py-1.5 font-label-md text-label-md font-bold uppercase tracking-wider text-on-tertiary-fixed-variant">
<span class="h-2 w-2 rounded-full bg-secondary"></span>
Katalog Patologi Jagung Tropis
</span>
<h2 class="mt-4 font-headline-lg text-headline-md font-bold text-primary md:text-headline-lg">
                Ensiklopedia 4 Ancaman Utama Tanaman Jagung
              </h2>
</div>
<p class="max-w-lg font-body-md text-body-md text-on-surface-variant">
              Pahami karakteristik gejala visual, fase rentan tanaman, serta tingkat keparahan risiko gagal panen dari masing-masing patogen.
            </p>
</div>
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
<!-- Card 1: Penyakit Bulai -->
<div class="group flex h-full flex-col overflow-hidden rounded-3xl border border-surface-container-high bg-surface-container-lowest shadow-sm transition duration-300 hover:-translate-y-1 hover:border-primary/20 hover:shadow-xl">
<div class="relative h-52 w-full overflow-hidden bg-surface-container sm:h-56">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" data-alt="Close up corn leaf with downy mildew symptoms chlorotic yellow stripes" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyUzvEdLyELF2DFTr-kflCjKXxR9KIwCZLICS8itvZbW04jaJcJAYmqUtyQ1u3hcG49wypgAfpUhNWBOn2p__ih0f_Zc09ZoEj1X1ZhYwagGGLfWMx1d3-DkmbjHW-YxOAajI5PFZ0NWRokxZ7kjpcTxYdh-7Pgo6B87AiT0PkGTLuB0erlHlBLBhZHDKmIA2sTQA9Dq3mDz0a9-8dc2OyHhtnJUjyeBA8C4diwZzW05Y2De0jca9Z"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-transparent to-black/10"></div>
<span class="absolute right-3 top-3 rounded-full bg-error/95 px-3 py-1.5 text-[11px] font-bold text-on-error shadow-lg backdrop-blur">Risiko sangat tinggi</span>
<span class="absolute bottom-3 left-4 inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-primary/65 px-3 py-1.5 text-[11px] font-semibold text-white backdrop-blur"><span class="material-symbols-outlined text-sm" aria-hidden="true">coronavirus</span>Penyakit</span>
</div>
<div class="flex flex-1 flex-col justify-between p-5">
<div>
<span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Jamur Oomycota</span>
<h3 class="mt-1 font-headline-sm text-headline-sm font-bold text-primary">Penyakit Bulai</h3>
<p class="mb-3 mt-1 text-xs font-serif italic text-outline">Peronosclerospora maydis</p>
<p class="font-body-sm text-body-sm leading-6 text-on-surface-variant">
                    Menyerang fase vegetatif awal (HST 7–35). Daun menguning keputihan bergaris, tanaman mandul dan tidak mampu membentuk tongkol jagung.
                  </p>
</div>
<div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-surface-container-high pt-4">
<span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-xs font-semibold text-on-surface-variant"><span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>HST 10–30</span>
<button class="inline-flex items-center gap-1.5 rounded-full bg-primary px-3.5 py-2.5 text-xs font-bold text-white transition hover:bg-primary-container focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" onclick="triggerPresetDiagnosis('bulai')" type="button">
<span>Uji dengan AI</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span>
</button>
</div>
</div>
</div>
<!-- Card 2: Busuk Batang -->
<div class="group flex h-full flex-col overflow-hidden rounded-3xl border border-surface-container-high bg-surface-container-lowest shadow-sm transition duration-300 hover:-translate-y-1 hover:border-primary/20 hover:shadow-xl">
<div class="relative h-52 w-full overflow-hidden bg-surface-container sm:h-56">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" data-alt="Damaged lower corn stalk with brown softening fungal rot rot in wet soil field" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCn5iYt3n31xYN1Uv6V5V8nnDc348cIo3MLt68IgSt5Xz47CCUNhJNuGoOJbNuzpoJyxTOEeZnaLJ1nBG_ertsTtJwg6ns6jf829s6wbKWJL3uCMr9Rolu_ULWq4kxMxEguAp3iV3bzttL7ofcJTWZM7zES2kak-Gx6rZ7_tumywQ2w6Q_RhHXLR7c2OxK21gyHkQMYqWs1tbJ5IHDptVNkxKw1rfc7_WKYlYaifcpfwbA6OrY_MWOC"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-transparent to-black/10"></div>
<span class="absolute right-3 top-3 rounded-full bg-secondary-container/95 px-3 py-1.5 text-[11px] font-bold text-on-secondary-container shadow-lg backdrop-blur">Risiko tinggi</span>
<span class="absolute bottom-3 left-4 inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-primary/65 px-3 py-1.5 text-[11px] font-semibold text-white backdrop-blur"><span class="material-symbols-outlined text-sm" aria-hidden="true">coronavirus</span>Penyakit</span>
</div>
<div class="flex flex-1 flex-col justify-between p-5">
<div>
<span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Jamur Tular Tanah</span>
<h3 class="mt-1 font-headline-sm text-headline-sm font-bold text-primary">Busuk Batang</h3>
<p class="mb-3 mt-1 text-xs font-serif italic text-outline">Fusarium verticillioides / Pythium</p>
<p class="font-body-sm text-body-sm leading-6 text-on-surface-variant">
                    Ruas batang bagian bawah lunak, menghitam, berbau asam, dan tanaman mudah roboh diterpa angin saat masa pengisian biji.
                  </p>
</div>
<div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-surface-container-high pt-4">
<span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-xs font-semibold text-on-surface-variant"><span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>HST 55–80</span>
<button class="inline-flex items-center gap-1.5 rounded-full bg-primary px-3.5 py-2.5 text-xs font-bold text-white transition hover:bg-primary-container focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" onclick="triggerPresetDiagnosis('busuk')" type="button">
<span>Uji dengan AI</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span>
</button>
</div>
</div>
</div>
<!-- Card 3: Karat Daun -->
<div class="group flex h-full flex-col overflow-hidden rounded-3xl border border-surface-container-high bg-surface-container-lowest shadow-sm transition duration-300 hover:-translate-y-1 hover:border-primary/20 hover:shadow-xl">
<div class="relative h-52 w-full overflow-hidden bg-surface-container sm:h-56">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" data-alt="Corn plant leaf full of reddish brown pustules rust fungus in tropical farm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7SUaVO5DkzUlHSQUf5rFLOZ4q7cTVIdy7FGBiiOwd19l2EMJpVJPbfoCirz7murwLZC2Fz8NuVF0pF0Uf3lDrqmfS8H9bS5O1GbRNLocNsf4AuGD9F7pMg0dhwc2wqF5jxIiDmulHkVmeKrvN5nfNEJ9ucG4_KixlC0sKEstmbW5nWwYKIh17Q1icBjvj4qFXAb1h3864h5CslI7vHSzw0h5D1TpoX1SekKATTSKnUjHR-gRPbxhF"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-transparent to-black/10"></div>
<span class="absolute right-3 top-3 rounded-full bg-tertiary-fixed/95 px-3 py-1.5 text-[11px] font-bold text-on-tertiary-fixed-variant shadow-lg backdrop-blur">Risiko sedang</span>
<span class="absolute bottom-3 left-4 inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-primary/65 px-3 py-1.5 text-[11px] font-semibold text-white backdrop-blur"><span class="material-symbols-outlined text-sm" aria-hidden="true">coronavirus</span>Penyakit</span>
</div>
<div class="flex flex-1 flex-col justify-between p-5">
<div>
<span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Pucciniales</span>
<h3 class="mt-1 font-headline-sm text-headline-sm font-bold text-primary">Karat Daun Jagung</h3>
<p class="mb-3 mt-1 text-xs font-serif italic text-outline">Puccinia sorghi</p>
<p class="font-body-sm text-body-sm leading-6 text-on-surface-variant">
                    Muncul bintik pustul berwarna cokelat kemerahan di atas dan bawah permukaan daun yang menghambat fotosintesis secara signifikan.
                  </p>
</div>
<div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-surface-container-high pt-4">
<span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-xs font-semibold text-on-surface-variant"><span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>HST 40–75</span>
<button class="inline-flex items-center gap-1.5 rounded-full bg-primary px-3.5 py-2.5 text-xs font-bold text-white transition hover:bg-primary-container focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" onclick="triggerPresetDiagnosis('karat')" type="button">
<span>Uji dengan AI</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span>
</button>
</div>
</div>
</div>
<!-- Card 4: Ulat Grayak (FAW) -->
<div class="group flex h-full flex-col overflow-hidden rounded-3xl border border-surface-container-high bg-surface-container-lowest shadow-sm transition duration-300 hover:-translate-y-1 hover:border-primary/20 hover:shadow-xl">
<div class="relative h-52 w-full overflow-hidden bg-surface-container sm:h-56">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" data-alt="Fall armyworm caterpillar eating young corn whorl leaving ragged holes and frass" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoDrtX1133LbY1YD3ukd9U2GYlo_rcGoa-rBQp4Ty-QTzDLD5h_5nQnqCMM4rZI7q0hreyuUV-uXelZ0YchOh5Q3CVT776LG8qtIqkt9wPkjF9Xbh2IC1cydOlGnMn04cwRbWyLenAFCnjx8P5VntotuPK61Bl3UPgw7F0iDuCqLPYjQ1701J0DM3itBIBx5fykpJfqYtkEP3pJ-JuUL484ltmtEA_dkhMCwSYtUtVMH68rVKpHtia"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/55 via-transparent to-black/10"></div>
<span class="absolute right-3 top-3 rounded-full bg-error/95 px-3 py-1.5 text-[11px] font-bold text-on-error shadow-lg backdrop-blur">Menyebar cepat</span>
<span class="absolute bottom-3 left-4 inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-primary/65 px-3 py-1.5 text-[11px] font-semibold text-white backdrop-blur"><span class="material-symbols-outlined text-sm" aria-hidden="true">pest_control</span>Hama</span>
</div>
<div class="flex flex-1 flex-col justify-between p-5">
<div>
<span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Hama Invasif Lepidoptera</span>
<h3 class="mt-1 font-headline-sm text-headline-sm font-bold text-primary">Ulat Grayak (FAW)</h3>
<p class="mb-3 mt-1 text-xs font-serif italic text-outline">Spodoptera frugiperda</p>
<p class="font-body-sm text-body-sm leading-6 text-on-surface-variant">
                    Larva memakan pucuk daun muda dan titik tumbuh tanaman, meninggalkan serbuk gerek kasar mirip serbuk gergaji dan lubang koyak besar.
                  </p>
</div>
<div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-surface-container-high pt-4">
<span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container-low px-3 py-2 text-xs font-semibold text-on-surface-variant"><span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">schedule</span>HST 15–50</span>
<button class="inline-flex items-center gap-1.5 rounded-full bg-primary px-3.5 py-2.5 text-xs font-bold text-white transition hover:bg-primary-container focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" onclick="triggerPresetDiagnosis('ulat')" type="button">
<span>Uji dengan AI</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span>
</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================================================= -->
<!-- 4. WORKFLOW / PANDUAN PENGGUNAAN SCANNER PETANI -->
<!-- ========================================================================= -->
<section class="bg-surface-container-low py-16 scroll-mt-14" id="alur-kerja">
<div class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop">
<div class="text-center max-w-2xl mx-auto mb-16">
<span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-bold">Panduan Cepat Lapangan</span>
<h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary font-bold mt-1">
                4 Langkah Mudah Deteksi Penyakit di Lahan
              </h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-2">
                Hanya butuh ponsel berkamera, tanpa perlu instalasi aplikasi rumit.
              </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-gutter relative">
<!-- Step 1 -->
<div class="relative bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col border border-surface-container-high">
<div class="w-10 h-10 rounded-full bg-primary text-on-primary font-bold flex items-center justify-center mb-space-md text-label-lg">
                  01
                </div>
<span class="font-label-sm text-label-sm uppercase tracking-wide text-secondary font-bold">Ambil Foto Daun</span>
<h3 class="font-headline-sm text-headline-sm text-primary font-bold my-space-xs">Foto Gejala Lapangan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Dekatkan kamera smartphone ke bagian daun yang terdapat bercak kuning, spora putih, bintik karat, atau koyak hama.
                </p>
</div>
<!-- Step 2 -->
<div class="relative bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col border border-surface-container-high">
<div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container font-bold flex items-center justify-center mb-space-md text-label-lg">
                  02
                </div>
<span class="font-label-sm text-label-sm uppercase tracking-wide text-secondary font-bold">Inferensi AI Cepat</span>
<h3 class="font-headline-sm text-headline-sm text-primary font-bold my-space-xs">Analisis &lt; 3 Detik</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Sistem Computer Vision VILAGRO membedah pola klorosis, ukuran spora, dan tekstur daun secara instan melalui server cloud.
                </p>
</div>
<!-- Step 3 -->
<div class="relative bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col border border-surface-container-high">
<div class="w-10 h-10 rounded-full bg-primary-fixed text-on-primary-fixed font-bold flex items-center justify-center mb-space-md text-label-lg">
                  03
                </div>
<span class="font-label-sm text-label-sm uppercase tracking-wide text-secondary font-bold">Dapatkan Resep SOP</span>
<h3 class="font-headline-sm text-headline-sm text-primary font-bold my-space-xs">Rekomendasi Tindakan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Terima rincian nama bahan aktif fungisida/insektisida, takaran semprot per tangki 16L, dan petunjuk sanitasi lahan.
                </p>
</div>
<!-- Step 4 -->
<div class="relative bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col border border-surface-container-high">
<div class="w-10 h-10 rounded-full bg-primary text-on-primary font-bold flex items-center justify-center mb-space-md text-label-lg">
                  04
                </div>
<span class="font-label-sm text-label-sm uppercase tracking-wide text-secondary font-bold">Pendampingan PPL</span>
<h3 class="font-headline-sm text-headline-sm text-primary font-bold my-space-xs">Konsultasi Lanjutan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Jika tingkat serangan &gt; 25%, agronomis wilayah VILAGRO siap visit ke petak sawah untuk mitigasi hama terpadu.
                </p>
</div>
</div>
</div>
</section>
<!-- ========================================================================= -->
<!-- 5. TESTIMONI PETANI YANG TERTOLONG DARI SERANGAN HAMA & PENYAKIT -->
<!-- ========================================================================= -->
<section class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop py-20">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-space-md">
<div>
<span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-bold">Kisah Sukses Penyelamatan Panen</span>
<h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary font-bold">
                Bukti Nyata Efektivitas Deteksi Dini
              </h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md">
              Mencegah gagal panen massal berkat intervensi obat yang tepat sasaran di 48 jam pertama gejala muncul.
            </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Testimoni 1 -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col justify-between border border-surface-container-high">
<div class="space-y-space-md">
<div class="flex items-center gap-1 text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
                  "Minggu ke-3 tanam, daun jagung mulai bergaris putih. Saya foto pakai AI VILAGRO, langsung keluar peringatan Bulai dan anjuran semprot Metalaksil. 3 hektar lahan saya selamat dari puso!"
                </p>
</div>
<div class="flex items-center gap-space-md pt-space-lg">
<img class="w-12 h-12 rounded-full object-cover shrink-0" data-alt="Portrait of smiling Indonesian farmer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8sdYCY_Rt0Eo4tjHWXTcSkV_azQia5kBUOs2KR_jJNxgtcAXt81MevzW0sRyJV3gnXntAVx3nFoQVsSL_UWtn-Qgmh0FlaChe_N_-fzy61fi4AiXflz6CNPE747gM8FKJ08vkHEg6-9THJNL8svFV6ZyHSH029I_GiHew97wQa-xAlDu1NLVG1TPyiO4BQOroSxwJunG3XyFxkicE-GTNelMSe6C528RNvXAcEnulX_rYBZpgBKaY"/>
<div>
<p class="font-label-lg text-label-lg font-bold text-primary">Pak Subandi</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Petani Jagung Pipil, Tuban (Jatim)</p>
<span class="font-label-sm text-label-sm font-semibold text-secondary">Terselamatkan 18 Ton Panen</span>
</div>
</div>
</div>
<!-- Testimoni 2 -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col justify-between border border-surface-container-high">
<div class="space-y-space-md">
<div class="flex items-center gap-1 text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
                  "Biasanya kami salah tebak antara Karat Daun dan bercak biasa sehingga salah beli fungisida. Sekarang tinggal foto, AI langsung tahu bahan aktif yang cocok. Biaya semprot obat terpangkas hampir 40%."
                </p>
</div>
<div class="flex items-center gap-space-md pt-space-lg">
<img class="w-12 h-12 rounded-full object-cover shrink-0" data-alt="Portrait of Indonesian female farm manager" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgzQR63o0L2OFbgMgMteYecs4vlfDtpkhbRUVsfOHAZA2C7qwWlDxMCYX72Fov1xdQfvoqm9RgEPEVu9__3_AxxofpEelyF4mgGu4wxTWQbvMDZCsX6EskYfhwPlGDftZSU5yuydfYU1SHpuLKOJlpVqcB-Hqb4sWSOlIFYtyy00xZRSEkpln4OfRwyFvnksno9--xjU4qxyLuhER70Ql1l7oSs2xhrmrY3I7Q79WtQ9atWfqhf3jx"/>
<div>
<p class="font-label-lg text-label-lg font-bold text-primary">Ibu Ratna Dewi</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Manajer Kebun Jagung Manis, Lampung</p>
<span class="font-label-sm text-label-sm font-semibold text-secondary">Efisiensi Pestisida 40%</span>
</div>
</div>
</div>
<!-- Testimoni 3 -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-sm flex flex-col justify-between border border-surface-container-high">
<div class="space-y-space-md">
<div class="flex items-center gap-1 text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
                  "Ulat Grayak FAW serangannya sangat rakus di malam hari. Berkat fitur deteksi cepat ini, ulat teridentifikasi saat instar ke-2, langsung kita atasi dengan emamektin dan perangkap feromon. Hasil panen tetap maksimal."
                </p>
</div>
<div class="flex items-center gap-space-md pt-space-lg">
<img class="w-12 h-12 rounded-full object-cover shrink-0" data-alt="Portrait of Indonesian corn agribusiness coordinator" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYWAUSf3D6XqvAyYiHQrM7aEX8rLVCqIa0UCk5-WEuMtasbkLsp0wdNtuAWmE5j9UuZtFuaonitkbCwhg3YdWWUFAtXLFjtXcXfjShpbnrcKKaL-VCQwoEjTbBb9GeROflW3Vk-sUxdFXq2IE60I_1Kvs_TVz9xOCqqSdwIXR1ONvzI-1G6NgGxMKai_bl1WSFTS4z1o6fBgXJJ11QF5JCXQOZMRFw3ak0_2hvym3VPCN0ltJtNif_"/>
<div>
<p class="font-label-lg text-label-lg font-bold text-primary">Ismail Katili</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Ketua Koperasi Tani, Gorontalo</p>
<span class="font-label-sm text-label-sm font-semibold text-secondary">Keberhasilan Pengendalian 95%</span>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================================================= -->
<!-- 6. PROGRAM DUKUNGAN KLINIS AGRONOMIS & BANTUAN OBAT PETANI -->
<!-- ========================================================================= -->
<section class="bg-surface-container-low py-16">
<div class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop">
<div class="bg-primary text-on-primary rounded-3xl p-space-lg md:p-space-xl relative overflow-hidden">
<div class="relative z-10 max-w-3xl">
<span class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed font-bold">Layanan Proteksi Tanaman Holistik</span>
<h2 class="font-headline-lg text-headline-md md:text-headline-lg font-bold mt-1 text-on-primary">
                  Klinik Tanaman &amp; Bantuan Agronomis Lapangan VILAGRO
                </h2>
<p class="font-body-lg text-body-lg text-on-primary-container mt-3">
                  Setelah mendeteksi penyakit melalui AI, petani mitra mendapatkan akses langsung ke klinik tanaman kami: penyediaan benih toleran penyakit bergaransi, suplai fungisida orisinal, serta pendampingan PPL sampai masa pemulihan selesai.
                </p>
<!-- 4 Feature Badges -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md mt-space-lg">
<div class="flex items-start gap-space-sm bg-primary-container p-space-md rounded-xl">
<span class="material-symbols-outlined text-secondary-fixed text-[24px]">verified_user</span>
<div>
<h4 class="font-label-lg text-label-lg font-bold text-on-primary">Garansi Benih Tahan Bulai</h4>
<p class="font-body-sm text-body-sm text-on-primary-container">Varietas VIL-Gold 01 telah diberi perlakuan fungisida seed dressing.</p>
</div>
</div>
<div class="flex items-start gap-space-sm bg-primary-container p-space-md rounded-xl">
<span class="material-symbols-outlined text-secondary-fixed text-[24px]">support_agent</span>
<div>
<h4 class="font-label-lg text-label-lg font-bold text-on-primary">Konsultasi Resep 24 Jam</h4>
<p class="font-body-sm text-body-sm text-on-primary-container">Agronomis standby meresepkan dosis semprot via WhatsApp darurat.</p>
</div>
</div>
<div class="flex items-start gap-space-sm bg-primary-container p-space-md rounded-xl">
<span class="material-symbols-outlined text-secondary-fixed text-[24px]">local_shipping</span>
<div>
<h4 class="font-label-lg text-label-lg font-bold text-on-primary">Pengiriman Obat Cepat</h4>
<p class="font-body-sm text-body-sm text-on-primary-container">Distribusi fungisida &amp; feromon ke kios tani desa dalam 1x24 jam.</p>
</div>
</div>
<div class="flex items-start gap-space-sm bg-primary-container p-space-md rounded-xl">
<span class="material-symbols-outlined text-secondary-fixed text-[24px]">health_and_safety</span>
<div>
<h4 class="font-label-lg text-label-lg font-bold text-on-primary">Mitigasi Risiko Gagal Panen</h4>
<p class="font-body-sm text-body-sm text-on-primary-container">Protokol karantina petak lahan untuk cegah transmisi spora jamur.</p>
</div>
</div>
</div>
<div class="mt-space-xl flex flex-wrap gap-space-md">
<a class="inline-flex items-center gap-space-xs px-space-lg py-space-md rounded-lg bg-secondary-fixed text-on-secondary-fixed font-label-lg text-label-lg font-bold hover:bg-secondary-fixed-dim transition-colors" href="#kontak">
<span>Ajukan Konsultasi Lahan Sekarang</span>
<span class="material-symbols-outlined text-[18px]">chat</span>
</a>
<a class="inline-flex items-center gap-space-xs px-space-lg py-space-md rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary-container/80 transition-colors" href="#ai-scanner">
<span class="material-symbols-outlined text-[18px]">photo_camera</span>
<span>Kembali ke Alat Scanner</span>
</a>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================================================= -->
<!-- 7. FAQ & FORMULIR KONSULTASI AGRONOMIS -->
<!-- ========================================================================= -->
<section class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop py-20" id="kontak">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg">
<!-- Accordion FAQ Column -->
<div class="lg:col-span-6 flex flex-col justify-between" id="faq">
<div>
<span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-bold">Tanya Jawab Deteksi AI</span>
<h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary font-bold mb-space-md">
                  Pertanyaan Sering Diajukan Seputar Scanner AI
                </h2>
<div class="space-y-space-sm" id="faq-accordion">
<!-- FAQ 1 -->
<div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
<button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
<span>Apakah scanner AI ini membutuhkan koneksi internet berkecepatan tinggi?</span>
<span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
</button>
<div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                      Model AI kami dikompresi menggunakan teknologi <em>Edge Inference</em> ringan. Foto secara otomatis diperkecil sebelum dianalisis, sehingga dapat beroperasi mulus bahkan dengan sinyal seluler 3G di pelosok perkebunan.
                    </div>
</div>
<!-- FAQ 2 -->
<div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
<button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
<span>Bagaimana cara membedakan gejala Bulai dengan kekurangan unsur hara seng (Zn)?</span>
<span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
</button>
<div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                      Gejala Bulai memiliki batas klorotik yang sangat tegas sejajar tulang daun dan disertai lapisan jamur halus seperti tepung putih di bagian bawah daun pada pagi hari bersuhu lembab. Sedangkan klorosis defisiensi hara Zn umumnya menyebar simetris tanpa adanya miselium jamur. AI VILAGRO telah dilatih membedakan kedua pola mikroskopis ini.
                    </div>
</div>
<!-- FAQ 3 -->
<div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
<button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
<span>Apakah ada biaya untuk menggunakan platform diagnosa ini?</span>
<span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
</button>
<div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                      Layanan AI Scanner VILAGRO 100% GRATIS dan bebas kuota scan tanpa batas bagi seluruh petani jagung di Indonesia demi menjaga ketahanan pangan dan kestabilan pasokan panen nasional.
                    </div>
</div>
<!-- FAQ 4 -->
<div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
<button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
<span>Bagaimana jika hasil diagnosis menunjukkan persentase keyakinan rendah (&lt;70%)?</span>
<span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
</button>
<div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                      Bila foto buram atau gejala kurang khas, Anda dapat menekan tombol "Konsultasi Agronomis" untuk mengirimkan sampel foto langsung ke agronomis VILAGRO melalui WhatsApp. Kami akan memverifikasi secara manual dalam waktu kurang dari 2 jam kerja.
                    </div>
</div>
</div>
</div>
<!-- Quick Contact Help Box -->
<div class="mt-space-lg p-space-md bg-surface-container rounded-xl flex items-center gap-space-md border border-surface-container-high">
<span class="material-symbols-outlined text-secondary text-[32px]">support</span>
<div>
<p class="font-label-lg text-label-lg font-bold text-on-surface">Hotline Darurat Hama &amp; Penyakit</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Kirim foto gejala via WhatsApp Agronomis: <span class="font-semibold text-primary">+62 811-2345-6789</span></p>
</div>
</div>
</div>
<!-- Contact Form Column -->
<div class="lg:col-span-6 bg-surface-container-lowest p-space-lg md:p-space-xl rounded-3xl shadow-md border border-surface-container-high">
<div class="mb-space-md">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Layanan Agronomis Lapangan</span>
<h3 class="font-headline-sm text-headline-sm text-primary font-bold mt-1">
                  Ajukan Verifikasi Manual &amp; Resep Lapangan
                </h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                  Kirimkan detail lahan Anda jika mengalami indikasi wabah penyakit luas agar tim PPL VILAGRO menjadwalkan inspeksi langsung.
                </p>
</div>
<form class="space-y-space-md" id="contact-form" onsubmit="handleContactSubmit(event)">
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-name">Nama Petani / Ketua Kelompok *</label>
<input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-name" placeholder="Contoh: Pak Slamet" required="" type="text"/>
</div>
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-phone">Nomor WhatsApp Aktif *</label>
<input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-phone" placeholder="0812-xxxx-xxxx" required="" type="tel"/>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-location">Kabupaten &amp; Desa *</label>
<input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-location" placeholder="Contoh: Tuban, Jatim" required="" type="text"/>
</div>
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-variety">Varietas Jagung yang Ditanam</label>
<input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-variety" placeholder="Contoh: VIL-Gold / Hibrida lokal" type="text"/>
</div>
</div>
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-disease-type">Dugaan Penyakit / Hama</label>
<select class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-disease-type">
<option value="bulai">Penyakit Bulai (Daun Garis Kuning / Klorosis)</option>
<option value="busuk-batang">Busuk Batang / Busuk Tongkol</option>
<option value="karat-daun">Karat Daun (Bintik Pustul Cokelat)</option>
<option value="ulat-grayak">Ulat Grayak FAW (Daun Pucuk Bolong)</option>
<option value="belum-tahu">Belum Tahu / Butuh Bantuan Diagnosa AI</option>
</select>
</div>
<div>
<label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-notes">Keterangan Gejala &amp; Luas Petak Terdampak</label>
<textarea class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-notes" placeholder="Ceritakan umur tanaman (HST), luas area yang terserang, serta riwayat obat/fungisida yang sudah pernah disemprot..." rows="3"></textarea>
</div>
<button class="w-full py-space-md px-space-lg rounded-lg bg-primary text-on-primary font-label-lg text-label-lg font-bold shadow-md hover:bg-primary-container transition-all flex items-center justify-center gap-space-xs" id="contact-submit-btn" type="submit">
<span>Kirim Permohonan Resep &amp; Konsultasi</span>
<span class="material-symbols-outlined text-[18px]">send</span>
</button>
<!-- Feedback Message -->
<div class="hidden p-space-sm rounded-lg bg-primary-fixed text-on-primary-fixed font-label-md text-label-md text-center" id="contact-success-msg">
                  ✓ Permohonan terkirim! Tim Agronomis VILAGRO segera memverifikasi data dan menghubungi WhatsApp Anda.
                </div>
</form>
</div>
</div>
</section>
</div>
</div>
</main>
<!-- ========================================================================= -->
<!-- FOOTER (Blade partial: resources/views/partials/footer.blade.php) -->
<!-- ========================================================================= -->

<!-- ========================================================================= -->
<!-- MODULAR JAVASCRIPT: Easy to extract into resources/js/diagnosis.js        -->
<!-- Handles: AI Scanner Simulation, File Upload, Preset Toggles, and FAQ Accordion -->
<!-- ========================================================================= -->
<script>
    (function () {
      // 1. DATA MODEL FOR PRESET CORN DISEASES
      const DISEASE_DATABASE = {
        bulai: {
          name: "Penyakit Bulai Jagung",
          pathogen: "Peronosclerospora maydis / P. philippinensis",
          confidence: "98.4%",
          confidenceVal: 98.4,
          status: "Patogen Terdeteksi",
          statusColor: "bg-error text-on-error",
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDyUzvEdLyELF2DFTr-kflCjKXxR9KIwCZLICS8itvZbW04jaJcJAYmqUtyQ1u3hcG49wypgAfpUhNWBOn2p__ih0f_Zc09ZoEj1X1ZhYwagGGLfWMx1d3-DkmbjHW-YxOAajI5PFZ0NWRokxZ7kjpcTxYdh-7Pgo6B87AiT0PkGTLuB0erlHlBLBhZHDKmIA2sTQA9Dq3mDz0a9-8dc2OyHhtnJUjyeBA8C4diwZzW05Y2De0jca9Z",
          symptoms: "Terdapat garis-garis klorotik kuning memanjang sejajar tulang daun. Daun mengalami kerdil, kaku, dan pada pagi hari bersuhu lembab tampak lapisan spora putih menyerupai tepung pada permukaan bawah daun.",
          treatments: [
            "<strong>Eradikasi Tanaman Terinfeksi:</strong> Cabut dan bakar tanaman bergejala sistemik parah agar konidia jamur tidak terbawa angin ke tanaman lain.",
            "<strong>Aplikasi Fungisida Sistemik:</strong> Semprot tanaman sekeliling menggunakan fungisida berbahan aktif <em>Metalaksil</em> atau <em>Dimetomorf</em> dosis 2-2.5 g/liter air.",
            "<strong>Pencegahan Musim Depan:</strong> Wajib gunakan benih bersertifikat tahan bulai seperti VIL-Gold 01 yang diberi perlakuan benih (seed-treatment)."
          ]
        },
        busuk: {
          name: "Penyakit Busuk Batang & Ruas",
          pathogen: "Fusarium verticillioides / Pythium aphanidermatum",
          confidence: "96.8%",
          confidenceVal: 96.8,
          status: "Patogen Terdeteksi",
          statusColor: "bg-error text-on-error",
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCn5iYt3n31xYN1Uv6V5V8nnDc348cIo3MLt68IgSt5Xz47CCUNhJNuGoOJbNuzpoJyxTOEeZnaLJ1nBG_ertsTtJwg6ns6jf829s6wbKWJL3uCMr9Rolu_ULWq4kxMxEguAp3iV3bzttL7ofcJTWZM7zES2kak-Gx6rZ7_tumywQ2w6Q_RhHXLR7c2OxK21gyHkQMYqWs1tbJ5IHDptVNkxKw1rfc7_WKYlYaifcpfwbA6OrY_MWOC",
          symptoms: "Ruas batang 1–3 di atas permukaan tanah melunak, berubah warna kecokelatan kehitaman, empulur batang membusuk berongga, dan bau asam tercium saat batang dibelah.",
          treatments: [
            "<strong>Perbaikan Sanitasi & Drainase:</strong> Buat parit buangan air agar tanah tidak tergenang anaerob saat intensitas hujan tinggi.",
            "<strong>Aplikasi Agens Hayati:</strong> Kocor pangkal batang dengan suspensi jamur antagonis <em>Trichoderma harzianum</em> dosis 100 gram/tangki.",
            "<strong>Kurangi Nitrogen Berlebih:</strong> Seimbangkan pupuk N dengan unsur Kalium (KCl) untuk memperkuat dinding sel selulosa batang."
          ]
        },
        karat: {
          name: "Penyakit Karat Daun Jagung",
          pathogen: "Puccinia sorghi Schwein",
          confidence: "97.2%",
          confidenceVal: 97.2,
          status: "Patogen Terdeteksi",
          statusColor: "bg-secondary text-on-secondary",
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuA7SUaVO5DkzUlHSQUf5rFLOZ4q7cTVIdy7FGBiiOwd19l2EMJpVJPbfoCirz7murwLZC2Fz8NuVF0pF0Uf3lDrqmfS8H9bS5O1GbRNLocNsf4AuGD9F7pMg0dhwc2wqF5jxIiDmulHkVmeKrvN5nfNEJ9ucG4_KixlC0sKEstmbW5nWwYKIh17Q1icBjvj4qFXAb1h3864h5CslI7vHSzw0h5D1TpoX1SekKATTSKnUjHR-gRPbxhF",
          symptoms: "Muncul bercak-bercak lepuh (pustul) kecil berbentuk bulat lonjong berwarna cokelat kemerahan atau cokelat tua di permukaan atas dan bawah helaian daun.",
          treatments: [
            "<strong>Semprot Fungisida Protektif-Kuratif:</strong> Semprotkan bahan aktif <em>Azoksistrobin</em> + <em>Difenokonazol</em> dosis 1.5 ml/liter air secara merata.",
            "<strong>Waktu Penyemprotan:</strong> Semprot pada pagi hari pukul 06.30–09.00 saat stomata terbuka dan angin tenang.",
            "<strong>Sanitasi Gulma:</strong> Bersihkan gulma rerumputan di sekitar pematang yang menjadi inang perantara urediospora."
          ]
        },
        ulat: {
          name: "Serangan Ulat Grayak Jagung (FAW)",
          pathogen: "Spodoptera frugiperda (Lepidoptera: Noctuidae)",
          confidence: "99.1%",
          confidenceVal: 99.1,
          status: "Hama Kritis Aktif",
          statusColor: "bg-error text-on-error",
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDoDrtX1133LbY1YD3ukd9U2GYlo_rcGoa-rBQp4Ty-QTzDLD5h_5nQnqCMM4rZI7q0hreyuUV-uXelZ0YchOh5Q3CVT776LG8qtIqkt9wPkjF9Xbh2IC1cydOlGnMn04cwRbWyLenAFCnjx8P5VntotuPK61Bl3UPgw7F0iDuCqLPYjQ1701J0DM3itBIBx5fykpJfqYtkEP3pJ-JuUL484ltmtEA_dkhMCwSYtUtVMH68rVKpHtia",
          symptoms: "Daun muda di pucuk tanaman robek bergerigi dan tampak transparan seperti jendela. Terdapat tumpukan serbuk kotoran menyerupai serbuk gergaji di dalam corong daun tempat ulat bersembunyi.",
          treatments: [
            "<strong>Aplikasi Insektisida Spesifik:</strong> Semprotkan insektisida berbahan aktif <em>Emamektin Benzoat</em> atau <em>Klorantraniliprol</em> tepat mengarah ke dalam titik tumbuh pucuk.",
            "<strong>Pemasangan Perangkap Feromon:</strong> Pasang 8-10 unit perangkap feromon seksual per hektar untuk menangkap ngengat jantan dewasa.",
            "<strong>Waktu Tindakan:</strong> Lakukan penyemprotan sore hari menjelang magrib saat larva mulai keluar dari celah corong daun untuk makan."
          ]
        }
      };

      // 2. DOM REFERENCES
      const fileInput = document.getElementById('corn-image-input');
      const uploadPrompt = document.getElementById('upload-prompt');
      const previewWrapper = document.getElementById('image-preview-wrapper');
      const previewImg = document.getElementById('image-preview');
      const previewFilename = document.getElementById('preview-filename');
      const btnReupload = document.getElementById('btn-reupload');
      const laserBeam = document.getElementById('scan-laser');
      const scanStatus = document.getElementById('scanning-status');
      const scanProgressText = document.getElementById('scan-progress-text');

      const diseaseNameEl = document.getElementById('result-disease-name');
      const pathogenLatinEl = document.getElementById('result-pathogen-latin');
      const statusBadgeEl = document.getElementById('result-status-badge');
      const confidenceTextEl = document.getElementById('result-confidence-text');
      const confidenceBarEl = document.getElementById('result-confidence-bar');
      const symptomsEl = document.getElementById('result-symptoms');
      const treatmentEl = document.getElementById('result-treatment');

      // 3. SCAN ANIMATION & RENDER PIPELINE
      function runDiagnosticScan(diseaseData, customImageSrc = null, customFileName = null) {
        // Show Image Preview
        uploadPrompt.classList.add('hidden');
        previewWrapper.classList.remove('hidden');
        previewImg.src = customImageSrc || diseaseData.image;
        previewFilename.textContent = customFileName || (diseaseData.name.replace(/\s+/g, '-').toLowerCase() + ".jpg");

        // Activate Laser & Loading Screen
        laserBeam.classList.remove('hidden');
        scanStatus.classList.remove('hidden');
        scanProgressText.textContent = "Memindai Morfologi Daun...";

        const steps = [
          "Mendeteksi pola klorosis daun...",
          "Mengisolasi kontur tekstur bercak...",
          "Memverifikasi neural network patogen...",
          "Menyusun SOP resep penanganan..."
        ];

        let stepIndex = 0;
        const interval = setInterval(function () {
          if (stepIndex < steps.length) {
            scanProgressText.textContent = steps[stepIndex];
            stepIndex++;
          }
        }, 350);

        // Finish Scanning after 1.5 seconds
        setTimeout(function () {
          clearInterval(interval);
          laserBeam.classList.add('hidden');
          scanStatus.classList.add('hidden');

          // Render AI Results into Right Panel
          diseaseNameEl.textContent = diseaseData.name;
          pathogenLatinEl.textContent = diseaseData.pathogen;
          statusBadgeEl.textContent = diseaseData.status;
          statusBadgeEl.className = "px-space-sm py-0.5 rounded-full font-label-sm text-label-sm font-bold " + diseaseData.statusColor;
          confidenceTextEl.textContent = diseaseData.confidence;
          confidenceBarEl.style.width = diseaseData.confidenceVal + "%";
          symptomsEl.innerHTML = diseaseData.symptoms;

          // Render treatments list
          let treatmentHtml = "";
          diseaseData.treatments.forEach(function (t) {
            treatmentHtml += `
              <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
                <span>${t}</span>
              </div>
            `;
          });
          treatmentEl.innerHTML = treatmentHtml;
        }, 1500);
      }

      // 4. PRESET BUTTON CLICK HANDLERS
      const presetBtns = document.querySelectorAll('.preset-btn');
      presetBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          const presetKey = btn.getAttribute('data-preset');
          const data = DISEASE_DATABASE[presetKey];
          if (data) {
            // Scroll smoothly into scanner view if needed
            const scannerSec = document.getElementById('ai-scanner');
            if (scannerSec && window.innerWidth < 768) {
              scannerSec.scrollIntoView({ behavior: 'smooth' });
            }
            runDiagnosticScan(data);
          }
        });
      });

      // Global window function for cards in Section 3
      window.triggerPresetDiagnosis = function (key) {
        const data = DISEASE_DATABASE[key];
        const scannerSec = document.getElementById('ai-scanner');
        if (scannerSec) {
          scannerSec.scrollIntoView({ behavior: 'smooth' });
        }
        if (data) {
          setTimeout(function () {
            runDiagnosticScan(data);
          }, 300);
        }
      };

      // 5. FILE UPLOAD HANDLER
      if (fileInput) {
        fileInput.addEventListener('change', function (e) {
          const file = e.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
              // Simulated AI inference based on random pick of realistic corn issues
              const keys = ['bulai', 'busuk', 'karat', 'ulat'];
              const randomKey = keys[Math.floor(Math.random() * keys.length)];
              const detectedData = Object.assign({}, DISEASE_DATABASE[randomKey]);

              runDiagnosticScan(detectedData, event.target.result, file.name);
            };
            reader.readAsDataURL(file);
          }
        });
      }

      // Re-upload button
      if (btnReupload) {
        btnReupload.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          fileInput.value = '';
          previewWrapper.classList.add('hidden');
          uploadPrompt.classList.remove('hidden');
        });
      }

      // 6. PDF DOWNLOAD SIMULATION
      const saveReportBtn = document.getElementById('btn-save-report');
      if (saveReportBtn) {
        saveReportBtn.addEventListener('click', function () {
          alert('Laporan diagnosa AI (' + diseaseNameEl.textContent + ') berhasil dibuat! Mencetak lembar rekomendasi penyemprotan...');
        });
      }

      // 7. ACCORDION FAQ LOGIC
      const faqItems = document.querySelectorAll('.faq-item');
      faqItems.forEach(function (item) {
        const toggle = item.querySelector('.faq-toggle');
        const content = item.querySelector('.faq-content');
        const icon = item.querySelector('.faq-icon');

        toggle.addEventListener('click', function () {
          const isHidden = content.classList.contains('hidden');
          faqItems.forEach(function (other) {
            other.querySelector('.faq-content').classList.add('hidden');
            other.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
          });

          if (isHidden) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
          }
        });
      });

      // 8. CONTACT FORM SUBMISSION HANDLER
      window.handleContactSubmit = function (event) {
        event.preventDefault();
        const name = document.getElementById('contact-name').value.trim();
        const phone = document.getElementById('contact-phone').value.trim();
        const location = document.getElementById('contact-location').value.trim();
        const submitBtn = document.getElementById('contact-submit-btn');
        const msgBox = document.getElementById('contact-success-msg');

        if (!name || !phone || !location) {
          alert('Mohon lengkapi data Nama, Nomor WhatsApp, dan Lokasi Kebun Anda.');
          return;
        }

        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-70');
        submitBtn.innerHTML = '<span>Mengirimkan Data Lapangan...</span>';

        setTimeout(function () {
          submitBtn.classList.add('hidden');
          msgBox.classList.remove('hidden');
        }, 600);
      };

    })();
  </script>
</body></html>