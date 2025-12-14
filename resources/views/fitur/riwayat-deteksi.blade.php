@extends('layouts.main')
@section('title', 'Riwayat Deteksi')

@push('styles')
    <style>
        .riwayat-container {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
            min-height: 80vh;
        }

        /* Wrapper baru agar button dan card sejajar */
        .content-wrapper {
            width: 100%;
            max-width: 700px;
            display: flex;
            flex-direction: column;
            gap: 1rem; /* Jarak antara tombol kembali dan card */
        }

        .history-card {
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            width: 100%;
            /* max-width dipindah ke content-wrapper */
            overflow: hidden;
        }

        /* Support Dark Mode (.eh) */
        .eh .history-card {
            background-color: #1f2937 !important;
            border-color: #374151 !important;
            color: white;
        }

        .history-header {
            background-color: #004780;
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
        }

        .eh .history-item {
            border-bottom-color: #374151;
        }

        .history-item:hover {
            background-color: #f9fafb;
        }
        
        .eh .history-item:hover {
            background-color: #374151; /* Sedikit lebih terang dari bg utama */
        }

        .history-meta {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .eh .history-meta {
            color: #9ca3af;
        }

        .history-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #111827;
            font-family: 'Outfit', sans-serif;
        }

        .eh .history-title {
            color: #f3f4f6;
        }

        .badge-hasil {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: #e0f2fe;
            color: #0369a1;
            margin-top: 0.5rem;
        }

        .eh .badge-hasil {
            background-color: #0c4a6e;
            color: #e0f2fe;
        }
        
        .link-detail {
            color: #004780;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .eh .link-detail {
            color: #60a5fa;
        }
        
        .link-detail:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')

<x-layout.navbar />

<div class="bb ze ki xn 2xl:ud-px-0 jb">
    <div class="riwayat-container">
        
        <div class="content-wrapper">
            
            <div>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="history-card">
                <div class="history-header">
                    <h2 class="text-xl font-bold m-0" style="font-family: 'Outfit', sans-serif;">
                        Riwayat Deteksi
                    </h2>
                </div>

                <ul class="history-list">
                    @forelse ($riwayat as $item)
                        <li class="history-item">
                            <div style="flex: 1;">
                                <div class="history-meta">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </div>
                                <div class="history-title">
                                    {{ $item->kategori->nama_kategori ?? 'Kategori Dihapus' }}
                                </div>
                                <div>
                                    <span class="badge-hasil">
                                        {{ $item->interpretasi->teks_interpretasi ?? 'Hasil tidak tersedia' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('deteksi.hasil', $item->id) }}" class="link-detail">
                                    Lihat Hasil <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="p-8 text-center text-gray-500 dark:text-gray-400">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                <i class="fas fa-clipboard-list" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p>Anda belum memiliki riwayat deteksi dini.</p>
                            </div>
                        </li>
                    @endforelse
                </ul>

                @if($riwayat->hasPages())
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $riwayat->links() }}
                    </div>
                @endif
            </div>
        </div> 
        </div>
</div>
@endsection