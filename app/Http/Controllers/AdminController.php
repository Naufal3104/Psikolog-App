<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Artikel;
use App\Models\HasilDeteksi;
use App\Models\InterpretasiSkor;
use App\Models\Infografis;
use App\Models\KategoriDeteksi;
use App\Models\Pertanyaan;
use App\Models\User;
use App\Models\Video;
use App\Models\JadwalPsikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function index_question(Request $request)
    {
        // 1. Ambil semua kategori untuk filter dropdown
        $semuaKategori = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 2. Mulai query pertanyaan, jangan panggil ->get() dulu
        $query = Pertanyaan::with('kategori')
            ->orderBy('kategori_deteksi_id')
            ->orderBy('urutan');

        // 3. Terapkan filter PENCARIAN (request 'search')
        $query->when($request->query('search'), function ($q, $search) {
            // Cari di kolom 'teks_pertanyaan'
            $q->where('teks_pertanyaan', 'like', "%{$search}%");
        });

        // 4. Terapkan filter KATEGORI (request 'kategori')
        $query->when($request->query('kategori'), function ($q, $kategoriId) {
            $q->where('kategori_deteksi_id', $kategoriId);
        });

        // 5. Eksekusi query dengan PAGINATE (50 data per halaman)
        //    ->withQueryString() akan membuat link pagination mengingat
        //    filter 'search' dan 'kategori' Anda.
        $semuaPertanyaan = $query->paginate(50)->withQueryString();

        // 6. Ambil total data (dari hasil pagination)
        $totalPertanyaan = $semuaPertanyaan->total();

        // 7. Kirim semua data ke view
        return view('admin.kelola-deteksi', [
            'semuaPertanyaan' => $semuaPertanyaan, // Ini sekarang adalah Paginator object
            'semuaKategori' => $semuaKategori,
            'totalPertanyaan' => $totalPertanyaan,
        ]);
    }

    public function create_question()
    {
        // Ambil kategori untuk dropdown
        $kategoriDeteksi = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 2. Siapkan PETA URUTAN (Urutan Tertinggi per Kategori)
        // Ini akan mengambil data seperti: ['kategori_id_A' => 5, 'kategori_id_B' => 2]
        $urutanMap = Pertanyaan::select('kategori_deteksi_id', DB::raw('MAX(urutan) as max_urutan'))
            ->groupBy('kategori_deteksi_id')
            ->get()
            ->pluck('max_urutan', 'kategori_deteksi_id');

        return view('admin.tambah-pertanyaan', [
            'kategoriDeteksi' => $kategoriDeteksi,

            // 3. Kirim PETA URUTAN sebagai JSON ke view
            'urutanMapJson' => $urutanMap->toJson(),
        ]);
    }

    public function store_question(Request $request)
    {
        // 1. Validasi data (sama seperti update)
        $validatedData = $request->validate([
            'kategori_deteksi_id' => 'required|string|exists:kategori_deteksi,id',
            'teks_pertanyaan' => 'required|string',
            'tipe_jawaban' => 'required|in:ya_tidak,rating_1_5',
            'urutan' => 'required|integer',
            'pilihan' => 'required|array',
            'pilihan.*.teks' => 'required|string',
            'pilihan.*.bobot' => 'required|integer',
        ]);

        // 2. Buat data pertanyaan baru
        $pertanyaan = Pertanyaan::create([
            'kategori_deteksi_id' => $validatedData['kategori_deteksi_id'],
            'teks_pertanyaan' => $validatedData['teks_pertanyaan'],
            'tipe_jawaban' => $validatedData['tipe_jawaban'],
            'urutan' => $validatedData['urutan'],
        ]);

        // 3. Buat pilihan jawaban yang terkait
        //    Loop ini hanya akan memproses 'pilihan' yang dikirim (bukan yang 'disabled')
        foreach ($validatedData['pilihan'] as $dataPilihan) {
            $pertanyaan->pilihanJawaban()->create([
                'teks_jawaban' => $dataPilihan['teks'],
                'bobot_nilai' => $dataPilihan['bobot'],
            ]);
        }

        // 4. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelola-deteksi.index')->with('success', 'Pertanyaan baru berhasil ditambahkan!');
    }

    public function edit_question(Pertanyaan $pertanyaan)
    {
        // 1. Eager load pilihan jawaban yang terkait dengan pertanyaan ini
        $pertanyaan->load('pilihanJawaban');

        // 2. Ambil semua kategori untuk mengisi dropdown
        $kategoriDeteksi = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 3. Kirim data ke view
        return view('admin.edit-pertanyaan', [
            'pertanyaan' => $pertanyaan,
            'kategoriDeteksi' => $kategoriDeteksi,
        ]);
    }

    public function update_question(Request $request, Pertanyaan $pertanyaan)
    {
        // 1. Validasi (Ini sudah benar)
        $validatedData = $request->validate([
            'kategori_deteksi_id' => 'required|string|exists:kategori_deteksi,id',
            'teks_pertanyaan' => 'required|string',
            'tipe_jawaban' => 'required|in:ya_tidak,rating_1_5',
            'urutan' => 'required|integer',
            'pilihan' => 'required|array',
            'pilihan.*.teks' => 'required|string',
            'pilihan.*.bobot' => 'required|integer',
        ]);

        // 2. Update data pertanyaan (INI PERBAIKANNYA)
        // Kita update pertanyaan HANYA dengan data miliknya.
        $pertanyaan->update([
            'kategori_deteksi_id' => $validatedData['kategori_deteksi_id'],
            'teks_pertanyaan' => $validatedData['teks_pertanyaan'],
            'tipe_jawaban' => $validatedData['tipe_jawaban'],
            'urutan' => $validatedData['urutan'],
        ]);

        // 3. Hapus SEMUA pilihan jawaban lama
        $pertanyaan->pilihanJawaban()->delete();

        // 4. Buat ulang pilihan jawaban berdasarkan data form yang baru
        foreach ($validatedData['pilihan'] as $dataPilihan) {
            $pertanyaan->pilihanJawaban()->create([
                'teks_jawaban' => $dataPilihan['teks'],
                'bobot_nilai' => $dataPilihan['bobot'],
            ]);
        }

        // 5. Redirect
        return redirect()->route('kelola-deteksi.index')->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    public function destroy_question(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();

        return redirect()->back()->with('success', 'Pertanyaan berhasil dihapus!');
    }

    public function index_score(Request $request)
    {
        // 1. Ambil semua kategori untuk filter dropdown
        $semuaKategori = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 2. Mulai query, eager load relasi 'kategori'
        //    Urutkan berdasarkan kategori, lalu skor minimal (agar logis)
        $query = InterpretasiSkor::with('kategori')
            ->orderBy('kategori_deteksi_id')
            ->orderBy('skor_minimal');

        // 3. Terapkan filter PENCARIAN (berdasarkan 'teks_interpretasi')
        $query->when($request->query('search'), function ($q, $search) {
            $q->where('teks_interpretasi', 'like', "%{$search}%");
        });

        // 4. Terapkan filter KATEGORI
        $query->when($request->query('kategori'), function ($q, $kategoriId) {
            $q->where('kategori_deteksi_id', $kategoriId);
        });

        // 5. Paginate (kita gunakan 25 per halaman, 50 terlalu banyak untuk data ini)
        //    withQueryString() akan mengingat filter saat pindah halaman
        $semuaSkor = $query->paginate(25)->withQueryString();

        // 6. Ambil total data (dari hasil pagination)
        $totalSkor = $semuaSkor->total();

        // 7. Kirim semua data ke view
        return view('admin.kelola-skor', [
            'semuaSkor' => $semuaSkor,
            'semuaKategori' => $semuaKategori,
            'totalSkor' => $totalSkor,
        ]);
    }

    public function create_score()
    {
        // Ambil semua kategori untuk mengisi dropdown
        $kategoriDeteksi = KategoriDeteksi::orderBy('nama_kategori')->get();

        return view('admin.tambah-skor', [
            'kategoriDeteksi' => $kategoriDeteksi,
        ]);
    }

    /**
     * Menyimpan interpretasi skor baru ke database.
     */
    public function store_score(Request $request)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'kategori_deteksi_id' => 'required|string|exists:kategori_deteksi,id',
            'teks_interpretasi' => 'required|string|max:255',
            'skor_minimal' => 'required|integer|min:0',
            // 'gte' = greater than or equal to (skor maks harus >= skor min)
            'skor_maksimal' => 'required|integer|gte:skor_minimal',
            'deskripsi_hasil' => 'nullable|string',
        ]);

        // 2. Buat data baru
        InterpretasiSkor::create($validatedData);

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelola-skor.index')->with('success', 'Interpretasi skor baru berhasil ditambahkan!');
    }

    public function edit_score(InterpretasiSkor $skor)
    {
        // Ambil semua kategori untuk dropdown
        $kategoriDeteksi = KategoriDeteksi::orderBy('nama_kategori')->get();

        return view('admin.edit-skor', [
            'skor' => $skor, // Kirim data skor yang akan diedit
            'kategoriDeteksi' => $kategoriDeteksi,
        ]);
    }

    /**
     * Memperbarui interpretasi skor di database.
     */
    public function update_score(Request $request, InterpretasiSkor $skor)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'kategori_deteksi_id' => 'required|string|exists:kategori_deteksi,id',
            'teks_interpretasi' => 'required|string|max:255',
            'skor_minimal' => 'required|integer|min:0',
            'skor_maksimal' => 'required|integer|gte:skor_minimal',
            'deskripsi_hasil' => 'nullable|string',
        ]);

        // 2. Update data
        $skor->update($validatedData);

        // 3. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelola-skor.index')->with('success', 'Interpretasi skor berhasil diperbarui!');
    }

    /**
     * Menghapus interpretasi skor dari database.
     */
    public function destroy_score(InterpretasiSkor $interpretasiSkor)
    {
        // 1. Hapus data
        $interpretasiSkor->delete();

        // 2. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelola-skor.index')->with('success', 'Interpretasi skor berhasil dihapus!');
    }

    public function index_riwayat(Request $request)
    {
        // 1. Ambil kategori untuk filter
        $semuaKategori = KategoriDeteksi::orderBy('nama_kategori')->get();

        // 2. Mulai query, eager load relasi 'user' dan 'kategori'
        $query = HasilDeteksi::with(['user', 'kategori'])
            ->orderBy('created_at', 'desc'); // Tampilkan yang terbaru dulu

        // 3. Filter PENCARIAN (berdasarkan nama user)
        $query->when($request->query('search'), function ($q, $search) {
            $q->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%");
            });
        });

        // 4. Filter KATEGORI
        $query->when($request->query('kategori'), function ($q, $kategoriId) {
            $q->where('kategori_deteksi_id', $kategoriId);
        });

        // 5. Paginate
        $semuaHasil = $query->paginate(50)->withQueryString();

        // 6. Total
        $totalHasil = $semuaHasil->total();

        // 7. Kirim ke view
        return view('admin.kelola-riwayat', [
            'semuaHasil' => $semuaHasil,
            'semuaKategori' => $semuaKategori,
            'totalHasil' => $totalHasil,
        ]);
    }

    public function show_riwayat(HasilDeteksi $hasil_deteksi)
    {
        // Gunakan Route Model Binding untuk mengambil $hasil_deteksi

        // Eager load semua relasi yang dibutuhkan untuk halaman detail
        $hasil_deteksi->load([
            'user',
            'kategori',
            'jawabanUser.pertanyaan',
            'jawabanUser.pilihanJawaban',
        ]);

        return view('admin.show-riwayat', [
            'hasil' => $hasil_deteksi,
        ]);
    }

    public function index_artikel(Request $request)
    {
        // 1. Mulai query dasar (load relasi penulis)
        // Kita gunakan query() agar bisa disambung dengan kondisi lain
        $query = Artikel::with('penulis')->latest();

        // 2. Terapkan filter PENCARIAN (jika ada request 'search')
        $query->when($request->query('search'), function ($q, $search) {
            // Cari berdasarkan Judul ATAU Slug (opsional)
            $q->where('judul', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        });

        // 3. Eksekusi query dengan PAGINATE
        // withQueryString() penting agar saat pindah halaman, kata kunci pencarian tidak hilang
        $artikel = $query->paginate(20)->withQueryString();

        // 4. Kirim ke view
        return view('admin.kelola-artikel', [
            'artikel' => $artikel,
        ]);
    }

    /**
     * Menampilkan halaman daftar artikel (Publik).
     * Ini adalah fungsi index() lama dari ArtikelController.
     */

    /**
     * Menampilkan form untuk membuat artikel baru.
     */
    public function create_artikel()
    {
        return view('admin.tambah-post');
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store_artikel(Request $request)
    {
        // dd($request->all());
        // 1. Validasi
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:artikel,slug',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
        ]);

        $gambarPath = null;

        // 2. Simpan gambar
        if ($request->hasFile('featured_image')) {
            $gambarPath = $request->file('featured_image')->store('', 'public');
        }

        // 3. Simpan data
        Artikel::create([
            'id' => (string) Str::ulid(),
            'judul' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'isi' => $validatedData['content'],
            'penulis_id' => Auth::id(),
            'gambar' => $gambarPath,
            'keterangan_gambar' => $validatedData['image_caption'] ?? null,
            'views' => 0,
        ]);

        // 4. Redirect ke index admin
        return redirect()->route('artikel.index')->with('success', 'Artikel baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan satu artikel spesifik (Publik).
     */
    public function show_artikel($id)
    {
        $artikel = Artikel::with('penulis')->findOrFail($id);
        $saranArtikel = Artikel::orderBy('created_at', 'desc')->take(3)->get();

        return view('fitur.isiartikel', [
            'artikel' => $artikel,
            'saranArtikel' => $saranArtikel,
        ]);
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit_artikel($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Pastikan Anda membuat view ini nanti:
        return view('admin.edit-artikel', [
            'artikel' => $artikel,
        ]);
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update_artikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        // 1. Validasi
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('artikel', 'slug')->ignore($artikel->id)],
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
        ]);

        $gambarPath = $artikel->gambar;

        // 2. Cek gambar baru
        if ($request->hasFile('featured_image')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $gambarPath = $request->file('featured_image')->store('', 'public');
        }

        // 3. Update data
        $artikel->update([
            'judul' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'isi' => $validatedData['content'],
            'gambar' => $gambarPath,
            'keterangan_gambar' => $validatedData['image_caption'] ?? null,
        ]);

        // 4. Redirect ke index admin
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy_artikel($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();

        // 3. Redirect ke index admin
        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }

    // Menampilkan daftar psikolog pending
    public function index_verifikasi_psikolog()
    {
        // Ambil data user yang punya role psikolog DAN status profilnya 'pending'
        $psikologs = User::role('psikolog')
            ->with('psikologProfile')
            ->get()
            ->sortBy(function ($user) {
                return $user->psikologProfile->status === 'pending' ? 0 : 1;
            });

        return view('admin.kelola-psikolog', compact('psikologs'));
    }

    // Proses Approve
    public function approve_psikolog($id)
    {
        $user = User::findOrFail($id);

        if ($user->psikologProfile) {
            $user->psikologProfile->update(['status' => 'approved']);

            return back()->with('success', 'Psikolog berhasil disetujui.');
        }

        return back()->with('error', 'Profil tidak ditemukan.');
    }

    // Proses Reject (Opsional)
    public function reject_psikolog($id)
    {
        $user = User::findOrFail($id);

        if ($user->psikologProfile) {
            $user->psikologProfile->update(['status' => 'rejected']);

            return back()->with('success', 'Psikolog berhasil ditolak.');
        }

        return back()->with('error', 'Profil tidak ditemukan.');
    }

    // --- TAMBAHAN EDIT PSIKOLOG ---
    public function edit_psikolog($id)
    {
        $psikolog = User::with('psikologProfile')->findOrFail($id);

        return view('admin.edit-psikolog', compact('psikolog'));
    }

    public function update_psikolog(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            // Validasi User Data
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'NIK' => ['required', 'string', 'max:20'],
            'no_telp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],

            // Validasi Profile Data
            'NIP' => ['required', 'string'],
            'spesialisasi' => ['required', 'string'],
            'status' => ['required', 'in:pending,approved,rejected'], // Bisa ubah status manual juga
        ]);

        // Update Tabel Users
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'NIK' => $request->NIK,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        // Update Tabel PsikologProfile
        if ($user->psikologProfile) {
            $user->psikologProfile->update([
                'NIP' => $request->NIP,
                'spesialisasi' => $request->spesialisasi,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('verifikasi.index')->with('success', 'Data Psikolog berhasil diperbarui.');
    }

    public function activityLogs(Request $request)
    {
        // 1. Memulai Query dari data terbaru (CCTV rekaman terakhir)
        $query = ActivityLog::latest();

        // 2. Logika Pencarian (Search Filter)
        // Jika admin mengetik sesuatu di kolom cari, kita filter berdasarkan Nama User atau Jenis Aksi
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%$search%")
                    ->orWhere('action', 'like', "%$search%");
            });
        }

        // 3. Logika Filter Tipe Aksi (Opsional, menggantikan dropdown Kategori)
        if ($request->has('filter_action') && $request->filter_action != null) {
            // Mencari aksi spesifik, misal hanya ingin lihat siapa yang LOGIN
            $query->where('action', 'like', '%'.$request->filter_action.'%');
        }

        // 4. Eksekusi dengan Pagination (10 data per halaman)
        $logs = $query->paginate(10)->withQueryString();

        // 5. Kirim data ke View
        return view('admin.activity-log', compact('logs'));
    }

    public function videoIndex(Request $request)
    {
        $query = Video::with('penulis');

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $videos = $query->latest()->paginate(10);

        return view('admin.kelola-video', compact('videos'));
    }

    public function videoCreate()
    {
        return view('admin.form-video');
    }

    public function videoStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url', // Validasi format URL
            'kategori' => 'required|string',
        ]);

        Video::create([
            'judul' => $request->judul,
            'url' => $request->url,
            'kategori' => $request->kategori,
            'penulis_id' => Auth::id(), // Mengambil ID admin yang sedang login
            'views' => 0,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function videoEdit($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.form-video', compact('video'));
    }

    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url',
            'kategori' => 'required|string',
        ]);

        $video = Video::findOrFail($id);
        $video->update([
            'judul' => $request->judul,
            'url' => $request->url,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function videoDestroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus.');
    }

    public function infografisIndex(Request $request)
    {
        $query = Infografis::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('caption', 'like', "%{$search}%");
        }

        $infografis = $query->latest()->paginate(10);

        return view('admin.kelola-infografis', compact('infografis'));
    }

    public function infografisCreate()
    {
        return view('admin.form-infografis');
    }

    public function infografisStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|url', // Wajib format URL
            'caption' => 'nullable|string',
        ]);

        Infografis::create([
            'judul' => $request->judul,
            'gambar' => $request->gambar,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil ditambahkan.');
    }

    public function infografisEdit($id)
    {
        $infografis = Infografis::findOrFail($id);

        return view('admin.form-infografis', compact('infografis'));
    }

    public function infografisUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|url',
            'caption' => 'nullable|string',
        ]);

        $item = Infografis::findOrFail($id);
        $item->update([
            'judul' => $request->judul,
            'gambar' => $request->gambar,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil diperbarui.');
    }

    public function infografisDestroy($id)
    {
        $item = Infografis::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.infografis.index')->with('success', 'Infografis berhasil dihapus.');
    }

    public function jadwalIndex(Request $request)
    {
        $search = $request->input('search');

        $jadwal = JadwalPsikolog::with('user')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('hari', 'like', "%{$search}%");
            })
            // Urutkan berdasarkan hari (opsional, bisa disesuaikan)
            ->orderBy('id', 'desc') 
            ->paginate(10);

        return view('admin.kelola-jadwal', compact('jadwal'));
    }

    /**
     * Menampilkan form tambah jadwal.
     */
    public function jadwalCreate()
    {
        // Ambil user yang berperan sebagai psikolog (sesuaikan logic jika ada role khusus)
        // Contoh: User::where('role', 'psikolog')->get();
        // Di sini saya ambil semua user sebagai contoh umum.
        $users = User::role('psikolog')->get(); 
        
        return view('admin.form-jadwal', compact('users'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function jadwalStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hari'    => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ]);

        // Cek apakah psikolog sudah punya jadwal di hari yang sama (opsional, untuk mencegah duplikasi)
        $exists = JadwalPsikolog::where('user_id', $request->user_id)
                    ->where('hari', $request->hari)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['hari' => 'Psikolog ini sudah memiliki jadwal di hari tersebut.']);
        }

        JadwalPsikolog::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function jadwalEdit($id)
    {
        $jadwal = JadwalPsikolog::findOrFail($id);
        $users = User::role('psikolog')->get(); // Sesuaikan dengan filter role psikolog jika ada

        return view('admin.form-jadwal', compact('jadwal', 'users'));
    }

    /**
     * Memperbarui jadwal di database.
     */
    public function jadwalUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hari'    => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ]);

        $jadwal = JadwalPsikolog::findOrFail($id);
        
        // Cek duplikasi jika mengubah hari/user (kecuali punya diri sendiri)
        $exists = JadwalPsikolog::where('user_id', $request->user_id)
                    ->where('hari', $request->hari)
                    ->where('id', '!=', $id)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['hari' => 'Psikolog ini sudah memiliki jadwal di hari tersebut.']);
        }

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function jadwalDestroy($id)
    {
        $jadwal = JadwalPsikolog::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
