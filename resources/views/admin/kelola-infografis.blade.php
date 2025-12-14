<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Infografis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Daftar Infografis ({{ $infografis->total() }})
                </h3>
                <a href="{{ route('admin.infografis.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
                    + Tambah Infografis
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('admin.infografis.index') }}">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul atau caption..."
                            class="w-full md:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    </div>
                </form>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 uppercase">Preview</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 uppercase">Judul & Caption</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($infografis as $item)
                                <tr>
                                    {{-- Kolom Preview Gambar --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600" style="width: 120px;">
                                        <div class="h-16 w-24 bg-gray-100 rounded overflow-hidden relative border border-gray-200">
                                            <img src="{{ $item->gambar }}" alt="Preview" class="object-cover w-full h-full">
                                        </div>
                                    </td>

                                    {{-- Kolom Info --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->judul }}</div>
                                        <div class="text-xs text-gray-500 mt-1 line-clamp-2" title="{{ $item->caption }}">
                                            {{ $item->caption ?? 'Tidak ada caption' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-sm text-gray-500">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    
                                    {{-- Kolom Aksi (Icon) --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.infografis.edit', $item->id) }}" title="Edit" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus infografis ini?');" class="contents">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada data infografis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-6">
                    {{ $infografis->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>