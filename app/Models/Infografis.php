<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'gambar_url',
        'kategori',
        'views',
        'penulis_id',
    ];

    // Relasi dengan model User (penulis)
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}

