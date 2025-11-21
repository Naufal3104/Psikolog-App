<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';

    protected $fillable = [
        'judul',
        'url',
        'penulis_id',
        'kategori',
        'views',
    ];

    // Accessor untuk URL embed YouTube
    public function getEmbedUrlAttribute()
    {
        $url = $this->url;

        // Cek apakah ini link YouTube
        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            // Logika untuk mengambil ID Video saja (misal: VanZGVOvxas)
            // dan membuang sampah lain seperti &list=... atau &t=...
            if (str_contains($url, 'watch?v=')) {
                parse_str(parse_url($url, PHP_URL_QUERY), $params);
                $videoId = $params['v'] ?? null;
            } else {
                // Handle youtu.be/ID
                $videoId = basename(parse_url($url, PHP_URL_PATH));
            }

            if ($videoId) {
                return "https://www.youtube.com/embed/" . $videoId;
            }
        }

        // Jika bukan youtube, kembalikan url asli (atau kosongkan)
        return $url; 
    }

    // Relasi dengan penulis
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
