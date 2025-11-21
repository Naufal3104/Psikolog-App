<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Menampilkan daftar video.
     */
    public function index()
    {
        return view('fitur.video', [
            // Ambil video terbaru paling atas, sertakan relasi penulis
            'videos' => Video::with('penulis')->latest()->get()
        ]);
    }

    /**
     * Menampilkan form tambah video baru.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.crud-video', compact('users'));
    }

    /**
     * Menyimpan video baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dari form
        $validatedData = $request->validate([
            'judul'      => 'required|string|max:255',
            'url'        => 'required|url|max:255',
            'penulis_id' => 'required|exists:users,id',
            'kategori'   => 'required|string|max:100',
        ]);

        // 2. Simpan data video ke database
        Video::create([
            'judul'      => $validatedData['judul'],
            'url'        => $validatedData['url'],
            'penulis_id' => $validatedData['penulis_id'],
            'kategori'   => $validatedData['kategori'],
            'views'      => 0,
        ]);

        // Cara lebih modern (hasilnya sama)
return to_route('video.index')->with('success', 'Video baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu video.
     */
    public function show($id)
    {
    }

    /**
     * Menampilkan form edit video.
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $users = User::all();

        return view('fitur.video.edit-video', compact('video', 'users'));
    }

    /**
     * Menyimpan perubahan video.
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'judul'      => 'required|string|max:255',
            'url'        => 'required|url|max:255',
            'penulis_id' => 'required|exists:users,id',
            'kategori'   => 'required|string|max:100',
        ]);

        // Update data video
        $video->update($validatedData);

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Menghapus video dari database.
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }
}
        