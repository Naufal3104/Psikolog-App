<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Infografis; // Pastikan import Model ini ada

class InfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataInfografis = [
            [
                'judul' => 'Pentingnya Kesehatan Mental',
                'gambar' => 'https://drive.google.com/file/d/15hpGry8uMNWr7gydF3rV3yn3QEwGFRgD/view?usp=drive_link',
                'caption' => 'Infografis mengenai dasar-dasar kesehatan mental dan mengapa kita harus peduli.',
            ],
            [
                'judul' => 'Tips Mengelola Stress',
                'gambar' => 'https://drive.google.com/file/d/1kfnM5a4Kz8U68luGtZUSgdEY4X7ac41o/view?usp=drive_link',
                'caption' => 'Beberapa langkah sederhana yang bisa dilakukan sehari-hari untuk mengurangi tingkat stress.',
            ],
            [
                'judul' => 'Mengenal Gejala Kecemasan',
                'gambar' => 'https://drive.google.com/file/d/1TPGEmfzpKLpZpNQ9Tt46YqEgu0LHOy4n/view?usp=drive_link',
                'caption' => 'Kenali tanda-tanda gangguan kecemasan sejak dini agar mendapatkan penanganan yang tepat.',
            ],
        ];

        foreach ($dataInfografis as $item) {
            // Kita menggunakan create() agar Mutator di Model Infografis berjalan
            // dan otomatis mengubah link Google Drive menjadi link thumbnail
            Infografis::create($item);
        }
    }
}