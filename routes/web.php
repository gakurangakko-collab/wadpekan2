<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenghuniKostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('penghuni.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/penghuni-laporan', [PenghuniKostController::class, 'laporan'])
        ->can('view-laporan-keuangan')
        ->name('penghuni.laporan');

    Route::middleware('role:pemilik,pengelola')->group(function () {
        Route::get('/penghuni', [PenghuniKostController::class, 'index'])->name('penghuni.index');
        Route::get('/penghuni/create', [PenghuniKostController::class, 'create'])->name('penghuni.create');
        Route::post('/penghuni', [PenghuniKostController::class, 'store'])->name('penghuni.store');
        Route::get('/penghuni/{penghuni}', [PenghuniKostController::class, 'show'])->name('penghuni.show');

        Route::get('/penghuni/{penghuni}/edit', [PenghuniKostController::class, 'edit'])
            ->can('update', 'penghuni')
            ->name('penghuni.edit');
        Route::match(['put', 'patch'], '/penghuni/{penghuni}', [PenghuniKostController::class, 'update'])
            ->can('update', 'penghuni')
            ->name('penghuni.update');
    });

    Route::delete('/penghuni/{penghuni}', [PenghuniKostController::class, 'destroy'])
        ->middleware('role:pemilik')
        ->can('delete', 'penghuni')
        ->name('penghuni.destroy');
});
