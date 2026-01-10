<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalPsikolog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Menampilkan halaman konsultasi dengan jadwal psikolog hari ini.
     */
    public function index(): View
    {
        // 1. Tentukan Hari Ini dalam Bahasa Indonesia
        // Mapping manual digunakan agar cocok 100% dengan database (case-sensitive)
        $mapHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];

        $hariIni = $mapHari[Carbon::now()->format('l')];

        // 2. Cari Psikolog yang Jaga Hari Ini
        // Mengambil 1 psikolog secara acak jika ada lebih dari 1 yang jaga
        $jadwalAktif = JadwalPsikolog::with('user')
            ->where('hari', $hariIni)
            ->inRandomOrder()
            ->first();

        // 3. Nomor Default (Admin/CS)
        // Digunakan jika tidak ada psikolog yang jaga hari ini
        $nomorDefault = '6281234567890'; 

        return view('fitur.konsultasi', [
            'jadwalAktif'  => $jadwalAktif,
            'nomorDefault' => $nomorDefault,
            'hariIni'      => $hariIni // Opsional: dikirim jika ingin menampilkan "Jadwal Hari Jumat" di view
        ]);
    }
}