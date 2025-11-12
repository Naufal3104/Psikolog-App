<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanyaJawab extends Model
{
    use HasFactory;

    protected $table = 'tanya_jawab';

    protected $fillable = [
        'user_id',
        'pertanyaan',
        'jawaban',
        'psikiater_id',
        'status',
        'kategori',
        'views',
    ];

    /**
     * Relasi ke user yang membuat pertanyaan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke psikiater yang menjawab pertanyaan
     */
    public function psikiater()
    {
        return $this->belongsTo(User::class, 'psikiater_id');
    }

    /**
     * Relasi ke balasan (komentar) dari pertanyaan ini
     */
    public function balasan()
    {
        return $this->hasMany(BalasanTanyaJawab::class, 'tanya_jawab_id');
    }
}
