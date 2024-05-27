<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    Route::get('/kategoris', [KategoriBarangController::class, 'index'])->name('kategori');
    Route::get('/kategoris/create', [KategoriBarangController::class, 'create'])->name('kategori.create');
    Route::post('/kategoris', [KategoriBarangController::class, 'store'])->name('kategori.store');
    Route::get('/kategoris/{id}/edit', [KategoriBarangController::class, 'edit'])->name('kategori.edit');
    Route::match(['put', 'patch'],'/kategoris/{id}', [KategoriBarangController::class, 'update'])->name('kategori.update');
    Route::delete('/kategoris/{id}', [KategoriBarangController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/barangs', [BarangController::class, 'index'])->name('barang');
    Route::get('/barangs/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barangs', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barangs/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::match(['put', 'patch'],'/barangs/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barangs/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});

require __DIR__ . '/auth.php';
