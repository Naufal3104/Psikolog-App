<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index'); // resources/views/index.blade.php
})->name('index'); 

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

    // Fitur Sub-Menu di Deteksi Dini
    Route::get('/deteksi/stress', fn() => view('fitur.deteksi-stress'))->name('deteksi.stress');
    Route::get('/deteksi/kesejahteraan', fn() => view('fitur.deteksi-kesejahteraan'))->name('deteksi.kesejahteraan');
    Route::get('/deteksi/belajar', fn() => view('fitur.deteksi-belajar'))->name('deteksi.belajar');
    Route::get('/deteksi/pernikahan', fn() => view('fitur.deteksi-nikah'))->name('deteksi.nikah');
    Route::get('/deteksi/putus-cinta', fn() => view('fitur.deteksi-putuscinta'))->name('deteksi.putuscinta');

;
require __DIR__.'/auth.php';

