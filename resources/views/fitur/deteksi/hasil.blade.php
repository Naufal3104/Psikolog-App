@extends('layouts.main')

@section('title', 'Hasil Deteksi Dini Psikologis - RSUD Jombang')
@section('page-slug', 'deteksi')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 150px); 
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
            font-family: 'Inter', sans-serif;
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

        .card-body-detection {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .score-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }

        .score-circle {
            width: 120px;
            height: 120px;
            background-color: #004780; 
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 3rem;
            font-weight: bold;
            color: white;
            box-shadow: 0 0 0 5px rgba(0, 71, 128, 0.2); 
        }

        .result-message {
            text-align: center;
            font-size: 1rem;
            color: #374151; 
            margin-bottom: 2rem;
            line-height: 1.5;
        }
        
        .result-message strong {
            color: #004780;
        }

        .level-criteria {
            background-color: #f3f4f6; 
            padding: 1.25rem;
            border-radius: 12px;
            text-align: center;
            font-size: 0.875rem;
            color: #4b5563;
            margin-bottom: 2rem;
            width: 100%;
        }

        .level-criteria h4 {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }
        
        .level-criteria p {
            margin: 0.25rem 0;
        }
        
        .btn-tes-lagi {
            width: 100%;
            padding: 1rem;
            background-color: #004780; 
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s;
        }

        .btn-tes-lagi:hover {
            background-color: #003666;
            transform: translateY(-1px);
        }
        
        .eh .detection-card { background-color: #1f2937 !important; border-color: #4b5563 !important; }
        .eh .score-title, .eh .result-message { color: #d1d5db; }
        .eh .level-criteria { background-color: #374151; color: #a1a1aa; }
        .eh .level-criteria h4 { color: #e5e7eb; }
        .eh .btn-tes-lagi { background-color: #3b82f6; }
        .eh .btn-tes-lagi:hover { background-color: #2563eb; }
    </style>
@endpush

@section('content')

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="detection-card">
                
                <div class="card-header-detection">
                    Hasil Deteksi Dini
                </div>

                <div class="card-body-detection">
                    
                    <h3 class="score-title">Skor Anda</h3>
                    
                    <div class="score-circle">
                        @php
                            $score = $score ?? -1; 
                        @endphp
                        {{ $score }}
                    </div>
                    
                    @php
                        $name = $name ?? 'Pasien'; 
                        $result_message = $result_message ?? 'Silahkan konsultasi lebih lanjut'; 
                        
                        $level = 'Sangat Rendah';
                        if ($score >= 1 && $score <= 5) $level = 'Rendah';
                        else if ($score >= 6 && $score <= 10) $level = 'Sedang';
                        else if ($score >= 11) $level = 'Tinggi';
                        
                        $custom_message = "Anda terdeteksi memiliki level stres: <strong>{$level}</strong>, {$name}! {$result_message}";
                        if ($score <= 0) {
                             $custom_message = "Anda terdeteksi memiliki level stres: <strong>Tidak Terdeteksi</strong>, {$name}! {$result_message}";
                        }
                    @endphp
                    
                    <p class="result-message">
                       {!! $custom_message !!}
                    </p>

                    <div class="level-criteria">
                        <h4>Perhitungan Level Stres</h4>
                        <p>Skor 1 - 5 = Rendah</p>
                        <p>Skor 6 - 10 = Sedang</p>
                        <p>Skor 11 - 15 = Tinggi</p>
                    </div>
                    
                    <a href="{{ route('deteksi.stress') }}" class="btn-tes-lagi">
                        Tes Lagi
                    </a>
                    
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

        // alert(`Hasil untuk {{ $name ?? 'Pengguna' }} adalah skor {{ $score ?? 'N/A' }}.`);
    </script>
@endpush
