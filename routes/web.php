<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});
Route::get('/web', function () {
    return view('index');
});
Route::get('/blog', function () {
    return view('blog');
});
