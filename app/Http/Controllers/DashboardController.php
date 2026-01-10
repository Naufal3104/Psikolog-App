<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Konten (Artikel, Video, Infografis)
        $totalArtikel = DB::table('artikel')->count();
        $totalViewsArtikel = DB::table('artikel')->sum('views');
        
        $totalVideo = DB::table('video')->count();
        $totalViewsVideo = DB::table('video')->sum('views');
        
        $totalInfografis = DB::table('infografis')->count();

        // 2. Statistik Interaksi (Tanya Jawab)
        $totalPertanyaan = DB::table('tanya_jawab')->count();
        $pertanyaanBelumDijawab = DB::table('tanya_jawab')
            ->where('status', 'Belum Dijawab')
            ->count();

        // 3. Statistik Deteksi Dini (Kesehatan Mental)
        $totalTesDeteksi = DB::table('hasil_deteksi')->count();
        $kategoriDeteksi = DB::table('kategori_deteksi')->count();

        // 4. Statistik User (Opsional, asumsi tabel users ada)
        $totalUser = DB::table('users')->count();

        return view('admin.dashboard', compact(
            'totalArtikel', 'totalViewsArtikel',
            'totalVideo', 'totalViewsVideo',
            'totalInfografis',
            'totalPertanyaan', 'pertanyaanBelumDijawab',
            'totalTesDeteksi', 'kategoriDeteksi',
            'totalUser'
        ));
    }
}