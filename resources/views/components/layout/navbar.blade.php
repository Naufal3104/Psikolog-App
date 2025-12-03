<header class="g s r vd ya cj" :class="{ 'hh sm _k dj bl ll': stickyMenu }"
    @scroll.window="stickyMenu = (window.pageYOffset > 20)">
    <div class="bb ze ri xn 2xl:ud-px-0 oo wf yf i flex items-center justify-between">
        <div class="tc wf">
            <a href="{{ url('/') }}" class="ek yj go kk wm xb font-extrabold" style="font-weight: 900 !important;">
                Psikolog
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex sd qo f ho oo wf">
            <div class="tc wf ig pb no flex items-center gap-3">
                <!-- Dark Mode Toggle -->
                <div class="pc h io pa ra">
                    <label class="rc ab i">
                        <input type="checkbox" :checked="darkMode" @change="darkMode = !darkMode"
                            class="pf vd yc uk h r za ab" />
                        <svg :class="{
                            'wm': !stickyMenu && darkMode,
                            'xh': page === 'home' && stickyMenu
                        }"
                            class="bla om" width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z" />
                        </svg>
                        <img class="xc nm" src="{{ asset('images/icon-moon.svg') }}" alt="Moon" />
                    </label>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="ek pk xl">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="lk gh dk rg tc wf xf _l gi hi">
                            Daftar
                        </a>
                    @endif
                @endguest

                @auth
                    <div x-data="{ profileOpen: false }" @click.away="profileOpen = false" class="i">
                        <button @click="profileOpen = !profileOpen" class="tc wf rg yk _k bl">
                            <span class="profile-avatar sc tc xf rg">
                                <img alt="Profil" class="vd yc rg" src="{{ asset('images/team-01.png') }}" />
                            </span>
                        </button>

                        <div x-show="profileOpen" x-transition class="h q r ug _g ch hh sm _k il"
                            style="display: none; min-width: 12rem; margin-top: 3.5rem; top: 0;">
                            <div class="vi ah ch">
                                <p class="ak fk kk wm rj">{{ Auth::user()->name }}</p>
                                <p class="uj pk wm rj">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('user.profile.edit') }}"
                                    class="rj rc vd text-left text-sm pk wm xl px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Edit Profil
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="rc vd text-left text-sm pk wm xl px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="flex lg:hidden items-center gap-3">
            <!-- Dark Mode Toggle (Mobile) - KIRI -->
            <div class="pc h io pa ra">
                <label class="rc ab i">
                    <input type="checkbox" :checked="darkMode" @change="darkMode = !darkMode"
                        class="pf vd yc uk h r za ab" />
                    <svg :class="{
                        'wn': page === 'home' && !stickyMenu && darkMode,
                        'xh': page === 'home' && stickyMenu
                    }"
                        class="bla om ubd" width="25" height="25" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z" />
                    </svg>
                    <img class="xc nm" src="{{ asset('images/icon-moon.svg') }}" alt="Moon" />
                </label>
            </div>

            @guest
                <!-- Hamburger Button for Guest - KANAN -->
                <div x-data="{ mobileMenuOpen: false }" @click.away="mobileMenuOpen = false" class="relative">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Mobile Menu Dropdown for Guest -->
                    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute top-full right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-50"
                        style="display: none;">
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                Daftar
                            </a>
                        @endif
                    </div>
                </div>
            @endguest

            @auth
                <!-- User Profile Button (Mobile) - KANAN -->
                <div x-data="{ profileMobileOpen: false }" @click.away="profileMobileOpen = false" class="relative">
                    <button @click="profileMobileOpen = !profileMobileOpen"
                        class="flex items-center justify-center w-8 h-8 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-colors"
                        aria-label="Profil">
                        <img alt="Profil" class="w-full h-full object-cover"
                            src="{{ asset('images/team-01.png') }}" />
                    </button>

                    <div x-show="profileMobileOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute top-full right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg z-50 overflow-hidden"
                        style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                Edit Profil
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>

<!-- Drawer Sidebar (tetap sama seperti sebelumnya) -->
@auth
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40">
    </div>

    <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 h-full w-80 z-50 shadow-2xl overflow-hidden bg-black text-white flex flex-col"
        role="dialog" aria-modal="true" @click.stop>
        <div class="p-4 flex items-center justify-end border-b border-white/10">
            <button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-white/10" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="px-6 pt-6 pb-4">
            <h2 class="mt-4 text-2xl font-semibold">Selamat Datang</h2>
            <p class="text-white/80">Psikolog</p>
        </div>

        <nav class="px-6 pb-6 flex-1 overflow-y-auto">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('konsultasi.whatsapp') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/comment.svg') }}" alt="">
                        <span class="leading-6">Konsultasi Psikolog</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('artikel.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/newspaper-svgrepo-com.svg') }}" alt="">
                        <span class="leading-6">Artikel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('deteksi.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/detect.svg') }}" alt="">
                        <span class="leading-6">Deteksi Dini</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tanya.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/ask.svg') }}" alt="">
                        <span class="leading-6">Tanya Jawab</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('video.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/video.svg') }}" alt="">
                        <span class="leading-6">Video</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('infografis.index') }}"
                        class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
                        <img class="w-5 h-5" src="{{ asset('images/infografis.svg') }}" alt="">
                        <span class="leading-6">Infografis</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-6 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
@endauth
