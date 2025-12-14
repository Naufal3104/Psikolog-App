<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPsikolog extends Model
{
    use HasFactory;

    protected $table = 'jadwal_psikolog';
    protected $fillable = ['user_id', 'hari'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // --- BAGIAN INI YANG DIREVISI ---
    public function getNomorWaAttribute()
    {
        // KOREKSI: Mengambil no_telp langsung dari relasi User, 
        // karena kolom no_telp ada di tabel 'users', bukan 'psikolog_profiles'
        return $this->user->no_telp ?? null;
    }
}