@extends('layouts.main')
@section('title', 'Tulis Artikel')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: calc(100vh - 100px);
            padding: 120px 20px 60px 20px;
            width: 100%;
        }

        /* Wrapper agar tombol kembali sejajar dengan card */
        .content-wrapper {
            width: 95%;
            max-width: 800px; /* Lebar sesuai kebutuhan form artikel */
            display: flex;
            flex-direction: column;
            gap: 16px; /* Jarak antara tombol dan card */
        }

        .consultation-card {
            width: 100%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .card-header {
            background-color: #004780;
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .card-body { padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; }
        
        .form-label {
            display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;
        }
        
        .form-input, .form-textarea {
            width: 100%; padding: 12px 16px; border: 1px solid #d1d5db;
            border-radius: 12px; font-size: 1rem; background-color: #f9fafb;
        }
        
        .form-textarea { min-height: 300px; } 
        
        .submit-button {
            display: flex; justify-content: center; align-items: center; width: 100%;
            padding: 14px 28px; border-radius: 12px; background-color: #004780;
            color: white; font-weight: 600; border: none; cursor: pointer; margin-top: 1rem;
        }
        
        .back-button-cancel {
            display: block; width: 100%; padding: 14px 28px; border-radius: 12px;
            background-color: transparent; color: #6b7280; font-weight: 600;
            text-align: center; margin-top: 0.5rem; text-decoration: none;
        }
        
        /* Dark Mode */
        .eh .consultation-card { background-color: #1f2937; border-color: #374151; }
        .eh .form-label { color: #e5e7eb; }
        .eh .form-input, .eh .form-textarea { background-color: #374151; border-color: #4b5563; color: white; }
        .eh .back-button-cancel { color: #9ca3af; }
    </style>
@endpush

@section('content')
<x-layout.navbar />

<div class="bb ze ki xn 2xl:ud-px-0">
    <section class="centered-content">
        
        {{-- Wrapper Pembungkus --}}
        <div class="content-wrapper">

            {{-- 1. TOMBOL KEMBALI (Di Atas Card) --}}
            <div>
                <a href="{{ route('psikolog.artikel.index') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- 2. CARD FORM --}}
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700;">Tulis Artikel Baru</h2>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 0.9rem;">Bagikan wawasan kesehatan mental Anda</p>
                </div>

                <form action="{{ route('psikolog.artikel.store') }}" method="POST" enctype="multipart/form-data" class="card-body" x-data="{ loading: false }" @submit="loading = true">
                    @csrf

                    {{-- Judul --}}
                    <div class="form-group">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="judul" class="form-input" placeholder="Judul artikel menarik..." value="{{ old('judul') }}" required>
                        @error('judul') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group">
                        <label class="form-label">Gambar Unggulan (Opsional)</label>
                        <input type="file" name="featured_image" class="form-input" accept="image/*">
                        @error('featured_image') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>

                    {{-- Keterangan Gambar --}}
                    <div class="form-group">
                        <label class="form-label">Keterangan Gambar / Sumber</label>
                        <input type="text" name="keterangan_gambar" class="form-input" 
                               placeholder="Contoh: Dokumen Pribadi / Unsplash" 
                               value="{{ old('keterangan_gambar') }}">
                        @error('keterangan_gambar') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>

                    {{-- Isi --}}
                    <div class="form-group">
                        <label class="form-label">Isi Artikel</label>
                        <textarea name="isi" class="form-textarea" placeholder="Tulis konten artikel di sini..." required>{{ old('isi') }}</textarea>
                        @error('isi') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="submit-button" :disabled="loading">
                        <span x-show="!loading"><i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Terbitkan</span>
                        <span x-show="loading" style="display: none;">Mengunggah...</span>
                    </button>

                    {{-- Tombol Batal (di bawah) --}}
                    <a href="{{ route('psikolog.artikel.index') }}" class="back-button-cancel">Batal</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection