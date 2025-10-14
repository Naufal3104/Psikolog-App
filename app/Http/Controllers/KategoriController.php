<?php

namespace App\Http\Controllers;
use App\Models\KategoriDeteksi;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('fitur.deteksi', [
            'kategori_deteksi' => KategoriDeteksi::all()
        ]);
    }

    public function show(KategoriDeteksi $kategori)
    {
        $kategori->load('pertanyaan.pilihan_jawaban');
        return view('fitur.pertanyaandeteksi', ['kategori' => $kategori]);
    }
}
