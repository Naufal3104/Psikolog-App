@extends('layouts.main')

@section('title', $kategori->nama_kategori)
@section('page-slug', 'deteksi')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Ubah ke flex-start agar scroll aman jika konten panjang */
            min-height: calc(100vh - 150px);
            padding: 40px 0;
            width: 100%;
        }

        /* Wrapper baru agar tombol kembali sejajar dengan card */
        .content-wrapper {
            width: 95%;
            max-width: 450px;
            display: flex;
            flex-direction: column;
            gap: 16px; /* Jarak antara tombol dan card */
        }

        .detection-card {
            width: 100%; /* Lebar mengikuti wrapper */
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -4px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .card-header-detection {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        .card-body-detection {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .question-text {
            font-size: 1rem;
            color: #374151;
            margin-bottom: 0.75rem;
            display: block;
        }

        .input-text {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .input-text:focus {
            border-color: #004780;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 71, 128, 0.25);
        }

        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            cursor: pointer;
            position: relative;
        }

        .radio-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .radio-custom {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #9ca3af;
            display: inline-block;
            margin-right: 8px;
            position: relative;
            transition: all 0.2s ease;
        }

        .radio-option input[type="radio"]:checked+.radio-custom {
            border-color: #004780;
            background-color: #004780;
        }

        .radio-option input[type="radio"]:checked+.radio-custom::after {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .radio-label {
            font-size: 1rem;
            color: #374151;
            user-select: none;
        }

        .submit-button {
            display: flex;
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

        .eh .detection-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
            color: #d1d5db;
        }

        .eh .question-text {
            color: #d1d5db;
        }

        .eh .input-text {
            background-color: #374151;
            border-color: #4b5563;
            color: #d1d5db;
        }

        .eh .radio-custom {
            border-color: #6b7280;
        }

        .eh .radio-option input[type="radio"]:checked+.radio-custom {
            border-color: #93c5fd;
            background-color: #93c5fd;
        }

        .eh .radio-option input[type="radio"]:checked+.radio-custom::after {
            background: #1f2937;
        }

        .eh .radio-label {
            color: #d1d5db;
        }

        .submit-button:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.8;
        }
    </style>
@endpush

@section('content')

    <div class="bb ze ki xn 2xl:ud-px-0 jb">
        <section class="centered-content">

            {{-- Wrapper Pembungkus --}}
            <div class="content-wrapper">

                {{-- 1. TOMBOL KEMBALI --}}
                <div>
                    <a href="{{ route('deteksi.index') }}" 
                       class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Kembali
                    </a>
                </div>

                {{-- 2. KARTU PERTANYAAN (FORM) --}}
                <form action="{{ route('deteksi.process') }}" method="POST" class="detection-card" x-data="{ loading: false }"
                    @submit="loading = true">
                    @csrf
                    <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">

                    <div class="card-header-detection">
                        {{ $kategori->nama_kategori }}
                    </div>

                    <div class="card-body-detection">
                        <div class="form-group">
                            <input type="hidden" id="nama" name="nama" class="input-text"
                                @if (auth()->check()) value="{{ auth()->user()->name }}" @endif required>
                        </div>

                        @foreach ($kategori->pertanyaan as $pertanyaan)
                            <div class="form-group">
                                <label class="question-text">
                                    {{ $loop->iteration }}. {{ $pertanyaan->teks_pertanyaan }}
                                </label>

                                @foreach ($pertanyaan->pilihanJawaban as $pilihan)
                                    <label for="q-{{ $pertanyaan->id }}-p-{{ $pilihan->id }}" class="radio-option">
                                        <input type="radio" id="q-{{ $pertanyaan->id }}-p-{{ $pilihan->id }}"
                                            name="jawaban[{{ $pertanyaan->id }}]" value="{{ $pilihan->id }}"
                                            @if ($loop->first) required @endif>
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">{{ $pilihan->teks_jawaban }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

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
                    </div>
                </form>

            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush