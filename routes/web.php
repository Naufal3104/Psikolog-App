<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

    Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    //laravel breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 6 fitur utama
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
    Route::get('/deteksi', fn() => view('fitur.deteksi'))->name('deteksi.index');
    Route::get('/tanya', fn() => view('fitur.tanya'))->name('tanya.index');
    Route::get('/video', fn() => view('fitur.video'))->name('video.index');
    Route::get('/infografis', fn() => view('fitur.infografis'))->name('infografis.index');
    Route::get('/konsultasi/whatsapp', fn() => view('fitur.konsultasi'))->name('konsultasi.whatsapp');

    // Fitur Sub-Menu di Deteksi Dini
    Route::get('/deteksi/stress', fn() => view('fitur.deteksi.stress'))->name('deteksi.stress');
    Route::get('/deteksi/kesejahteraan', fn() => view('fitur.deteksi.kesejahteraan'))->name('deteksi.kesejahteraan');
    Route::get('/deteksi/belajar', fn() => view('fitur.deteksi.belajar'))->name('deteksi.belajar');
    Route::get('/deteksi/pernikahan', fn() => view('fitur.deteksi.nikah'))->name('deteksi.nikah');
    Route::get('/deteksi/putuscinta', fn() => view('fitur.deteksi.putuscinta'))->name('deteksi.putuscinta');
    Route::get('/deteksi/hasil', fn() => view('fitur.deteksi.hasil'))->name('deteksi.hasil');

    // Route POST untuk memproses hasil deteksi dini
    Route::post('/deteksi/process', fn(Request $request) => back()->with('success', 'Hasil deteksi berhasil diproses!'))->name('deteksi.process');

    // Fitur Buat Pertanyaan
    Route::get('/buat-tanya', fn() => view('fitur.buat-tanya'))->name('buat.tanya');
    Route::post('/tanya', fn(Request $request) => back()->with('success', 'Pertanyaan berhasil dikirim!'))->name('tanya.store');

;
require __DIR__.'/auth.php';

