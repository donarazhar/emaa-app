<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});
Route::get('/homepage', function () {
    return view('homepage');
});
Route::get('/maa', function () {
    return view('maa');
});
