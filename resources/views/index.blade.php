{{-- resources/views/welcome.blade.php (atau home.blade.php) --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Psikolog - RSUD Jombang</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body
     x-data="{ darkMode: true, scrollTop: false, sidebarOpen: false, stickyMenu: false, navigationOpen: false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
        $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
    "
    x-on:scroll.window="scrollTop = (window.pageYOffset > 300)"
    :class="{ 'b eh': darkMode }"
>
    <x-layout.navbar />

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
                        {{-- CTA optional
                        <div class="mb">
                            <a href="#layanan" class="ek jk lk gh gi hi rg ml il vc _d _l">Mulai Sekarang</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== Hero End ===== -->

        <!-- ===== Services Start ===== -->
        <section id="layanan" class="lj tp kr">
            <!-- Section Title Start -->
            <div
                x-data="{
                    sectionTitle: 'Layanan Kami',
                    sectionTitleText: 'Layanan psikolog profesional untuk mendukung kesehatan mental dan kesejahteraan Anda secara personal dan terpercaya.'
                }"
            >
                <div class="animate_top bb ze rj ki xn vq">
                    <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                    <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                </div>
            </div>
            <!-- Section Title End -->

            <div class="bb ze ki xn yq mb en">
                <div class="wc qf pn xo ng">
                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('konsultasi.whatsapp') }}">
                            <img class="ce ed" src="{{ asset('images/comment.svg') }}" alt="Konsultasi" />
                            <h4 class="ek zj kk wm nb _b">Konsultasi Psikolog</h4>
                            <p>Bimbingan profesional untuk kesehatan mental Anda.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('artikel-publik.index') }}">
                            <img class="ce ed" src="{{ asset('images/newspaper-svgrepo-com.svg') }}" alt="Artikel" />
                            <h4 class="ek zj kk wm nb _b">Artikel</h4>
                            <p>Informasi dan tips seputar psikologi dan kesejahteraan.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('deteksi.index') }}">
                            <img class="ce ed" src="{{ asset('images/detect.svg') }}" alt="Deteksi Dini" />
                            <h4 class="ek zj kk wm nb _b">Deteksi Dini</h4>
                            <p>Screening sederhana untuk mengenali gejala awal.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('tanya.index') }}">
                            <img class="ce ed" src="{{ asset('images/ask.svg') }}" alt="Tanya Jawab" />
                            <h4 class="ek zj kk wm nb _b">Tanya Jawab</h4>
                            <p>Ruang aman untuk bertanya terkait isu psikologis.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('video.index') }}">
                            <img class="ce ed" src="{{ asset('images/video.svg') }}" alt="Video" />
                            <h4 class="ek zj kk wm nb _b">Video</h4>
                            <p>Materi audio-visual edukatif dari tim kami.</p>
                        </a>
                    </div>

                    <!-- Service Item -->
                    <div class="animate_top sg oi pi zq ml il am cn _m">
                        <a href="{{ route('infografis.index') }}">
                            <img class="ce ed" src="{{ asset('images/infografis.svg') }}" alt="Infografis" />
                            <h4 class="ek zj kk wm nb _b">Infografis</h4>
                            <p>Ringkasan visual topik-topik penting psikologi.</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== Services End ===== -->

        <!-- ===== Small Features Start ===== -->
        <section class="lj tp kr">
            <div x-data="{ sectionTitle: 'Kenapa Kami?', sectionTitleText: '' }">
                <div class="animate_top bb ze rj ki xn vq mb-20">
                    <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b" style="margin-bottom: 50px;"></h2>
                    <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                </div>

                <section id="features">
                    <div class="bb ze ki yn 2xl:ud-px-12.5">
                        <div class="tc uf zo xf ap zf bp mq">
                            <!-- Small Features Item -->
                            <div class="animate_top kn to/3 tc cg oq">
                                <div class="tc wf xf cf ae cd rg nh" style="background-color: #044f86;">
                                    <img class="ce ed" src="{{ asset('images/medal.svg') }}" alt="Berkualitas" />
                                </div>
                                <div>
                                    <h4 class="ek yj go kk wm xb">Layanan Berkualitas</h4>
                                    <p>Didukung tim berpengalaman dan tepercaya.</p>
                                </div>
                            </div>

                            <!-- Small Features Item -->
                            <div class="animate_top kn to/3 tc cg oq">
                                <div class="tc wf xf cf ae cd rg nh" style="background-color: #044f86;">
                                    <img class="ce ed" src="{{ asset('images/lock.svg') }}" alt="Privasi" />
                                </div>
                                <div>
                                    <h4 class="ek yj go kk wm xb">Privasi Terjaga</h4>
                                    <p>Data dan konsultasi dijamin kerahasiaannya.</p>
                                </div>
                            </div>

                            <!-- Small Features Item -->
                            <div class="animate_top kn to/3 tc cg oq">
                                <div class="tc wf xf cf ae cd rg oh" style="background-color: #044f86;">
                                    <img class="ce ed" src="{{ asset('images/globe.svg') }}" alt="Akses" />
                                </div>
                                <div>
                                    <h4 class="ek yj go kk wm xb">Akses Fleksibel</h4>
                                    <p>Bisa digunakan kapan saja dan di mana saja.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- ===== Small Features End ===== -->

        <!-- ===== Blog Start ===== -->
        <section class="ji gp uq">
            <div
                x-data="{
                    sectionTitle: 'Artikel Kesehatan',
                    sectionTitleText: 'Baca informasi terbaru seputar kesehatan mental, edukasi, dan perkembangan layanan kami.'
                }"
            >
                <div class="animate_top bb ze rj ki xn vq">
                    <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                    <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                </div>
            </div>

            <div class="bb ye ki xn vq jb jo">
                <div class="wc qf pn xo zf iq">
                    <!-- Blog Item 1 -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="{{ asset('images/blog-01.png') }}" alt="Blog" />
                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="{{ url('/blog/free-advertising') }}" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>
                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-man.svg') }}" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-calender.svg') }}" alt="Calendar" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="{{ url('/blog/free-advertising') }}">Free advertising for your online business</a>
                            </h4>
                        </div>
                    </div>

                    <!-- Blog Item 2 -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="{{ asset('images/blog-02.png') }}" alt="Blog" />
                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="{{ url('/blog/improve-design') }}" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>
                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-man.svg') }}" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-calender.svg') }}" alt="Calendar" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="{{ url('/blog/improve-design') }}">9 simple ways to improve your design skills</a>
                            </h4>
                        </div>
                    </div>

                    <!-- Blog Item 3 -->
                    <div class="animate_top sg vk rm xm">
                        <div class="c rc i z-1 pg">
                            <img class="w-full" src="{{ asset('images/blog-03.png') }}" alt="Blog" />
                            <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                <a href="{{ url('/blog/coding-speed') }}" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
                            </div>
                        </div>
                        <div class="yh">
                            <div class="tc uf wf ag jq">
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-man.svg') }}" alt="User" />
                                    <p>Musharof Chy</p>
                                </div>
                                <div class="tc wf ag">
                                    <img src="{{ asset('images/icon-calender.svg') }}" alt="Calendar" />
                                    <p>25 Dec, 2025</p>
                                </div>
                            </div>
                            <h4 class="ek tj ml il kk wm xl eq lb">
                                <a href="{{ url('/blog/coding-speed') }}">Tips to quickly improve your coding speed.</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== Blog End ===== -->
    </main>

    <x-layout.footer />

    <script defer src="{{ asset('bundle.js') }}"></script>
</body>
</html>
