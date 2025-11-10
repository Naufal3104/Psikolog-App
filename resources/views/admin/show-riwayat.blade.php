<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Riwayat Deteksi') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <a href="{{ route('kelola-riwayat.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Riwayat
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Ringkasan Hasil
                    </h3>
                    
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Pengguna:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasil->user->name }} ({{ $hasil->user->email }})</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Kategori:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasil->kategori->nama_kategori }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Tanggal Tes:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasil->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Skor Akhir:</span>
                            <span class="font-bold text-xl text-indigo-600 dark:text-indigo-400">{{ $hasil->total_skor }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Interpretasi:</span>
                            <span class="font-bold text-xl text-gray-900 dark:text-gray-100">{{ $hasil->interpretasi_hasil }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Detail Jawaban
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach ($hasil->jawabanUser as $jawaban)
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-2">
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $loop->iteration }}. {{ $jawaban->pertanyaan->teks_pertanyaan }}
                                </p>
                                <p class="text-sm mt-1">
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">Jawaban:</span>
                                    <span class="text-indigo-600 dark:text-indigo-400">{{ $jawaban->pilihanJawaban->teks_jawaban }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">(Bobot: {{ $jawaban->pilihanJawaban->bobot_nilai }})</span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>