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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    page: 'home',
    darkMode: true,
    stickyMenu: false,
    navigationOpen: false,
    scrollTop: false,
    sidebarOpen: false
    termsAccepted: false
}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
$watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))" 
:class="{ 'b eh': darkMode === true, 'dark': darkMode === true }" x-cloak>

    <x-layout.navbar />

    <main>
        <section class="i pg fh rm ki xn vq gj qp gr hj rp hr">
            <div class="animate_top bb af i va sg hh sm vk xm yi _n jp hi ao kp">
                <div class="rj">
                    <h2 class="ek ck kk wm xb">Buat Akun</h2>
                </div>

                <form class="sb" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="wb">
                        <label class="rc kk wm vb" for="name">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus autocomplete="name" placeholder="Nama sesuai KTP"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- username --}}
                    <div class="wb">
                        <label class="rc kk wm vb" for="name">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required
                            autofocus autocomplete="username" placeholder="Username"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="NIK">NIK (Nomor Induk Kependudukan)</label>
                        <input id="NIK" type="text" name="NIK" value="{{ old('NIK') }}" required
                            placeholder="16 Digit NIK" maxlength="16" unique
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('NIK')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No Telepon --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="no_telp">Nomor WhatsApp / Telepon</label>
                        <input id="no_telp" type="text" name="no_telp" value="{{ old('no_telp') }}" required maxlength="14"
                            placeholder="08xxxxxxxxxx"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('no_telp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="example@gmail.com"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="alamat">Alamat Lengkap</label>
                        <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" required
                            placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" maxlength="1000"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="password">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                            <button type="button" onclick="togglePassword('password', 'eyeIcon1')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="wb mt-4">
                        <label class="rc kk wm vb" for="password_confirmation">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="Ulangi password"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black dark:text-white dark:bg-gray-800 placeholder-gray-400 dark:placeholder-gray-500 pr-10" />
                            <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Script Toggle Password --}}
                    <script>
                        function togglePassword(inputId, iconId) {
                            const input = document.getElementById(inputId);
                            const icon = document.getElementById(iconId);
                            if (input.type === "password") {
                                input.type = "text";
                                icon.setAttribute("stroke", "#000");
                            } else {
                                input.type = "password";
                                icon.setAttribute("stroke", "currentColor");
                            }
                        }
                    </script>

                    <div class="block mt-4">
    <label for="terms" class="inline-flex items-center">
        <input 
            id="terms" 
            type="checkbox" 
            name="terms" 
            required 
            x-model="termsAccepted"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer">
        
        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
            Saya Setuju Dengan 
            <a href="https://docs.google.com/document/d/1CjKmiNU6W4fiE05SbA4RZ5QM1M4qSFdPaNaLqqpJ8c4/edit?tab=t.yknkzr1wkgig" 
               target="_blank" 
               rel="noopener noreferrer"
               class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline">
               Syarat dan Ketentuan
            </a>
        </span>
    </label>
    @error('terms')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between mt-6">
    <button 
        type="submit" 
        :disabled="!termsAccepted"
        :class="{ 'opacity-50 cursor-not-allowed': !termsAccepted }"
        class="vd rj ek rc rg gh lk ml il _l gi hi transition-opacity duration-300">
        Daftar Sekarang
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
    </main>

    <x-layout.footer />
    <script defer src="{{ asset('bundle.js') }}"></script>
</body>

</html>
