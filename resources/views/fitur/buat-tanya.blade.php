@extends('layouts.main')
@section('title', 'Tanya Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* --- Layout & Card --- */
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
            padding: 120px 20px 60px 20px;
            width: 100%;
            background-color: #f9fafb;
            /* Sedikit abu-abu agar kartu menonjol */
        }

        .dark .centered-content {
            background-color: #111827;
        }

        .consultation-card {
            max-width: 500px;
            width: 100%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .card-header {
            background-color: #004780;
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
            position: relative;
        }

        /* --- Form Elements --- */
        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 1rem;
            color: #1f2937;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #004780;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 71, 128, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        /* --- Buttons --- */
        .submit-button {
            display: flex;
            /* Supaya icon loading bisa ditengah */
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 14px 28px;
            border-radius: 12px;
            background-color: #004780;
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .submit-button:hover {
            background-color: #003666;
        }

        /* Style khusus saat tombol Disabled / Loading */
        .submit-button:disabled {
            background-color: #9ca3af;
            /* Abu-abu */
            cursor: not-allowed;
            opacity: 0.8;
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 14px 28px;
            border-radius: 12px;
            background-color: transparent;
            color: #6b7280;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .back-button:hover {
            color: #374151;
            background-color: #f3f4f6;
        }

        /* --- Dark Mode Support (Manual) --- */
        .eh .consultation-card {
            background-color: #1f2937;
            border-color: #374151;
        }

        .eh .form-label {
            color: #e5e7eb;
        }

        .eh .form-input,
        .eh .form-textarea {
            background-color: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }

        .eh .form-input:focus,
        .eh .form-textarea:focus {
            background-color: #1f2937;
        }

        .eh .back-button {
            color: #9ca3af;
        }

        .eh .back-button:hover {
            color: #e5e7eb;
            background-color: #374151;
        }
    </style>
@endpush

@section('content')
    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="consultation-card">

                {{-- Header --}}
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700;">Buat Pertanyaan</h2>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 0.9rem;">Konsultasi dengan Psikolog atau Komunitas
                    </p>
                </div>

                {{-- Form dengan Alpine.js untuk Loading State --}}
                <form action="{{ route('tanya.store') }}" method="POST" class="card-body" x-data="{ loading: false }"
                    @submit="loading = true">
                    @csrf

                    {{-- Input Judul --}}
                    <div class="form-group">
                        <label for="judul_pertanyaan" class="form-label">Judul Pertanyaan</label>
                        <input type="text" id="judul_pertanyaan" name="judul_pertanyaan" class="form-input"
                            placeholder="Contoh: Cara mengatasi cemas berlebih" value="{{ old('judul_pertanyaan') }}"
                            required>
                        @error('judul_pertanyaan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Input Pertanyaan --}}
                    <div class="form-group">
                        <label for="pertanyaan" class="form-label">Detail Pertanyaan</label>
                        <textarea id="pertanyaan" name="pertanyaan" class="form-textarea"
                            placeholder="Ceritakan keluhan Anda secara lengkap di sini..." required>{{ old('pertanyaan') }}</textarea>
                        @error('pertanyaan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="submit-button" :disabled="loading">
                        {{-- Teks Normal --}}
                        <span x-show="!loading">
                            <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Kirim
                        </span>

                        {{-- Teks Loading --}}
                        <span x-show="loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Mengirim...
                        </span>
                    </button>

                    {{-- Tombol Kembali --}}
                    <a href="{{ url()->previous() }}" class="back-button">Batal & Kembali</a>
                </form>
            </div>
        </section>

        @push('scripts')
            <script>
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            </script>
        @endpush
    </div>
@endsection
