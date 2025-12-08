@extends('layouts.main')
@section('title', 'Deteksi Dini')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 250px);
            padding: 40px 0;
            width: 100%;
        }

        /* Wrapper baru untuk mensejajarkan tombol kembali dan card */
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
            transition: all 0.3s ease;
        }

        .eh .detection-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
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

        .menu-item-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            text-decoration: none;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s ease-in-out;
        }

        .menu-item-link:last-child {
            border-bottom: none;
        }

        .menu-item-link:hover {
            background-color: #f9fafb;
            color: #004780;
        }

        /* Dark Mode for Menu Items */
        .eh .menu-item-link {
            color: #d1d5db;
            border-bottom-color: #374151;
        }

        .eh .menu-item-link:hover {
            background-color: #374151;
            color: #93c5fd;
        }

        .eh .menu-item-link .arrow-icon {
            color: #9ca3af;
        }

        .menu-item-link:hover .arrow-icon {
            color: #004780;
        }

        .item-text {
            font-size: 1rem;
            font-weight: 500;
        }

        .arrow-icon {
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
        }
    </style>
@endpush

@section('content')

    <x-layout.navbar />

    <div class="bb ze ki xn 2xl:ud-px-0 jb">
        <section class="centered-content">

            {{-- Wrapper Pembungkus --}}
            <div class="content-wrapper">

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

                {{-- 2. KARTU DETEKSI --}}
                <div class="detection-card">
                    <div class="card-header-detection">
                        Deteksi Dini
                    </div>

                    <div style="padding: 0;">
                        @foreach ($kategori_deteksi as $item)
                            <a href="{{ route('deteksi.show', $item->id) }}" class="menu-item-link">
                                <span class="item-text">{{ $item->nama_kategori }}</span>
                                <i data-feather="chevron-right" class="arrow-icon"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script>
        feather.replace();
    </script>
@endpush