<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController\homeAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\regisController;
use App\Http\Controllers\adminController\dataMenuController;

// LOGIN
// halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
// // halaman registrasi
// Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
// POST login pelanggan dan pengelola
Route::post('/login-pelanggan', [LoginController::class, 'loginPelanggan'])->name('login-pelanggan');
// logout pelanggan
Route::post('/logout-pelanggan', [LoginController::class, 'logutPelanggan'])->name('logout-pelanggan');

// PELANGGAN
// get regis
Route::get('/register', [RegisController::class, 'showRegis'])->name('register');

// post regis
Route::post('/form-register', [RegisController::class, 'store'])->name('form-register');

// Home
Route::get('/', [HomeController::class, 'home'])->name('home');


// User
// reservasi
Route::get('/reservasi', [reservasiController::class, 'showResevasi'])->name('reservasi');
Route::post('/form-reservasi', [reservasiController::class, 'formReservasi'])->name('form-reservasi');
// POST dari form reservasi
Route::post('/tempat-duduk', [reservasiController::class, 'pilihTempatDuduk'])
    ->name('tempat-duduk');
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
// REGIS
// ADMIN
Route::get('/register-admin', [RegisController::class, 'showRegisAdmin'])->name('register');

// post regis
Route::post('/form-registerAdmin', [RegisController::class, 'storeAdmin'])->name('form-registerAdmin');

// Home admin
Route::get('dashboard/admin-home', [homeAdminController::class, 'home'])->name('home-admin');

// logout admin
Route::get('/logout-pengelola', [LoginController::class, 'logutPengelola'])->name('logout-admin');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // atau folder lain misalnya: admin.dashboard
})->name('admin.dashboard');



// MENU
// routes/web.php
// Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::get('/admin/makanan', [dataMenuController::class, 'showMakanan'])->name('showMakanan');
Route::get('/admin/minuman', [dataMenuController::class, 'showMinuman'])->name('showMinuman');

// FORM MENU
Route::get('/tambah-minuman', [dataMenuController::class, 'formMinuman'])->name('formMinuman');
Route::get('/tambah-makanan', [dataMenuController::class, 'formMakanan'])->name('formMakanan');
Route::post('/tambah-menu', [dataMenuController::class, 'addMenu'])->name('addMenu');

// AKSI MENU
Route::get('/admin/menu/{id}/edit', [dataMenuController::class, 'edit'])
 ->name('edit');
 Route::post('/menu/{id}', [dataMenuController::class, 'update'])->name('update');
 Route::delete('/menu/{id}', [dataMenuController::class, 'destroy'])->name('destroy');
   Route::get('/menu/{id}', [dataMenuController::class, 'show'])->name('menu.show');



// Route::get('/admin/minuman', function () {
//     return view('admin.minuman');
// })->name('admin.minuman');

Route::get('/admin/datauser', function () {
    return view('admin.datauser');
})->name('admin.datauser');

Route::get('/admin/riwayat', function () {
    return view('admin.riwayat');
})->name('admin.riwayat');


