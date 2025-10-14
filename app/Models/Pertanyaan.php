<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_deteksi_id',
        'teks_pertanyaan',
        'tipe_jawaban',
        'urutan'
    ];
    protected $table = 'pertanyaan';
    public function kategori(){
        return $this->belongsTo(KategoriDeteksi::class);
    }
    public function pilihan_jawaban(): HasMany
    {
        return $this->hasMany(PilihanJawaban::class);
    }
}
