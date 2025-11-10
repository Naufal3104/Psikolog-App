@extends('layouts.main')

@section('title', 'Konsultasi Psikolog - RSUD Jombang')
@section('page-slug', 'konsultasi')

@push('styles')
    <style>
        
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 200px); 
            
            padding: 40px 0; 
            width: 100%;
        }

        .icon-small {
            /* ... */
        }
        .consultation-card {
            max-width: 400px;
            width: 90%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
            .eh & {
                background-color: #1f2937 !important;
                border-color: #4b5563 !important;
            }
        }
        .card-header {
            background-color: #004780 !important; 
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }
        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border-radius: 9999px;
            background-color: #10a884 !important;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
            gap: 10px;
        }
        .whatsapp-button:hover {
            background-color: #0c7a5f !important;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 9999px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            font-size: 0.875rem;
            color: #6b7280;
            margin: 4px;
            .eh & {
                background-color: #374151;
                border-color: #4b5563;
                color: #d1d5db;
            }
            .eh & .icon-small {
                color: #93c5fd;
            }
        }
    </style>
@endpush

@section('content')

    <div class="bb ze ki xn 2xl:ud-px-0 jb">
        <section class="centered-content">
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Konsultasi Psikolog</h2>
                </div>
                <div style="padding: 32px 24px;">
                    <p style="text-align: center; margin-bottom: 32px; color: #4b5563;" class="dark:text-gray-300">
                        Dapatkan layanan konsultasi psikologi via WhatsApp bersama psikolog profesional!
                    </p>
                    <div style="text-align: center; margin-bottom: 32px;">
                        <a href="https://wa.me/nomorwhatsappanda" target="_blank" class="whatsapp-button">
                            <i class="fab fa-whatsapp" style="font-size: 20px;"></i> 
                            KLIK DISINI
                        </a>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 4px; font-size: 0.875rem; color: #6b7280;">
                        <span class="badge">
                            <i data-feather="lock" class="icon-small"></i>
                            Privasi Terjamin
                        </span>
                        <span class="badge">
                            <i data-feather="clock" class="icon-small"></i>
                            Respon Cepat
                        </span>
                        <span class="badge">
                            <i data-feather="user-check" class="icon-small"></i>
                            Psikolog Berpengalaman
                        </span>
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