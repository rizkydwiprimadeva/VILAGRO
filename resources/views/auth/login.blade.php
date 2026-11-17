<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - VILAGRO</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-symbol.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-symbol.png') }}" />
    @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#faf9f4]">
<div class="flex min-h-screen">

    {{-- KIRI: form login --}}
    <div class="flex w-full items-center justify-center px-6 py-10 md:w-[55%] md:px-12">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="mb-6 flex items-center gap-2">
                <img src="{{ asset('images/logo-symbol.png') }}" alt="VILAGRO" class="h-14 w-auto shrink-0">
                <div>
                    <p class="text-3xl font-semibold text-black leading-none">VILAGRO</p>
                    <p class="mt-1 text-base font-medium text-[#1f4d3a]">AGRI VISION AI</p>
                </div>
            </div>

            <h1 class="mb-8 text-left text-3xl font-bold">Masuk Ke Akun Anda</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                          <label class="mb-1.5 block text-sm text-gray-600">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="example@gmail.com" required autofocus
                              class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                    @error('email')
                           <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="mb-1.5 block text-sm text-gray-600">Sandi</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                               placeholder="••••••••" required
                               class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 pr-12 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                        <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 px-4 text-gray-500 hover:text-gray-700"
                                aria-label="Tampilkan sandi">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Ingat saya & lupa sandi --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300"> Ingat Saya
                    </label>
                    <a href="#" class="font-semibold text-[#04342a] hover:underline">Lupa Sandi?</a>
                </div>

                {{-- Tombol masuk --}}
                <button type="submit"
                        class="w-full rounded-lg bg-[#04342a] py-3.5 text-base font-semibold text-white shadow hover:bg-[#06483a] transition">
                    Masuk
                </button>
            </form>

            {{-- Pembatas --}}
            <div class="my-6 flex items-center gap-3 text-xs text-gray-500">
                <span class="h-px flex-1 bg-gray-300"></span>
                Atau masuk dengan
                <span class="h-px flex-1 bg-gray-300"></span>
            </div>

            {{-- Login sosial (belum aktif) --}}
            <div class="grid grid-cols-2 gap-3">
                <button type="button" disabled
                        class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-[#f3f6fb] py-3 text-sm font-semibold shadow-sm cursor-not-allowed opacity-80">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="#1877f2"><path d="M24 12a12 12 0 1 0-13.9 11.9v-8.4H7.1V12h3V9.4c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 .9-2 1.9V12h3.4l-.5 3.5h-2.9v8.4A12 12 0 0 0 24 12z"/></svg>
                    Facebook
                </button>
                <button type="button" disabled
                        class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-[#f3f6fb] py-3 text-sm font-semibold shadow-sm cursor-not-allowed opacity-80">
                    <svg class="h-4 w-4" viewBox="0 0 24 24"><path fill="#4285f4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5a5.5 5.5 0 0 1-2.4 3.6v3h3.9c2.3-2.1 3.5-5.2 3.5-8.8z"/><path fill="#34a853" d="M12 24c3.2 0 6-1.1 8-2.9l-3.9-3c-1.1.7-2.5 1.2-4.1 1.2-3.1 0-5.8-2.1-6.7-5H1.3v3.1A12 12 0 0 0 12 24z"/><path fill="#fbbc05" d="M5.3 14.3a7.2 7.2 0 0 1 0-4.6V6.6H1.3a12 12 0 0 0 0 10.8l4-3.1z"/><path fill="#ea4335" d="M12 4.8c1.8 0 3.3.6 4.6 1.8l3.4-3.4A12 12 0 0 0 1.3 6.6l4 3.1c.9-2.8 3.6-4.9 6.7-4.9z"/></svg>
                    Google
                </button>
            </div>

            <p class="mt-6 text-center text-sm text-gray-600">
                Tidak punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-[#04342a] hover:underline">Daftar Disini</a>
            </p>
        </div>
    </div>

    {{-- KANAN: panel sambutan (disembunyikan di layar kecil) --}}
    <div class="relative hidden items-center overflow-hidden bg-[#f3f2ec] md:flex md:w-[45%]">
        <svg class="pointer-events-none absolute inset-0 h-full w-full" aria-hidden="true" preserveAspectRatio="none" viewBox="0 0 100 100" fill="none" stroke="#04342a" stroke-width="0.12">
            <line x1="6" y1="0" x2="11" y2="100"/>
            <line x1="6" y1="0" x2="100" y2="47"/>
            <line x1="100" y1="38" x2="11" y2="100"/>
        </svg>

        <div class="absolute -top-10 -right-10 h-32 w-52 rounded-full bg-[#04342a]"></div>
        <div class="absolute -bottom-16 -right-8 h-40 w-40 rounded-full bg-[#04342a]"></div>

        <div class="relative z-10 px-10 lg:px-20">
            <h2 class="text-3xl font-semibold leading-snug">Selamat Datang di<br>VILAGRO</h2>
            <p class="mt-2 max-w-xs text-lg leading-relaxed text-[#3d6b5a]">
                Platform AI patologi tanaman jagung terdepan. Deteksi cepat, panduan tepat, panen terlindungi.
            </p>
        </div>
    </div>
</div>

<script>
    const pwd = document.getElementById('password');
    document.getElementById('togglePassword').addEventListener('click', () => {
        pwd.type = pwd.type === 'password' ? 'text' : 'password';
    });
</script>
</body>
</html>