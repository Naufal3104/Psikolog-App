<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video; // Pastikan Model Video sudah ada
use App\Models\User;
use Carbon\Carbon;

class VideoSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID user pertama untuk dijadikan penulis
        $user = User::first();
        $userId = $user ? $user->id : 1;

        $dataVideo = [
            [
                'judul' => 'Buat yang Lagi Stress..',
                'url' => 'https://www.youtube.com/watch?v=q5x1SNjRQwY&pp=ygUIcHNpa29sb2c%3D',
                'kategori' => 'Edukasi Mental',
                'views' => 150,
            ],
            [
                'judul' => 'Anxiety Disorder dan Cara untuk Menghadapinya | PAB #61 Psikolog Joe Irene',
                'url' => 'https://www.youtube.com/watch?v=BwivvpCyVAA',
                'kategori' => 'Kesehatan Mental',
                'views' => 342,
            ],
            [
                'judul' => 'Trauma dan Bekasnya: Ketika Masa Lalu Menghantui Masa Sekarang | PAB #50 Psikolog Koleta Acintya',
                'url' => 'https://www.youtube.com/watch?v=A72GOa6M5fY',
                'kategori' => 'Self Improvement',
                'views' => 89,
            ],
        ];

        foreach ($dataVideo as $item) {
            Video::create([
                'judul' => $item['judul'],
                'url' => $item['url'],
                'penulis_id' => $userId,
                'kategori' => $item['kategori'],
                'views' => $item['views'],
                // created_at dan updated_at otomatis diisi oleh Eloquent
            ]);
        }
    }
}