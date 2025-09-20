<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanyaJawab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pertanyaan',
        'jawaban',
        'psikiater_id',
        'status',
        'kategori',
        'views',
    ];

    // Relasi dengan model User (user yang bertanya)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model User (psikiater yang menjawab)
    public function psikiater()
    {
        return $this->belongsTo(User::class, 'psikiater_id');
    }
}

