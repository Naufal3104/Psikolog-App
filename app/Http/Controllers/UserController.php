<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan formulir profil user dengan tampilan baru.
     */
    public function edit(Request $request): View
    {
        return view('fitur.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil akun user.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Ambil data tervalidasi
        // Data NIP & Spesialisasi otomatis masuk ke sini jika user adalah psikolog (karena logic di Request tadi)
        $validatedData = $request->validated();

        // 2. Update data tabel users (name, email, nik, dll)
        $request->user()->fill($validatedData);

        // 3. Reset verifikasi email jika email berubah
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // 4. Update Foto Profil
        if ($request->hasFile('foto_profil')) {
            // Validasi file gambar (bisa dipindah ke Request juga sebenarnya)
            $request->validate([
                'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($request->user()->foto_profil && Storage::disk('public')->exists($request->user()->foto_profil)) {
                Storage::disk('public')->delete($request->user()->foto_profil);
            }

            $path = $request->file('foto_profil')->store('foto-profil', 'public');
            $request->user()->foto_profil = $path;
        }

        // 5. Simpan data User Utama
        $request->user()->save();

        // 6. LOGIKA KHUSUS PSIKOLOG (UPDATE TABEL RELASI)
        if ($request->user()->hasRole('psikolog')) {

            // Menggunakan updateOrCreate agar:
            // - Jika data belum ada -> Dibuat (Create)
            // - Jika data sudah ada -> Diupdate (Update)

            // Pastikan relasi 'psikologProfile' ada di Model User
            $request->user()->psikologProfile()->updateOrCreate(
                ['user_id' => $request->user()->id], // Kondisi pencarian (WHERE)
                [
                    'NIP' => $validatedData['NIP'],           // Data yang diupdate
                    'spesialisasi' => $validatedData['spesialisasi'],
                ]
            );
        }

        return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus foto profil saat akun dihapus
        if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
