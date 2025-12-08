@extends('layouts.main')
@section('title', 'Deteksi Dini Pengguna')

@push('styles')
    <style>
        .riwayat-container {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
            min-height: 80vh;
        }

        .content-wrapper {
            width: 100%;
            max-width: 800px; /* Sedikit lebih lebar untuk info user */
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .history-card {
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            width: 100%;
            overflow: hidden;
        }

        .history-header {
            background-color: #004780;
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .header-title {
            font-size: 1.25rem; 
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            margin: 0;
        }

        /* Search Bar di Header */
        .search-wrapper {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.95rem;
        }
        
        .search-input::placeholder { color: rgba(255, 255, 255, 0.7); }
        .search-input:focus { outline: none; background-color: rgba(255, 255, 255, 0.2); border-color: white; }

        .search-btn {
            padding: 0 16px;
            border-radius: 8px;
            background-color: white;
            color: #004780;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }
        .search-btn:hover { background-color: #f3f4f6; }

        .history-list { list-style: none; padding: 0; margin: 0; }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
        }
        .history-item:hover { background-color: #f9fafb; }

        /* User Info Badge */
        .user-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .history-meta {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .history-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #111827;
            font-family: 'Outfit', sans-serif;
        }

        .badge-hasil {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: #f3f4f6;
            color: #4b5563;
            margin-top: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .link-detail {
            color: #004780;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #004780;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .link-detail:hover {
            background-color: #004780;
            color: white;
        }

        /* Dark Mode */
        .eh .history-card { background-color: #1f2937 !important; border-color: #374151 !important; color: white; }
        .eh .history-item { border-bottom-color: #374151; }
        .eh .history-item:hover { background-color: #374151; }
        .eh .user-badge { background-color: #0c4a6e; color: #bae6fd; }
        .eh .history-meta { color: #9ca3af; }
        .eh .history-title { color: #f3f4f6; }
        .eh .badge-hasil { background-color: #374151; color: #d1d5db; border-color: #4b5563; }
        .eh .link-detail { color: #60a5fa; border-color: #60a5fa; }
        .eh .link-detail:hover { background-color: #60a5fa; color: #1f2937; }
    </style>
@endpush

@section('content')

<x-layout.navbar />

<div class="bb ze ki xn 2xl:ud-px-0 jb">
    <div class="riwayat-container">
        
        <div class="content-wrapper">
            <div class="history-card">
                
                {{-- Header + Search --}}
                <div class="history-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 class="header-title">Deteksi Dini Pengguna</h2>
                    </div>

                    <form action="{{ route('psikolog.deteksi.index') }}" method="GET" class="search-wrapper">
                        <input type="text" name="search" class="search-input" 
                               placeholder="Cari nama pengguna..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="search-btn">Cari</button>
                    </form>
                </div>

                <ul class="history-list">
                    @forelse ($riwayat as $item)
                        <li class="history-item">
                            <div style="flex: 1; padding-right: 15px;">
                                {{-- Nama Pengguna (Pembeda Utama) --}}
                                <div class="user-badge">
                                    <i data-feather="user" style="width: 14px; height: 14px;"></i>
                                    {{ $item->user->name ?? 'User Terhapus' }}
                                </div>

                                <div class="history-title">
                                    {{ $item->kategori->nama_kategori ?? 'Kategori Dihapus' }}
                                </div>

                                <div class="history-meta">
                                    <i data-feather="calendar" style="width: 14px; height: 14px;"></i>
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </div>

                                <div>
                                    <span class="badge-hasil">
                                        Hasil: {{ $item->interpretasi->teks_interpretasi ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                {{-- Link ke Route Detail yang SAMA dengan User --}}
                                <a href="{{ route('deteksi.hasil', $item->id) }}" class="link-detail">
                                    Lihat Detail
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="p-8 text-center text-gray-500 dark:text-gray-400">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
                                <p>Belum ada data deteksi dini dari pengguna.</p>
                                @if(request('search'))
                                    <a href="{{ route('psikolog.deteksi.index') }}" class="text-blue-600 underline text-sm">Reset Pencarian</a>
                                @endif
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

@push('scripts')
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush