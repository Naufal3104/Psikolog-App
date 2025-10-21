@extends('layouts.admin-master') 
{{-- Asumsikan nama master layout Anda adalah 'admin_master' --}}

@section('title', 'Ringkasan Statistik')

{{-- 1. Definisikan Menu Aktif --}}
{{-- Variabel $active_menu ini akan digunakan oleh master layout untuk menandai menu 'Dashboard' --}}
@php
    $active_menu = 'dashboard';
@endphp

{{-- 2. Tempatkan Konten Utama di dalam section('content') --}}
@section('content')

    <h2 class="mb-6 text-3xl font-extrabold text-gray-800">Dashboard</h2>

    {{-- Konten Dashboard Anda dimulai di sini --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        
        {{-- 1. Kartu Total Pengguna (DIUBAH agar sama dengan Total Artikel) --}}
        <div class="flex items-center p-5 bg-white rounded-xl shadow-lg">
            <div class="p-3 mr-4 text-rsud-blue bg-blue-100 rounded-full">
                {{-- Mengganti ikon dan warna sesuai dengan konteks pengguna --}}
                <i data-feather="users" class="w-6 h-6"></i> 
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                <h3 class="text-2xl font-bold text-gray-800">450</h3>
            </div>
        </div>

        {{-- 2. Kartu Total Artikel (Tetap sama) --}}
        <div class="flex items-center p-5 bg-white rounded-xl shadow-lg">
            <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
                <i data-feather="file-text" class="w-6 h-6"></i> 
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Artikel</p>
                <h3 class="text-2xl font-bold text-gray-800">120</h3>
            </div>
        </div>

        {{-- 3. Kartu Deteksi Dini (Tetap sama) --}}
        <div class="flex items-center p-5 bg-white rounded-xl shadow-lg">
            <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
                <i data-feather="bell" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Deteksi Dini</p>
                <h3 class="text-2xl font-bold text-gray-800">8</h3>
            </div>
        </div>

        {{-- 4. Kartu Deteksi Tertinggi (DIUBAH agar sama dengan Total Artikel) --}}
        <div class="flex items-center p-5 bg-white rounded-xl shadow-lg">
            <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">

                <i data-feather="trending-up" class="w-6 h-6"></i> 
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Deteksi Tertinggi (7 Hari)</p>
                <h3 class="text-2xl font-bold text-gray-800">Stres (45%)</h3>
            </div>
        </div>
        
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Tren Pengisian Kuesioner (30 Hari)</h3>
                <div class="flex items-center justify-center rounded-lg bg-gray-100 h-64 border border-gray-200">
                    <span class="text-gray-500">[Placeholder Area Grafik Line Chart]</span>
                </div>
            </div>
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Total & Pengguna Aktif</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="mb-2 text-lg font-bold text-gray-800">450</p>
                        <p class="text-sm text-gray-500">Total Pengguna</p>
                        <div class="flex items-center justify-center w-full h-16 mt-3 bg-gray-100 rounded-md text-xs text-gray-500">
                            Placeholder Bar Chart
                        </div>
                    </div>
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="mb-2 text-lg font-bold text-gray-800">122</p>
                        <p class="text-sm text-gray-500">Pengguna Aktif</p>
                        <div class="flex items-center justify-center w-full h-16 mt-3 text-xs text-gray-500">
                            Placeholder Donut Chart 78%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                <ul class="space-y-3">
                    <li class="p-3 border-b border-gray-100 last:border-b-0">
                        <p class="font-medium text-gray-800">Artikel "Gejala Kesukaran Belajar" dipublikasi.</p>
                    </li>
                    <li class="p-3 border-b border-gray-100 last:border-b-0">
                        <p class="font-medium text-gray-800">Admin A mengedit Kuesioner Kesiapan Pernikahan.</p>
                    </li>
                    <li class="p-3 border-b border-gray-100 last:border-b-0">
                        <p class="font-medium text-gray-800">Akun Admin B ditambahkan ke grup Manajemen Konten.</p>
                    </li>
                </ul>
            </div>
            
            <div class="admin-card">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Deteksi Dini Terlaris</h3>
                <div class="flex items-center justify-between p-3 mb-2 bg-gray-50 rounded-lg">
                    <span class="font-medium text-gray-700">1. Kenali Tingkat Stress</span>
                    <span class="px-2 py-1 text-xs font-semibold text-rsud-blue bg-rsud-blue-light bg-opacity-10 rounded-full">15.2K Sesi</span>
                </div>
                <div class="flex items-center justify-between p-3 mb-2 bg-gray-50 rounded-lg">
                    <span class="font-medium text-gray-700">2. Kesiapan Pernikahan</span>
                    <span class="px-2 py-1 text-xs font-semibold text-rsud-blue bg-rsud-blue-light bg-opacity-10 rounded-full">12.8K Sesi</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="font-medium text-gray-700">3. Putus Cinta</span>
                    <span class="px-2 py-1 text-xs font-semibold text-rsud-blue bg-rsud-blue-light bg-opacity-10 rounded-full">5.7K Sesi</span>
                </div>
            </div>
        </div>
    </div>
    
@endsection