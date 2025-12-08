@extends('layouts.main')
@section('title', 'Hasil Deteksi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        /* --- Layout Dasar --- */
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Menggunakan flex-start agar aman saat scroll */
            min-height: calc(100vh - 100px);
            padding: 120px 20px 60px 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .centered-content {
                padding: 100px 20px 40px 20px;
            }
        }

        /* Wrapper Pembungkus (Agar tombol sejajar dengan card) */
        .content-wrapper {
            width: 90%;
            max-width: 450px;
            display: flex;
            flex-direction: column;
            gap: 16px; /* Jarak antara tombol kembali dan card */
        }

        .consultation-card {
            width: 100%; /* Mengikuti lebar wrapper */
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2),
                        0 8px 10px -4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .consultation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.25),
                        0 10px 15px -4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        /* --- Styling Khusus Halaman Hasil --- */
        
        .result-icon-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .result-icon-circle {
            width: 80px;
            height: 80px;
            background-color: #f0f9ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #004780;
        }

        .result-label {
            font-size: 1rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 4px;
        }

        .result-value {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* Warna dinamis untuk hasil */
        .text-aman { color: #10b981; } 
        .text-sedang { color: #f59e0b; }
        .text-bahaya { color: #ef4444; }

        .result-score {
            text-align: center;
            font-size: 0.9rem;
            color: #9ca3af;
            background: #f9fafb;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin: 0 auto 20px auto;
            border: 1px solid #e5e7eb;
        }

        .result-description {
            text-align: center;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 32px;
            font-size: 0.95rem;
        }

        /* Tombol */
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border-radius: 12px;
            background-color: #10a884;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
        }

        .btn-primary-custom:hover {
            background-color: #0c7a5f;
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border-radius: 12px;
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-secondary-custom:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }

    </style>
@endpush

@section('content')

<x-layout.navbar />

<div class="centered-content">
    
    {{-- Wrapper Pembungkus --}}
    <div class="content-wrapper">

        {{-- 1. TOMBOL KEMBALI --}}
        <div>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- 2. KARTU HASIL --}}
        <div class="consultation-card">
            <div class="card-header">
                <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Hasil Deteksi Dini</h2>
            </div>
            
            <div style="padding: 32px 24px; display: flex; flex-direction: column; align-items: center;">
                
                {{-- Icon Ilustrasi --}}
                <div class="result-icon-wrapper">
                    <div class="result-icon-circle">
                        <i data-feather="clipboard" style="width: 40px; height: 40px;"></i>
                    </div>
                </div>

                {{-- Label Hasil --}}
                <div class="result-label">
                    Hasil Tes Deteksi Dini Anda:
                </div>

                {{-- LOGIC PHP: Menentukan Warna --}}
                @php
                    $skor = $hasilDeteksi->total_skor;
                    $colorClass = 'text-bahaya'; 

                    if ($skor >= 70) {
                        $colorClass = 'text-aman'; 
                    } elseif ($skor >= 30) {
                        $colorClass = 'text-sedang';
                    } else {
                        $colorClass = 'text-bahaya';
                    }
                @endphp

                {{-- Teks Interpretasi --}}
                <div class="result-value {{ $colorClass }}">
                    {{ $hasilDeteksi->interpretasi->teks_interpretasi ?? 'Tidak Diketahui' }}
                </div>

                {{-- Skor Deteksi --}}
                <div class="result-score">
                    Skor Deteksi: <strong>{{ $hasilDeteksi->total_skor }}</strong>
                </div>

                {{-- Deskripsi Hasil --}}
                <div class="result-description">
                    {{ $hasilDeteksi->interpretasi->deskripsi_hasil ?? 'Belum ada deskripsi untuk hasil ini.' }}
                </div>

                {{-- Tombol Aksi --}}
                <div class="button-group" style="width: 100%;">
                    
                    <a href="{{ route('konsultasi.whatsapp') }}" class="btn-primary-custom">
                        <i class="fab fa-whatsapp" style="margin-right: 8px; font-size: 18px;"></i>
                        Konsultasi Psikolog
                    </a>

                    <a href="{{ route('deteksi.index') }}" class="btn-secondary-custom">
                        <i data-feather="refresh-cw" style="margin-right: 8px; width: 18px; height: 18px;"></i>
                        Ulangi Deteksi
                    </a>
                </div>

            </div>
        </div>
    </div>
    {{-- End Wrapper --}}

</div>

@endsection

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush