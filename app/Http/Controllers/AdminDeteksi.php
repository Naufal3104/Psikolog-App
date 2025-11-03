<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriDeteksi;
use App\Models\Pertanyaan;

class AdminDeteksi extends Controller
{
    public function index()
    {
        $kategori = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 2. Ambil semua pertanyaan, urutkan berdasarkan KATEGORI, lalu berdasarkan urutan
        $pertanyaan = Pertanyaan::with('kategori') // Eager load relasi 'kategori'
                            ->orderBy('kategori_deteksi_id')
                            ->orderBy('urutan') // Asumsi Anda punya kolom 'urutan'
                            ->get();
        
        // 3. Hitung total untuk judul
        $totalPertanyaan = $pertanyaan->count();

        // 4. Kirim semua data ke view
        return view('admin.kelola-deteksi', [
            'semuaPertanyaan' => $pertanyaan,
            'semuaKategori' => $kategori,
            'totalPertanyaan' => $totalPertanyaan,
        ]);
    }
}
