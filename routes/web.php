<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});
Route::get('/blog', function () {
    return view('mobile-app');
});
Route::get('/tailsimple', function () {
    return view('tailsimple');
});
