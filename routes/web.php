<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\reservasiController;


// halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

// POST login dan logout pelaggan
Route::post('/login-pelanggan', [LoginController::class, 'loginPelanggan'])->name('login-pelanggan');
Route::post('/logout-pelanggan', [LoginController::class, 'logutPelanggan'])->name('logout-pelanggan');

// Home
// Route::get('/', fn() => view('home'))->name('home');


Route::get('/', [HomeController::class, 'home'])->name('home');

// reservasi
Route::get('/reservasi', [reservasiController::class, 'showResevasi'])->name('reservasi');
Route::post('/form-reservasi', [reservasiController::class, 'formReservasi'])->name('form-reservasi');

// User

// POST dari form reservasi
Route::post('/tempat-duduk', [MenuController::class, 'pilihTempatDuduk'])
    ->name('tempat-duduk');

// GET untuk menampilkan halaman pilih tempat duduk
Route::get('/tempat-duduk', [MenuController::class, 'showTempatDuduk'])
    ->name('show-tempat-duduk');
Route::post('/pilih-tempat', [reservasiController::class, 'pilihTempatDuduk'])->name('pilihTempatDuduk');

// DETAIL PESANAN
Route::get('/detail-pesanan', [reservasiController::class, 'detailPesanan'])->name('detail-pesanan');

Route::get('/detail-transaksi', [reservasiController::class, 'detailTransaksi'])->name('detail-transaksi');


// Route::get('/menu-makanan', fn() => view('User.menu-makanan'))->name('menu-makanan');
Route::get('/menu-minuman', [MenuController::class, 'menuMinuman'])->name('menu-minuman');

Route::get('/menu-makanan', [MenuController::class, 'menuMakanan'])->name('menu-makanan');
// Route::get('/data_minuman', fn() => view('user.data-minuman'))->name('data_minuman');
// Route::get('/menu/detail/{id}', [MenuController::class, 'detail'])->name('detail-menu');
Route::get('/makanan/{id}', [MenuController::class, 'detailMakanan'])->name('detail-makanan');
Route::get('/minuman/{id}', [MenuController::class, 'detailMinuman'])->name('detail-minuman');

Route::post('/menu/add-to-cart', [MenuController::class, 'addToCart'])->name('add-to-cart');

Route::delete('/keranjang/hapus/{index}', [MenuController::class, 'removeItem'])->name('remove-item');

Route::get('/keranjang', [MenuController::class, 'keranjang'])->name('keranjang');




