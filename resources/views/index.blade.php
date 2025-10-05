<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang</title>
    <link rel="icon" href="favicon.ico">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body x-data="{ page: 'home', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }">
    <!-- ===== Header Start ===== -->
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
                                'xh': page === 'home' &&
                                    stickyMenu
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

                    <a href="{{ route('login') }}"
                        :class="{ 'lk': page === 'home', 'ok': page === 'home' && stickyMenu }"
                        class="ek pk xl">Masuk</a>
                    <a href="{{ route('register') }}"
                        :class="{ 'nk': page === 'home', 'sh': page === 'home' && stickyMenu }"
                        class="lk gh dk rg tc wf xf _l gi hi">Daftar</a>
                </div>
            </div>
        </div>
    </header>
    <!-- ===== Header End ===== -->

    <main>
        <!-- ===== Hero Start ===== -->
        <section class="gj do ir hj sp jr i pg">
    <div class="bb ze ki xn 2xl:ud-px-0">
        <div class="tc sf wf rj">
            <div class="animate_left">
                <h1 class="fk vj zp or kk wm wb">Kesehatan Mental Anda Prioritas Kami</h1>
                <p class="fq">
                    Temukan solusi terbaik untuk kesehatan mental Anda bersama psikolog profesional
                </p>

                <!-- <div class="mb">
                    <a href="#!" class="ek jk lk gh gi hi rg ml il vc _d _l">Get Started Now</a>
                    </div> -->
            </div>
        </div>
    </div>
</section>
        <!-- ===== Hero End ===== -->

        <!-- ===== Services Start ===== -->
        <section class="lj tp kr">
            <!-- Section Title Start -->
            <div x-data="{ sectionTitle: `Layanan Kami`, sectionTitleText: `Layanan psikolog profesional untuk mendukung kesehatan mental dan kesejahteraan Anda secara personal dan terpercaya.` }">
                <div class="animate_top bb ze rj ki xn vq">
                    <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b">
                    </h2>
                    <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                </div>


            </div>
            <!-- Section Title End -->

            <div class="bb ze ki xn yq mb en">
                <div class="wc qf pn xo ng">
                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m" > 
                    <a href="{{ route('konsultasi.whatsapp') }}">
                        <img class="ce ed" src="images/comment.svg" alt="Icon" />
                        <h4 class="ek zj kk wm nb _b">Konsultasi Psikolog</h4>
                        <p>Bimbingan profesional untuk kesehatan mental Anda.</p>
                    </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m" > 
                    <a href="{{ route('artikel.index') }}">
                        <img class="ce ed" src="images/newspaper-svgrepo-com.svg" alt="Icon" />
                        <h4 class="ek zj kk wm nb _b">Artikel</h4>
                        <p>Informasi dan tips seputar psikologi dan kesejahteraan.</p>
                    </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('deteksi.index') }}">
                            <img class="ce ed" src="images/detect.svg" alt="Icon" />
                            <h4 class="ek zj kk wm nb _b">Deteksi Dini</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis tortor.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('tanya.index') }}">
                            <img class="ce ed" src="images/ask.svg" alt="Icon" />
                            <h4 class="ek zj kk wm nb _b">Tanya Jawab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis tortor.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('video.index') }}">
                            <img class="ce ed" src="images/video.svg" alt="Icon" />
                            <h4 class="ek zj kk wm nb _b">Video</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis tortor.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('infografis.index') }}">
                            <img class="ce ed" src="images/infografis.svg" alt="Icon" />
                            <h4 class="ek zj kk wm nb _b">Infografis</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis tortor.</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== Services End ===== -->        

<!-- ===== Small Features Start ===== -->
<section class="lj tp kr">
    <div x-data="{ sectionTitle: `Kenapa Kami?` }">
        <div class="animate_top bb ze rj ki xn vq mb-20">
            <!-- Add margin to the title for spacing -->
            <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b" style="margin-bottom: 50px;">
            </h2>
            <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
        </div>

        <section id="features">
            <div class="bb ze ki yn 2xl:ud-px-12.5">
                <div class="tc uf zo xf ap zf bp mq">
                    <!-- Small Features Item -->
                    <div class="animate_top kn to/3 tc cg oq">
                        <div class="tc wf xf cf ae cd rg nh" style="background-color: #044f86;">
                            <img class="ce ed" src="images/medal.svg" alt="Icon" />
                        </div>
                        <div>
                            <h4 class="ek yj go kk wm xb">Layanan Berkualitas</h4>
                            <p>Didukung tim berpengalaman dan tepercaya.</p>
                        </div>
                    </div>

                    <!-- Small Features Item -->
                    <div class="animate_top kn to/3 tc cg oq">
                        <div class="tc wf xf cf ae cd rg nh" style="background-color: #044f86;">
                            <img class="ce ed" src="images/lock.svg" alt="Icon" />
                        </div>
                        <div>
                            <h4 class="ek yj go kk wm xb">Privasi Terjaga</h4>
                            <p>Data dan konsultasi dijamin kerahasiaannya.</p>
                        </div>
                    </div>

                    <!-- Small Features Item -->
                    <div class="animate_top kn to/3 tc cg oq">
                        <div class="tc wf xf cf ae cd rg oh" style="background-color: #044f86;">
                            <img class="ce ed" src="images/globe.svg" alt="Icon" />
                        </div>
                        <div>
                            <h4 class="ek yj go kk wm xb">Akses Fleksibel</h4>
                            <p>Bisa digunakan kapan saja dan di mana saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- ===== Small Features End ===== -->

        <!-- ===== Blog Start ===== -->
        <section class="ji gp uq">
            <!-- Section Title Start -->
            <div x-data="{ sectionTitle: `Artikel Kesehatan`, sectionTitleText: `Baca informasi terbaru seputar kesehatan mental, edukasi, dan perkembangan layanan kami.` }">
                <div class="animate_top bb ze rj ki xn vq">
                    <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b">
                    </h2>
                    <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                </div>


            </div>
            <!-- Section Title End -->

            <div class="bb ye ki xn vq jb jo">
                <div class="wc qf pn xo zf iq">
                    <!-- Blog Item -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="images/blog-01.png" alt="Blog" />

                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>

                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="images/icon-man.svg" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="images/icon-calender.svg" alt="Calender" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="blog-single.html">Free advertising for your online business</a>
                            </h4>
                        </div>
                    </div>

                    <!-- Blog Item -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="images/blog-02.png" alt="Blog" />

                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>

                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="images/icon-man.svg" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="images/icon-calender.svg" alt="Calender" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="blog-single.html">9 simple ways to improve your design skills</a>
                            </h4>
                        </div>
                    </div>

                    <!-- Blog Item -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="images/blog-03.png" alt="Blog" />

                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>

                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="images/icon-man.svg" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="images/icon-calender.svg" alt="Calender" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="blog-single.html">Tips to quickly improve your coding speed.</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== Blog End ===== -->
    </main>
    <!-- ===== Footer Start ===== -->
<footer>
    <div class="bb ze ki xn 2xl:ud-px-0">
        
        <div class="bh ch pm tc uf sf yo wf xf ap cg fp bj flex justify-center py-8">
            <div class="animate_top text-center">
                <p class="xl dark:text-gray-400">&copy; 2025 Psikologi RSUD Jombang. All Rights Reserved.</p>
            </div>
        </div>
        </div>
</footer>
    <!-- ===== Footer End ===== -->

    <!-- ====== Back To Top Start ===== -->
    <button class="xc wf xf ie ld vg sr gh tr g sa ta _a" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false" :class="{ 'uc': scrollTop }">
        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>
    <!-- ====== Back To Top End ===== -->

    <script>
    </script>
    <script defer src="bundle.js"></script>
</body>

</html>
