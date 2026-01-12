<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class IsiDataKinerjaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil Data User & Psikolog berdasarkan USERNAME (Bukan Role)
        $drAndi = User::where('username', 'andi_psikolog')->first();
        $drBudi = User::where('username', 'budi_psikolog')->first();
        
        // PERBAIKAN DISINI: Cari user berdasarkan username 'user', bukan where('role')
        $userBiasa = User::where('username', 'user')->first() ?? User::first(); 

        if (!$drAndi || !$drBudi) {
            $this->command->error('User Psikolog tidak ditemukan. Pastikan UserSeeder sudah dijalankan!');
            return;
        }

        // 2. Insert Artikel (Dr. Andi rajin, Dr. Budi malas)
        
        // Dr. Andi buat 3 artikel
        for ($i = 1; $i <= 3; $i++) {
            DB::table('artikel')->insert([
                'id' => Str::uuid()->toString(),
                'judul' => "Artikel Kesehatan $i oleh Andi",
                'slug' => "artikel-kesehatan-$i-andi-" . Str::random(5),
                'isi' => 'Isi artikel dummy...',
                'penulis_id' => $drAndi->id,
                'views' => rand(100, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Dr. Budi buat 1 artikel
        DB::table('artikel')->insert([
            'id' => Str::uuid()->toString(),
            'judul' => "Tips Santai oleh Budi",
            'slug' => "tips-santai-budi-" . Str::random(5),
            'isi' => 'Isi artikel dummy...',
            'penulis_id' => $drBudi->id,
            'views' => rand(50, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Insert Tanya Jawab & Balasan
        
        // Buat Pertanyaan dari User
        $tanyaId = Str::uuid()->toString();
        DB::table('tanya_jawab')->insert([
            'id' => $tanyaId,
            'user_id' => $userBiasa->id,
            'judul_pertanyaan' => 'Stress Berat',
            'pertanyaan' => 'Bagaimana cara healing?',
            'status' => 'Sudah Dijawab',
            'created_at' => now(),
        ]);

        // Dr. Andi membalas
        DB::table('balasan_tanya_jawab')->insert([
            'tanya_jawab_id' => $tanyaId,
            'user_id' => $drAndi->id,
            'isi_balasan' => 'Coba liburan sebentar...',
            'created_at' => now(),
        ]);
    }
}