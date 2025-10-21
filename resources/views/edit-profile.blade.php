@extends('layouts.admin-master') 
{{-- Pastikan nama master layout sesuai dengan file di atas (layouts/admin-master.blade.php) --}}

{{-- 1. Definisikan Judul Halaman --}}
@section('title', 'Pengaturan Profil Admin')

{{-- 2. Definisikan Menu Aktif di Sidebar --}}
{{-- Menu 'Manajemen Admin' diasumsikan mencakup fitur edit profile --}}
@php
    $active_menu = 'manajemen_admin'; 
@endphp

{{-- 3. Konten Utama Halaman --}}
@section('content')
            
    <h2 class="mb-8 text-3xl font-extrabold text-gray-800 border-b pb-4">Pengaturan Profile Admin</h2>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        
        {{-- Kolom Kiri: Detail Profil --}}
        <div>
            <div class="admin-card">
                <h3 class="mb-6 text-xl font-semibold text-gray-800 flex items-center">
                    <i data-feather="user" class="w-6 h-6 mr-2 text-rsud-blue"></i> Detail Informasi Profil
                </h3>
                
                <form action="/update-profile" method="POST" class="space-y-5">
                    {{-- Asumsi @csrf ada di sini untuk keamanan Laravel --}}
                    @csrf 
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="Admin Utama" class="admin-input" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                        <input type="email" id="email" name="email" value="admin.utama@rsudjombang.com" class="admin-input" required>
                    </div>

                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-600">Role/Jabatan</label>
                        <input type="text" id="role" name="role" value="Super Admin Konten" class="admin-input bg-gray-100 cursor-not-allowed" disabled>
                        <p class="mt-1 text-xs text-gray-500">Jabatan ditentukan oleh sistem dan tidak dapat diubah.</p>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full px-4 py-2 font-semibold text-white transition duration-150 ease-in-out bg-rsud-blue rounded-lg hover:bg-rsud-blue-light shadow-md hover:shadow-lg">
                            Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Ganti Kata Sandi --}}
        <div>
            <div class="admin-card">
                <h3 class="mb-6 text-xl font-semibold text-gray-800 flex items-center">
                    <i data-feather="lock" class="w-6 h-6 mr-2 text-red-600"></i> Ganti Kata Sandi
                </h3>
                
                <form action="/change-password" method="POST" class="space-y-5">
                    {{-- Asumsi @csrf ada di sini untuk keamanan Laravel --}}
                    @csrf 
                    <div>
                        <label for="current_password" class="block mb-2 text-sm font-medium text-gray-600">Kata Sandi Lama</label>
                        <input type="password" id="current_password" name="current_password" class="admin-input" required>
                    </div>
                    
                    <div>
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-600">Kata Sandi Baru</label>
                        <input type="password" id="new_password" name="new_password" class="admin-input" required>
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, mengandung huruf besar dan angka.</p>
                    </div>

                    <div>
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-600">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="admin-input" required>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full px-4 py-2 font-semibold text-white transition duration-150 ease-in-out bg-red-600 rounded-lg hover:bg-red-700 shadow-md hover:shadow-lg">
                            Ganti Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection