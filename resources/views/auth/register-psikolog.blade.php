<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Sebagai Psikolog - RSUD Jombang</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body
  x-data="{
      page: 'home',
      darkMode: true,
      stickyMenu: false,
      navigationOpen: false,
      scrollTop: false,
      sidebarOpen: false
  }"
  x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
      $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
  "
  :class="{ 'b eh': darkMode === true }"
  x-cloak
>

    <x-layout.navbar />

    <main>
        <section class="i pg fh rm ki xn vq gj qp gr hj rp hr">
            <div class="animate_top bb af i va sg hh sm vk xm yi _n jp hi ao kp">
                <div class="rj">
                    <h2 class="ek ck kk wm xb">Daftar Psikolog</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Silakan lengkapi data profesi Anda</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="sb" method="POST" action="{{ route('psikolog.register.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        {{-- Name --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="name">Nama Lengkap & Gelar</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama Lengkap"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        {{-- NIK --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="NIK">NIK (KTP)</label>
                            <input id="NIK" type="number" name="NIK" value="{{ old('NIK') }}" required placeholder="16 digit NIK"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('NIK')" class="mt-2" />
                        </div>

                        {{-- NIP --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="NIP">NIP</label>
                            <input id="NIP" type="number" name="NIP" value="{{ old('NIP') }}" required placeholder="Nomor Induk Profesi"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('NIP')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        {{-- No Telepon --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="no_telp">No. WhatsApp</label>
                            <input id="no_telp" type="number" name="no_telp" value="{{ old('no_telp') }}" required placeholder="62812345678"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <p class="text-xs mt-1 text-gray-500">Gunakan format 628...</p>
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>

                        {{-- Spesialisasi --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="spesialisasi">Spesialisasi</label>
                            <input id="spesialisasi" type="text" name="spesialisasi" value="{{ old('spesialisasi') }}" required placeholder="Spesialisasi"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('spesialisasi')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="wb mb-4">
                        <label class="rc kk wm vb" for="alamat">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" required placeholder="Alamat domisili saat ini"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" rows="2">{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        {{-- Password --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="password">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Confirm Password --}}
                        <div class="wb">
                            <label class="rc kk wm vb" for="password_confirmation">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                                class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Terms (opsional) --}}
                    <div class="block mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="terms" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                Saya menyetujui <a href="{{ url('/terms') }}" class="mk">Syarat & Ketentuan</a>
                            </span>
                        </label>
                        <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="vd rj ek rc rg gh lk ml il _l gi hi w-full">
                            Daftar Sebagai Psikolog
                        </button>
                    </div>

                    <p class="sj hk xj rj ob mt-6">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="mk">Masuk</a>
                    </p>
                </form>
            </div>
        </section>
        </main>

    <x-layout.footer />
    <script src="{{ asset('bundle.js') }}"></script>
</body>
</html>