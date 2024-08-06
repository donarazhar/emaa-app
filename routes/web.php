<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarbotController;



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
