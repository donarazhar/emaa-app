<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarbotController;
use App\Http\Controllers\KasKecilController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\PengislamanController;

Route::get('/', [BlogController::class, 'web'])->name('web');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/article/{id}', [BlogController::class, 'show'])->name('article.show');

Route::get('/pdf-preview/{id}', [MarbotController::class, 'preview'])->name('pdf.preview');
Route::get('/pdf-previewkonsultasi/{id}', [KonsultasiController::class, 'preview'])->name('pdf.previewkonsultasi');
Route::get('/pdf-previewpengislmaman/{id}', [PengislamanController::class, 'preview'])->name('pdf.previewpengislaman');
Route::get('/cetak-pengisian/{id}', [KasKecilController::class, 'cetakPengisianKas'])->name('cetak-pengisiankas');
Route::get('/cetak-laporankas/{selected}/{periodeawal}/{periodeakhir}', [KasKecilController::class, 'cetakLaporanKas'])->name('cetak-laporankas');
Route::get('/pdf-previewpendaftaran/{id}', [KursusController::class, 'preview'])->name('pdf.previewpendaftaran');
Route::get('/pdf-previewkwitansi/{id}', [KursusController::class, 'kwitansi'])->name('pdf.previewkwitansi');
Route::get('/export', [KursusController::class, 'export']);
