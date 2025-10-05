{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang • Daftar</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body
    x-data="{ darkMode: true, scrollTop: false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
        $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
    "
    x-on:scroll.window="scrollTop = (window.pageYOffset > 300)"
    :class="{ 'b eh': darkMode }"
>
    <x-layout.navbar />

    <main>
        <!-- ===== SignUp Form Start ===== -->
        <section class="i pg fh rm ki xn vq gj qp gr hj rp hr">
            <div class="animate_top bb af i va sg hh sm vk xm yi _n jp hi ao kp">
                <div class="rj">
                    <h2 class="ek ck kk wm xb">Buat Akun</h2>
                </div>

                <form class="sb" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="wb">
                        <label class="rc kk wm vb" for="name">Nama Lengkap</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Nama lengkap"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="example@gmail.com"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs mt-2 dark:text-gray-400">
                            Gunakan kombinasi huruf besar, kecil, angka, dan simbol.
                        </p>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="password_confirmation">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Terms (opsional) --}}
                    <div class="block mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="terms"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                Saya menyetujui <a href="{{ url('/terms') }}" class="mk">Syarat & Ketentuan</a>
                            </span>
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="vd rj ek rc rg gh lk ml il _l gi hi">
                            Daftar
                        </button>
                    </div>

                    <p class="sj hk xj rj ob mt-6">
                        Sudah punya akun?
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="mk">Masuk</a>
                        @else
                            <a href="{{ url('/') }}" class="mk">Kembali</a>
                        @endif
                    </p>
                </form>
            </div>
        </section>
        <!-- ===== SignUp Form End ===== -->
    </main>

    <x-layout.footer />

    <script defer src="{{ asset('bundle.js') }}"></script>
</body>
</html>
