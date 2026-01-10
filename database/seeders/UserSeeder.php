<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PsikologProfile;
use App\Models\JadwalPsikolog; // Tambahan: Import Model Jadwal

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // 1. Buat Admin
        // ==========================================
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => '12345678', 
            'alamat' => 'Jl. Admin No.1',
            'no_telp' => '081234567890',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $admin2 = User::create([
            'name' => 'Admin 2',
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => '12345679',
            'alamat' => 'Jl. Admin No.2',
            'no_telp' => '081234567891',
            'email_verified_at' => now(),
        ]);
        $admin2->assignRole('admin');

        // ==========================================
        // 2. Buat User Biasa
        // ==========================================
        $user = User::create([
            'name' => 'User Pengguna',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => '87654321',
            'alamat' => 'Jl. User No.3',
            'no_telp' => '087654321098',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');


        // ==========================================
        // 3. Buat Psikolog Shift SABTU
        // ==========================================
        $psikologSabtu = User::create([
            'name' => 'Dr. Andi (Sabtu)',
            'username' => 'andi_psikolog',
            'email' => 'andi@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => '11223344',
            'alamat' => 'Jl. Psikolog A No.2',
            'no_telp' => '6281234567891', 
            'email_verified_at' => now(),
        ]);
        $psikologSabtu->assignRole('psikolog');

        PsikologProfile::create([
            'user_id' => $psikologSabtu->id,
            'NIP' => 1001, 
            'spesialisasi' => 'Psikolog Klinis Dewasa',
            'hari_jaga' => 'Saturday', 
        ]);

        // PERBAIKAN UTAMA: Tambahkan ke tabel jadwal_psikolog dengan hari Bahasa Indonesia
        JadwalPsikolog::create([
            'user_id' => $psikologSabtu->id,
            'hari' => 'Sabtu', 
        ]);


        // ==========================================
        // 4. Buat Psikolog Shift MINGGU
        // ==========================================
        $psikologMinggu = User::create([
            'name' => 'Dr. Budi (Minggu)',
            'username' => 'budi_psikolog',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => '55667788',
            'alamat' => 'Jl. Psikolog B No.4',
            'no_telp' => '6281234567892',
            'email_verified_at' => now(),
        ]);
        $psikologMinggu->assignRole('psikolog');

        PsikologProfile::create([
            'user_id' => $psikologMinggu->id,
            'NIP' => 1002,
            'spesialisasi' => 'Psikolog Anak & Remaja',
            'hari_jaga' => 'Sunday',
        ]);

        // PERBAIKAN UTAMA: Tambahkan ke tabel jadwal_psikolog dengan hari Bahasa Indonesia
        JadwalPsikolog::create([
            'user_id' => $psikologMinggu->id,
            'hari' => 'Minggu',
        ]);
    }
}