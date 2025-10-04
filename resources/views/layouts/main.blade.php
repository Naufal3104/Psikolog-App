<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>@yield('title', 'Psikolog - RSUD Jombang')</title>
    
    <link rel="icon" href="favicon.ico">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <style>
        .icon-small {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            color: #1e40af; /* Warna ikon badge */
        }
    </style>
    @stack('styles')
</head>

<body x-data="{ page: '@yield('page-slug', 'other')', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }">
    
    <header class="g s r vd ya cj" :class="{ 'hh sm _k dj bl ll': stickyMenu }"
        @scroll.window="stickyMenu = (window.pageYOffset > 20) ? true : false">
        <div class="bb ze ki xn 2xl:ud-px-0 oo wf yf i">
            <div class="tc wf">
                <a href="{{ url('/') }}" class="ek yj go kk wm xb font-extrabold" style="font-weight: 900 !important;">Psikolog</a> 
            </div>

            <div class="sd qo f ho oo wf" :class="{ 'd hh rm sr td ud qg ug jc yh': navigationOpen }">

                <div class="tc wf ig pb no">
                    <div class="pc h io pa ra" :class="navigationOpen ? '!-ud-visible' : 'd'">
                        <label class="rc ab i">
                            <input type="checkbox" :value="darkMode" @change="darkMode = !darkMode"
                                class="pf vd yc uk h r za ab" />
                            <svg :class="{
                                'wn': page === 'home' && !stickyMenu && darkMode,
                                'xh': page === 'home' && stickyMenu
                            }"
                                class="th om" width="25" height="25" viewBox="0 0 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z"
                                    fill="" />
                            </svg>
                            <img class="xc nm" src="images/icon-moon.svg" alt="Moon" />
                        </label>
                    </div>

                    <a href="{{ route('login') }}" class="ek pk xl"
                        :class="{ 'lk': page === 'home', 'ok': page === 'home' && stickyMenu }">Masuk</a>
                    <a href="{{ route('register') }}" class="lk gh dk rg tc wf xf _l gi hi"
                        :class="{ 'nk': page === 'home', 'sh': page === 'home' && stickyMenu }">Daftar</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    
    <footer>
        <div class="bb ze ki xn 2xl:ud-px-0">
            <div class="bh ch pm tc uf sf yo wf xf ap cg fp bj flex justify-center py-8">
                <div class="animate_top text-center">
                    <p class="xl dark:text-gray-400">&copy; 2025 Psikologi RSUD Jombang. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <button class="xc wf xf ie ld vg sr gh tr g sa ta _a" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false" :class="{ 'uc': scrollTop }">
        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>
    <script>
        feather.replace();
    </script>
    <script defer src="bundle.js"></script>
    @stack('scripts')
</body>

</html>