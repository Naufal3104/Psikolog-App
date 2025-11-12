@extends('layouts.main')

@section('title', 'Buat Pertanyaan Baru - Tanya Psikolog')
@section('page-slug', 'buat-pertanyaan-psikolog')

@push('styles')
<style>
    .centered-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 100px);
        padding: 40px 0;
        width: 100%;
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
                    <div class="form-group">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <textarea id="pertanyaan" name="pertanyaan" class="form-textarea"
                            placeholder="Tuliskan pertanyaan Anda di sini..." required>{{ old('pertanyaan') }}</textarea>
                        @error('pertanyaan')
                            <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori" class="form-label">Kategori (Opsional)</label>
                        <input type="text" id="kategori" name="kategori" class="form-input"
                            placeholder="Contoh: Kecemasan, Hubungan, Stres, dll"
                            value="{{ old('kategori') }}">
                        @error('kategori')
                            <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="submit-button">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
