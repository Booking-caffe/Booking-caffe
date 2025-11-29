<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;



// ADMIN
Route::get('/login', function () {
    return view('login');
});



// USER
Route::get('/', fn() => view('User.dashboard'))->name('dashboard');
Route::get('/reservasi', fn() => view('User.reservasi'))->name('reservasi');

// POST dari form reservasi
Route::post('/tempat-duduk', [MenuController::class, 'pilihTempatDuduk'])
    ->name('tempat-duduk');

// GET untuk menampilkan halaman pilih tempat duduk
Route::get('/tempat-duduk', [MenuController::class, 'showTempatDuduk'])
    ->name('show-tempat-duduk');

Route::get('/menu-makanan', fn() => view('User.menu-makanan'))->name('menu-makanan');
Route::get('/menu-minuman', [MenuController::class, 'menuMinuman'])->name('menu-minuman');
// Route::get('/data_minuman', fn() => view('user.data-minuman'))->name('data_minuman');
Route::get('/menu/detail/{id}', [MenuController::class, 'detail'])->name('detail-menu');
Route::post('/menu/add-to-cart', [MenuController::class, 'addToCart'])->name('add-to-cart');
Route::get('/keranjang', [MenuController::class, 'keranjang'])->name('keranjang');
Route::delete('/keranjang/hapus/{index}', [MenuController::class, 'removeItem'])->name('remove-item');



