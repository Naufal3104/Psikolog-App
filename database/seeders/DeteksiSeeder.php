<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Sesuaikan namespace model Anda
// Pastikan Anda mengimport Model lain jika sudah dibuat, atau gunakan DB::table
// Disini saya menggunakan DB::table untuk memastikan kode jalan meski Model belum dibuat

class DeteksiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA USER (Sesuai request)
        // Menggunakan updateOrInsert agar tidak error jika dijalankan 2x
        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Pengguna',
                'username' => 'user',
                'password' => bcrypt('12345678'),
                'NIK' => '87654321', // Pastikan tipe data di DB string/bigint
                'alamat' => 'Jl. User No.3',
                'no_telp' => '087654321098',
                'email_verified_at' => now(),
            ]
        );
        
        // Jika Anda menggunakan Spatie Permission:
        // $user->assignRole('user'); 

        // 2. KATEGORI DETEKSI
        $kategoriData = [
            ['id' => 'stress', 'nama_kategori' => 'Kenali Tingkat Stress', 'deskripsi' => 'Tes untuk mengukur tingkat stres Anda saat ini.'],
            ['id' => 'psikologis', 'nama_kategori' => 'Kesejahteraan Psikologis', 'deskripsi' => 'Mengukur kesejahteraan mental secara umum.'],
            ['id' => 'belajar', 'nama_kategori' => 'Gejala Kesukaran Belajar', 'deskripsi' => 'Deteksi dini kesulitan dalam proses belajar.'],
            ['id' => 'pernikahan', 'nama_kategori' => 'Kesiapan Pernikahan', 'deskripsi' => 'Mengukur kesiapan mental sebelum menikah.'],
            ['id' => 'putuscinta', 'nama_kategori' => 'Putus Cinta', 'deskripsi' => 'Bantuan pemulihan pasca putus cinta.'],
        ];

        foreach ($kategoriData as $cat) {
            DB::table('kategori_deteksi')->updateOrInsert(
                ['id' => $cat['id']],
                ['nama_kategori' => $cat['nama_kategori'], 'deskripsi' => $cat['deskripsi'], 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // ==================================================
        // FOKUS PENGISIAN DATA LENGKAP PADA KATEGORI: STRESS
        // ==================================================
        $targetKategori = 'stress';

        // 3. INTERPRETASI SKOR (Logika: 10 Pertanyaan, Max Skor 50)
        // Range: Rendah (10-23), Sedang (24-36), Tinggi (37-50)
        $interpretasiData = [
            [
                'kategori_deteksi_id' => $targetKategori,
                'skor_minimal' => 0,
                'skor_maksimal' => 23,
                'teks_interpretasi' => 'Tingkat Stres Rendah',
                'deskripsi_hasil' => 'Anda mampu mengelola tekanan dengan baik. Pertahankan pola hidup sehat dan manajemen waktu Anda.'
            ],
            [
                'kategori_deteksi_id' => $targetKategori,
                'skor_minimal' => 24,
                'skor_maksimal' => 36,
                'teks_interpretasi' => 'Tingkat Stres Sedang',
                'deskripsi_hasil' => 'Anda mengalami tekanan yang mulai mengganggu. Disarankan untuk mengambil jeda istirahat dan melakukan relaksasi.'
            ],
            [
                'kategori_deteksi_id' => $targetKategori,
                'skor_minimal' => 37,
                'skor_maksimal' => 100,
                'teks_interpretasi' => 'Tingkat Stres Tinggi',
                'deskripsi_hasil' => 'Tekanan yang Anda alami sangat tinggi dan berisiko bagi kesehatan. Segera konsultasikan dengan profesional (psikolog).'
            ],
        ];

        foreach ($interpretasiData as $inter) {
            DB::table('interpretasi_skor')->insert(array_merge($inter, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 4. PERTANYAAN (10 Soal untuk Stress)
        $daftarPertanyaan = [
            "Apakah Anda sering merasa mudah marah karena hal-hal sepele?",
            "Apakah Anda merasa sulit untuk beristirahat atau bersantai?",
            "Apakah Anda sering merasa cemas atau gelisah berlebihan?",
            "Apakah Anda merasa sulit untuk mentoleransi gangguan pada pekerjaan Anda?",
            "Apakah Anda merasa mudah tersinggung atau sensitif?",
            "Apakah Anda merasa energi Anda cepat terkuras?",
            "Apakah Anda mengalami gangguan tidur (sulit tidur atau bangun terlalu pagi)?",
            "Apakah Anda sering merasa jantung berdebar tanpa alasan fisik (olahraga)?",
            "Apakah Anda kehilangan minat pada hal-hal yang biasanya Anda sukai?",
            "Apakah Anda merasa pesimis tentang masa depan?"
        ];

        // Simpan ID Pertanyaan untuk keperluan dummy transaksi nanti
        $pertanyaanIds = [];

        foreach ($daftarPertanyaan as $index => $teks) {
            $pertanyaanId = DB::table('pertanyaan')->insertGetId([
                'kategori_deteksi_id' => $targetKategori,
                'teks_pertanyaan' => $teks,
                'tipe_jawaban' => 'rating_1_5',
                'urutan' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $pertanyaanIds[] = $pertanyaanId;

            // 5. PILIHAN JAWABAN (Rating 1-5)
            $pilihan = [
                ['teks' => 'Tidak Pernah', 'bobot' => 1],
                ['teks' => 'Jarang', 'bobot' => 2],
                ['teks' => 'Kadang-kadang', 'bobot' => 3],
                ['teks' => 'Sering', 'bobot' => 4],
                ['teks' => 'Selalu', 'bobot' => 5],
            ];

            foreach ($pilihan as $p) {
                DB::table('pilihan_jawaban')->insert([
                    'pertanyaan_id' => $pertanyaanId,
                    'teks_jawaban' => $p['teks'],
                    'bobot_nilai' => $p['bobot'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ==================================================
        // 6. DUMMY TRANSAKSI (HASIL & JAWABAN USER)
        // ==================================================
        
        // Kita simulasikan User menjawab dengan skor total "Sedang" (Misal total 30)
        // Kita ambil interpretasi 'Sedang'
        $interpretasiSedang = DB::table('interpretasi_skor')
            ->where('kategori_deteksi_id', $targetKategori)
            ->where('teks_interpretasi', 'Tingkat Stres Sedang')
            ->first();

        if ($interpretasiSedang) {
            // A. Buat Header Hasil Deteksi
            $hasilId = DB::table('hasil_deteksi')->insertGetId([
                'user_id' => $user->id,
                'interpretasi_id' => $interpretasiSedang->id,
                'kategori_deteksi_id' => $targetKategori,
                'total_skor' => 30, // Kita set manual biar cocok
                'created_at' => now()->subDays(2), // Seolah-olah tes 2 hari lalu
                'updated_at' => now()->subDays(2),
            ]);

            // B. Buat Detail Jawaban User (Looping pertanyaan yang tadi dibuat)
            // Kita akan acak jawaban biar totalnya mendekati 30
            foreach ($pertanyaanIds as $pId) {
                // Ambil pilihan jawaban untuk pertanyaan ini
                $pilihanJawaban = DB::table('pilihan_jawaban')->where('pertanyaan_id', $pId)->get();
                
                // Kita ambil jawaban 'Kadang-kadang' (bobot 3) secara konstan agar total 10 soal x 3 = 30
                $jawabanDipilih = $pilihanJawaban->where('bobot_nilai', 3)->first();

                DB::table('jawaban_user')->insert([
                    'hasil_deteksi_id' => $hasilId,
                    'pertanyaan_id' => $pId,
                    'pilihan_jawaban_id' => $jawabanDipilih->id,
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);
            }
        }
    }
}