<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang • Verifikasi Email</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    page: 'verify-email',
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
                    <h2 class="ek ck kk wm xb">Verifikasi Email</h2>
                </div>

                <div class="sb">
                    <div class="mb-6 text-base leading-relaxed text-body dark:text-gray-400">
                        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang baru.') }}
                    </div>

                    {{-- ================= ALERT SUCCESS (HIJAU) ================= --}}
                    {{-- Muncul jika link verifikasi baru saja dikirim --}}
                    @if (session('status') == 'verification-link-sent')
                        <div x-data="{ show: true }" x-show="show" x-transition
                            class="mb-6 flex w-full border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-6">
                            <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#34D399]">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div class="w-full">
                                <h5 class="mb-1 text-lg font-semibold text-black dark:text-[#34D399]">
                                    Email Terkirim
                                </h5>
                                <p class="text-base leading-relaxed text-body">
                                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                                </p>
                            </div>
                            <button @click="show = false" type="button" class="ml-auto text-body hover:text-black dark:text-white">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                    {{-- ================= END ALERT ================= --}}

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="vd rj ek rc rg gh lk ml il _l gi hi w-full text-center justify-center">
                                {{ __('Kirim Ulang Email Verifikasi') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="mt-6 text-center">
                            <button type="submit" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline decoration-gray-500 hover:decoration-2 focus:outline-none">
                                {{ __('Keluar') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>

    <x-layout.footer />
    <script defer src="{{ asset('bundle.js') }}"></script>
</body>
</html>