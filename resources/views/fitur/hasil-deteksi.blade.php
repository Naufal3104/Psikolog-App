@extends('layouts.main')
@section('title', 'Detail Riwayat Deteksi')

@push('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS Tambahan untuk Print agar rapi */
        @media print {
            nav, header, .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
            .shadow-sm { box-shadow: none !important; border: 1px solid #ddd !important; }
            .dark .bg-gray-800 { background-color: white !important; color: black !important; }
            .dark .text-gray-100 { color: black !important; }
            .text-gray-900, .text-gray-500, .text-gray-600 { color: black !important; }
            
            /* Reset padding saat print agar tidak terlalu turun di kertas */
            .main-container { padding-top: 0 !important; }
        }
    </style>
@endpush

@section('content')

    {{-- PERUBAHAN DISINI: Mengganti py-12 menjadi pt-28 pb-12 --}}
    {{-- pt-28 memberikan jarak atas yang cukup besar agar tidak ketutup navbar --}}
    <div class="main-container pt-28 pb-12 font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. KARTU RINGKASAN HASIL --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative z-10">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- === BARIS TOMBOL AKSI === --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4 border-b border-gray-200 dark:border-gray-700 no-print gap-4">
                        
                        {{-- Tombol Kembali --}}
                        <a href="{{ route('deteksi.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-[#004780] dark:hover:text-white transition-colors relative z-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Menu Deteksi
                        </a>

                        {{-- Tombol Print --}}
                        <button type="button" id="btn-print" class="inline-flex items-center px-4 py-2 bg-[#004780] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:outline-none transition ease-in-out duration-150 cursor-pointer relative z-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak PDF
                        </button>
                    </div>
                    {{-- === AKHIR TOMBOL AKSI === --}}

                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Ringkasan Hasil Deteksi
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Pengguna:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasilDeteksi->user->name }}</span>
                            <span class="text-xs text-gray-500">({{ $hasilDeteksi->user->email }})</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Kategori Tes:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasilDeteksi->kategori->nama_kategori }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Tanggal Tes:</span>
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $hasilDeteksi->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Skor Akhir:</span>
                            <span class="font-bold text-2xl text-indigo-600 dark:text-indigo-400">{{ $hasilDeteksi->total_skor }}</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg border border-indigo-100 dark:border-indigo-800">
                        <span class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Interpretasi Hasil:</span>
                        <span class="font-bold text-xl text-gray-900 dark:text-gray-100">
                            {{ $hasilDeteksi->interpretasi->teks_interpretasi ?? 'Tidak Diketahui' }}
                        </span>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            {{ $hasilDeteksi->interpretasi->deskripsi_hasil ?? '' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- 2. DETAIL JAWABAN --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg relative z-10">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">
                        Detail Jawaban
                    </h3>
                    
                    <div class="space-y-6">
                        @foreach ($hasilDeteksi->jawabanUser as $jawaban)
                            <div class="border-b border-gray-100 dark:border-gray-700 pb-4 last:border-0" style="page-break-inside: avoid;">
                                <p class="text-gray-800 dark:text-gray-200 font-medium">
                                    {{ $loop->iteration }}. {{ $jawaban->pertanyaan->teks_pertanyaan }}
                                </p>
                                <div class="mt-2 flex items-center space-x-2">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Jawaban Anda:</span>
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-full text-sm font-semibold">
                                        {{ $jawaban->pilihanJawaban->teks_jawaban }}
                                    </span>
                                    <span class="text-xs text-gray-400">(Bobot: {{ $jawaban->pilihanJawaban->bobot_nilai }})</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Footer Print Disclaimer --}}
            <div class="text-center text-xs text-gray-400 pb-8 hidden print:block">
                Dokumen ini digenerate otomatis pada {{ now()->format('d F Y H:i') }}. <br>
                Dapat digunakan sebagai referensi awal untuk konsultasi dengan profesional.
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printBtn = document.getElementById('btn-print');
            if(printBtn) {
                printBtn.addEventListener('click', function(e) {
                    e.preventDefault(); 
                    window.print();
                });
            }
        });
    </script>
@endpush