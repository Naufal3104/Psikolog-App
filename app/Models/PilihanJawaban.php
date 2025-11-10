<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan_id',
        'teks_jawaban',
        'bobot_nilai'
    ];
    protected $table = 'pilihan_jawaban';
    public function pertanyaan(){
        return $this->belongsTo(Pertanyaan::class);
    }
}
