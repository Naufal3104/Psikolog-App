@extends('layouts.admin-master') 
{{-- Ganti 'admin-master' dengan nama file layout master Anda jika berbeda --}}

{{-- 1. Definisikan Judul Halaman --}}
@section('title', 'Buat Artikel Baru')

{{-- 2. Definisikan Menu Aktif di Sidebar --}}
@php
    $active_menu = 'buat_artikel';
@endphp

{{-- 3. Konten Utama Halaman --}}
@section('content')

    <div class="sticky top-16 z-5 flex items-center justify-between p-4 mb-8 bg-white border-b border-gray-200 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-gray-800">Buat Artikel Baru</h2>
        
        <div class="space-x-4">
            <button type="button" class="px-6 py-2 font-semibold text-gray-700 transition duration-150 ease-in-out bg-gray-200 border border-gray-300 rounded-lg hover:bg-gray-300">
                Simpan Draft
            </button>
            <button type="submit" form="articleForm" class="px-6 py-2 font-semibold text-white transition duration-150 ease-in-out bg-rsud-blue rounded-lg hover:bg-rsud-blue-light">
                <i data-feather="upload" class="w-5 h-5 mr-1 inline-block"></i> Publikasikan Sekarang
            </button>
        </div>
    </div>

    <form action="#" method="POST" id="articleForm" class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="admin-card p-4">
                <label for="judul" class="sr-only">Judul Artikel</label>
                <input type="text" id="judul" name="judul" class="w-full text-3xl font-extrabold border-none focus:ring-0 p-0 placeholder-gray-400" placeholder="Masukkan Judul Artikel di sini" required>
            </div>

            <div class="admin-card p-0">
                <label for="konten" class="sr-only">Konten Artikel</label>
                <div class="rte-area">
                    <textarea id="konten" name="konten" class="w-full h-96 p-4 border-none resize-none focus:outline-none placeholder-gray-500" placeholder="Tulis konten artikel Anda. (Simulasi Rich Text Editor)"></textarea>
                    <div class="h-10 bg-gray-100 border-t border-gray-200 flex items-center p-2 text-sm text-gray-500">
                        [Toolbar RTE Placeholder: Bold | Italic | Link | Image | H1/H2]
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-bold text-gray-800 border-b pb-2">Status & Organisasi</h3>
                
                <div class="mb-4">
                    <label for="status" class="form-label">Status Publikasi</label>
                    <select id="status" name="status" class="form-input-field p-2">
                        <option value="draft">Draft</option>
                        <option value="published">Publikasi</option>
                        <option value="archived">Arsip</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="kategori" class="form-label">Kategori Utama</label>
                    <select id="kategori" name="kategori" class="form-input-field p-2" required>
                        <option value="">Pilih Kategori</option>
                        <option value="kesehatan_mental">Kesehatan Mental</option>
                        <option value="deteksi_dini">Deteksi Dini</option>
                        <option value="berita_rsud">Berita RSUD</option>
                    </select>
                </div>
            </div>
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-bold text-gray-800 border-b pb-2">Gambar Utama</h3>
                <label for="gambar" class="form-label">Pilih Gambar (Maks 2MB)</label>
                <input type="file" id="gambar" name="gambar" class="form-input-field p-2" accept="image/*">
                <p class="mt-2 text-xs text-gray-500">Gambar akan digunakan sebagai thumbnail dan header artikel.</p>
            </div>

            <div class="admin-card">
                <h3 class="mb-4 text-lg font-bold text-gray-800 border-b pb-2">Pengaturan SEO</h3>
                
                <div class="mb-4">
                    <label for="tags" class="form-label">Tags (Pisahkan dengan koma)</label>
                    <input type="text" id="tags" name="tags" class="form-input-field" placeholder="contoh: stress, psikolog, rsud">
                </div>

                <div>
                    <label for="meta_desc" class="form-label">Meta Deskripsi (Maks 160 Karakter)</label>
                    <textarea id="meta_desc" name="meta_desc" rows="3" class="form-input-field resize-none" placeholder="Tulis deskripsi singkat untuk SEO..."></textarea>
                </div>
            </div>
        </div>
    </form>
    
@endsection