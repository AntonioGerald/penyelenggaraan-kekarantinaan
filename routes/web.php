<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\PenumpangController;
use App\Http\Controllers\Admin\AlatAngkutController;
use App\Http\Controllers\Admin\KeslingController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\VektorController;
use App\Http\Controllers\Admin\PelayananKesehatanController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Autentikasi admin
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Dashboard admin sederhana (nanti bisa dikembangkan)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Admin: Kelola data penumpang, alat angkut, kesling, penyakit, vektor, dan pelayanan kesehatan
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Penumpang
    Route::get('penumpang/export-pdf', [PenumpangController::class, 'exportPdf'])->name('penumpang.exportPdf');
    Route::post('penumpang/import-excel', [PenumpangController::class, 'importExcel'])->name('penumpang.importExcel');
    Route::resource('penumpang', PenumpangController::class)->except(['show']);

    // Alat Angkut (CRUD sederhana tanpa export/import dulu)
    Route::resource('alat-angkut', AlatAngkutController::class)->except(['show']);

    // Kesling (CRUD sederhana)
    Route::resource('kesling', KeslingController::class)->except(['show']);

    // Penyakit (CRUD sederhana)
    Route::resource('penyakit', PenyakitController::class)->except(['show']);

    // Vektor (CRUD sederhana)
    Route::resource('vektor', VektorController::class)->except(['show']);

    // Pelayanan Kesehatan (CRUD sederhana)
    Route::resource('pelayanan-kesehatan', PelayananKesehatanController::class)->except(['show']);
});
