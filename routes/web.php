<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //laravel breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // 6 fitur utama
Route::get('/artikel', fn() => view('fitur.artikel'))->name('artikel.index');
Route::get('/deteksi', fn() => view('fitur.deteksi'))->name('deteksi.index');
Route::get('/tanya', fn() => view('fitur.tanya'))->name('tanya.index');
Route::get('/video', fn() => view('fitur.video'))->name('video.index');
Route::get('/infografis', fn() => view('fitur.infografis'))->name('infografis.index');
Route::get('/konsultasi/whatsapp', fn() => view('fitur.konsultasi'))->name('konsultasi.whatsapp');

});
require __DIR__.'/auth.php';

