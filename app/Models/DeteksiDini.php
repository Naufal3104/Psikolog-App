<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeteksiDini extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_id',
        'skor',
        'hasil',
        'tanggal_deteksi',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
