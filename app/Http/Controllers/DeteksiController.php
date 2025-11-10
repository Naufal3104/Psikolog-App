<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriDeteksi;
use App\Models\HasilDeteksi;
use App\Models\JawabanUser;
use App\Models\PilihanJawaban;
use App\Models\InterpretasiSkor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class DeteksiController extends Controller
{
    public function index()
    {
        return view('fitur.deteksi', [
            'kategori_deteksi' => KategoriDeteksi::all()
        ]);
    }

    public function show(KategoriDeteksi $kategori)
    {
        $kategori->load('pertanyaan.pilihanJawaban');
        return view('fitur.pertanyaandeteksi', ['kategori' => $kategori]);
    }
    public function process(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        // (Kita asumsikan 'nama' adalah 'nullable' jika user tidak login)
        $validatedData = $request->validate([
            'kategori_id' => 'required|string|exists:kategori_deteksi,id',
            'nama'        => 'nullable|string|max:255',
            'jawaban'     => 'required|array',
            'jawaban.*'   => 'required|integer|exists:pilihan_jawaban,id',
        ]);

        $totalSkor = 0;
        $hasilTeks = 'Tidak Terdefinisi';
        $hasilDeteksi = null;

        // 2. Kalkulasi Skor
        // Kita mengambil semua ID pilihan jawaban dari form
        $pilihanIds = array_values($validatedData['jawaban']);
        
        // Menjumlahkan 'bobot_nilai' dari semua pilihan yang dipilih
        $totalSkor = PilihanJawaban::whereIn('id', $pilihanIds)->sum('bobot_nilai');

        // 3. Dapatkan Interpretasi
        $interpretasi = InterpretasiSkor::where('kategori_deteksi_id', $validatedData['kategori_id'])
            ->where('skor_minimal', '<=', $totalSkor)
            ->where('skor_maksimal', '>=', $totalSkor)
            ->first();

        if ($interpretasi) {
            $hasilTeks = $interpretasi->teks_interpretasi;
        }

        // 4. Simpan ke Database (Menggunakan Transaksi)
        // Ini memastikan jika salah satu 'jawaban_user' gagal disimpan,
        // 'hasil_deteksi' juga tidak akan disimpan (rollback).
        try {
            DB::transaction(function () use ($validatedData, $totalSkor, $hasilTeks, &$hasilDeteksi) {
                
                // 4a. Simpan ke tabel hasil_deteksi
                $hasilDeteksi = HasilDeteksi::create([
                    'user_id'             => Auth::id(), // Mengambil ID user yang sedang login
                    'kategori_deteksi_id' => $validatedData['kategori_id'],
                    'total_skor'          => $totalSkor,
                    'interpretasi_hasil'  => $hasilTeks,
                ]);

                // 4b. Simpan setiap jawaban ke tabel jawaban_user
                foreach ($validatedData['jawaban'] as $pertanyaan_id => $pilihan_jawaban_id) {
                    JawabanUser::create([
                        'hasil_deteksi_id'   => $hasilDeteksi->id,
                        'pertanyaan_id'      => $pertanyaan_id,
                        'pilihan_jawaban_id' => $pilihan_jawaban_id,
                    ]);
                }
            });
        } catch (\Exception $e) {
            // Jika terjadi error, kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan hasil Anda: ' . $e->getMessage());
        }

        // 5. Redirect ke Halaman Hasil
        // Kita akan redirect ke halaman 'show_riwayat' (yang akan Anda buat)
        // atau bisa juga ke halaman 'hasil' kustom.
        // Untuk saat ini, kita redirect kembali ke index deteksi dengan sukses.
        return redirect()->route('deteksi.index')->with('success', 'Deteksi berhasil diselesaikan! Hasil Anda: ' . $hasilTeks);
        
        // --- ATAU (Jika Anda punya halaman 'show' untuk hasil) ---
        // return redirect()->route('deteksi.hasil', $hasilDeteksi->id)->with('success', 'Deteksi berhasil diselesaikan!');
    }   
}
