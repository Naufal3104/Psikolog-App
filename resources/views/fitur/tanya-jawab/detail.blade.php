@extends('layouts.main')

@section('title', 'Detail Pertanyaan dan Jawaban - RSUD Jombang')
@section('page-slug', 'detail-tanya-jawab-psikolog')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px); 
            padding: 40px 0; 
            width: 100%;
        }

        .consultation-card {
            max-width: 600px;
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
        
        .detail-content {
            padding: 30px;
        }

        .question-box, .answer-box {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .question-box {
            background-color: #f0f7ff;
            border: 1px solid #cce0f5;
        }

        .answer-box {
            background-color: #f7fff0;
            border: 1px solid #e0f5cc;
        }

        .box-title {
            font-weight: bold;
            font-size: 1.125rem;
            color: #1f2937;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .box-text {
            font-size: 1rem;
            line-height: 1.6;
            color: #4b5563;
        }

        .meta-info {
            font-size: 0.875rem;
            color: #9ca3af;
            margin-top: 10px;
            text-align: right;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 8px;
            background-color: #6b7280; 
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
            gap: 4px;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: #4b5563;
        }
    </style>
@endpush

@section('content')

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Detail Konsultasi Psikolog</h2>
                </div>
                
                <div class="detail-content">

                    <a href="{{ route('tanya') }}" class="back-button">
                        <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i> 
                        Kembali ke Daftar Pertanyaan
                    </a>

                    <div class="question-box">
                        <div class="box-title">
                            <i data-feather="user" style="width: 20px; height: 20px; color: #004780;"></i>
                            Pertanyaan
                        </div>
                        <div class="box-text">
                            <p style="font-weight: bold; color: #1f2937; margin-top: 0;">Asep jahat banget, dia tega ninggalin aku!</p>
                            <p style="margin-bottom: 0;">Dok, saya sedang **sakit hati**, saya baru saja diputusin pacar saya yang namanya Asep. Kami sudah pacaran 2 tahun, Dok. Saya merasa hidup saya hampa, Dok. Setiap malam saya menangis dan tidak nafsu makan. Saya nggak tahu harus bagaimana, Dok. Mohon bantuannya.</p>
                        </div>
                        <div class="meta-info">
                            Ditanyakan oleh: Anonim | Tanggal: 07 Oktober 2025
                        </div>
                    </div>

                    <div class="answer-box">
                        <div class="box-title">
                            <i data-feather="user-check" style="width: 20px; height: 20px; color: #10a884;"></i>
                            Jawaban Psikolog
                        </div>
                        <div class="box-text">
                            <p style="margin-top: 0;">Halo, terima kasih telah berani bercerita. Saya mengerti bahwa perpisahan, apalagi setelah menjalin hubungan selama 2 tahun, pasti terasa sangat berat dan menyakitkan. Perasaan **sakit hati**, **hampa**, dan menangis adalah reaksi yang **sangat wajar** dalam proses berduka.</p>
                            
                            <p>Beberapa hal yang bisa Anda lakukan saat ini:</p>
                            
                            <ol style="padding-left: 20px; margin: 15px 0;">
                                <li>**Izinkan Diri Anda Merasa**: Jangan menekan emosi Anda. Menangislah jika Anda perlu. Proses penyembuhan dimulai dengan mengakui rasa sakit itu.</li>
                                <li>**Fokus pada Kebutuhan Dasar**: Pastikan Anda tetap makan, minum, dan tidur dengan cukup. Kesehatan fisik sangat memengaruhi kesehatan mental.</li>
                                <li>**Cari Dukungan**: Bicaralah dengan teman atau keluarga yang Anda percaya. Mereka bisa memberikan dukungan emosional yang Anda butuhkan.</li>
                                <li>**Alihkan Perhatian**: Lakukan kegiatan yang Anda sukai, atau coba hal baru. Ini akan membantu mengalihkan pikiran dari Asep dan membangun kembali identitas diri Anda.</li>
                            </ol>
                            
                            <p style="margin-bottom: 0;">Jika perasaan hampa, sedih, dan nafsu makan terganggu terus berlanjut hingga berminggu-minggu dan mulai mengganggu aktivitas sehari-hari Anda, sangat disarankan untuk melakukan konsultasi tatap muka dengan psikolog atau psikiater agar mendapatkan penanganan yang lebih intensif dan personal. Anda tidak sendirian. Semangat!</p>
                        </div>
                        <div class="meta-info">
                            Dijawab oleh: Dr. Rina Kusuma, S.Psi, Psikolog Klinis | Tanggal: 08 Oktober 2025
                        </div>
                    </div>
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