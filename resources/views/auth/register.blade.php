<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - VILAGRO</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-symbol.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo-symbol.png') }}" />
    @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#faf9f4]">
<div class="flex min-h-screen">
    <div class="flex w-full items-center justify-center px-6 py-10 md:w-[55%] md:px-12">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="mb-6 flex items-center gap-2">
                <img src="{{ asset('images/logo-symbol.png') }}" alt="VILAGRO" class="h-14 w-auto shrink-0">
                <span>
                    <span class="block text-3xl font-semibold leading-none text-black">VILAGRO</span>
                    <span class="mt-1 block text-base font-medium text-[#1f4d3a]">AGRI VISION AI</span>
                </span>
            </a>

            <h1 class="mb-2 text-left text-3xl font-bold">Buat Akun</h1>
            <p class="mb-8 text-sm text-gray-600">Daftar untuk mulai menggunakan VILAGRO AI.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-1.5 block text-sm text-gray-600">Nama lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus
                           class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm text-gray-600">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" autocomplete="email" required
                           class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm text-gray-600">Sandi</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" required
                           class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm text-gray-600">Ulangi sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required
                           class="w-full rounded-lg border border-gray-200 bg-[#f3f6fb] px-4 py-3 text-base shadow-sm focus:outline-none focus:ring-2 focus:ring-[#04342a]">
                </div>

                <button type="submit" class="w-full rounded-lg bg-[#04342a] py-3.5 text-base font-semibold text-white shadow transition hover:bg-[#06483a]">
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-[#04342a] hover:underline">Masuk</a>
            </p>
        </div>
    </div>

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
                Daftar untuk memeriksa kesehatan tanaman jagung dan mendapatkan panduan awal dari VILAGRO AI.
            </p>
        </div>
    </div>
</div>
</body>
</html>