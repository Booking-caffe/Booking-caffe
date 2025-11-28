<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User.dashboard');
});

// USER
Route::get('/', fn() => view('user.dashboard'))->name('dashboard');
Route::get('/data-menu', fn() => view('user.data_menu'))->name('data-menu');
Route::get('/data-makanan', fn() => view('user.data-makanan'))->name('data-makanan');
Route::get('/data_minuman', fn() => view('user.data-minuman'))->name('data_minuman');