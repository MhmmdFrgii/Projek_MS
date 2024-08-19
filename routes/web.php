<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});


// Protected Routes
Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('organisasi', OrganisasiController::class);
    Route::resource('ekskul', EkskulController::class);
    Route::resource('detail', DetailController::class);
    Route::resource('mapel', MapelController::class)->except(['show']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Soft delete routes for mapel
    Route::get('mapel/trashed', [MapelController::class, 'trashed'])->name('mapel.trashed');
    Route::post('mapel/{id}/restore', [MapelController::class, 'restore'])->name('mapel.restore');
    Route::delete('mapel/{id}/force-delete', [MapelController::class, 'forceDelete'])->name('mapel.forceDelete');
});
