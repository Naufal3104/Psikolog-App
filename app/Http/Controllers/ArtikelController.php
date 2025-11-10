<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman daftar artikel.
     */
    public function index()
    {
        return view('fitur.artikel', [
            // Ambil artikel terbaru di paling atas
            'artikel' => Artikel::with('penulis')->latest()->get() 
        ]);
    }

    public function create()
    {
        return view('admin.tambah-post'); 
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dari form (sesuai dengan atribut 'name' di HTML)
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'required|string|max:255|unique:artikel,slug', // Validasi unik di tabel 'artikel', kolom 'slug'
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Validasi file gambar
            'image_caption'  => 'nullable|string|max:255',
        ]);

        $gambarPath = null;

        // 2. Cek jika ada file gambar yang diunggah
        if ($request->hasFile('featured_image')) {
            // Simpan gambar ke storage/app/public/artikel-gambar
            // 'public' adalah disk. 'artikel-gambar' adalah foldernya.
            $gambarPath = $request->file('featured_image')->store('artikel-gambar', 'public');
        }

        // 3. Simpan data ke database
        Artikel::create([
            'id'                => (string) Str::ulid(), // Membuat ID unik (karena kolom Anda varchar)
            'judul'             => $validatedData['title'],
            'slug'              => $validatedData['slug'],
            'isi'               => $validatedData['content'],
            'penulis_id'        => Auth::id(), // Ambil ID pengguna yang sedang login
            'gambar'            => $gambarPath, // Simpan path gambar (atau null)
            'keterangan_gambar' => $validatedData['image_caption'] ?? null,
            'views'             => 0, // Set default views
        ]);

        // 4. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('artikel.index')->with('success', 'Artikel baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan satu artikel spesifik.
     */
    public function show($id)
    {
        $artikel = Artikel::with('penulis')->findOrFail($id);

        // Contoh: Menambah 'views' setiap kali artikel dilihat
        // $artikel->increment('views'); // Pindahkan ini ke logic jika diperlukan

        return view('fitur.isiartikel', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        // Anda perlu membuat view: resources/views/fitur/artikel-edit.blade.php
        // View ini akan mirip dengan 'create', tapi datanya sudah terisi.
        return view('fitur.artikel-edit', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        // 1. Validasi data
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            // Rule::unique... -> abaikan ID artikel ini saat mengecek keunikan slug
            'slug'           => ['required', 'string', 'max:255', Rule::unique('artikel', 'slug')->ignore($artikel->id)],
            'content'        => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'image_caption'  => 'nullable|string|max:255',
        ]);

        $gambarPath = $artikel->gambar; // Ambil path gambar yang lama

        // 2. Cek jika ada gambar baru diunggah
        if ($request->hasFile('featured_image')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('featured_image')->store('artikel-gambar', 'public');
        }

        // 3. Update data di database
        $artikel->update([
            'judul'             => $validatedData['title'],
            'slug'              => $validatedData['slug'],
            'isi'               => $validatedData['content'],
            'gambar'            => $gambarPath, // Path gambar baru (atau path lama jika tidak ganti)
            'keterangan_gambar' => $validatedData['image_caption'] ?? null,
        ]);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // 1. Hapus file gambar terkait dari storage
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        // 2. Hapus data artikel dari database
        $artikel->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}