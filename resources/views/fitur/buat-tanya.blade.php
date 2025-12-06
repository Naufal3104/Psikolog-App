@extends('layouts.main')
@section('title', 'Tanya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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

        .card-header {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 1rem;
            color: #374151;
            transition: border-color 0.15s ease-in-out,
                box-shadow 0.15s ease-in-out;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #004780;
            box-shadow: 0 0 0 3px rgba(0, 71, 128, 0.25);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 12px 28px;
            border-radius: 12px;
            background-color: #004780;
            color: white;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            font-size: 1.1rem;
        }

        .submit-button:hover {
            background-color: #003666;
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 12px 28px;
            border-radius: 12px;
            background-color: #6b7280;
            color: white;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            font-size: 1.1rem;
            text-align: center;
            margin-top: 12px;
        }

        .back-button:hover {
            background-color: #4b5563;
        }

        /* Dark Mode Styles */
        .eh .consultation-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
        }

        .eh .form-label {
            color: #d1d5db !important;
        }

        .eh .form-input,
        .eh .form-textarea {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
            color: #d1d5db !important;
        }

        .eh .form-input::placeholder,
        .eh .form-textarea::placeholder {
            color: #9ca3af !important;
        }

        .eh .form-input:focus,
        .eh .form-textarea:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.25) !important;
        }

        .eh .submit-button {
            background-color: #3b82f6 !important;
        }

        .eh .submit-button:hover {
            background-color: #2563eb !important;
        }

        .eh .back-button {
            background-color: #4b5563 !important;
        }

        .eh .back-button:hover {
            background-color: #374151 !important;
        }
    </style>
@endpush

@section('content')
    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Buat Pertanyaan</h2>
                </div>

                <form action="{{ route('tanya.store') }}" method="POST">
                    @csrf
                    <div style="padding: 24px;">
                        
                        <!-- [BARU] Input untuk Judul Pertanyaan -->
                        <div class="form-group">
                            <label for="judul_pertanyaan" class="form-label">Judul Pertanyaan</label>
                            <input type="text" id="judul_pertanyaan" name="judul_pertanyaan" class="form-input" 
                                   placeholder="Tuliskan judul singkat pertanyaan Anda..." 
                                   value="{{ old('judul_pertanyaan') }}" required>
                            @error('judul_pertanyaan')
                                <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- [LAMA] Textarea untuk Pertanyaan -->
                        <div class="form-group">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <textarea id="pertanyaan" name="pertanyaan" class="form-textarea" placeholder="Tuliskan pertanyaan Anda di sini..."
                                required>{{ old('pertanyaan') }}</textarea>
                            @error('pertanyaan')
                                <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="submit-button">Kirim</button>
                        <a href="{{ url()->previous() }}" class="back-button">Kembali</a>
                    </div>
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