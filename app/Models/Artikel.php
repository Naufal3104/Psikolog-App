<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'penulis_id',
        'gambar',
        'keterangan_gambar',
        'views',
    ];

    // Relasi dengan model User (penulis)
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}

