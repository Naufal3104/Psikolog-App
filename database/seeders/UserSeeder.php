<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PsikologProfile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => 12345678, 
            'alamat' => 'Jl. Admin No.1',
            'no_telp' => '081234567890',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $admin2 = User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => 12345679,  // NIK dibedakan
            'alamat' => 'Jl. Admin No.2',
            'no_telp' => '081234567891', // No Telp dibedakan
            'email_verified_at' => now(),
        ]);
        $admin2->assignRole('admin');

        $user = User::create([
            'name' => 'User Pengguna',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'NIK' => 87654321,
            'alamat' => 'Jl. User No.3',
            'no_telp' => '087654321098',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');


        // // ==========================================
        // // 3. Buat Psikolog Shift SENIN
        // // ==========================================
        // $psikologSenin = User::create([
        //     'name' => 'Dr. Andi (Senin)',
        //     'email' => 'andi@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'NIK' => 11223344,
        //     'alamat' => 'Jl. Psikolog A No.2',
        //     'no_telp' => '6281234567891', 
        //     'email_verified_at' => now(),
        // ]);
        // $psikologSenin->assignRole('psikolog');

        // PsikologProfile::create([
        //     'user_id' => $psikologSenin->id,
        //     'NIP' => 1001, 
        //     'spesialisasi' => 'Psikolog Klinis Dewasa',
        //     'hari_jaga' => 'Monday', // Jaga hari Senin
        // ]);


        // // ==========================================
        // // 4. Buat Psikolog Shift SELASA
        // // ==========================================
        // $psikologSelasa = User::create([
        //     'name' => 'Dr. Budi (Selasa)',
        //     'email' => 'budi@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'NIK' => 55667788,
        //     'alamat' => 'Jl. Psikolog B No.4',
        //     'no_telp' => '6281234567892',
        //     'email_verified_at' => now(),
        // ]);
        // $psikologSelasa->assignRole('psikolog');

        // PsikologProfile::create([
        //     'user_id' => $psikologSelasa->id,
        //     'NIP' => 1002,           // Sesuai migrasi (integer)
        //     'spesialisasi' => 'Psikolog Anak & Remaja',
        //     'hari_jaga' => 'Tuesday', // Jaga hari Selasa
        // ]);
    }
}