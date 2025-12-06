<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log Aktivitas Sistem') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Daftar Aktivitas ({{ $logs->total() }} Total)
                </h3>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Form Filter & Search --}}
                <form method="GET" action="{{ route('activity-logs.index') }}">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between gap-4">
                        <div class="relative flex-grow">
                            {{-- Input Search --}}
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama user atau aksi..." class="w-full md:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pl-10">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        
                        {{-- Filter Tipe Aksi (Menggantikan Kategori) --}}
                        <select name="filter_action" onchange="this.form.submit()" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Semua Aktivitas</option>
                            <option value="LOGIN" {{ request('filter_action') == 'LOGIN' ? 'selected' : '' }}>Login & Logout</option>
                            <option value="CREATE" {{ request('filter_action') == 'CREATE' ? 'selected' : '' }}>Pembuatan Data (Create)</option>
                            <option value="UPDATE" {{ request('filter_action') == 'UPDATE' ? 'selected' : '' }}>Perubahan Data (Update)</option>
                            <option value="DELETE" {{ request('filter_action') == 'DELETE' ? 'selected' : '' }}>Penghapusan Data (Delete)</option>
                        </select>
                    </div>
                </form>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aktivitas / Aksi
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Waktu
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            
                            @forelse ($logs as $log)
                                <tr>
                                    {{-- Kolom Pengguna --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-300 mr-3">
                                                {{ substr($log->user_name, 0, 1) }}
                                            </div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $log->user_name }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Aksi dengan Badge Warna --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        @php
                                            // Logika Sederhana untuk Warna Badge
                                            $colorClass = 'bg-gray-100 text-gray-800'; // Default
                                            
                                            if (Str::contains($log->action, 'LOGIN')) $colorClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                                            elseif (Str::contains($log->action, 'LOGOUT')) $colorClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                                            elseif (Str::contains($log->action, 'CREATE')) $colorClass = 'bg-green-100 text-green-800 border border-green-200';
                                            elseif (Str::contains($log->action, 'UPDATE')) $colorClass = 'bg-yellow-100 text-yellow-800 border border-yellow-200';
                                            elseif (Str::contains($log->action, 'DELETE')) $colorClass = 'bg-red-100 text-red-800 border border-red-200';
                                        @endphp

                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                            {{-- Mengubah Underscore jadi Spasi agar rapi (misal: CREATE_ARTIKEL jadi CREATE ARTIKEL) --}}
                                            {{ str_replace('_', ' ', $log->action) }}
                                        </span>
                                    </td>

                                    {{-- Kolom Waktu --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $log->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $log->created_at->format('H:i:s') }} WIB
                                        </div>
                                        <div class="text-xs text-gray-400 italic mt-1">
                                            {{ $log->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p>Belum ada aktivitas yang tercatat.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer --}}
                <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 md:mb-0">
                            Menampilkan 
                            <span class="font-medium">{{ $logs->firstItem() ?? 0 }}</span>
                            sampai 
                            <span class="font-medium">{{ $logs->lastItem() ?? 0 }}</span>
                            dari 
                            <span class="font-medium">{{ $logs->total() }}</span>
                            Aktivitas
                        </p>
                        <div class="flex space-x-1">
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>