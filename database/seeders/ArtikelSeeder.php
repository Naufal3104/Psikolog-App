<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        $dataArtikel = [
            [
                'id' => Str::uuid(),
                'judul' => 'Judul Artikel 1',
                'slug' => 'judul-artikel-1',
                'isi' => 'Isi artikel pertama...',
                'penulis_id' => 1,
                'gambar' => 'artikel1.jpg',
                'keterangan_gambar' => 'Foto artikel 1',
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Judul Artikel 2',
                'slug' => 'judul-artikel-2',
                'isi' => 'Isi artikel kedua...',
                'penulis_id' => 1,
                'gambar' => 'artikel2.jpg',
                'keterangan_gambar' => 'Foto artikel 2',
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Judul Artikel 3',
                'slug' => 'judul-artikel-3',
                'isi' => 'Isi artikel ketiga...',
                'penulis_id' => 1,
                'gambar' => 'artikel3.jpg',
                'keterangan_gambar' => 'Foto artikel 3',
            ],
        ];

        foreach ($dataArtikel as $item) {
            // Copy gambar ke storage dengan nama yang sama
            $sourcePath = database_path('seeders/gambar-artikel/' . $item['gambar']);
            $targetPath = 'artikel-gambar/' . $item['gambar'];

            Storage::disk('public')->put($targetPath, file_get_contents($sourcePath));

            // Insert database
            Artikel::create([
                'id' => $item['id'],
                'judul' => $item['judul'],
                'slug' => $item['slug'],
                'isi' => $item['isi'],
                'penulis_id' => $item['penulis_id'],
                'gambar' => $targetPath, // disimpan persis
                'keterangan_gambar' => $item['keterangan_gambar'],
            ]);
        }
    }
}
