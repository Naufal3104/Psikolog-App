@extends('layouts.main')

@section('title', $kategori->nama_kategori)
@section('page-slug', 'deteksi')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 150px);
            padding: 40px 0;
            width: 100%;
        }

        .detection-card {
            max-width: 450px;
            width: 95%;
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

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background-color: #004780;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 1rem;
        }

        .btn-submit:hover {
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

        .eh .btn-submit {
            background-color: #3b82f6;
        }

        .eh .btn-submit:hover {
            background-color: #2563eb;
        }
    </style>
@endpush

@section('content')

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            {{-- Form akan mengirim data ke rute 'deteksi.submit' --}}
            <form action"" method="POST" class="detection-card">
                @csrf
                {{-- Input tersembunyi untuk mengirim ID kategori, penting untuk proses di backend --}}
                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">

                <div class="card-header-detection">
                    {{-- Judul kartu sekarang dinamis sesuai nama kategori --}}
                    {{ $kategori->nama_kategori }}
                </div>

                <div class="card-body-detection">
                    <div class="form-group">
                        <label for="nama" class="question-text">Nama</label>
                        <input type="text" id="nama" name="nama" class="input-text" 
                        @if (auth()->check()) 
                            value="{{ auth()->user()->name }}"
                        @endif
                            placeholder="Masukkan nama anda" required>
                    </div>
                    {{-- Lakukan perulangan untuk setiap pertanyaan yang ada di dalam $kategori --}}
                    @foreach ($kategori->pertanyaan as $pertanyaan)
                        <div class="form-group">
                            <label class="question-text">
                                {{-- $loop->iteration memberikan nomor urut 1, 2, 3, ... --}}
                                {{ $loop->iteration }}. {{ $pertanyaan->teks_pertanyaan }}
                            </label>

                            {{-- Lakukan perulangan untuk setiap pilihan jawaban dari pertanyaan saat ini --}}
                            @foreach ($pertanyaan->pilihan_jawaban as $pilihan)
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

                    <button type="submit" class="btn-submit">Selesai & Lihat Hasil</button>
                </div>
            </form>
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
