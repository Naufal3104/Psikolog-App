<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Jadwal Psikolog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Daftar Shift ({{ $jadwal->total() }})
                </h3>
                
                <a href="{{ route('jadwal.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Jadwal
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('jadwal.index') }}">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau hari..." class="w-full md:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama Psikolog</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Hari Bertugas</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nomor WhatsApp</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($jadwal as $item)
                                <tr>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $item->user->name ?? 'User Tidak Ditemukan' }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $item->hari }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->user->no_telp ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('jadwal.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada jadwal shift.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    {{ $jadwal->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>