<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanUser extends Model
{
    use HasFactory;
    protected $table = 'jawaban_user';

    /**
     * Atribut yang tidak boleh diisi massal.
     * @var array
     */
    protected $guarded = ['id'];
    protected $fillable = [
        'hasil_deteksi_id',
        'pertanyaan_id',
        'pilihan_jawaban_id',
    ];

    /**
     * Relasi ke Hasil Deteksi
     */
    public function hasilDeteksi(): BelongsTo
    {
        return $this->belongsTo(HasilDeteksi::class);
    }

    /**
     * Relasi ke Pertanyaan
     */
    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    /**
     * Relasi ke Pilihan Jawaban
     */
    public function pilihanJawaban(): BelongsTo
    {
        return $this->belongsTo(PilihanJawaban::class);
    }
}