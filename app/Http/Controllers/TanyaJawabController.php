<?php

namespace App\Http\Controllers;

use App\Models\TanyaJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanyaJawabController extends Controller
{
    /**
     * Tampilkan semua pertanyaan (fitur.tanya)
     */
    public function index()
    {
        $tanyaJawab = TanyaJawab::with(['user', 'psikiater'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('fitur.tanya', compact('tanyaJawab'));
    }

    /**
     * Form untuk membuat pertanyaan baru (fitur.buat-tanya)
     */
    public function create()
    {
        return view('fitur.buat-tanya');
    }

    public function belumDijawab()
{
    // Ambil pertanyaan dengan status "belum dijawab"
    $tanyaJawab = TanyaJawab::with('user')
        ->where('status', 'belum dijawab')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.tanya-jawab', compact('tanyaJawab'));
}
public function formJawab($id)
{
    $tanyaJawab = TanyaJawab::with('user')->findOrFail($id);

    return view('admin.form-jawab', compact('tanyaJawab'));
}

    /**
     * Simpan pertanyaan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'nullable|string',
        ]);

        TanyaJawab::create([
            'user_id' => Auth::id(),
            'pertanyaan' => $request->pertanyaan,
            'kategori' => $request->kategori,
            'status' => 'belum dijawab',
            'views' => 0,
        ]);

        return redirect()->route('tanya.index')->with('success', 'Pertanyaan berhasil dikirim!');
    }

    /**
     * Tampilkan detail satu pertanyaan + jawaban (fitur.tanya-jawab)
     */
    public function show($id)
    {
        $tanyaJawab = TanyaJawab::with(['user', 'psikiater', 'balasan'])->findOrFail($id);

        // Tambah view count
        $tanyaJawab->increment('views');

        return view('fitur.tanya', compact('tanyaJawab'));
    }

    /**
     * Update jawaban psikiater (bisa diatur hanya untuk role tertentu)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $tanyaJawab = TanyaJawab::findOrFail($id);

        $tanyaJawab->update([
            'jawaban' => $request->jawaban,
            'psikiater_id' => Auth::id(),
            'status' => 'sudah dijawab',
        ]);

        return redirect()->route('tanya.show', $id)->with('success', 'Jawaban berhasil dikirim!');
    }

    /**
     * Hapus pertanyaan
     */
    public function destroy($id)
    {
        $tanyaJawab = TanyaJawab::findOrFail($id);

        // Opsional: hanya boleh hapus jika pemiliknya
        if ($tanyaJawab->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus pertanyaan ini.');
        }

        $tanyaJawab->delete();

        return redirect()->route('tanya.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
