<?php

use Illuminate\Support\Facades\Route;

// ==================== BACKEND ====================
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\FotoProdukController;
// ==================== FRONTEND ====================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProdukController as FrontendProdukController;

/*
|--------------------------------------------------------------------------
| FRONTEND (CUSTOMER / PUBLIC)
|--------------------------------------------------------------------------
*/

// halaman utama
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// daftar produk
Route::get('/produk', [FrontendProdukController::class, 'index'])
    ->name('produk');

// produk per kategori
Route::get('/produk/kategori/{id}', [FrontendProdukController::class, 'kategori'])
    ->name('produk.kategori');

// detail produk
Route::get('/produk/{id}', [FrontendProdukController::class, 'detail'])
    ->name('produk.detail');

// halaman kontak
Route::view('/kontak', 'frontend.kontak')
    ->name('kontak');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

// redirect /admin ke login
Route::get('/admin', function () {
    return redirect()->route('backend.login');
});

// login admin
Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login');

Route::post('backend/login', [LoginController::class, 'authenticateBackend']);

Route::post('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');

// dashboard admin
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| MASTER DATA (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('backend/user', UserController::class, ['as' => 'backend']);
    Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend']);
    Route::resource('backend/produk', ProdukController::class, ['as' => 'backend']);

    // ==================== FOTO PRODUK ====================
    Route::post(
        'backend/foto-produk',
        [FotoProdukController::class, 'store']
    )->name('backend.foto_produk.store');
      Route::delete('backend/foto-produk/{id}', [FotoProdukController::class, 'destroy'])
    ->name('backend.foto_produk.destroy');


    // ==================== LAPORAN ====================
    Route::prefix('backend/laporan')->name('backend.laporan.')->group(function () {

        Route::get('/formuser', [UserController::class, 'formUser'])
            ->name('formuser');

        Route::post('/cetakuser', [UserController::class, 'cetakUser'])
            ->name('cetakuser');

        Route::get('/formproduk', [ProdukController::class, 'formProduk'])
            ->name('formproduk');

        Route::post('/cetakproduk', [ProdukController::class, 'cetakProduk'])
            ->name('cetakproduk');

    });

});
