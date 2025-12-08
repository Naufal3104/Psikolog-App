@extends('layouts.main')
@section('title', 'Kelola Artikel')

@push('styles')
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
            min-height: 80vh;
        }
        
        /* UPDATED: Wrapper dibuat flex column agar tombol kembali rapi di atas card */
        .content-wrapper {
            width: 100%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            gap: 1rem; /* Jarak antara tombol kembali dan card */
        }

        .card-box {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        .header-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #f3f4f6;
        }
        .btn-add {
            background-color: #004780;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }
        .btn-add:hover { background-color: #003666; }
        
        /* Table Styles */
        .table-responsive { overflow-x: auto; }
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            font-size: 0.9rem;
        }
        .custom-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            color: #4b5563;
            vertical-align: middle;
        }
        .custom-table tr:last-child td { border-bottom: none; }

        /* Styling Action Icons */
        .action-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .text-edit { color: #4f46e5; }
        .text-edit:hover { color: #312e81; }

        .text-delete { color: #dc2626; }
        .text-delete:hover { color: #7f1d1d; }
        
        /* Dark Mode */
        .eh .card-box { background-color: #1f2937; border-color: #374151; }
        .eh .custom-table th { background-color: #374151; color: #d1d5db; }
        .eh .custom-table td { border-color: #374151; color: #9ca3af; }
        .eh .header-action { border-bottom-color: #374151; }
        
        .eh .text-edit { color: #818cf8; }
        .eh .text-edit:hover { color: #a5b4fc; }
        .eh .text-delete { color: #f87171; }
        .eh .text-delete:hover { color: #fca5a5; }
    </style>
@endpush

@section('content')
<x-layout.navbar />

<div class="bb ze ki xn 2xl:ud-px-0 jb">
    <div class="centered-content">
        <div class="content-wrapper">
            
            {{-- 1. TOMBOL KEMBALI (BARU) --}}
            <div>
                {{-- Arahkan ke Dashboard Psikolog atau Halaman Utama --}}
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#004780] dark:hover:text-white transition-colors font-medium">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Feedback Message --}}
            @if(session('success'))
                <div class="p-4 text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 2. KARTU TABEL ARTIKEL --}}
            <div class="card-box">
                <div class="header-action">
                    <h2 class="text-xl font-bold dark:text-white">Artikel Saya</h2>
                    <a href="{{ route('psikolog.artikel.create') }}" class="btn-add">
                        <i data-feather="plus-circle"></i> Tulis Artikel
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Judul Artikel</th>
                                <th>Tanggal</th>
                                <th style="width: 100px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($artikel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $item->judul }}</div>
                                    <div class="text-xs text-gray-500 truncate" style="max-width: 300px;">
                                        {{ Str::limit(strip_tags($item->isi), 50) }}
                                    </div>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                
                                <td style="text-align: center;">
                                    <div class="action-wrapper">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('psikolog.artikel.edit', $item->id) }}" title="Edit" class="icon-btn text-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('psikolog.artikel.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" style="display: contents;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus" class="icon-btn text-delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">Belum ada artikel yang ditulis.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4">
                    {{ $artikel->links() }}
                </div>
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