<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DeteksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsikologController;
use App\Http\Controllers\TanyaJawabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/register-psikolog', [PsikologController::class, 'create'])->name('psikolog.register');
Route::post('/psikolog-store', [PsikologController::class, 'store'])->name('psikolog.register.store');

Route::middleware(['auth', 'verified'])->group(function () {
    // Halaman Home
    Route::get('/', fn () => view('index'))->name('home');

    // Profil User
    Route::get('/user/profile', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/user/profile', [UserController::class, 'destroy'])->name('user.profile.destroy');

    // === 6 FITUR UTAMA (PUBLIK) ===
    // Artikel (Publik + Form Tambah)
    Route::middleware(['role:admin|psikolog'])->group(function () {
        Route::prefix('psikolog/artikel')->name('psikolog.artikel.')->group(function () {
            Route::get('/', [PsikologController::class, 'index_artikel'])->name('index');
            Route::get('/create', [PsikologController::class, 'create_artikel'])->name('create');
            Route::post('/', [PsikologController::class, 'store_artikel'])->name('store');
            Route::get('/{id}/edit', [PsikologController::class, 'edit_artikel'])->name('edit');
            Route::put('/{id}', [PsikologController::class, 'update_artikel'])->name('update');
            Route::delete('/{id}', [PsikologController::class, 'destroy_artikel'])->name('destroy');
        });
        Route::get('/psikolog/deteksi-pengguna', [PsikologController::class, 'index_deteksi'])
            ->name('psikolog.deteksi.index');
    });
    Route::get('/artikel', [AdminController::class, 'index_artikel_publik'])->name('artikel-publik.index');
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

    // Deteksi Dini (Publik)
    Route::get('/deteksi', [DeteksiController::class, 'index'])->name('deteksi.index');
    Route::get('/deteksi/hasil', [DeteksiController::class, 'hasil'])->name('deteksi.hasil');
    Route::get('/deteksi/riwayat', [DeteksiController::class, 'riwayat'])->name('deteksi.riwayat');
    Route::get('/deteksi/{kategori}', [DeteksiController::class, 'show'])->name('deteksi.show');
    Route::post('/deteksi/process', [DeteksiController::class, 'process'])->name('deteksi.process');
    Route::get('/deteksi/hasil/{id}', [DeteksiController::class, 'hasil'])->name('deteksi.hasil');

    // Tanya Psikolog
    Route::get('/tanya', [TanyaJawabController::class, 'index'])->name('tanya.index');
    Route::get('/tanya/buat', [TanyaJawabController::class, 'create'])->name('tanya.create');
    Route::post('/tanya', [TanyaJawabController::class, 'store'])->name('tanya.store');
    Route::get('/tanya/{id}', [TanyaJawabController::class, 'show'])->name('tanya.show');
    Route::put('/tanya/{id}', [TanyaJawabController::class, 'update'])->name('tanya.update');
    Route::delete('/tanya/{id}', [TanyaJawabController::class, 'destroy'])->name('tanya.destroy');
    Route::post('/tanya/{id}/balas', [TanyaJawabController::class, 'storeBalasan'])->name('tanya.balas.store');
    Route::post('/tanya/{id}/upvote', [TanyaJawabController::class, 'upvote'])->name('tanya.upvote');
    Route::post('/tanya/{id}/downvote', [TanyaJawabController::class, 'downvote'])->name('tanya.downvote');
    
    // Video, Infografis, Konsultasi
    Route::resource('video', VideoController::class);
    Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis.index');
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
    // === GRUP ADMIN ===
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

        // === KELOLA ARTIKEL ===
        Route::get('/artikel', [AdminController::class, 'index_artikel'])->name('artikel.index');
        Route::get('/artikel/create', [AdminController::class, 'create_artikel'])->name('artikel.create');
        Route::post('/artikel', [AdminController::class, 'store_artikel'])->name('artikel.store');
        Route::get('/artikel/{id}/edit', [AdminController::class, 'edit_artikel'])->name('artikel.edit');
        Route::put('/artikel/{id}', [AdminController::class, 'update_artikel'])->name('artikel.update');
        Route::delete('/artikel/{id}', [AdminController::class, 'destroy_artikel'])->name('artikel.destroy');

        // === KELOLA DETEKSI (Pertanyaan) ===
        Route::get('/kelola-deteksi', [AdminController::class, 'index_question'])->name('kelola-deteksi.index');
        Route::get('/kelola-deteksi/create', [AdminController::class, 'create_question'])->name('kelola-deteksi.create');
        Route::post('/kelola-deteksi', [AdminController::class, 'store_question'])->name('kelola-deteksi.store');
        Route::get('/kelola-deteksi/{pertanyaan}/edit', [AdminController::class, 'edit_question'])->name('kelola-deteksi.edit');
        Route::put('/kelola-deteksi/{pertanyaan}', [AdminController::class, 'update_question'])->name('kelola-deteksi.update');
        Route::delete('/kelola-deteksi/{pertanyaan}', [AdminController::class, 'destroy_question'])->name('kelola-deteksi.destroy');

        // Kelola Skor
        Route::get('/kelola-skor', [AdminController::class, 'index_score'])->name('kelola-skor.index');
        Route::get('/kelola-skor/create', [AdminController::class, 'create_score'])->name('kelola-skor.create');
        Route::post('/kelola-skor', [AdminController::class, 'store_score'])->name('kelola-skor.store');
        Route::get('/kelola-skor/{skor}/edit', [AdminController::class, 'edit_score'])->name('kelola-skor.edit');
        Route::put('/kelola-skor/{skor}', [AdminController::class, 'update_score'])->name('kelola-skor.update');
        Route::delete('/kelola-skor/{skor}', [AdminController::class, 'destroy_score'])->name('kelola-skor.destroy');

        // Riwayat Deteksi
        Route::get('/riwayat-deteksi', [AdminController::class, 'index_riwayat'])->name('kelola-riwayat.index');
        Route::get('/riwayat-deteksi/{hasil_deteksi}', [AdminController::class, 'show_riwayat'])->name('kelola-riwayat.show');

        // === TANYA JAWAB ===
        Route::get('/pertanyaan', [TanyaJawabController::class, 'belumDijawab'])->name('psikolog.pertanyaan');
        Route::get('/pertanyaan/{id}', [TanyaJawabController::class, 'formJawab'])->name('psikolog.jawab');
        Route::put('/pertanyaan/{id}', [TanyaJawabController::class, 'update'])->name('psikolog.jawab.submit');

        Route::get('/verifikasi-psikolog', [AdminController::class, 'index_verifikasi_psikolog'])->name('verifikasi.index');
        Route::post('/verifikasi-psikolog/{id}/approve', [AdminController::class, 'approve_psikolog'])->name('verifikasi.approve');
        Route::delete('/verifikasi-psikolog/{id}/reject', [AdminController::class, 'reject_psikolog'])->name('verifikasi.reject');
        Route::get('/verifikasi-psikolog/{id}/edit', [AdminController::class, 'edit_psikolog'])->name('verifikasi.edit');
        Route::put('/verifikasi-psikolog/{id}', [AdminController::class, 'update_psikolog'])->name('verifikasi.update');

        Route::get('/admin/activity-logs', [AdminController::class, 'activityLogs'])->name('activity-logs.index');

        // === Laravel Breeze ===
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('video')->name('admin.video.')->middleware(['auth', 'verified'])->group(function () {
            Route::get('/', [AdminController::class, 'videoIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'videoCreate'])->name('create');
            Route::post('/store', [AdminController::class, 'videoStore'])->name('store');
            Route::get('/edit/{id}', [AdminController::class, 'videoEdit'])->name('edit');
            Route::put('/update/{id}', [AdminController::class, 'videoUpdate'])->name('update');
            Route::delete('/destroy/{id}', [AdminController::class, 'videoDestroy'])->name('destroy');
        });
        Route::prefix('infografis')->name('admin.infografis.')->middleware(['auth', 'verified'])->group(function () {
            Route::get('/', [AdminController::class, 'infografisIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'infografisCreate'])->name('create');
            Route::post('/store', [AdminController::class, 'infografisStore'])->name('store');
            Route::get('/edit/{id}', [AdminController::class, 'infografisEdit'])->name('edit');
            Route::put('/update/{id}', [AdminController::class, 'infografisUpdate'])->name('update');
            Route::delete('/destroy/{id}', [AdminController::class, 'infografisDestroy'])->name('destroy');
        });
    });
});
