<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Tambahkan ini


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'user_id', 'id');
    }

    // Relasi satu ke banyak (User ke PengajuanSiswa)
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_sekolah');
    }

    // Relasi dengan JurnalKegiatan (Seorang User dapat memiliki banyak JurnalKegiatan)
    public function jurnal()
    {
        return $this->hasMany(Jurnal::class, 'user_id');
    }

    public function laporanPkl()
{
    return $this->hasMany(LaporanPkl::class);
}
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
