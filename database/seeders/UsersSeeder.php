<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin industri
        $Industri = User::create([
            'name' => 'Industri',
            'email' => 'industri@gmail.com',
            'password' => Hash::make('industri'), // Password admin industri
            'role' => 'industri', // Role admin industri
        ]);
        $Industri->assignRole('industri');

        $Industri->profile()->create([
            'alamat' => null,
        ]);

        // Membuat akun sekolah (registrasi sekolah)
        $sekolah = User::create([
            'name' => 'SMKN 1 Ciomas',
            'email' => 'smkn1ciomas@gmail.com',
            'password' => Hash::make('skanic'), // Password sekolah
            'role' => 'sekolah', // Role admin sekolah
        ]);
        $sekolah->assignRole('sekolah');

        $sekolah->profile()->create([
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
        ]);

        $sekolah->sekolah()->create([
            'nama' => 'SMKN 1 Ciomas',
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
        ]);

        // Membuat akun siswa
        $siswa = User::create([
            'name' => 'Fitri Amaliah',
            'email' => 'fitri@gmail.com',
            'password' => Hash::make('fitri'), // Password siswa
            'role' => 'siswa', // Role siswa
        ]);
        $siswa->assignRole('siswa');

        $siswa->profile()->create([
            'alamat' => null,
        ]);

        // Siswa hanya perlu login menggunakan email dan password yang sudah dibuatkan oleh admin industri
        // Akun siswa akan dibuat oleh admin industri
    }
}
