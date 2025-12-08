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
            align-items: flex-start;
            min-height: calc(100vh - 100px);
            padding: 120px 20px 60px 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .centered-content {
                padding: 100px 20px 40px 20px;
            }
        }

        .layout-wrapper {
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 15px;
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

        .card-header {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        .ask-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 28px;
            border-radius: 12px;
            background-color: #10a884;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
            gap: 8px;
            border: none;
        }

        .ask-button:hover {
            background-color: #0c7a5f;
        }

        /* --- STYLE FORM PENCARIAN & FILTER --- */
        .search-form {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        /* Style Input Search */
        .search-input {
            flex: 1; /* Mengisi ruang yang tersedia */
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            background-color: #f9fafb;
            transition: border-color 0.2s;
        }

        /* Style Select Filter (Baru) */
        .filter-select {
            width: 140px; /* Lebar fix untuk dropdown */
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 0.9rem;
            background-color: #f9fafb;
            color: #374151;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .search-input:focus, .filter-select:focus {
            outline: none;
            border-color: #004780;
            background-color: white;
        }

        .search-button {
            padding: 0 16px;
            border-radius: 10px;
            background-color: #004780;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-button:hover {
            background-color: #00335c;
        }

        .question-item {
            display: flex;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.1s;
            text-decoration: none;
            color: inherit;
        }

        .vote-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 60px;
            margin-right: 16px;
            height: 100%;
        }

        .vote-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            transition: color 0.2s ease;
        }

        .vote-count {
            font-weight: 700;
            font-size: 1.1rem;
            color: #374151;
            margin: 4px 0;
            text-align: center;
            line-height: 1;
        }

        .content-link-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
            width: 100%;
            text-decoration: none;
            color: inherit;
        }

        .question-item:hover {
            background-color: #f9fafb;
        }

        .avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #6b7280;
        }

        .question-title {
            font-weight: bold;
            font-size: 1rem;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .question-excerpt {
            font-size: 0.875rem;
            color: #6b7280;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 16px 0;
            border-top: 1px solid #f3f4f6;
        }

        .pagination-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            margin: 0 4px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            color: #4b5563;
            background-color: #f3f4f6;
            transition: background-color 0.1s, color 0.1s;
        }

        .pagination-link:hover:not(.active) {
            background-color: #e5e7eb;
        }

        .pagination-link.active {
            background-color: #004780;
            color: white;
        }

        /* Dark Mode Styles */
        .eh .consultation-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
        }

        .eh .ask-button {
            background-color: #059669 !important;
        }

        .eh .ask-button:hover {
            background-color: #047857 !important;
        }

        .eh .search-input, .eh .filter-select {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
            color: #f3f4f6 !important;
        }

        .eh .search-input:focus, .eh .filter-select:focus {
            border-color: #3b82f6 !important;
        }

        .eh .search-button {
            background-color: #3b82f6 !important;
        }

        .eh .search-button:hover {
            background-color: #2563eb !important;
        }

        .eh .question-item {
            border-bottom-color: #374151 !important;
            color: #d1d5db !important;
        }

        .eh .question-item:hover {
            background-color: #374151 !important;
        }

        .eh .avatar-placeholder {
            background-color: #374151 !important;
            color: #9ca3af !important;
        }

        .eh .question-title {
            color: #f3f4f6 !important;
        }

        .eh .question-excerpt {
            color: #9ca3af !important;
        }

        .eh .pagination {
            border-top-color: #374151 !important;
        }

        .eh .pagination-link {
            background-color: #374151 !important;
            color: #d1d5db !important;
        }

        .eh .pagination-link:hover:not(.active) {
            background-color: #4b5563 !important;
        }

        .eh .pagination-link.active {
            background-color: #3b82f6 !important;
            color: white !important;
        }
    </style>
@endpush

@section('content')

    <x-layout.navbar />

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            
            {{-- Wrapper untuk Layout --}}
            <div class="layout-wrapper">

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

                {{-- KARTU UTAMA --}}
                <div class="consultation-card">
                    <div class="card-header">
                        <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Tanya Psikolog</h2>
                    </div>

                    <div style="padding: 24px;">
                        {{-- Tombol Buat Pertanyaan --}}
                        <div style="margin-bottom: 16px;">
                            <a href="{{ route('tanya.create') }}" class="ask-button">
                                <i data-feather="plus" style="width: 20px; height: 20px;"></i>
                                Buat Pertanyaan
                            </a>
                        </div>

                        {{-- Form Pencarian & Filter (BARU) --}}
                        <form action="{{ route('tanya.index') }}" method="GET" class="search-form">
                            
                            {{-- Input Pencarian --}}
                            <input type="text" name="search" class="search-input" 
                                   placeholder="Cari pertanyaan..." 
                                   value="{{ request('search') }}">

                            {{-- Dropdown Filter (BARU) --}}
                            <select name="filter" class="filter-select">
                                <option value="semua" {{ request('filter') == 'semua' ? 'selected' : '' }}>Semua</option>
                                <option value="belum_dijawab" {{ request('filter') == 'belum_dijawab' ? 'selected' : '' }}>Belum Dijawab</option>
                                <option value="sudah_dijawab" {{ request('filter') == 'sudah_dijawab' ? 'selected' : '' }}>Sudah Dijawab</option>
                            </select>

                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        {{-- Daftar Pertanyaan --}}
                        <div class="questions-list">
                            @forelse ($tanya as $item)
                                <div class="question-item">

                                    {{-- BAGIAN KIRI: VOTING --}}
                                    <div class="vote-section">
                                        <form action="{{ route('tanya.upvote', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="vote-btn" title="Upvote">
                                                <i data-feather="chevron-up" style="width: 32px; height: 32px;"></i>
                                            </button>
                                        </form>

                                        <span class="vote-count">{{ $item->vote_count }}</span>

                                        <form action="{{ route('tanya.downvote', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="vote-btn" title="Downvote">
                                                <i data-feather="chevron-down" style="width: 32px; height: 32px;"></i>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- BAGIAN KANAN: KONTEN --}}
                                    <a href="{{ route('tanya.show', $item->id) }}" class="content-link-wrapper">
                                        <div class="avatar-placeholder">
                                            <i data-feather="user" style="width: 20px; height: 20px;"></i>
                                        </div>
                                        <div>
                                            <div class="question-title">
                                                {{ $item->judul_pertanyaan }}
                                            </div>
                                            <div class="question-excerpt">
                                                <em class="{{ $item->status == 'Sudah Dijawab' ? 'text-green-600' : 'text-gray-500' }}">
                                                    {{ ucfirst($item->status) }}
                                                </em>
                                            </div>
                                            <div style="font-size: 0.75rem; color: #9ca3af; margin-top: 6px;">
                                                oleh {{ $item->user->name ?? 'Anonim' }}
                                                @if ($item->psikiater)
                                                    • dijawab oleh {{ $item->psikiater->name ?? '-' }}
                                                @endif
                                                • {{ $item->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div style="text-align: center; color: #6b7280; padding: 40px 20px;">
                                    <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                    <p>Tidak ada pertanyaan ditemukan.</p>
                                    @if(request('search') || request('filter'))
                                        <a href="{{ route('tanya.index') }}" style="color: #004780; text-decoration: underline; font-size: 0.9rem; display: block; margin-top: 8px;">Reset Filter</a>
                                    @endif
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if (method_exists($tanya, 'links'))
                        <div class="pagination">
                            {{ $tanya->links() }}
                        </div>
                    @endif
                </div>

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