@extends('layouts.admin-master') 
{{-- Pastikan ini adalah file layout master admin Anda --}}

{{-- 1. Definisikan Judul Halaman --}}
@section('title', 'Kelola Pertanyaan Deteksi Dini')

{{-- 2. Definisikan Menu Aktif di Sidebar --}}
@php
    // Sesuaikan 'pengaturan_tes_pertanyaan' dengan nama menu di sidebar Anda
    $active_menu = 'pengaturan_tes_pertanyaan'; 
@endphp
@push('styles')
<style>
    /* 1. Hapus border-collapse bawaan dari .admin-table-modern agar border bisa menyatu.
      2. Beri border keliling pada tabel.
    */
    .admin-table-modern {
        border-collapse: collapse;
        border: 1px solid #d1d5db; /* gray-300 (lebih tebal dari gray-200) */
    }

    /* 3. Beri border (horizontal DAN vertikal) pada SEMUA sel.
      Ini akan menciptakan grid yang lengkap.
    */
    .admin-table-modern th,
    .admin-table-modern td {
        border: 1px solid #d1d5db; /* gray-300 */
    }
</style>

{{-- 3. Konten Utama Halaman --}}
@section('content')

    {{-- Header Halaman --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-8">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">Kelola Pertanyaan (3 Total)</h2>
        
        {{-- Tombol Buat Baru --}}
        <a href="{{ url('/admin/pertanyaan/create') }}" class="flex items-center px-4 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out bg-rsud-blue rounded-lg hover:bg-rsud-blue-light shadow-md">
            <i data-feather="plus" class="w-5 h-5 mr-1"></i> Buat Pertanyaan Baru
        </a>
    </div>

    {{-- Kartu Konten Utama --}}
    <div class="main-content-card">
        
        {{-- Filter dan Pencarian --}}
        <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white rounded-t-xl">
            <div class="relative w-full md:w-auto flex-grow mr-0 md:mr-4 mb-3 md:mb-0">
                <input type="text" placeholder="Cari teks pertanyaan..." class="filter-input w-full md:w-64 pl-10">
                <i data-feather="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            </div>

            <div class="flex flex-wrap justify-end gap-3 w-full md:w-auto">
                <select class="filter-select flex-grow md:flex-grow-0">
                    <option value="">Semua Kategori</option>
                    {{-- Opsi ini nantinya akan di-load dinamis dari DB --}}
                    <option value="stres">Tingkat Stres</option>
                    <option value="pernikahan">Kesiapan Pernikahan</option>
                    {{-- ... etc ... --}}
                </select>
            </div>
        </div>

        {{-- Konten Tabel (Layout Baru Sesuai Permintaan) --}}
        <div class="overflow-x-auto">
            <table class="admin-table-modern">
                <thead>
                    <tr>
                        {{-- 4 Kolom Sesuai Permintaan --}}
                        <th>Kategori</th>
                        <th class="w-1/2">Pertanyaan</th> {{-- Diberi lebar lebih --}}
                        <th>Tipe Jawaban</th>
                        <th class="w-24 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {{-- GRUP KATEGORI 1: TINGKAT STRES --}}
                    
                    {{-- Baris Data 1.1 --}}
                    <tr>
                        <td>
                            {{-- Kategori HANYA ditampilkan di baris pertama --}}
                            <span class="font-semibold text-gray-900">Tingkat Stres</span>
                        </td>
                        <td>
                            <div class="text-gray-800">Apakah Anda merasa sulit untuk bersantai?</div>
                        </td>
                        <td class="text-center">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                <i data-feather="check-circle" class="w-3 h-3 mr-1 "></i> Ya / Tidak
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    
                    {{-- Baris Data 1.2 --}}
                    <tr>
                        <td>
                            {{-- Sel Kategori DIBIARKAN KOSONG --}}
                        </td>
                        <td>
                            <div class="text-gray-800">Seberapa sering Anda merasa gugup atau cemas dalam sebulan terakhir?</div>
                        </td>
                        <td class="text-center">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-purple-700 bg-purple-100 rounded-full">
                                <i data-feather="bar-chart-2" class="w-3 h-3 mr-1"></i> Rating 1-5
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>

                    {{-- GRUP KATEGORI 2: KESIAPAN PERNIKAHAN --}}

                    {{-- Baris Data 2.1 --}}
                    <tr>
                        <td>
                            {{-- Kategori ditampilkan lagi karena ini grup baru --}}
                            <span class="font-semibold text-gray-900">Kesiapan Pernikahan</span>
                        </td>
                        <td>
                            <div class="text-gray-800">Apakah Anda dan pasangan telah membicarakan ekspektasi finansial secara terbuka?</div>
                        </td>
                        <td class="text-center">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                <i data-feather="check-circle" class="w-3 h-3 mr-1"></i> Ya / Tidak
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    
                    {{-- (Nantinya, Anda akan melakukan @foreach untuk semua data pertanyaan di sini) --}}

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white rounded-b-xl border-t border-gray-100">
            <p class="text-sm text-gray-600 mb-3 md:mb-0">Menampilkan 1 sampai 3 dari 3 Pertanyaan</p>
            <div class="flex space-x-1">
                <button class="px-3 py-1 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 text-sm font-semibold text-white bg-rsud-blue rounded-lg">1</button>
                <button class="px-3 py-1 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100">Next</button>
            </div>
        </div>

    </div>
@endsection