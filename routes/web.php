<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    // laravel breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === 6 FITUR UTAMA (PUBLIK) ===

    // Artikel (diarahkan ke AdminController)
    Route::middleware(['role:admin|psikolog'])->group(function () {
        Route::get('/artikel/create', [AdminController::class, 'create_artikel'])->name('artikel.create');
    });
    Route::get('/artikel', [AdminController::class, 'index_artikel_publik'])->name('artikel-publik.index');
    Route::get('/artikel/{id}', [AdminController::class, 'show_artikel'])->name('artikel.show');

    // Fitur lain
    Route::get('/deteksi', [KategoriController::class, 'index'])->name('deteksi.index');
    Route::get('/deteksi/{kategori}', [KategoriController::class, 'show'])->name('deteksi.show');
    Route::get('/tanya', fn () => view('fitur.tanya'))->name('tanya.index');
    Route::get('/video', fn () => view('fitur.video'))->name('video.index');
    Route::get('/infografis', fn () => view('fitur.infografis'))->name('infografis.index');
    Route::get('/konsultasi/whatsapp', fn () => view('fitur.konsultasi'))->name('konsultasi.whatsapp');

    // Route POST
    Route::post('/deteksi/process', fn (Request $request) => back()->with('success', 'Hasil deteksi berhasil diproses!'))->name('deteksi.process');
    Route::get('/buat-tanya', fn () => view('fitur.buat-tanya'))->name('buat.tanya');
    Route::post('/tanya', fn (Request $request) => back()->with('success', 'Pertanyaan berhasil dikirim!'))->name('tanya.store');

    // === GRUP ADMIN ===
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

        // Kelola Artikel
        Route::get('/artikel', [AdminController::class, 'index_artikel'])->name('artikel.index');
        Route::post('/artikel', [AdminController::class, 'store_artikel'])->name('artikel.store');
        Route::get('/artikel/{id}/edit', [AdminController::class, 'edit_artikel'])->name('artikel.edit');
        Route::put('/artikel/{id}', [AdminController::class, 'update_artikel'])->name('artikel.update');
        Route::delete('/artikel/{id}', [AdminController::class, 'destroy_artikel'])->name('artikel.destroy');

        // Kelola Deteksi (Pertanyaan)
        Route::get('/kelola-deteksi', [AdminController::class, 'deteksi_index'])->name('kelola-deteksi.index');
        Route::get('/kelola-deteksi/create', [AdminController::class, 'deteksi_create'])->name('kelola-deteksi.create');
        Route::post('/kelola-deteksi', [AdminController::class, 'deteksi_store'])->name('kelola-deteksi.store');
        Route::get('/kelola-deteksi/{pertanyaan}/edit', [AdminController::class, 'deteksi_edit'])->name('kelola-deteksi.edit');
        Route::put('/kelola-deteksi/{pertanyaan}', [AdminController::class, 'deteksi_update'])->name('kelola-deteksi.update');
        Route::delete('/kelola-deteksi/{pertanyaan}', [AdminController::class, 'deteksi_destroy'])->name('kelola-deteksi.destroy');

        // Kelola Skor
        Route::get('/kelola-skor', [AdminController::class, 'skor_index'])->name('kelola-skor.index');
        Route::get('/kelola-skor/create', [AdminController::class, 'skor_create'])->name('kelola-skor.create');
        Route::post('/kelola-skor', [AdminController::class, 'skor_store'])->name('kelola-skor.store');
        // (Anda bisa menambahkan rute edit/update/destroy untuk skor di sini)

        // Riwayat Deteksi
        Route::get('/riwayat-deteksi', [AdminController::class, 'riwayat_index'])->name('kelola-riwayat.index');
        Route::get('/riwayat-deteksi/{hasil_deteksi}', [AdminController::class, 'riwayat_show'])->name('kelola-riwayat.show');
    });
});
