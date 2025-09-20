<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [
            // Admin khusus
            'kelola-akun',
            'atur-akses-akun',
            'hapus-akun',

            // Umum
            'kelola-profil',
            'kelola-jadwal',
            'lihat-jadwal',

            // Artikel
            'kelola-artikel',
            'input-artikel',
            'lihat-artikel',

            // Tanya jawab
            'kelola-tanya-jawab',
            'buat-pertanyaan',
            'jawab-pertanyaan',
            'lihat-tanya-jawab',

            // Konsultasi
            'link-whatsapp-consultation',

            // Deteksi dini
            'kelola-deteksi-dini',
            'fitur-deteksi-dini',

            // Video
            'kelola-video',
            'tambah-video',
            'lihat-video',

            // Infografis
            'kelola-infografis',
            'input-infografis',
            'lihat-infografis',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $psikolog = Role::firstOrCreate(['name' => 'psikolog']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Admin → semua
        $admin->givePermissionTo(Permission::all());

        // Psikolog
        $psikolog->givePermissionTo([
            'kelola-artikel',
            'input-artikel',
            'lihat-artikel',
            'jawab-pertanyaan',
            'kelola-jadwal',
            'tambah-video',
            'input-infografis',
        ]);

        // User (Customer)
        $user->givePermissionTo([
            'lihat-artikel',
            'lihat-video',
            'lihat-infografis',
            'buat-pertanyaan',
            'lihat-tanya-jawab',
            'lihat-jadwal',
            'link-whatsapp-consultation',
            'fitur-deteksi-dini',
        ]);
    }
}
