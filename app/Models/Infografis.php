<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // <--- PASTIKAN INI ADA

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'infografis'; // sesuaikan nama tabel jika berbeda
    protected $guarded = [];

    protected $fillable = [
        'judul',
        'gambar',
        'caption',
    ];

    /**
     * Mutator: Secara otomatis mengubah link GDrive biasa menjadi link Thumbnail
     * saat data akan disimpan ke database.
     */
    protected function gambar(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                // 1. Cek apakah link mengandung 'drive.google.com'
                if (strpos($value, 'drive.google.com') !== false) {
                    
                    // 2. Gunakan Regex untuk mengambil ID File (string acak setelah /d/)
                    // Mencocokkan pola: /d/ID_FILE/
                    preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $value, $matches);

                    // 3. Jika ID ditemukan, ubah format linknya
                    if (isset($matches[1])) {
                        $fileId = $matches[1];
                        return "https://drive.google.com/thumbnail?id={$fileId}&sz=w1000";
                    }
                }

                // Jika bukan link GDrive (atau sudah format benar), simpan apa adanya
                return $value;
            }
        );
    }
}