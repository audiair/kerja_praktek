<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\LaporanMasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::match(['put', 'patch'],'/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('users/search',[UserController::class, 'search'])->name('user.search');

    Route::get('/kategoris', [KategoriBarangController::class, 'index'])->name('kategori');
    Route::get('/kategoris/create', [KategoriBarangController::class, 'create'])->name('kategori.create');
    Route::post('/kategoris', [KategoriBarangController::class, 'store'])->name('kategori.store');
    Route::get('/kategoris/{id}/edit', [KategoriBarangController::class, 'edit'])->name('kategori.edit');
    Route::match(['put', 'patch'],'/kategoris/{id}', [KategoriBarangController::class, 'update'])->name('kategori.update');
    Route::delete('/kategoris/{id}', [KategoriBarangController::class, 'destroy'])->name('kategori.destroy');
    Route::get('kategoris/search',[KategoriBarangController::class, 'search'])->name('kategori.search');

    Route::get('/barangs', [BarangController::class, 'index'])->name('barang');
    Route::get('/barangs/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barangs', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barangs/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::match(['put', 'patch'],'/barangs/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barangs/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('barangs/search',[BarangController::class, 'search'])->name('barang.search');

    Route::get('/barang_masuks', [BarangMasukController::class, 'index'])->name('barang_masuk');
    Route::get('/barang_masuks/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
    Route::post('/barang_masuks', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::get('/barang_masuks/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang_masuk.edit');
    Route::match(['put', 'patch'],'/barang_masuks/{id}', [BarangMasukController::class, 'update'])->name('barang_masuk.update');
    Route::delete('/barang_masuks/{id}', [BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');
    Route::get('barang_masuks/search',[BarangMasukController::class, 'search'])->name('barang_masuk.search');

    Route::get('/barang_keluars', [BarangKeluarController::class, 'index'])->name('barang_keluar');
    Route::get('/barang_keluars/create', [BarangKeluarController::class, 'create'])->name('barang_keluar.create');
    Route::post('/barang_keluars', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
    Route::get('/barang_keluars/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barang_keluar.edit');
    Route::match(['put', 'patch'],'/barang_keluars/{id}', [BarangKeluarController::class, 'update'])->name('barang_keluar.update');
    Route::delete('/barang_keluars/{id}', [BarangKeluarController::class, 'destroy'])->name('barang_keluar.destroy');
    Route::get('barang_keluars/search',[BarangKeluarController::class, 'search'])->name('barang_keluar.search');

    Route::get('/laporan_masuks', [LaporanMasukController::class, 'index'])->name('laporan_masuk');
    Route::get('/laporan_masuks/filter/{tgl_awal}/{tgl_akhir}', [LaporanMasukController::class, 'filter'])->name('laporan_masuk.filter');
    Route::get('/laporan_masuks/print', [LaporanMasukController::class, 'print'])->name('laporan_masuk.print');
    Route::get('/laporan_masuks/export', [LaporanMasukController::class, 'export'])->name('laporan_masuk.export');
    
    Route::get('/laporan_keluars', [LaporanKeluarController::class, 'index'])->name('laporan_keluar');
    Route::get('/laporan_keluars/filter/{tgl_awal}/{tgl_akhir}', [LaporanKeluarController::class, 'filter'])->name('laporan_keluar.filter');
    Route::get('/laporan_keluars/print', [LaporanKeluarController::class, 'print'])->name('laporan_keluar.print');
    Route::get('/laporan_keluars/export', [LaporanKeluarController::class, 'export'])->name('laporan_keluar.export');
});

require __DIR__ . '/auth.php';
