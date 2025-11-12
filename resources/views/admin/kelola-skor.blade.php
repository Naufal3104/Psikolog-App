<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Interpretasi Skor') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Daftar Interpretasi ({{ $totalSkor }} Total)
                </h3>

                {{-- Mengarah ke rute create_score (yang akan Anda buat nanti) --}}
                <a href="{{ route('kelola-skor.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Buat Interpretasi Baru
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                {{-- Form Filter --}}
                <form method="GET" action="{{ route('kelola-skor.index') }}">
                    <div
                        class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between gap-4">
                        <div class="relative flex-grow">
                            {{-- Input Search --}}
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari teks interpretasi..."
                                class="w-full md:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pl-10">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        {{-- Filter Kategori --}}
                        <select name="kategori" onchange="this.form.submit()"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($semuaKategori as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Hasil Teks
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Rentang Skor
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @php $currentCategory = null; @endphp

                            @forelse ($semuaSkor as $item)
                                <tr>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 whitespace-nowrap">
                                        @if ($currentCategory !== $item->kategori_deteksi_id)
                                            <span
                                                class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->kategori->nama_kategori }}</span>
                                            @php $currentCategory = $item->kategori_deteksi_id; @endphp
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $item->teks_interpretasi }}</div>
                                        {{-- Tampilkan deskripsi singkat jika ada --}}
                                        <div class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                            {{ $item->deskripsi_hasil }}</div>
                                    </td>
                                    <td
                                        class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                            {{ $item->skor_minimal }} - {{ $item->skor_maksimal }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            {{-- Ganti ke rute 'kelola-skor.edit' (yang akan Anda buat nanti) --}}
                                            <a href="{{ route('kelola-skor.edit', $item->id) }}" title="Edit"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            {{-- Ganti ke rute 'kelola-skor.destroy' (yang akan Anda buat nanti) --}}
                                            <form action="{{ route('kelola-skor.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus interpretasi ini?');"
                                                class="contents">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600">
                                        Tidak ada data interpretasi skor ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer --}}
                <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div classT="flex flex-col md:flex-row items-center justify-between">
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 md:mb-0">
                            Menampilkan
                            <span class="font-medium">{{ $semuaSkor->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-medium">{{ $semuaSkor->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium">{{ $semuaSkor->total() }}</span>
                            Hasil
                        </p>

                        <div class="flex space-x-1">
                            {{ $semuaSkor->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
