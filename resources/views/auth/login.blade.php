{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang • Masuk</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body
  x-data="{
      page: 'home',
      darkMode: true,
      stickyMenu: false,
      navigationOpen: false,
      scrollTop: false,
      sidebarOpen: false   // <— penting
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
                    <h2 class="ek ck kk wm xb">Masuk</h2>
                </div>

                <form class="sb" method="POST" action="{{ route('login') }}">
                    @csrf

                    @if (session('status'))
                        <div class="mb-4 text-sm text-green-600">{{ session('status') }}</div>
                    @endif

                    <div class="wb">
                        <label for="email" class="rc kk wm vb">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="example@gmail.com"
                            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40  text-black placeholder-gray-400 pr-10"" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="wb mt-4">
    <label for="password" class="rc kk wm vb">Password</label>

    <div class="relative">
        <input
            id="password"
            type="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="**************"
            class="vd hh rg zk _g ch hm dm fm pl/50 xi mi sm xm pm dn/40 text-black placeholder-gray-400 pr-10" />

        <!-- Icon Mata -->
        <button type="button"
            onclick="togglePassword()"
            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                    4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>
    </div>

    @error('password')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");

        if (input.type === "password") {
            input.type = "text";
            icon.setAttribute("stroke", "#000"); // optional
        } else {
            input.type = "password";
            icon.setAttribute("stroke", "currentColor"); // optional
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
                        <button type="submit" class="vd rj ek rc rg gh lk ml il _l gi hi">
                            Masuk
                        </button>
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
