<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-200 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalUser ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-200 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Tes Deteksi</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalTesDeteksi ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Dari {{ $kategoriDeteksi ?? 0 }} Kategori</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-200 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pertanyaan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalPertanyaan ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center border-l-4 border-red-500">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-200 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum Dijawab</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $pertanyaanBelumDijawab ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Butuh respons segera</p>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Statistik Konten Edukasi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Artikel</h4>
                            <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $totalArtikel ?? 0 }}</span>
                            <span class="text-sm text-gray-500">postingan</span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Views</p>
                            <p class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($totalViewsArtikel ?? 0) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                        <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 70%"></div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Video</h4>
                            <span class="text-3xl font-bold text-pink-600 dark:text-pink-400">{{ $totalVideo ?? 0 }}</span>
                            <span class="text-sm text-gray-500">video</span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Views</p>
                            <p class="font-semibold text-gray-700 dark:text-gray-300">{{ number_format($totalViewsVideo ?? 0) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                        <div class="bg-pink-600 h-1.5 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Infografis</h4>
                            <span class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $totalInfografis ?? 0 }}</span>
                            <span class="text-sm text-gray-500">file</span>
                        </div>
                        <div class="p-2 bg-yellow-100 rounded text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                        <div class="bg-yellow-500 h-1.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>