<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsikologProfile extends Model
{
    use HasFactory;

    protected $table = 'psikolog_profiles';

    protected $fillable = [
        'user_id',
        'NIP',          // Sesuai migrasi Anda
        'spesialisasi',
        'hari_jaga',
        'clicks',       // WAJIB ADA untuk fitur kinerja
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}