<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasanTanyaJawab extends Model
{
    use HasFactory;

    protected $table = 'balasan_tanya_jawab';

    protected $fillable = [
        'tanya_jawab_id',
        'user_id',
        'isi_balasan',
    ];

    public function tanyaJawab()
    {
        return $this->belongsTo(TanyaJawab::class, 'tanya_jawab_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
