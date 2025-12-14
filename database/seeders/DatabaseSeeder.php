<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FiturSeeder;
use Database\Seeders\ArtikelSeeder;
use Database\Seeders\VideoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        RolePermissionSeeder::class,
        UserSeeder::class,
        FiturSeeder::class,
        ArtikelSeeder::class,
        VideoSeeder::class,
    ]);
}
}
