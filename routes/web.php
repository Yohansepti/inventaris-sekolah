<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
}); 

//Login & Dashboard
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['web', 'auth'])
    ->name('dashboard');

Route::get('/profil', function () {
    return 'Profil';
})->name('profil');

// kib A
use App\Http\Controllers\KibAController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kib/kib-a', [KibAController::class, 'index'])->name('kib.a');
    Route::get('/kib/kib-a/create', [KibAController::class, 'create'])->name('kib.a.create');
    Route::post('/kib/kib-a', [KibAController::class, 'store'])->name('kib.a.store');
    Route::get('/kib/kib-a/{kode_barang}/edit', [KibAController::class, 'edit'])->name('kib.a.edit');
    Route::put('/kib/kib-a/{kode_barang}', [KibAController::class, 'update'])->name('kib.a.update');
    Route::delete('/kib/kib-a/{kode_barang}', [KibAController::class, 'destroy'])->name('kib.a.destroy');
});


// kib B
use App\Http\Controllers\KibBController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kib/kib-b', [KibBController::class, 'index'])->name('kib.b');
    Route::get('/kib/kib-b/create', [KibBController::class, 'create'])->name('kib.b.create');
    Route::post('/kib/kib-b', [KibBController::class, 'store'])->name('kib.b.store');
    Route::get('/kib/kib-b/{kode_barang}/edit', [KibBController::class, 'edit'])->name('kib.b.edit');
    Route::put('/kib/kib-b/{kode_barang}', [KibBController::class, 'update'])->name('kib.b.update');
    Route::delete('/kib/kib-b/{kode_barang}', [KibBController::class, 'destroy'])->name('kib.b.destroy');
});

// kib C
use App\Http\Controllers\KibCController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kib/kib-c', [KibCController::class, 'index'])->name('kib.c');
    Route::get('/kib/kib-c/create', [KibCController::class, 'create'])->name('kib.c.create');
    Route::post('/kib/kib-c', [KibCController::class, 'store'])->name('kib.c.store');
    Route::get('/kib/kib-c/{kode_barang}/edit', [KibCController::class, 'edit'])->name('kib.c.edit');
    Route::put('/kib/kib-c/{kode_barang}', [KibCController::class, 'update'])->name('kib.c.update');
    Route::delete('/kib/kib-c/{kode_barang}', [KibCController::class, 'destroy'])->name('kib.c.destroy');
});

// kib D
use App\Http\Controllers\KibDController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kib/kib-d', [KibDController::class, 'index'])->name('kib.d');
    Route::get('/kib/kib-d/create', [KibDController::class, 'create'])->name('kib.d.create');
    Route::post('/kib/kib-d', [KibDController::class, 'store'])->name('kib.d.store');
    Route::get('/kib/kib-d/{kode_barang}/edit', [KibDController::class, 'edit'])->name('kib.d.edit');
    Route::put('/kib/kib-d/{kode_barang}', [KibDController::class, 'update'])->name('kib.d.update');
    Route::delete('/kib/kib-d/{kode_barang}', [KibDController::class, 'destroy'])->name('kib.d.destroy');
});

// kib E
use App\Http\Controllers\KibEController;

Route::middleware(['auth'])->group(function () {
    Route::get('/kib/kib-e', [KibEController::class, 'index'])->name('kib.e');
    Route::get('/kib/kib-e/create', [KibEController::class, 'create'])->name('kib.e.create');
    Route::post('/kib/kib-e', [KibEController::class, 'store'])->name('kib.e.store');
    Route::get('/kib/kib-e/{kode_barang}/edit', [KibEController::class, 'edit'])->name('kib.e.edit');
    Route::put('/kib/kib-e/{kode_barang}', [KibEController::class, 'update'])->name('kib.e.update');
    Route::delete('/kib/kib-e/{kode_barang}', [KibEController::class, 'destroy'])->name('kib.e.destroy');
});

// kib F
use App\Http\Controllers\KibFController;
Route::get('/kib/kib-f', [KibFController::class, 'index'])->name('kib.f');
    Route::get('/kib/kib-f/create', [KibFController::class, 'create'])->name('kib.f.create');
    Route::post('/kib/kib-f', [KibFController::class, 'store'])->name('kib.f.store');
    Route::get('/kib/kib-f/{kode_barang}/edit', [KibFController::class, 'edit'])->name('kib.f.edit');
    Route::put('/kib/kib-f/{kode_barang}', [KibFController::class, 'update'])->name('kib.f.update');
    Route::delete('/kib/kib-f/{kode_barang}', [KibFController::class, 'destroy'])->name('kib.f.destroy');

// guru
use App\Http\Controllers\GuruController;

Route::middleware(['auth'])->group(function () {
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
});

// ruang
use App\Http\Controllers\RuangController;

Route::middleware(['auth'])->group(function () {
    Route::get('/ruang', [RuangController::class, 'index'])->name('ruang.index');
    Route::get('/ruang/create', [RuangController::class, 'create'])->name('ruang.create');
    Route::post('/ruang', [RuangController::class, 'store'])->name('ruang.store');
    Route::get('/ruang/{kode_ruangan}/edit', [RuangController::class, 'edit'])->name('ruang.edit');
    Route::put('/ruang/{kode_ruangan}', [RuangController::class, 'update'])->name('ruang.update');
    Route::delete('/ruang/{kode_ruangan}', [RuangController::class, 'destroy'])->name('ruang.destroy');
});

// peminjaman
use App\Http\Controllers\PeminjamanController;

Route::resource('peminjaman', PeminjamanController::class);
Route::get('/peminjaman-print', [PeminjamanController::class, 'print'])->name('peminjaman.print');

//profiles
use App\Http\Controllers\ProfilController;

Route::get('/profil', [ProfilController::class, 'index'])
    ->middleware('auth')
    ->name('profil');

Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('profil.update-password');
  
// Barang Masuk
use App\Http\Controllers\BarangMasukController;
Route::resource('barang-masuk', BarangMasukController::class);
Route::get('/barang-masuk-print', [BarangMasukController::class, 'print'])->name('barang-masuk.print');
Route::get('/api/barang-by-kib/{jenis}', [BarangMasukController::class, 'getBarangByKib'])->name('api.barang.by.kib');

