<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PsikologProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class PsikologController extends Controller
{
    /**
     * Menampilkan form registrasi khusus Psikolog
     */
    public function create()
    {
        return view('auth.register-psikolog');
    }

    /**
     * Memproses registrasi Psikolog
     */
    public function store(Request $request)
    {
        dd($request->all());
        // 1. Validasi Input Lengkap
        $request->validate([
            // Data Akun Dasar
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Data Tambahan User (Wajib diisi sesuai request)
            'NIK' => ['required', 'numeric', 'digits_between:10,20'], 
            'alamat' => ['required', 'string', 'max:500'],
            'no_telp' => ['required', 'numeric', 'digits_between:10,15'], // Disarankan format 628...
            
            // Data Khusus Psikolog (Wajib diisi, kecuali hari_jaga)
            'NIP' => ['required', 'numeric'],
            'spesialisasi' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 2. Buat User
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'NIK' => $request->NIK,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                ]);

                // 3. Assign Role
                $user->assignRole('psikolog');

                // 4. Buat Profile Psikolog
                // hari_jaga sengaja dikosongi (null) sesuai permintaan
                PsikologProfile::create([
                    'user_id' => $user->id,
                    'NIP' => $request->NIP,
                    'spesialisasi' => $request->spesialisasi,
                    'hari_jaga' => null, 
                ]);

                event(new Registered($user));
            });

            return redirect(route('login', absolute: false));

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftar. Silakan coba lagi. ' . $e->getMessage()]);
        }
    }
}