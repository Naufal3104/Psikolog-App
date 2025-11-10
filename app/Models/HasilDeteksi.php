<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasilDeteksi extends Model
{
    use HasFactory;
    protected $table = 'hasil_deteksi';

    /**
     * Atribut yang tidak boleh diisi massal.
     * @var array
     */
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'kategori_deteksi_id',
        'total_skor',
        'interpretasi_hasil',
    ];
    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kategori Deteksi
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDeteksi::class, 'kategori_deteksi_id');
    }

    /**
     * Relasi ke Jawaban User
     */
    public function jawabanUser(): HasMany
    {
        return $this->hasMany(JawabanUser::class);
    }
}