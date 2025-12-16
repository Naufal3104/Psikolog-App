<aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in lg:translate-x-0'"
       class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 lg:static lg:inset-auto">
    
    <div class="flex items-center justify-center h-16 border-b border-gray-100 dark:border-gray-700">
        <a href="{{ route('dashboard.index') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>

    <nav class="mt-5 px-4 space-y-1">
        
        <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.*')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('artikel.index')" :active="request()->routeIs('artikel-admin.*')">
            {{ __('Kelola Artikel') }}
        </x-responsive-nav-link>

        <div x-data="{ openDeteksi: {{ request()->routeIs('kelola-deteksi.*') || request()->routeIs('kelola-skor.*') || request()->routeIs('kelola-riwayat.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button @click="openDeteksi = !openDeteksi"
                    class="flex items-center justify-between w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                    {{ request()->routeIs('kelola-deteksi.*') || request()->routeIs('kelola-skor.*') || request()->routeIs('kelola-riwayat.*')
                        ? 'border-indigo-400 dark:border-indigo-600 text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50'
                        : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }}">
                <span>{{ __('Deteksi Dini') }}</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': openDeteksi}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="openDeteksi" class="pl-4 space-y-1" style="display: none;">
                <x-responsive-nav-link :href="route('kelola-deteksi.index')" :active="request()->routeIs('kelola-deteksi.*')" class="text-sm">
                    {{ __('Kelola Pertanyaan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kelola-skor.index')" :active="request()->routeIs('kelola-skor.*')" class="text-sm">
                    {{ __('Interpretasi Skor') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kelola-riwayat.index')" :active="request()->routeIs('kelola-riwayat.*')" class="text-sm">
                    {{ __('Riwayat Deteksi') }}
                </x-responsive-nav-link>
            </div>
        </div>

        <x-responsive-nav-link :href="route('tanya.index')" :active="request()->routeIs('psikolog.pertanyaan')">
            {{ __('Tanya Jawab') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('verifikasi.index')" :active="request()->routeIs('verifikasi.*')">
            {{ __('Verifikasi Psikolog') }}
        </x-responsive-nav-link>
        
        <x-responsive-nav-link :href="route('admin.video.index')" :active="request()->routeIs('admin.video.*')">
             {{ __('Kelola Video') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('admin.infografis.index')" :active="request()->routeIs('admin.infografis.*')">
             {{ __('Kelola Infografis') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('activity-logs.index')" :active="request()->routeIs('activity-logs.*')">
            {{ __('Riwayat Aktivitas') }}
        </x-responsive-nav-link>

    </nav>
    
    <div @click="sidebarOpen = false" :class="sidebarOpen ? 'block' : 'hidden'" class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>
</aside>