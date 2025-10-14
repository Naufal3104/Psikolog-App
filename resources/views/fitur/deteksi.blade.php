@extends('layouts.main')

@section('title', 'Deteksi Dini Psikologis - RSUD Jombang')
@section('page-slug', 'deteksi')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 250px); 
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
            transition: all 0.3s ease;

            .eh & {
                background-color: #1f2937 !important; 
                border-color: #4b5563 !important;
            }
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
            color: #374151; /* Warna teks standar */
            border-bottom: 1px solid #f3f4f6; /* Garis tipis antar item */
            transition: background-color 0.2s ease-in-out;
        }
        .menu-item-link:last-child {
            border-bottom: none; /* Hilangkan garis di item terakhir */
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

    <div class="bb ze ki xn 2xl:ud-px-0 jb">
        <section class="centered-content">
            <div class="detection-card">
                
                <div class="card-header-detection">
                    Deteksi Dini
                </div>

                <div style="padding: 0;">
                    
                    <a href="{{ route('deteksi.stress') }}" class="menu-item-link">
                        <span class="item-text">Kenali Tingkat Stress</span>
                        <i data-feather="chevron-right" class="arrow-icon"></i>
                    </a>

                    <a href="{{ route('deteksi.kesejahteraan') }}" class="menu-item-link">
                        <span class="item-text">Kesejahteraan Psikologis</span>
                        <i data-feather="chevron-right" class="arrow-icon"></i>
                    </a>
                    
                    <a href="{{ route('deteksi.belajar') }}" class="menu-item-link">
                        <span class="item-text">Gejala Kesukaran Belajar</span>
                        <i data-feather="chevron-right" class="arrow-icon"></i>
                    </a>

                    <a href="{{ route('deteksi.nikah') }}" class="menu-item-link">
                        <span class="item-text">Kesiapan Pernikahan</span>
                        <i data-feather="chevron-right" class="arrow-icon"></i>
                    </a>

                    <a href="{{ route('deteksi.putuscinta') }}" class="menu-item-link">
                        <span class="item-text">Putus Cinta</span>
                        <i data-feather="chevron-right" class="arrow-icon"></i>
                    </a>
                    
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