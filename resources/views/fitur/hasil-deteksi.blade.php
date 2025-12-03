@extends('layouts.main')
@section('title', 'Hasil Deteksi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        /* --- Layout Dasar (Sama dengan Konsultasi) --- */
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
            padding: 120px 20px 60px 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .centered-content {
                padding: 100px 20px 40px 20px;
            }
        }

        .consultation-card {
            max-width: 450px;
            width: 90%;
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
        
        /* Area Icon/Gambar di tengah */
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

        /* Teks Hasil */
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
        .text-aman { color: #10b981; } /* Hijau (70-100) */
        .text-sedang { color: #f59e0b; } /* Oranye (30-69) */
        .text-bahaya { color: #ef4444; } /* Merah (1-29) */

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
    <div class="consultation-card">
        <div class="card-header">
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Hasil Deteksi Dini</h2>
        </div>
        
        <div style="padding: 32px 24px; display: flex; flex-direction: column; align-items: center;">
            
            {{-- 1. Icon Ilustrasi --}}
            <div class="result-icon-wrapper">
                <div class="result-icon-circle">
                    <i data-feather="clipboard" style="width: 40px; height: 40px;"></i>
                </div>
            </div>

            {{-- 2. Label Hasil --}}
            <div class="result-label">
                Hasil Tes Deteksi Dini Anda:
            </div>

            {{-- LOGIC PHP: Menentukan Warna Berdasarkan Skor --}}
            @php
                $skor = $hasilDeteksi->total_skor;
                $colorClass = 'text-bahaya'; // Default jika di bawah 30 atau null

                if ($skor >= 70) {
                    $colorClass = 'text-aman';   // Hijau (70-100)
                } elseif ($skor >= 30) {
                    $colorClass = 'text-sedang'; // Oranye (30-69)
                } else {
                    $colorClass = 'text-bahaya'; // Merah (1-29)
                }
            @endphp

            {{-- 3. Teks Interpretasi (Judul Hasil) --}}
            <div class="result-value {{ $colorClass }}">
                {{ $hasilDeteksi->interpretasi->teks_interpretasi ?? 'Tidak Diketahui' }}
            </div>

            {{-- 4. Skor Deteksi --}}
            <div class="result-score">
                Skor Deteksi: <strong>{{ $hasilDeteksi->total_skor }}</strong>
            </div>

            {{-- 5. Deskripsi Hasil dari Database --}}
            <div class="result-description">
                {{ $hasilDeteksi->interpretasi->deskripsi_hasil ?? 'Belum ada deskripsi untuk hasil ini.' }}
            </div>

            {{-- 6. Tombol Aksi --}}
            <div class="button-group" style="width: 100%;">
                
                {{-- Tombol Konsultasi --}}
                <a href="{{ route('konsultasi.whatsapp') }}" class="btn-primary-custom">
                    <i class="fab fa-whatsapp" style="margin-right: 8px; font-size: 18px;"></i>
                    Konsultasi Psikolog
                </a>

                {{-- Tombol Ulangi (Pastikan route 'deteksi.index' benar di web.php Anda) --}}
                <a href="{{ route('deteksi.index') }}" class="btn-secondary-custom">
                    <i data-feather="refresh-cw" style="margin-right: 8px; width: 18px; height: 18px;"></i>
                    Ulangi Deteksi
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush