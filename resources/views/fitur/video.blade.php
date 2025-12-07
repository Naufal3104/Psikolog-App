@extends('layouts.main')
@section('title', 'Video')

@push('styles')
    <style>
        .video-section {
            padding: 120px 20px 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .video-section {
                padding: 100px 20px 40px 20px;
            }
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .eh .section-title h1 {
            color: white;
        }

        .section-title p {
            font-size: 1.125rem;
            color: #6b7280;
        }

        .eh .section-title p {
            color: #d1d5db;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 640px) {
            .video-grid {
                grid-template-columns: 1fr;
            }
        }

        .video-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .eh .video-card {
            background: #1f2937;
            border: 1px solid #374151;
        }

        .video-thumbnail {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            background: #000;
            overflow: hidden;
        }

        .video-thumbnail iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-content {
            padding: 1.25rem;
        }

        .video-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .eh .video-title {
            color: white;
        }

        .video-description {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .eh .video-description {
            color: #d1d5db;
        }

        .video-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e5e7eb;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .eh .video-meta {
            border-top-color: #374151;
            color: #9ca3af;
        }

        .video-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .video-meta-item svg {
            width: 16px;
            height: 16px;
        }
    </style>
@endpush

@section('content')
    <main class="video-section">
        
        {{-- TOMBOL KEMBALI --}}
        <div style="margin-bottom: 2rem;">
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="section-title">
            <h1>Video Edukasi Psikologi</h1>
            <p>Pelajari lebih lanjut tentang kesehatan mental melalui video edukatif</p>
        </div>

        <div class="video-grid">
            @foreach ($videos as $video)
                <div class="video-card">
                    <div class="video-thumbnail">
                        <iframe 
                            src="{{ $video->embed_url }}"
                            title="{{ $video->judul }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-content">
                        <h3 class="video-title">{{ $video->judul }}</h3>

                        <p class="video-description">
                            Video edukasi kategori: <strong>{{ $video->kategori }}</strong>
                        </p>

                        <div class="video-meta">
                            <div class="video-meta-item">
                                <i data-feather="user"></i>
                                <span>{{ $video->penulis->name }}</span>
                            </div>
                            <div class="video-meta-item">
                                <i data-feather="eye"></i>
                                <span>{{ $video->views }} views</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush