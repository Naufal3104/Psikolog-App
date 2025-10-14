<header class="g s r vd ya cj" :class="{ 'hh sm _k dj bl ll': stickyMenu }"
    @scroll.window="stickyMenu = (window.pageYOffset > 20)">
    <div class="bb ze ki xn 2xl:ud-px-0 oo wf yf i">
        <div class="tc wf">
            <a href="{{ url('/') }}" class="ek yj go kk wm xb font-extrabold" style="font-weight: 900 !important;">
                Psikolog
            </a>
        </div>

        <div class="sd qo f ho oo wf" :class="{ 'd hh rm sr td ud qg ug jc yh': navigationOpen }">
            <div class="tc wf ig pb no flex items-center gap-3">

                <div class="pc h io pa ra"
                    :class="{ 'hidden': sidebarOpen, '!-ud-visible': navigationOpen, 'd': !navigationOpen }">
                    <label class="rc ab i">
                        <input type="checkbox" :checked="darkMode" @change="darkMode = !darkMode"
                            class="pf vd yc uk h r za ab" />
                        <svg :class="{
                            'wn': page === 'home' && !stickyMenu && darkMode,
                            'xh': page === 'home' && stickyMenu
                        }"
                            class="th om" width="25" height="25" viewBox="0 0 25 25" fill="none"
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
                            style="display: none; min-width: 12rem; margin-top: 0.5rem;">
                            <div class="vi ah ch">
                                <p class="ak fk kk wm rj">{{ Auth::user()->name }}</p>
                                <p class="uj pk wm rj">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- Menu Item --}}
                            {{-- Menu Item --}}
                            <div class="py-1">
                                {{-- START: Tombol Edit Profil Ditambahkan di Sini --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="rj rc vd text-left text-sm pk wm xl px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Edit Profil
                                </a>
                                {{-- END: Tombol Edit Profil --}}

                                {{-- Form Logout yang sudah ada --}}
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
    </div>
    </div>
</header>
