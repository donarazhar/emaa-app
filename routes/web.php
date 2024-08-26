<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MarbotController;
use App\Http\Controllers\KasKecilController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\PengislamanController;
use Illuminate\Support\Facades\Route;

// Blog route
Route::get('/', [BlogController::class, 'web'])->name('web');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/article/{id}', [BlogController::class, 'show'])->name('article.show');
Route::get('/article/view-all/{categoryId}', [BlogController::class, 'viewAll'])->name('article.viewAll');
Route::get('/profile', [BlogController::class, 'profile'])->name('profile');
Route::get('/profile/{id}', [BlogController::class, 'profileShow'])->name('profile.show');
Route::get('/giat-masjid', [BlogController::class, 'kegiatan'])->name('giatMasjid');
Route::get('/giat-masjid/{id}', [BlogController::class, 'giatMasjidShow'])->name('giatMasjid.show');


// Marbot route
Route::get('/pdf-preview/{id}', [MarbotController::class, 'preview'])->name('pdf.preview');

// Konsultasi route
Route::get('/pdf-previewkonsultasi/{id}', [KonsultasiController::class, 'preview'])->name('pdf.previewkonsultasi');

// Pengislaman route
Route::get('/pdf-previewpengislmaman/{id}', [PengislamanController::class, 'preview'])->name('pdf.previewpengislaman');

// Kas kecil route
Route::get('/cetak-pengisian/{id}', [KasKecilController::class, 'cetakPengisianKas'])->name('cetak-pengisiankas');
Route::get('/cetak-laporankas/{selected}/{periodeawal}/{periodeakhir}', [KasKecilController::class, 'cetakLaporanKas'])->name('cetak-laporankas');

// Kursus route
Route::get('/pdf-previewpendaftaran/{id}', [KursusController::class, 'preview'])->name('pdf.previewpendaftaran');
Route::get('/pdf-previewkwitansi/{id}', [KursusController::class, 'kwitansi'])->name('pdf.previewkwitansi');
Route::get('/export', [KursusController::class, 'export']);
