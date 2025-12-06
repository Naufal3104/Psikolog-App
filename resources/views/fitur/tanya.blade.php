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
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background-color 0.1s;
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
                            <a href="{{ route('tanya.show', $item->id) }}" class="question-item">
                                <div class="avatar-placeholder">
                                    <i data-feather="user" style="width: 20px; height: 20px;"></i>
                                </div>
                                <div>
                                    <div class="question-title">
                                        {{ $item->judul_pertanyaan }}
                                    </div>
                                    <div class="question-excerpt">
                                        @if ($item->jawaban)
                                            <strong>Jawaban Psikolog:</strong> {{ Str::limit($item->jawaban, 100) }}
                                        @else
                                            <em>Belum dijawab oleh psikolog.</em>
                                        @endif
                                    </div>
                                    <div style="font-size: 0.75rem; color: #9ca3af; margin-top: 6px;">
                                        oleh {{ $item->user->name ?? 'Anonim' }}
                                        @if ($item->psikiater)
                                            • dijawab oleh {{ $item->psikiater->name ?? '-' }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p style="text-align: center; color: #6b7280;">Belum ada pertanyaan.</p>
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