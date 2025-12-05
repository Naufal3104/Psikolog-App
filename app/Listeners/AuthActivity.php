<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use App\Models\ActivityLog;
use Illuminate\Events\Dispatcher;

class AuthActivity
{
    // 1. Menangani Login
    public function onLogin($event) {
        ActivityLog::create([
            'user_name' => $event->user->name,
            'action'    => 'LOGIN',
        ]);
    }

    // 2. Menangani Logout
    public function onLogout($event) {
        // Cek jika user ada (kadang session sudah habis duluan)
        $name = $event->user ? $event->user->name : 'Unknown User';
        
        ActivityLog::create([
            'user_name' => $name,
            'action'    => 'LOGOUT',
        ]);
    }

    // 3. Menangani Register (User Baru)
    public function onRegister($event) {
        ActivityLog::create([
            'user_name' => $event->user->name,
            'action'    => 'REGISTER_NEW_USER',
        ]);
    }

    // Ini adalah "Jadwal Tugas" Kepala Security
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(Login::class, [self::class, 'onLogin']);
        $events->listen(Logout::class, [self::class, 'onLogout']);
        $events->listen(Registered::class, [self::class, 'onRegister']);
    }
}