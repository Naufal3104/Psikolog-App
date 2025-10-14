<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriDeteksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama_kategori',
        'deskripsi',
    ];
    protected $table = 'kategori_deteksi';

    public function pertanyaan(): HasMany
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
