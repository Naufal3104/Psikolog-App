<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\PsikologProfile;
use App\Models\User;
use App\Models\HasilDeteksi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

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
        // 1. Validasi Input
        $request->validate([
            // Data Akun Dasar
            'name' => ['required', 'string', 'max:255'],
            // Tambahkan validasi username di sini
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Data Tambahan User
            'NIK' => ['required', 'numeric', 'digits_between:10,20'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_telp' => ['required', 'string', 'max:15'], // Ubah ke string agar aman untuk format +62

            // Data Khusus Psikolog
            'NIP' => ['required', 'numeric'],
            'spesialisasi' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 2. Buat User
                $user = User::create([
                    'name' => $request->name,
                    'username' => $request->username, // Ambil dari inputan user
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'NIK' => $request->NIK,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                ]);

                // 3. Assign Role
                $user->assignRole('psikolog');

                // 4. Buat Profile Psikolog
                PsikologProfile::create([
                    'user_id' => $user->id,
                    'NIP' => $request->NIP,
                    'spesialisasi' => $request->spesialisasi,
                ]);

                event(new Registered($user));
                Auth::login($user);
            });

            return redirect(route('login', absolute: false));

        } catch (\Exception $e) {
            // Tampilkan pesan error spesifik untuk debugging (bisa dihapus saat production)
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftar: '.$e->getMessage()]);
        }
    }

    public function index_artikel(Request $request)
    {
        // Ambil artikel HANYA milik psikolog yang sedang login
        $query = Artikel::where('penulis_id', Auth::id())->latest();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        $artikel = $query->paginate(10)->withQueryString();

        return view('psikolog.kelola-artikel', compact('artikel'));
    }

    public function create_artikel()
    {
        return view('psikolog.tambah-artikel');
    }

    public function store_artikel(Request $request)
    {
        // 1. Tambahkan validasi keterangan_gambar
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan_gambar' => 'nullable|string|max:255', // <--- Baru
        ]);

        $gambarPath = null;
        if ($request->hasFile('featured_image')) {
            $gambarPath = $request->file('featured_image')->store('artikel-images', 'public');
        }

        $slug = Str::slug($validatedData['judul']).'-'.Str::random(5);

        Artikel::create([
            'id' => (string) Str::ulid(),
            'judul' => $validatedData['judul'],
            'slug' => $slug,
            'isi' => $validatedData['isi'],
            'penulis_id' => Auth::id(),
            'gambar' => $gambarPath,
            'keterangan_gambar' => $request->keterangan_gambar, // <--- Simpan Data
            'views' => 0,
        ]);

        return redirect()->route('psikolog.artikel.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit_artikel($id)
    {
        // Pastikan hanya bisa edit artikel sendiri
        $artikel = Artikel::where('penulis_id', Auth::id())->findOrFail($id);

        return view('psikolog.edit-artikel', compact('artikel'));
    }

    public function update_artikel(Request $request, $id)
    {
        $artikel = Artikel::where('penulis_id', Auth::id())->findOrFail($id);

        // 1. Tambahkan validasi keterangan_gambar
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan_gambar' => 'nullable|string|max:255', // <--- Baru
        ]);

        if ($request->hasFile('featured_image')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $artikel->gambar = $request->file('featured_image')->store('artikel-images', 'public');
        }

        if ($artikel->judul != $validatedData['judul']) {
            $artikel->slug = Str::slug($validatedData['judul']).'-'.Str::random(5);
        }

        $artikel->judul = $validatedData['judul'];
        $artikel->isi = $validatedData['isi'];
        $artikel->keterangan_gambar = $request->keterangan_gambar; // <--- Update Data
        $artikel->save();

        return redirect()->route('psikolog.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy_artikel($id)
    {
        $artikel = Artikel::where('penulis_id', Auth::id())->findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }

    public function index_deteksi(Request $request)
    {
        // 1. Ambil data HasilDeteksi dari SEMUA user
        // Load relasi 'user' karena kita perlu menampilkan namanya
        $query = HasilDeteksi::with(['user', 'kategori', 'interpretasi'])->latest();

        // 2. Fitur Pencarian berdasarkan Nama User
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $riwayat = $query->paginate(10)->withQueryString();

        return view('psikolog.riwayat-deteksi', compact('riwayat'));
    }
}
