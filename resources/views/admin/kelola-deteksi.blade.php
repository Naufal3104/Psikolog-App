<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pertanyaan Deteksi Dini') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-4">
                {{-- 1. Judul sekarang mengambil total dari $semuaPertanyaan->total() --}}
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Daftar Pertanyaan ({{ $totalPertanyaan }} Total)
                </h3>
                
                <a href="{{ route('kelola-deteksi.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Buat Pertanyaan Baru
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- 2. Bungkus filter dengan <form method="GET"> --}}
                <form method="GET" action="{{ route('kelola-deteksi.index') }}">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between gap-4">
                        <div class="relative flex-grow">
                            {{-- 3. Tambahkan name="search" dan value="{{ request('search') }}" --}}
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari teks pertanyaan..." class="w-full md:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pl-10">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        {{-- 3. Tambahkan name="kategori" dan onchange="this.form.submit()" --}}
                        <select name="kategori" onchange="this.form.submit()" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($semuaKategori as $kategori)
                                {{-- 3. Tambahkan 'selected' jika kategori ini sedang difilter --}}
                                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    {{-- Tidak ada perubahan di dalam tabel, @forelse akan menangani data yang dipaginasi --}}
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                           {{-- ... Header Tabel Anda ... --}}
                           <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th scope="col" class="w-1/2 px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipe Jawaban
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            
                            @php $currentCategory = null; @endphp

                            @forelse ($semuaPertanyaan as $item)
                                <tr>
                                    {{-- ... Sel Data Anda ... --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 whitespace-nowrap">
                                        @if ($currentCategory !== $item->kategori_deteksi_id)
                                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->kategori->nama_kategori }}</span>
                                            @php $currentCategory = $item->kategori_deteksi_id; @endphp
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->teks_pertanyaan }}</div>
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        @if ($item->tipe_jawaban == 'ya_tidak')
                                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                Ya / Tidak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-purple-700 bg-purple-100 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12H5.25V8.25C5.25 7.629 5.754 7.125 6.375 7.125H7.5V3.375C7.5 2.754 8.004 2.25 8.625 2.25H9.75C10.371 2.25 10.875 2.754 10.875 3.375V7.125H12V3.375C12 2.754 12.504 2.25 13.125 2.25H14.25C14.871 2.25 15.375 2.754 15.375 3.375V7.125H16.5V3.375C16.5 2.754 17.004 2.25 17.625 2.25H18.75C19.371 2.25 19.875 2.754 19.875 3.375V13.125H21C21.621 13.125 22.125 13.629 22.125 14.25V15.375C22.125 15.996 21.621 16.5 21 16.5H3C2.379 16.5 1.875 15.996 1.875 15.375V14.25C1.875 13.629 2.379 13.125 3 13.125z" />
                                                </svg>
                                                Rating 1-5
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('kelola-deteksi.edit', $item->id) }}" title="Edit" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('kelola-deteksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');" class="contents">
                                                @csrf
                                                @method('DELETE')
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
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600">
                                        Tidak ada pertanyaan yang cocok dengan pencarian Anda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 4. Ganti Teks Pagination --}}
                <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 md:mb-0">
                            Menampilkan 
                            <span class="font-medium">{{ $semuaPertanyaan->firstItem() ?? 0 }}</span>
                            sampai 
                            <span class="font-medium">{{ $semuaPertanyaan->lastItem() ?? 0 }}</span>
                            dari 
                            <span class="font-medium">{{ $semuaPertanyaan->total() }}</span>
                            Pertanyaan
                        </p>
                        
                        {{-- 5. Ganti Tombol Manual dengan Link Paginasi Laravel --}}
                        <div class="flex space-x-1">
                            {{ $semuaPertanyaan->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>