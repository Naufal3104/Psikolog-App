<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kinerja & Ranking Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">🏆 Tabel Peringkat Keaktifan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Metrik: Jumlah Artikel + Balasan Tanya Jawab + Klik Konsultasi
                            </p>
                        </div>
                        <div class="text-xs text-right text-gray-400 italic">
                            *Diupdate secara realtime
                        </div>
                    </div>

                    <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Peringkat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Psikolog
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        📝 Artikel
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        💬 Balasan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        🖱️ Klik
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                                        Total Skor
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($dataKinerja as $index => $row)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($loop->iteration == 1)
                                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    🥇 #1
                                                </span>
                                            @elseif($loop->iteration == 2)
                                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                                    🥈 #2
                                                </span>
                                            @elseif($loop->iteration == 3)
                                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-800 border border-orange-200">
                                                    🥉 #3
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                                    #{{ $loop->iteration }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-sm">
                                                        {{ substr($row->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $row->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $row->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600 dark:text-gray-300">
                                            {{ $row->jumlah_artikel }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600 dark:text-gray-300">
                                            {{ $row->jumlah_balasan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600 dark:text-gray-300">
                                            {{ $row->jumlah_klik }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 dark:bg-indigo-900/50 dark:text-indigo-300 dark:border-indigo-700">
                                                {{ $row->total_skor }} Poin
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400 flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium">Belum ada data kinerja psikolog.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>