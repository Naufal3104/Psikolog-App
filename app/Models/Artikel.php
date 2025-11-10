<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Artikel extends Model
{
    use HasFactory,HasUlids;
    
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'penulis_id',
        'gambar',
        'keterangan_gambar',
        'views',
    ];
    protected $table = 'artikel';
    // Relasi dengan model User (penulis)
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}

