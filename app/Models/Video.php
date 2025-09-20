<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'url',
        'penulis_id',
        'kategori',
        'views',
    ];

    // Relasi dengan model User (penulis)
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
