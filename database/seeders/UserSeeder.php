<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         //
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $psikolog = \App\Models\User::create([
            'name' => 'Psikolog',
            'email' => 'psikolog@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $psikolog->assignRole('psikolog');

        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('user');
    }
}
