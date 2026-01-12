<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KinerjaPsikologController extends Controller
{
    public function index()
    {
        // 1. Ambil semua user yang memiliki role 'psikolog'
        // dan load relasi 'psikologProfile' agar hemat query
        $psikologs = User::role('psikolog')->with('psikologProfile')->get(); 

        $ranking = $psikologs->map(function ($psikolog) {
            
            // A. Hitung Artikel (Real dari Database)
            $jumlahArtikel = DB::table('artikel')
                ->where('penulis_id', $psikolog->id)
                ->count();

            // B. Hitung Balasan Chat (Real dari Database)
            $jumlahBalasan = DB::table('balasan_tanya_jawab')
                ->where('user_id', $psikolog->id)
                ->count();

            // C. Hitung Klik Konsultasi (Real dari Database tabel psikolog_profiles)
            // Jika profil belum dibuat, anggap 0
            $jumlahKlik = $psikolog->psikologProfile ? $psikolog->psikologProfile->clicks : 0;

            // D. Hitung Total Skor
            $totalSkor = $jumlahArtikel + $jumlahBalasan + $jumlahKlik;

            return (object) [
                'name' => $psikolog->name,
                'email' => $psikolog->email,
                'jumlah_artikel' => $jumlahArtikel,
                'jumlah_balasan' => $jumlahBalasan,
                'jumlah_klik' => $jumlahKlik, 
                'total_skor' => $totalSkor
            ];
        });

        // Urutkan Ranking Tertinggi
        $sortedRanking = $ranking->sortByDesc('total_skor');

        return view('admin.kinerja', [
            'dataKinerja' => $sortedRanking
        ]);
    }
}