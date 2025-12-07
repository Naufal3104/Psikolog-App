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
        // 1. Update Data Standar (Nama, Email)
        $request->user()->fill($request->validated());

        // 2. Cek apakah Email berubah
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // 3. Logika Upload Foto Profil (REVISI: menggunakan 'foto_profil')
        if ($request->hasFile('foto_profil')) {

            // Validasi input 'foto_profil'
            $request->validate([
                'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            // Hapus foto lama jika ada
            // Perhatikan: Kita akses kolom '$request->user()->foto_profil'
            if ($request->user()->foto_profil && Storage::disk('public')->exists($request->user()->foto_profil)) {
                Storage::disk('public')->delete($request->user()->foto_profil);
            }

            // Simpan foto baru ke folder 'foto-profil' di storage public
            // Input form juga bernama 'foto_profil'
            $path = $request->file('foto_profil')->store('foto-profil', 'public');

            // Simpan path ke database (kolom foto_profil)
            $request->user()->foto_profil = $path;
        }

        // 4. Simpan Perubahan
        $request->user()->save();

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
