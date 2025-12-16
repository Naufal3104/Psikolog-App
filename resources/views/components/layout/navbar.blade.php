<header class="g s r vd ya cj" :class="{ 'hh sm _k dj bl ll': stickyMenu }" x-data="{ sidebarOpen: false }"
    @scroll.window="stickyMenu = (window.pageYOffset > 20)">

    <div class="bb ze ri xn 2xl:ud-px-0 oo wf yf i flex items-center justify-between">

        <div class="tc wf">
            <a href="{{ url('/') }}" class="ek yj go kk wm xb font-extrabold" style="font-weight: 900 !important;">
                Psikolog
            </a>
        </div>

        <div class="hidden lg:flex items-center gap-5">

            <div class="relative flex-shrink-0">
                <label class="cursor-pointer flex items-center justify-center">
                    <input type="checkbox" x-model="darkMode" class="hidden" />

                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform duration-200 active:scale-90">
                        <svg :class="{ 'block': !darkMode, 'hidden': darkMode }" width="25" height="25"
                            viewBox="0 0 25 25" fill="currentColor"
                            :style="(!stickyMenu) ? 'color: #000000;' : 'color: #000000;'"
                            class="transition-colors duration-300">
                            <path
                                d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z" />
                        </svg>

                        <img :class="{ 'hidden': !darkMode, 'block': darkMode }"
                            src="{{ asset('images/icon-moon.svg') }}" alt="Moon" width="25" height="25" />
                    </div>
                </label>
            </div>

            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="ek pk xl font-medium hover:text-blue-600 transition">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="lk gh dk rg tc wf xf _l gi hi px-6 py-2 rounded-full text-white bg-blue-600 hover:bg-blue-700 transition">Daftar</a>
                    @endif
                </div>
            @endguest

            @auth
                <div class="relative flex-shrink-0" x-data="{ userDropdownOpen: false }" @click.away="userDropdownOpen = false">
                    <button @click="userDropdownOpen = !userDropdownOpen"
                        class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700 hover:border-blue-500 transition-all focus:outline-none">
                        @if (Auth::user()->foto_profil)
                            <img alt="Profil" class="w-full h-full object-cover"
                                src="{{ asset('storage/' . Auth::user()->foto_profil) }}" />
                        @else
                            <img alt="Profil" class="w-full h-full object-cover"
                                src="{{ asset('images/avatar.png') }}" />
                        @endif
                    </button>

                    <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute top-full right-0 mt-3 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl z-50 overflow-hidden border border-gray-100 dark:border-gray-700"
                        style="display: none;">

                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            <span class="text-[10px] uppercase tracking-wider font-bold text-blue-600 dark:text-blue-400">
                                {{ Auth::user()->hasRole('psikolog') ? 'Psikolog' : 'Pengguna' }}
                            </span>
                        </div>

        <!-- User Info -->
        <div class="px-6 pt-6 pb-4">
            <h2 class="mt-4 text-2xl font-semibold">{{ Auth::user()->name }}</h2>
            <p class="text-white/80">{{ Auth::user()->email }}</p>
        </div>

        <!-- Menu -->
        <nav class="px-6 pb-6 flex-1 overflow-y-auto">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('konsultasi.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/comment.svg') }}" alt="">
                        <span>Konsultasi Psikolog</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('artikel-publik.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/newspaper-svgrepo-com.svg') }}" alt="">
                        <span>Artikel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('deteksi.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/detect.svg') }}" alt="">
                        <span>Deteksi Dini</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tanya.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/ask.svg') }}" alt="">
                        <span>Tanya Jawab</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('video.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/video.svg') }}" alt="">
                        <span>Video</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('infografis.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/infografis.svg') }}" alt="">
                        <span>Infografis</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout -->
        <div class="p-6 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
@endauth

            </div>
        </div>

        <div class="flex lg:hidden items-center" style="gap: 15px;">
            <div class="relative flex-shrink-0">
                <label class="cursor-pointer flex items-center justify-center">
                    <input type="checkbox" :checked="darkMode" @change="darkMode = !darkMode" class="hidden" />
                    <div class="flex items-center justify-center w-8 h-8">
                        <svg :class="{ 'block': !darkMode, 'hidden': darkMode }"
                            style="width: 24px; height: 24px; color: #000000;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <img :class="{ 'hidden': !darkMode, 'block': darkMode }"
                            src="{{ asset('images/icon-moon.svg') }}" alt="Moon"
                            style="width: 24px; height: 24px;" />
                    </div>
                </label>
            </div>

            @guest
                <div x-data="{ mobileMenuOpen: false }" @click.away="mobileMenuOpen = false" class="relative">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" style="padding: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor"
                            :style="darkMode ? 'color: #ffffff;' : 'color: #000000;'">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div x-show="mobileMenuOpen"
                        class="bg-white dark:bg-gray-800 shadow-lg rounded-lg absolute top-full right-0 mt-2 w-48 z-50"
                        style="display: none;">
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">Daftar</a>
                        @endif
                    </div>
                </div>
            @endguest

            @auth
                <div x-data="{ profileMobileOpen: false }" @click.away="profileMobileOpen = false" class="relative flex-shrink-0">
                    <button @click="profileMobileOpen = !profileMobileOpen"
                        style="width: 32px; height: 32px; border-radius: 50%; overflow: hidden; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center;">
                        @if (Auth::user()->foto_profil)
                            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Profil"
                                style="width: 100%; height: 100%; object-fit: cover;" />
                        @else
                            <img src="{{ asset('images/icon-man.svg') }}" alt="Profil"
                                style="width: 100%; height: 100%; object-fit: cover;" />
                        @endif
                    </button>
                    <div x-show="profileMobileOpen" x-transition
                        class="bg-white dark:bg-gray-800 shadow-lg rounded-lg border border-gray-100 dark:border-gray-700 absolute top-full right-0 mt-2 w-56 z-50 overflow-hidden"
                        style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('user.profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Edit
                                Profil</a>
                            <a href="{{ route('deteksi.riwayat') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Riwayat
                                Deteksi</a>
                            <form action="{{ route('logout') }}" method="POST" style="margin:0;">@csrf <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <button @click="sidebarOpen = !sidebarOpen"
                        style="background: transparent; border: none; padding: 0; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-bars" style="font-size: 24px;"
                            :style="darkMode ? 'color: #ffffff;' : 'color: #000000;'"></i>
                    </button>
                </div>
            @endauth
        </div>
    </div>

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/50 z-40"
        @click="sidebarOpen = false" style="display:none;"></div>
    <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 h-full w-80 z-50 shadow-2xl overflow-hidden bg-black text-white flex flex-col"
        style="display:none;" @click.stop>
        <div class="p-4 flex items-center justify-end border-b border-white/10"><button @click="sidebarOpen = false"
                class="p-2 rounded-lg hover:bg-white/10"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg></button></div>
        <nav class="px-6 py-6 flex-1 overflow-y-auto">
            <ul class="space-y-4">
                <li><a href="{{ route('konsultasi.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/comment.svg') }}" alt=""><span>Konsultasi
                            Psikolog</span></a></li>
                <li><a href="{{ route('artikel.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/newspaper-svgrepo-com.svg') }}"
                            alt=""><span>Artikel</span></a></li>
                <li><a href="{{ route('deteksi.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/detect.svg') }}" alt=""><span>Deteksi
                            Dini</span></a></li>
                <li><a href="{{ route('tanya.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/ask.svg') }}" alt=""><span>Tanya
                            Jawab</span></a></li>
                <li><a href="{{ route('video.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/video.svg') }}"
                            alt=""><span>Video</span></a></li>
                <li><a href="{{ route('infografis.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition"><img
                            class="w-5 h-5" src="{{ asset('images/infografis.svg') }}"
                            alt=""><span>Infografis</span></a></li>
            </ul>
        </nav>
        {{-- <div class="p-6 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16 17 21 12 16 7" /><line x1="21" y1="12" x2="9" y2="12" /></svg> Keluar</button></form>
        </div> --}}
    </div>
</header>
