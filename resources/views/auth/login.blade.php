<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang • Masuk</title>
    {{-- ... (HEAD SAMA SEPERTI SEBELUMNYA) ... --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    page: 'home',
    darkMode: true,
    stickyMenu: false,
    navigationOpen: false,
    scrollTop: false,
    sidebarOpen: false
}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
$watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))" :class="{ 'b eh': darkMode === true, 'dark': darkMode === true }" x-cloak>

    <x-layout.navbar />

    <main>
        <section class="i pg fh rm ki xn vq gj qp gr hj rp hr">
            <div class="animate_top bb af i va sg hh sm vk xm yi _n jp hi ao kp">
                <div class="rj">
                    <h2 class="ek ck kk wm xb">Masuk</h2>
                </div>

                <form class="sb" method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- ================= ALERT SUCCESS (HIJAU) ================= --}}
                    {{-- Menangani: Registrasi berhasil, Link reset password dikirim, Verifikasi email berhasil --}}
                    @if (session('status') || session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            class="mb-6 flex w-full border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-6">
                            <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#34D399]">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div class="w-full">
                                <h5 class="mb-1 text-lg font-semibold text-black dark:text-[#34D399]">
                                    Berhasil
                                </h5>
                                <p class="text-base leading-relaxed text-body">
                                    {{ session('status') ?? session('success') }}
                                </p>
                            </div>
                            <button @click="show = false" type="button" class="ml-auto text-body hover:text-black dark:text-white">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    {{-- ================= ALERT ERROR / WARNING (MERAH) ================= --}}
                    {{-- Menangani: Gagal Login, Akun Belum Approved, Email Belum Verified --}}
                    @if ($errors->any() || session('error'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            class="mb-6 flex w-full border-l-6 border-[#F87171] bg-[#F87171] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-6">
                            <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#F87171]">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                            <div class="w-full">
                                <h5 class="mb-1 text-lg font-semibold text-[#F87171]">
                                    Perhatian
                                </h5>
                                <p class="text-base leading-relaxed text-body text-red-600 dark:text-red-400">
                                    @if (session('error'))
                                        {{-- 1. Error dari session manual (misal middleware) --}}
                                        {{ session('error') }}
                                    @elseif ($errors->has('email'))
                                        {{-- 2. Error Spesifik dari Controller (Not Approved / Auth Failed) --}}
                                        {{ $errors->first('email') }}
                                    @else
                                        {{-- 3. Error Validasi Umum Lainnya --}}
                                        Terjadi kesalahan, silakan periksa input Anda.
                                    @endif
                                </p>
                            </div>
                            <button @click="show = false" type="button" class="ml-auto text-body hover:text-black dark:text-white">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                    {{-- ================= END ALERT ================= --}}

                    <div class="wb">
                        <label for="email" class="rc kk wm vb">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="example@gmail.com"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        {{-- Error kecil di bawah input dihapus agar tidak duplikat dengan Alert --}}
                    </div>

                    <div class="wb mt-4">
                        <label for="password" class="rc kk wm vb">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="**************"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />

                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <script>
                        function togglePassword() {
                            const input = document.getElementById("password");
                            const icon = document.getElementById("eyeIcon");
                            if (input.type === "password") {
                                input.type = "text"; icon.setAttribute("stroke", "#000");
                            } else {
                                input.type = "password"; icon.setAttribute("stroke", "currentColor");
                            }
                        }
                    </script>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="vd rj ek rc rg gh lk ml il _l gi hi">Masuk</button>
                    </div>

                    <p class="sj hk xj rj ob mt-6">
                        Belum punya akun?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="mk">Daftar</a>
                            <a href="{{ route('psikolog.register') }}" class="mk">Psikolog</a>
                        @else
                            <a href="{{ url('/') }}" class="mk">Kembali</a>
                        @endif
                    </p>
                </form>
            </div>
        </section>
    </main>

    <x-layout.footer />
    <script defer src="{{ asset('bundle.js') }}"></script>
</body>
</html>