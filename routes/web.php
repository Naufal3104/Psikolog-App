<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeteksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanyaJawabController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', fn () => view('index'))->name('home');

    // === Laravel Breeze ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === 6 FITUR UTAMA (PUBLIK) ===
    // Artikel (Publik + Form Tambah)
    Route::middleware(['role:admin|psikolog'])->group(function () {
        Route::get('/artikel/create', [AdminController::class, 'create_artikel'])->name('artikel.create');
    });
    Route::get('/artikel', [AdminController::class, 'index_artikel_publik'])->name('artikel-publik.index');
    Route::get('/artikel/{id}', [AdminController::class, 'show_artikel'])->name('artikel.show');

    // Deteksi Dini (Publik)
    Route::get('/deteksi', [DeteksiController::class, 'index'])->name('deteksi.index');
    Route::get('/deteksi/{kategori}', [DeteksiController::class, 'show'])->name('deteksi.show');
    Route::post('/deteksi/process', fn (Request $request) => back()->with('success', 'Hasil deteksi berhasil diproses!'))->name('deteksi.process');

    // Tanya Psikolog, Video, Infografis, Konsultasi
    Route::get('/tanya', [TanyaJawabController::class, 'index'])->name('tanya.index');
    Route::get('/tanya/buat', [TanyaJawabController::class, 'create'])->name('tanya.create');
    Route::post('/tanya', [TanyaJawabController::class, 'store'])->name('tanya.store');
    Route::get('/tanya/{id}', [TanyaJawabController::class, 'show'])->name('tanya.show');
    Route::put('/tanya/{id}', [TanyaJawabController::class, 'update'])->name('tanya.update');
    Route::delete('/tanya/{id}', [TanyaJawabController::class, 'destroy'])->name('tanya.destroy');
    Route::post('/tanya/{id}/balas', [TanyaJawabController::class, 'storeBalasan'])->name('tanya.balas.store');

    Route::get('/video', fn () => view('fitur.video'))->name('video.index');
    Route::get('/infografis', fn () => view('fitur.infografis'))->name('infografis.index');
    Route::get('/konsultasi/whatsapp', fn () => view('fitur.konsultasi'))->name('konsultasi.whatsapp');
    
    // === GRUP ADMIN ===
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

        // === KELOLA ARTIKEL ===
        Route::get('/artikel', [AdminController::class, 'index_artikel'])->name('artikel.index');
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
    });
});
