<?php

use Illuminate\Support\Facades\Route;



// ADMIN
Route::get('/login', function () {
    return view('login');
});



// USER
Route::get('/', fn() => view('user.dashboard'))->name('dashboard');
Route::get('/menu-makanan', fn() => view('user.menu-makanan'))->name('menu-makanan');
Route::get('/menu-minuman', fn() => view('user.menu-minuman'))->name('menu-minuman');
// Route::get('/data_minuman', fn() => view('user.data-minuman'))->name('data_minuman');