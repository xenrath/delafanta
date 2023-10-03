<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SubKategoriController;
use App\Http\Controllers\Admin\TingkatController;
use App\Http\Controllers\Admin\UkuranController;
use App\Http\Controllers\Admin\WarnaController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebController::class, 'index']);
Route::get('produk/{slug?}/{filter?}', [WebController::class, 'produk']);
Route::get('kontak', [WebController::class, 'kontak']);
Route::get('hubungi', [WebController::class, 'hubungi']);
Route::get('unduh/{kode}', [WebController::class, 'unduh']);

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('pesanan', PesananController::class);

    Route::get('produk/sub-kategori/{id}', [ProdukController::class, 'sub_kategori']);
    Route::get('produk/jenis-ukuran/{id}', [ProdukController::class, 'jenis_ukuran']);
    Route::post('produk/unduh/{id}', [ProdukController::class, 'unduh']);
    Route::get('produk/delete-gambar/{id}/{i}', [ProdukController::class, 'delete_gambar']);
    Route::resource('produk', ProdukController::class);

    Route::resource('kategori', KategoriController::class);

    Route::resource('sub-kategori', SubKategoriController::class)->except('show');

    Route::resource('kontak', KontakController::class);

    Route::resource('tingkat', TingkatController::class);

    Route::resource('ukuran', UkuranController::class);

    Route::resource('warna', WarnaController::class);

    Route::resource('kontak', KontakController::class);
});
