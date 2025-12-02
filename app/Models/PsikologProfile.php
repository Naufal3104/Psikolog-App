<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsikologProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'NIP',
        'spesialisasi',
        'hari_jaga',
        'status',
    ];

    protected $table = 'psikolog_profiles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}