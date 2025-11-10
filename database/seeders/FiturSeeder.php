<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriDeteksi;

class FiturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriDeteksi::insert([
            ['id' => 'stress', 'nama_kategori' => 'Kenali Tingkat Stress'],
            ['id' => 'psikologis', 'nama_kategori' => 'Kesejahteraan Psikologis'],
            ['id' => 'belajar', 'nama_kategori' => 'Gejala Kesukaran Belajar'],
            ['id' => 'pernikahan', 'nama_kategori' => 'Kesiapan Pernikahan'],
            ['id' => 'putuscinta', 'nama_kategori' => 'Putus Cinta'],
        ]);
    }
}
