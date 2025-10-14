<header class="g s r vd ya cj"
        :class="{ 'hh sm _k dj bl ll': stickyMenu }"
        @scroll.window="stickyMenu = (window.pageYOffset > 20)">
    <div class="bb ze ki xn 2xl:ud-px-0 oo wf yf i">
        <!-- Brand -->
        <div class="tc wf">
            <a href="{{ url('/') }}"
               class="ek yj go kk wm xb font-extrabold"
               style="font-weight: 900 !important;">
                Psikolog
            </a>
        </div>

        <!-- Right Side -->
        <div class="sd qo f ho oo wf"
             :class="{ 'd hh rm sr td ud qg ug jc yh': navigationOpen }">
            <div class="tc wf ig pb no flex items-center gap-3">

                <!-- Dark Mode Toggle -->
                <div class="pc h io pa ra"
                     :class="{'hidden': sidebarOpen, '!-ud-visible': navigationOpen, 'd': !navigationOpen}">
                    <label class="rc ab i">
                        <input type="checkbox"
                               :checked="darkMode"
                               @change="darkMode = !darkMode"
                               class="pf vd yc uk h r za ab" />
                        <svg :class="{
                                'wn': page === 'home' && !stickyMenu && darkMode,
                                'xh': page === 'home' && stickyMenu
                            }"
                             class="th om" width="25" height="25"
                             viewBox="0 0 25 25" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363Z"/>
                        </svg>
                        <img class="xc nm" src="{{ asset('images/icon-moon.svg') }}" alt="Moon" />
                    </label>
                </div>

                <!-- Auth Links -->
                @guest
                    <a href="{{ route('login') }}"
                       class="ek pk xl">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="lk gh dk rg tc wf xf _l gi hi">
                            Daftar
                        </a>
                    @endif
                @endguest

                <!-- Tombol Hamburger setelah login -->
                @auth
<button
  x-show="!sidebarOpen"
  @click.stop="sidebarOpen = true"
  class="p-2 rounded-lg bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 transition focus:outline-none focus:ring"
  aria-label="Buka menu">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
       fill="none" stroke="currentColor" stroke-width="2"
       stroke-linecap="round" stroke-linejoin="round"
       class="w-6 h-6 text-gray-700 dark:text-gray-200">
    <line x1="3" y1="6"  x2="21" y2="6"></line>
    <line x1="3" y1="12" x2="21" y2="12"></line>
    <line x1="3" y1="18" x2="21" y2="18"></line>
  </svg>
</button>
@endauth

            </div>
        </div>
    </div>
</header>

<!-- Drawer Sidebar -->

@auth
<div
  x-show="sidebarOpen"
  x-transition.opacity
  @click="sidebarOpen = false"
  class="fixed inset-0 bg-black/50 z-40"> </div>

<div
  x-show="sidebarOpen"
  x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="translate-x-full"
  x-transition:enter-end="translate-x-0"
  x-transition:leave="transition ease-in duration-300"
  x-transition:leave-start="translate-x-0"
  x-transition:leave-end="translate-x-full"
  class="fixed inset-y-0 right-0 h-full w-80 z-50 shadow-2xl overflow-hidden bg-black text-white flex flex-col"
  role="dialog" aria-modal="true"
  @click.stop
>
  <div class="p-4 flex items-center justify-end border-b border-white/10">
    <button @click="sidebarOpen = false"
            class="p-2 rounded-lg hover:bg-white/10" aria-label="Tutup">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
           viewBox="0 0 24 24" fill="none" stroke="currentColor"
           stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        <a href="{{ route('konsultasi.whatsapp') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
          <img class="w-5 h-5" src="{{ asset('images/comment.svg') }}" alt="">
          <span class="leading-6">Konsultasi Psikolog</span>
        </a>
      </li>
      <li>
        <a href="{{ route('artikel.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
          <img class="w-5 h-5" src="{{ asset('images/newspaper-svgrepo-com.svg') }}" alt="">
          <span class="leading-6">Artikel</span>
        </a>
      </li>
      <li>
        <a href="{{ route('deteksi.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
          <img class="w-5 h-5" src="{{ asset('images/detect.svg') }}" alt="">
          <span class="leading-6">Deteksi Dini</span>
        </a>
      </li>
      <li>
        <a href="{{ route('tanya.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
          <img class="w-5 h-5" src="{{ asset('images/ask.svg') }}" alt="">
          <span class="leading-6">Tanya Jawab</span>
        </a>
      </li>
      <li>
        <a href="{{ route('video.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
          <img class="w-5 h-5" src="{{ asset('images/video.svg') }}" alt="">
          <span class="leading-6">Video</span>
        </a>
      </li>
      <li>
        <a href="{{ route('infografis.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-white/10 transition">
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
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Keluar
      </button>
    </form>
  </div>
</div>
@endauth