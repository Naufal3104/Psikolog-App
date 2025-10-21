@extends('layouts.admin-master') 
{{-- Ganti 'admin-master' dengan nama file layout master Anda jika berbeda --}}

{{-- 1. Definisikan Judul Halaman --}}
@section('title', 'Kelola Artikel')

{{-- 2. Definisikan Menu Aktif di Sidebar --}}
@php
    $active_menu = 'kelola_artikel'; // Nilai ini harus sama dengan yang didefinisikan di master layout
@endphp

{{-- 3. Konten Utama Halaman --}}
@section('content')

    <div class="flex flex-col md:flex-row items-center justify-between mb-8">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">Daftar Artikel (45 Total)</h2>
        <a href="{{ url('/admin/article/create') }}" class="flex items-center px-4 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out bg-rsud-blue rounded-lg hover:bg-rsud-blue-light shadow-md">
            <i data-feather="plus" class="w-5 h-5 mr-1"></i> Buat Baru
        </a>
    </div>

    <div class="main-content-card">
        
        <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white rounded-t-xl">
            <div class="relative w-full md:w-auto flex-grow mr-0 md:mr-4 mb-3 md:mb-0">
                <input type="text" placeholder="Cari Judul atau Penulis..." class="filter-input w-full md:w-64 pl-10">
                <i data-feather="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            </div>

            <div class="flex flex-wrap justify-end gap-3 w-full md:w-auto">
                <select class="filter-select flex-grow md:flex-grow-0">
                    <option value="">Semua Kategori</option>
                    <option value="mental">Kesehatan Mental</option>
                    <option value="dini">Deteksi Dini</option>
                    <option value="umum">Edukasi Umum</option>
                </select>
                <select class="filter-select flex-grow md:flex-grow-0">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="review">Review</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table-modern">
                <thead>
                    <tr>
                        <th class="w-1/3">Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="w-24 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Baris Data 1 --}}
                    <tr>
                        <td>
                            <div class="font-semibold text-gray-900">Pentingnya Screening Kesehatan Mental pada Remaja</div>
                            <div class="text-xs text-gray-500 mt-1 truncate">/pentingnya-screening-kesehatan-mental</div>
                        </td>
                        <td><span class="text-sm text-gray-700">Kesehatan Mental</span></td>
                        <td>Admin A</td>
                        <td>
                            <div class="text-sm text-gray-700">21 Okt 2025</div>
                            <div class="text-xs text-gray-500">14:30 WIB</div>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                <i data-feather="check-circle" class="w-3 h-3 mr-1"></i> Published
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    {{-- Baris Data 2 --}}
                    <tr>
                        <td>
                            <div class="font-semibold text-gray-900">Draft Panduan Kesiapan Menikah Terbaru</div>
                            <div class="text-xs text-gray-500 mt-1 truncate">/draft-panduan-kesiapan-nikah</div>
                        </td>
                        <td><span class="text-sm text-gray-700">Deteksi Dini</span></td>
                        <td>Admin B</td>
                        <td>
                            <div class="text-sm text-gray-700">19 Okt 2025</div>
                            <div class="text-xs text-gray-500">10:15 WIB</div>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                <i data-feather="save" class="w-3 h-3 mr-1"></i> Draft
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    {{-- Baris Data 3 --}}
                    <tr>
                        <td>
                            <div class="font-semibold text-gray-900">Cara Mengatasi Kesukaran Belajar pada Anak</div>
                            <div class="text-xs text-gray-500 mt-1 truncate">/mengatasi-kesukaran-belajar</div>
                        </td>
                        <td><span class="text-sm text-gray-700">Edukasi Umum</span></td>
                        <td>Super Admin</td>
                        <td>
                            <div class="text-sm text-gray-700">18 Okt 2025</div>
                            <div class="text-xs text-gray-500">16:00 WIB</div>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                <i data-feather="clock" class="w-3 h-3 mr-1"></i> Review
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    {{-- Baris Data 4 --}}
                    <tr>
                        <td>
                            <div class="font-semibold text-gray-900">10 Tips Menjaga Kesehatan Mental di Era Digital</div>
                            <div class="text-xs text-gray-500 mt-1 truncate">/tips-kesehatan-mental-digital</div>
                        </td>
                        <td><span class="text-sm text-gray-700">Kesehatan Mental</span></td>
                        <td>Admin C</td>
                        <td>
                            <div class="text-sm text-gray-700">15 Okt 2025</div>
                            <div class="text-xs text-gray-500">09:00 WIB</div>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                <i data-feather="check-circle" class="w-3 h-3 mr-1"></i> Published
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="#" title="Edit" class="text-rsud-blue hover:text-rsud-blue-light transition p-1 rounded-md hover:bg-gray-100"><i data-feather="edit" class="w-4 h-4"></i></a>
                                <a href="#" title="Hapus" class="text-red-500 hover:text-red-700 transition p-1 rounded-md hover:bg-red-50"><i data-feather="trash-2" class="w-4 h-4"></i></a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white rounded-b-xl border-t border-gray-100">
            <p class="text-sm text-gray-600 mb-3 md:mb-0">Menampilkan 1 sampai 4 dari 45 Artikel</p>
            <div class="flex space-x-1">
                <button class="px-3 py-1 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 text-sm font-semibold text-white bg-rsud-blue rounded-lg">1</button>
                <button class="px-3 py-1 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100">2</button>
                <button class="px-3 py-1 text-sm text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100">3</button>
                <button class="px-3 py-1 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100">Next</button>
            </div>
        </div>

    </div>
@endsection