@extends('layouts.main')
@section('title', 'Infografis')

@push('styles')
    <style>
        .infografis-section {
            padding: 120px 20px 60px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .infografis-section {
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

        /* Masonry Grid Layout */
        .infografis-grid {
            columns: 3;
            column-gap: 2rem;
        }

        @media (max-width: 1024px) {
            .infografis-grid {
                columns: 2;
            }
        }

        @media (max-width: 640px) {
            .infografis-grid {
                columns: 1;
            }
        }

        .infografis-item {
            break-inside: avoid;
            margin-bottom: 2rem;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .infografis-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .eh .infografis-item {
            background: #1f2937;
            border: 1px solid #374151;
        }

        .infografis-image {
            width: 100%;
            height: auto;
            display: block;
            position: relative;
        }

        .infografis-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.7));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .infografis-item:hover .infografis-overlay {
            opacity: 1;
        }

        .infografis-content {
            padding: 1.25rem;
        }

        .infografis-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .eh .infografis-title {
            color: white;
        }

        .infografis-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: #dbeafe;
            color: #1e40af;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            margin-bottom: 0.75rem;
        }

        .eh .infografis-category {
            background-color: #1e3a8a;
            color: #93c5fd;
        }

        .infografis-description {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .eh .infografis-description {
            color: #d1d5db;
        }

        /* Download Button */
        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background-color: #004780;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .download-btn:hover {
            background-color: #004780;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .download-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Modal Lightbox */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            position: relative;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
        }

        .modal-close {
            position: absolute;
            top: -3rem;
            right: 0;
            background: white;
            color: black;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 24px;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            transform: scale(1.1);
            background: #f3f4f6;
        }
    </style>
@endpush

@section('content')
    {{-- Wrapper dengan x-data untuk menangani state Modal secara lokal --}}
    <div x-data="{ modalOpen: false, modalImage: '' }">

        <main class="infografis-section">

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
                <h1>Infografis Kesehatan Mental</h1>
                <p>Informasi visual yang mudah dipahami tentang kesehatan mental</p>
            </div>

            <div class="infografis-grid">
                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://i.pinimg.com/originals/24/ce/f9/24cef9502f4ad8b23fe12c140cfe2f05.jpg'">
                    <div style="position: relative;">
                        <img src="https://i.pinimg.com/originals/24/ce/f9/24cef9502f4ad8b23fe12c140cfe2f05.jpg"
                            alt="5 Cara Mengatasi Stress" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">Kesehatan Jasmani</h3>
                        <p class="infografis-description">
                            Sehat jasamni
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>

                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://i.pinimg.com/originals/c1/b8/99/c1b89984a3d1292526d983082e10a416.png'">
                    <div style="position: relative;">
                        <img src="https://i.pinimg.com/originals/c1/b8/99/c1b89984a3d1292526d983082e10a416.png"
                            alt="Mengenal Gejala Depresi" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">Kesehatan jiwa</h3>
                        <p class="infografis-description">
                            yoyoyo
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>

                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://i.pinimg.com/736x/27/23/12/272312481927ea0cb98db4e843f7cb6d.jpg'">
                    <div style="position: relative;">
                        <img src="https://i.pinimg.com/736x/27/23/12/272312481927ea0cb98db4e843f7cb6d.jpg"
                            alt="Pentingnya Self Care" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">Kesehatan Mental</h3>
                        <p class="infografis-description">
                            PENTING BGT MENTAL
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>

                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://cdn.antaranews.com/cache/infografis/1140x2100/2024/04/05/20240405-angkutan-kapal-lebaran-2024.jpg'">
                    <div style="position: relative;">
                        <img src="https://cdn.antaranews.com/cache/infografis/1140x2100/2024/04/05/20240405-angkutan-kapal-lebaran-2024.jpg"
                            alt="Mindfulness untuk Pemula" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">kesehatan rohani</h3>
                        <p class="infografis-description">
                            olahraga , lari, gym
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>

                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://marketplace.canva.com/EAFmCxCs164/2/0/1067w/canva-biru-dan-putih-scrapbook-manfaat-minum-susu-infografis-pin-pinterest-AM0imSXS6iE.jpg'">
                    <div style="position: relative;">
                        <img src="https://marketplace.canva.com/EAFmCxCs164/2/0/1067w/canva-biru-dan-putih-scrapbook-manfaat-minum-susu-infografis-pin-pinterest-AM0imSXS6iE.jpg"
                            alt="Kesehatan Mental di Tempat Kerja" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">Sehat badannya</h3>
                        <p class="infografis-description">
                            menjaga kesehatan badna.
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>

                <div class="infografis-item"
                    @click="modalOpen = true; modalImage = 'https://i.pinimg.com/originals/e9/d3/ff/e9d3ff2e92866e2457138a82620d55ea.png'">
                    <div style="position: relative;">
                        <img src="https://i.pinimg.com/originals/e9/d3/ff/e9d3ff2e92866e2457138a82620d55ea.png"
                            alt="Komunikasi Sehat dalam Hubungan" class="infografis-image">
                        <div class="infografis-overlay">
                            <span style="color: white; font-weight: 600;">Klik untuk memperbesar</span>
                        </div>
                    </div>
                    <div class="infografis-content">
                        <h3 class="infografis-title">asep</h3>
                        <p class="infografis-description">
                            yoi
                        </p>
                        <a href="#" class="download-btn" @click.stop>
                            <i data-feather="download"></i>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </main>

        {{-- Modal Image Viewer --}}
        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="modalOpen = false" class="modal-overlay" style="display: none;">
            <div class="modal-content" @click.stop>
                <button @click="modalOpen = false" class="modal-close">&times;</button>
                <img :src="modalImage" alt="Infografis">
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush