<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard-dummy', function () {
    return view('dashboard-dummy');
})->middleware(['auth', 'role:admin'])->name('dashboard.dummy');

    //laravel breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 6 fitur utama
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
    Route::get('/deteksi', [KategoriController::class, 'index'])->name('deteksi.index');
    Route::get('/deteksi/{kategori}', [KategoriController::class, 'show'])->name('deteksi.show');
    Route::get('/tanya', fn() => view('fitur.tanya'))->name('tanya.index');
    Route::get('/video', fn() => view('fitur.video'))->name('video.index');
    Route::get('/infografis', fn() => view('fitur.infografis'))->name('infografis.index');
    Route::get('/konsultasi/whatsapp', fn() => view('fitur.konsultasi'))->name('konsultasi.whatsapp');

    // Fitur Sub-Menu di Deteksi Dini
    // Route::get('/deteksi/stress', fn() => view('fitur.deteksi.stress'))->name('deteksi.stress');
    // Route::get('/deteksi/kesejahteraan', fn() => view('fitur.deteksi.kesejahteraan'))->name('deteksi.kesejahteraan');
    // Route::get('/deteksi/belajar', fn() => view('fitur.deteksi.belajar'))->name('deteksi.belajar');
    // Route::get('/deteksi/pernikahan', fn() => view('fitur.deteksi.nikah'))->name('deteksi.nikah');
    // Route::get('/deteksi/putuscinta', fn() => view('fitur.deteksi.putuscinta'))->name('deteksi.putuscinta');
    // Route::get('/deteksi/hasil', fn() => view('fitur.deteksi.hasil'))->name('deteksi.hasil');

    // Route POST untuk memproses hasil deteksi dini
    Route::post('/deteksi/process', fn(Request $request) => back()->with('success', 'Hasil deteksi berhasil diproses!'))->name('deteksi.process');

    // Fitur Buat Pertanyaan
    Route::get('/buat-tanya', fn() => view('fitur.buat-tanya'))->name('buat.tanya');
    Route::post('/tanya', fn(Request $request) => back()->with('success', 'Pertanyaan berhasil dikirim!'))->name('tanya.store');

    // DUMMY TAMPILAN DASHBOARDDD
Route::get('dashboard-dummy', function () {
    return view('dashboard-dummy');
});
Route::get('buat-artikel', function () {
    return view('buat-artikel');
});
Route::get('kelola-artikel', function () {
    return view('kelola-artikel');
});
Route::get('edit-profile', function () {
    return view('edit-profile');
});

;
require __DIR__.'/auth.php';

