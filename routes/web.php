<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'login']);

Route::controller(PenggunaController::class)->group(function () {
    Route::get('pengguna', 'dashboard')->middleware(['auth', 'admin']);
    Route::get('pengguna/logout', 'logout');
    Route::get('pengguna/dashboard', 'dashboard');
    Route::get('pengguna/kegiatandaftar', 'kegiatandaftar');
    Route::get('pengguna/kegiatantambah', 'kegiatantambah');
    Route::post('pengguna/kegiatantambahsimpan', 'kegiatantambahsimpan');
    Route::get('pengguna/kegiatanedit/{id}', 'kegiatanedit');
    Route::post('pengguna/kegiataneditsimpan/{id}', 'kegiataneditsimpan');
    Route::get('pengguna/kegiatanhapus/{id}', 'kegiatanhapus');
    Route::get('pengguna/keuangandaftar', 'keuangandaftar');
    Route::get('pengguna/keuangantambah', 'keuangantambah');
    Route::post('pengguna/keuangantambahsimpan', 'keuangantambahsimpan');
    Route::get('pengguna/keuanganedit/{id}', 'keuanganedit');
    Route::post('pengguna/keuanganeditsimpan/{id}', 'keuanganeditsimpan');
    Route::get('pengguna/keuanganhapus/{id}', 'keuanganhapus');
    Route::get('pengguna/keuanganfilter', 'keuanganfilter');
    Route::get('pengguna/profil', 'profil');
    Route::get('pengguna/profiledit', 'profiledit');
    Route::post('pengguna/profileditsimpan', 'profileditsimpan');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('tentang', 'tentang');
    Route::get('loginakun', 'login');
    Route::post('logincek', 'logincek');
    Route::get('daftar', 'daftar');
    Route::post('dodaftar', 'dodaftar');
    Route::get('loginakun', 'login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
