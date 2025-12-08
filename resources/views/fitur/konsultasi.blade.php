@extends('layouts.main')
@section('title', 'Konsultasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 200px);
            padding: 120px 20px 60px 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .centered-content {
                padding: 100px 20px 40px 20px;
            }
        }

        .content-wrapper {
            width: 90%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .consultation-card {
            width: 100%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .consultation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.25), 0 10px 15px -4px rgba(0, 0, 0, 0.1);
        }

        .eh .consultation-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
        }

        .card-header {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border-radius: 9999px;
            background-color: #10a884 !important;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 10px;
        }

        .whatsapp-button.offline {
            background-color: #6b7280 !important; /* Warna abu-abu jika offline */
            cursor: not-allowed;
        }

        .whatsapp-button:not(.offline):hover {
            background-color: #0c7a5f !important;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(16, 168, 132, 0.3);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 9999px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            font-size: 0.875rem;
            color: #6b7280;
            margin: 4px;
            transition: all 0.2s ease;
        }

        .badge:hover {
            background-color: #e5e7eb;
            transform: translateY(-2px);
        }

        .eh .badge {
            background-color: #374151;
            border-color: #4b5563;
            color: #d1d5db;
        }

        .eh .badge .icon-small {
            color: #93c5fd;
        }

        .icon-small {
            width: 16px;
            height: 16px;
            margin-right: 4px;
        }
    </style>
@endpush

@section('content')

    <x-layout.navbar />

    <div class="centered-content">
        
        <div class="content-wrapper">

            {{-- 1. TOMBOL KEMBALI --}}
            <div>
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- 2. KARTU KONSULTASI --}}
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Konsultasi Psikolog</h2>
                </div>
                <div style="padding: 32px 24px;">
                    
                    {{-- Logika Tampilan Status --}}
                    @if($jadwalAktif)
                        {{-- JIKA ADA PSIKOLOG JAGA --}}
                        <p style="text-align: center; margin-bottom: 8px; color: #4b5563;" class="dark:text-gray-300">
                            Sekarang sedang berlangsung sesi jaga:
                        </p>
                        <p style="text-align: center; margin-bottom: 24px; font-weight: bold; color: #004780;" class="dark:text-blue-400">
                            {{ $jadwalAktif->user->name }}
                        </p>
                        
                        {{-- Ambil nomor WA via Accessor yang kita buat sebelumnya --}}
                        @php
                            $targetPhone = $jadwalAktif->user->no_telp ?? $nomorDefault;
                            $pesan = "Halo Kak " . $jadwalAktif->user->name . ", saya ingin konsultasi.";
                        @endphp

                        <div style="text-align: center; margin-bottom: 32px;">
                            <a href="https://wa.me/{{ $targetPhone }}?text={{ urlencode($pesan) }}" target="_blank" class="whatsapp-button">
                                <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                                CHAT SEKARANG
                            </a>
                        </div>
                    @else
                        {{-- JIKA TIDAK ADA JADWAL --}}
                        <p style="text-align: center; margin-bottom: 32px; color: #4b5563;" class="dark:text-gray-300">
                            Maaf, saat ini belum ada psikolog yang berjaga. Silakan hubungi Admin untuk info jadwal.
                        </p>
                        <div style="text-align: center; margin-bottom: 32px;">
                            <a href="https://wa.me/{{ $nomorDefault }}?text=Halo%20Admin,%20kapan%20jadwal%20psikolog%20tersedia?" target="_blank" class="whatsapp-button" style="background-color: #4b5563 !important;">
                                <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                                HUBUNGI ADMIN
                            </a>
                        </div>
                    @endif

                    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 4px; font-size: 0.875rem; color: #6b7280;">
                        <span class="badge">
                            <i data-feather="lock" class="icon-small"></i>
                            Privasi Terjamin
                        </span>
                        <span class="badge">
                            <i data-feather="clock" class="icon-small"></i>
                            Respon Cepat
                        </span>
                        <span class="badge">
                            <i data-feather="user-check" class="icon-small"></i>
                            Psikolog Berpengalaman
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        feather.replace();
    </script>
@endpush