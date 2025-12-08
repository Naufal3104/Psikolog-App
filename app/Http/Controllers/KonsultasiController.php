<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalPsikolog;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        // 1. Ambil Hari Ini (Format Inggris)
        $hariInggris = Carbon::now()->format('l');

        // 2. Translate ke Indonesia
        $namaHari = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];
        $hariIni = $namaHari[$hariInggris];

        // 3. Cari Psikolog yang Jaga HARI INI
        // Kita load relasi 'user' karena no_telp ada di tabel users
        $jadwalAktif = JadwalPsikolog::with('user') 
            ->where('hari', $hariIni)
            ->inRandomOrder() 
            ->first();

        // 4. Nomor Admin (Cadangan)
        $nomorDefault = '6281234567890'; 

        return view('fitur.konsultasi', compact('jadwalAktif', 'nomorDefault'));
    }
}