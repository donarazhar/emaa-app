<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MarbotController;
use App\Http\Controllers\KasKecilController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PengislamanController;

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});
Route::get('/web', function () {
    return view('index');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/pdf-preview/{id}', [MarbotController::class, 'preview'])->name('pdf.preview');
Route::get('/pdf-previewkonsultasi/{id}', [KonsultasiController::class, 'preview'])->name('pdf.previewkonsultasi');
Route::get('/pdf-previewpengislmaman/{id}', [PengislamanController::class, 'preview'])->name('pdf.previewpengislaman');
Route::get('/cetak-pengisian/{id}', [KasKecilController::class, 'cetakPengisianKas'])->name('cetak-pengisiankas');
Route::get('/cetak-laporankas/{selected}/{periodeawal}/{periodeakhir}', [KasKecilController::class, 'cetakLaporanKas'])->name('cetak-laporankas');
