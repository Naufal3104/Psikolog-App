<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
// tambahkan ini
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'username',
        'NIK',
        'alamat',
        'no_telp',
        'foto_profil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function psikologProfile()
    {
        return $this->hasOne(PsikologProfile::class);
    }

    public function hasilDeteksi()
    {
        return $this->hasMany(HasilDeteksi::class);
    }

    public function jadwal()

    {
        return $this->hasMany(JadwalPsikolog::class, 'user_id');
    }
}
