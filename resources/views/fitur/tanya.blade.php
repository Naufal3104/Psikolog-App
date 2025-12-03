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

        .question-item {
            display: flex;
            align-items: center;
            /* [PENTING] Ini membuat Kiri (Vote) dan Kanan (Konten) sejajar di tengah secara vertikal */
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.1s;
            text-decoration: none;
            color: inherit;
        }

        /* Kolom Vote (Kiri) */
        .vote-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Tengahkan ikon dan angka secara horizontal */
            justify-content: center;
            /* Tengahkan ikon dan angka secara vertikal */
            min-width: 60px;
            /* Beri lebar pasti agar tidak goyang */
            margin-right: 16px;
            /* Jarak antara Vote dan Konten */
            height: 100%;
            /* Pastikan tinggi mengikuti container */
        }

        .vote-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            transition: color 0.2s;
        }

        /* Reset tombol vote agar rapi */
        .vote-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            /* Beri sedikit ruang klik */
            display: flex;
            /* Pastikan icon di tengah tombol */
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

        /* Kolom Konten (Kanan) */
        .content-section {
            flex-grow: 1;
            display: flex;
            gap: 16px;
            text-decoration: none;
            /* Agar link tidak bergaris bawah */
            color: inherit;
        }

        /* Wrapper link agar area teks tetap bisa diklik */
        .content-link-wrapper {
            display: flex;
            align-items: center;
            /* [PENTING] Sejajarkan Avatar dan Teks di tengah */
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
    </style>
@endpush

@section('content')

    <x-layout.navbar />

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Tanya Psikolog</h2>
                </div>

                <div style="padding: 24px;">
                    <div style="margin-bottom: 24px;">
                        <a href="{{ route('tanya.create') }}" class="ask-button">
                            <i data-feather="plus" style="width: 20px; height: 20px;"></i>
                            Buat Pertanyaan
                        </a>
                    </div>

                    <div class="questions-list">
                        @forelse ($tanya as $item)
                            <div class="question-item">

                                {{-- BAGIAN KIRI: VOTING --}}
                                <div class="vote-section">
                                    {{-- Tombol Upvote --}}
                                    <form action="{{ route('tanya.upvote', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="vote-btn" title="Upvote">
                                            <i data-feather="chevron-up" style="width: 32px; height: 32px;"></i>
                                        </button>
                                    </form>

                                    {{-- Angka Vote --}}
                                    <span class="vote-count">{{ $item->vote_count }}</span>

                                    {{-- Tombol Downvote --}}
                                    <form action="{{ route('tanya.downvote', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="vote-btn" title="Downvote">
                                            <i data-feather="chevron-down" style="width: 32px; height: 32px;"></i>
                                        </button>
                                    </form>
                                </div>

                                {{-- BAGIAN KANAN: KONTEN (Bisa diklik menuju detail) --}}
                                <a href="{{ route('tanya.show', $item->id) }}" class="content-link-wrapper">
                                    <div class="avatar-placeholder">
                                        <i data-feather="user" style="width: 20px; height: 20px;"></i>
                                    </div>
                                    <div>
                                        <div class="question-title">
                                            {{ $item->judul_pertanyaan }}
                                        </div>
                                        <div class="question-excerpt">
                                            <em
                                                class="{{ $item->status == 'Sudah Dijawab' ? 'text-green-600' : 'text-gray-500' }}">
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
                            <p style="text-align: center; color: #6b7280; padding: 20px;">Belum ada pertanyaan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Pagination jika kamu pakai paginate() --}}
                @if (method_exists($tanya, 'links'))
                    <div class="pagination">
                        {{ $tanya->links() }}
                    </div>
                @endif
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
