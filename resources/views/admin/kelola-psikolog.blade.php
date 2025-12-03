<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Verifikasi Akun Psikolog') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Menampilkan pesan sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Menampilkan pesan error --}}
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                    Menunggu Persetujuan ({{ $psikologs->count() }} Permintaan)
                </h3>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                {{-- Form Filter (Opsional, jika ingin pencarian) --}}
                <form method="GET" action="{{ route('verifikasi.index') }}">
                    <div
                        class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between gap-4">
                        <div class="relative flex-grow">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama atau NIP..."
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
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama & Email
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data Profesi
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Kontak & Alamat
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal Daftar
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse ($psikologs as $item)
                                <tr>
                                    {{-- Kolom Nama --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->email }}</div>
                                        <div class="text-xs text-gray-400 mt-1">NIK: {{ $item->NIK ?? '-' }}</div>
                                    </td>

                                    {{-- Kolom Profesi --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            NIP: {{ $item->psikologProfile->NIP ?? '-' }}
                                        </div>
                                        <div
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mt-1">
                                            {{ $item->psikologProfile->spesialisasi ?? 'Umum' }}
                                        </div>
                                    </td>

                                    {{-- Kolom Kontak --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $item->no_telp ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs"
                                            title="{{ $item->alamat }}">
                                            {{ Str::limit($item->alamat, 40) }}
                                        </div>
                                    </td>

                                    {{-- Kolom Tanggal --}}
                                    <td
                                        class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $item->created_at->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }} WIB
                                        </div>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="px-4 py-3 border border-gray-300 dark:border-gray-600 text-center">
                                        @if ($item->psikologProfile->status == 'pending')
                                            <div class="flex items-center justify-center space-x-3">
                                                {{-- Tombol Approve --}}
                                                <form action="{{ route('verifikasi.approve', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menyetujui psikolog ini?');">
                                                    @csrf
                                                    <button type="submit" title="Setujui / Terima"
                                                        class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transform hover:scale-110 transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                {{-- Tombol Reject --}}
                                                <form action="{{ route('verifikasi.reject', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK pendaftaran ini? Akun akan dihapus.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Tolak & Hapus"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transform hover:scale-110 transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="flex items-center justify-center">
                                                <a href="{{ route('verifikasi.edit', $item->id) }}" title="Edit"
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
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-4 py-8 text-center text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-10 w-10 text-gray-400 mb-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>Tidak ada permintaan verifikasi psikolog saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer (Jika menggunakan pagination di controller) --}}
                @if ($psikologs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $psikologs->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
