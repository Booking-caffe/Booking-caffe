<?php

use App\Http\Controllers\adminController\homeAdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\reservasiController;


// halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

// POST login pelanggan dan pengelola
Route::post('/login-pelanggan', [LoginController::class, 'loginPelanggan'])->name('login-pelanggan');
// logout pelanggan
Route::post('/logout-pelanggan', [LoginController::class, 'logutPelanggan'])->name('logout-pelanggan');

// Home
Route::get('/', [HomeController::class, 'home'])->name('home');

// reservasi
Route::get('/reservasi', [reservasiController::class, 'showResevasi'])->name('reservasi');
Route::post('/form-reservasi', [reservasiController::class, 'formReservasi'])->name('form-reservasi');

// User

// POST dari form reservasi
// Route::post('/tempat-duduk', [reservasiController::class, 'pilihTempatDuduk'])
    // ->name('tempat-duduk');

// GET untuk menampilkan halaman pilih tempat duduk
Route::get('/tempat-duduk', [reservasiController::class, 'showTempatDuduk'])
    ->name('show-tempat-duduk');
Route::post('/pilih-tempat', [reservasiController::class, 'pilihTempatDuduk'])->name('pilihTempatDuduk');





// Route::get('/menu-makanan', fn() => view('User.menu-makanan'))->name('menu-makanan');
Route::get('/menu-minuman', [MenuController::class, 'menuMinuman'])->name('menu-minuman');

Route::get('/menu-makanan', [MenuController::class, 'menuMakanan'])->name('menu-makanan');
// Route::get('/data_minuman', fn() => view('user.data-minuman'))->name('data_minuman');
// Route::get('/menu/detail/{id}', [MenuController::class, 'detail'])->name('detail-menu');
Route::get('/makanan/{id}', [MenuController::class, 'detailMakanan'])->name('detail-makanan');
Route::get('/minuman/{id}', [MenuController::class, 'detailMinuman'])->name('detail-minuman');




Route::get('/keranjang', [MenuController::class, 'keranjang'])->name('keranjang');
Route::delete('/keranjang/hapus/{index}', [MenuController::class, 'removeItem'])->name('remove-item');
Route::put('/keranjang/update/{index}', [MenuController::class, 'updateQty'])
->name('update-qty');

Route::post('/menu/add-to-cart', [MenuController::class, 'addToCart'])->name('add-to-cart');


// DETAIL PESANAN (USER)
Route::get('/detail-pesanan', [reservasiController::class, 'detailPesanan'])->name('detail-pesanan');

Route::get('/detail-transaksi', [reservasiController::class, 'detailTransaksi'])->name('detail-transaksi');

Route::post('/upload-bukti', [reservasiController::class, 'uploadBukti'])
    ->name('upload-bukti');


// ========================================== ADMIN ==================================================================
// Home admin
Route::get('dashboard/admin-home', [homeAdminController::class, 'home'])->name('home-admin');

// logout admin
Route::get('/logout-pengelola', [LoginController::class, 'logutPengelola'])->name('logout-admin');
