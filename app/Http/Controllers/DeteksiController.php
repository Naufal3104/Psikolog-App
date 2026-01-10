<?php

namespace App\Http\Controllers;

use App\Models\HasilDeteksi;
use App\Models\InterpretasiSkor;
use App\Models\JawabanUser;
use App\Models\KategoriDeteksi;
use App\Models\PilihanJawaban;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DeteksiController extends Controller
{
    public function index()
    {
        return view('fitur.deteksi', [
            'kategori_deteksi' => KategoriDeteksi::all(),
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
        $validatedData = $request->validate([
            'kategori_id' => 'required|string|exists:kategori_deteksi,id',
            'nama' => 'nullable|string|max:255',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|exists:pilihan_jawaban,id',
        ]);

        $totalSkor = 0;
        $id_interpretasi = 0;
        $hasilDeteksi = null;

        // 2. Kalkulasi Skor
        $pilihanIds = array_values($validatedData['jawaban']);
        $totalSkor = PilihanJawaban::whereIn('id', $pilihanIds)->sum('bobot_nilai');

        // 3. Dapatkan Interpretasi
        $interpretasi = InterpretasiSkor::where('kategori_deteksi_id', $validatedData['kategori_id'])
            ->where('skor_minimal', '<=', $totalSkor)
            ->where('skor_maksimal', '>=', $totalSkor)
            ->first();

        if (! $interpretasi) {
            return redirect()->back()->with('error', 'Maaf, hasil interpretasi tidak ditemukan untuk skor Anda ('.$totalSkor.'). Silakan hubungi admin.');
        }

        $id_interpretasi = $interpretasi->id;

        // 4. Simpan ke Database (Menggunakan Transaksi)
        try {
            DB::transaction(function () use ($validatedData, $totalSkor, $id_interpretasi, &$hasilDeteksi) {

                // 4a. Simpan ke tabel hasil_deteksi
                $hasilDeteksi = HasilDeteksi::create([
                    'user_id' => Auth::id(),
                    'interpretasi_id' => $id_interpretasi,
                    'kategori_deteksi_id' => $validatedData['kategori_id'],
                    'total_skor' => $totalSkor,
                ]);

                // 4b. Simpan setiap jawaban ke tabel jawaban_user
                foreach ($validatedData['jawaban'] as $pertanyaan_id => $pilihan_jawaban_id) {
                    JawabanUser::create([
                        'hasil_deteksi_id' => $hasilDeteksi->id,
                        'pertanyaan_id' => $pertanyaan_id,
                        'pilihan_jawaban_id' => $pilihan_jawaban_id,
                    ]);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan hasil Anda: '.$e->getMessage());
        }

        // 5. Redirect ke Halaman Hasil (UPDATED)
        // Menggunakan ID dari $hasilDeteksi yang baru saja dibuat di dalam transaksi
        if ($hasilDeteksi) {
            return redirect()->route('deteksi.hasil', $hasilDeteksi->id);
        }

        return redirect()->back()->with('error', 'Gagal menyimpan hasil deteksi.');
    }

    public function hasil($id)
    {
        // PERUBAHAN DISINI:
        // Tambahkan relasi 'jawabanUser', 'pertanyaan', 'pilihanJawaban', 'kategori', dan 'user'
        // agar data di halaman laporan/cetak muncul semua.
        $hasilDeteksi = HasilDeteksi::with([
            'interpretasi', 
            'kategori', 
            'user', 
            'jawabanUser.pertanyaan', 
            'jawabanUser.pilihanJawaban'
        ])->findOrFail($id);

        // Validasi akses (tetap sama)
        // Pastikan Anda sudah install Spatie Permission jika pakai hasRole, 
        // jika belum, hapus bagian '&& !Auth::user()->hasRole...'
        if ($hasilDeteksi->user_id !== Auth::id() && Auth::user()->role !== 'psikolog') {
            abort(403, 'Anda tidak memiliki akses ke hasil ini.');
        }

        // Kirim ke view yang baru kita buat (deteksi.show)
        // Sebelumnya Anda mengarah ke 'fitur.hasil-deteksi', pastikan namanya sesuai
        return view('fitur.hasil-deteksi', compact('hasilDeteksi')); 
    }

    public function riwayat()
    {
        // Mengambil data hasil deteksi milik user saat ini
        // Kita urutkan dari yang terbaru (latest) dan kita batasi 10 per halaman (paginate)
        $riwayat = HasilDeteksi::with(['kategori', 'interpretasi'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('fitur.riwayat-deteksi', compact('riwayat'));
    }
}
