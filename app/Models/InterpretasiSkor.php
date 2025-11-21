<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterpretasiSkor extends Model
{
    use HasFactory;
    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'interpretasi_skor';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kategori_deteksi_id',
        'skor_minimal',
        'skor_maksimal',
        'teks_interpretasi',
        'deskripsi_hasil',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDeteksi::class, 'kategori_deteksi_id');
    }
}
