<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanyaJawab extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'tanya_jawab';

    protected $fillable = [
        'id',
        'user_id',
        'judul_pertanyaan',
        'pertanyaan',
        'status'
    ];

    /**
     * Relasi ke user yang membuat pertanyaan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke balasan (komentar) dari pertanyaan ini
     */
    public function balasan()
    {
        return $this->hasMany(BalasanTanyaJawab::class, 'tanya_jawab_id');
    }
}
