<?php

namespace App\Http\Controllers;

use App\Models\TanyaJawab;
use App\Models\BalasanTanyaJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TanyaJawabController extends Controller
{
    /**
     * Tampilkan semua pertanyaan (fitur.tanya)
     */
    public function index()
    {
        $tanya = TanyaJawab::with('user') // Eager loading
            ->orderBy('vote_count', 'desc')
            ->latest() // Urutkan berdasarkan terbaru
            ->paginate(10); // Gunakan pagination

        return view('fitur.tanya', compact('tanya'));
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
        // 1. Validasi - Menambahkan 'judul_pertanyaan' dan menghapus 'kategori'
        $request->validate([
            'judul_pertanyaan' => 'required|string|max:255',
            'pertanyaan' => 'required|string',
        ]);

        // 2. Membuat Slug (ID)
        $slug = Str::slug($request->judul_pertanyaan, '-');

        // 3. Memeriksa Keunikan Slug
        // Jika slug sudah ada, tambahkan akhiran unik (misal: "sebuah-pertanyaan-2")
        $originalSlug = $slug;
        $counter = 1;

        // Kita menggunakan find() karena 'id' adalah primary key.
        // Ini adalah cara paling efisien untuk memeriksa berdasarkan primary key.
        while (TanyaJawab::find($slug)) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        // 4. Membuat Data
        // Menyesuaikan dengan $fillable di model baru
        TanyaJawab::create([
            'id' => $slug, // <-- ID string yang unik
            'user_id' => Auth::id(),
            'judul_pertanyaan' => $request->judul_pertanyaan,
            'pertanyaan' => $request->pertanyaan,
            'status' => 'Belum Dijawab',
            // 'kategori' dan 'views' dihapus karena tidak ada di $fillable baru
        ]);

        return redirect()->route('tanya.index')->with('success', 'Pertanyaan berhasil dikirim!');
    }

    /**
     * Tampilkan detail satu pertanyaan + jawaban (fitur.tanya-jawab)
     */
    public function show($id)
    {
        $tanyaJawab = TanyaJawab::with(['user', 'balasan'])->findOrFail($id);

        // Tambah view count
        $tanyaJawab->increment('vote_count');

        return view('fitur.balasan-tanya', compact('tanyaJawab'));
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

    public function storeBalasan(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'isi_balasan' => 'required|string|min:3', 
        ]);

        // 2. Pastikan pertanyaan utamanya ada
        $tanyaJawab = TanyaJawab::findOrFail($id);
        $user = Auth::user(); // Ambil user yang sedang login

        // 3. Buat balasan
        BalasanTanyaJawab::create([
            'tanya_jawab_id' => $tanyaJawab->id,
            'user_id' => $user->id,
            'isi_balasan' => $request->isi_balasan,
        ]);

        // [LOGIKA BARU] Cek Role Psikolog & Update Status
        // Jika user punya role 'psikolog' DAN status saat ini masih 'belum dijawab'
        if ($user->hasRole('psikolog') && $tanyaJawab->status == 'Belum Dijawab') {
            
            // Update status pertanyaan jadi 'sudah dijawab'
            // Kita juga bisa set psikiater_id ke user yang membalas ini
            $tanyaJawab->update([
                'status' => 'Sudah Dijawab',
                'psikiater_id' => $user->id 
            ]);
        }

        // 4. Kembalikan ke halaman 'show' dengan pesan sukses
        return redirect()->route('tanya.show', $tanyaJawab->id)
                         ->with('success', 'Balasan Anda berhasil dikirim!');
    }

    public function upvote($id)
    {
        $tanya = TanyaJawab::findOrFail($id);
        $tanya->increment('vote_count');
        return back(); // Kembali ke halaman sebelumnya
    }

    public function downvote($id)
    {
        $tanya = TanyaJawab::findOrFail($id);
        $tanya->decrement('vote_count');
        return back(); // Kembali ke halaman sebelumnya
    }
}
