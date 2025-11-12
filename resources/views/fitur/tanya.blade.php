@extends('layouts.main')

@section('title', 'Tanya Jawab Psikolog - RSUD Jombang')
@section('page-slug', 'tanya-jawab-psikolog')

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
        }
        .question-item:hover {
            background-color: #f9fafb;
        }
        .question-item:last-child {
            border-bottom: none;
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

    <div class="bb ze ki xn 2xl:ud-px-0">
        <section class="centered-content">
            <div class="consultation-card">
                <div class="card-header">
                    <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Tanya Psikolog</h2>
                </div>
                
                <div style="padding: 24px;">
                    <div style="margin-bottom: 24px;">
                        <a href="{{ route('tanya.create') }}"  class="ask-button">
                            <i data-feather="plus" style="width: 20px; height: 20px;"></i> 
                            Buat Pertanyaan
                        </a>
                    </div>

                    <div class="questions-list">
                        <div class="question-item">
                            <div class="avatar-placeholder">
                                <i data-feather="user" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <div class="question-title">Asep jahat banget, dia tega ninggalin aku!</div>
                                <div class="question-excerpt">
                                    Dok, saya sedang sakit hati, saya baru saja diputusin pacar saya yang namanya Asep. 
                                    Saya merasa hidup saya hampa, Dok. Mohon bantuannya.
                                </div>
                            </div>
                        </div>

                        <div class="question-item">
                            <div class="avatar-placeholder">
                                <i data-feather="user" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <div class="question-title">Asep udah janjiin aku buat beli pentol, tapi dia boong</div>
                                <div class="question-excerpt">
                                    Dok, aku baru aja di-PHP-in sama si Asep, dia pernah janjiin aku buat beli pentol di dekat sekolah, 
                                    tapi setelah aku tungguin dia nggak datang. Sakit banget rasanya, Dok.
                                </div>
                            </div>
                        </div>

                        <div class="question-item">
                            <div class="avatar-placeholder">
                                <i data-feather="user" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <div class="question-title">Asep punya pacar baru, aku belom move on dari dia</div>
                                <div class="question-excerpt">
                                    Dok, aku baru putus dari Asep, dia baik banget, aku merasa kehilangan dari...
                                    aku nggak tahu harus bagaimana, tiap malam aku nangis.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination">
                    <a href="#" class="pagination-link active">1</a>
                    <a href="#" class="pagination-link">2</a>
                    <a href="#" class="pagination-link">3</a>
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