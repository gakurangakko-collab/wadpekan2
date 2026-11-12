<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjagaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e) {
        return "DB gagal connect: " . $e->getMessage();
    }
})->withoutMiddleware('web');

// Publik: boleh dibuka tanpa login
Route::get('/penjaga', [PenjagaController::class, 'index'])->name('penjaga.index');

// Hanya untuk yang BELUM login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Hanya untuk yang SUDAH login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dibatasi lagi berdasarkan peran
    Route::middleware('role:admin,pengelola')->group(function () {
        Route::get('/penjaga/create', [PenjagaController::class, 'create'])->name('penjaga.create');
        Route::post('/penjaga', [PenjagaController::class, 'store'])->name('penjaga.store');

        Route::get('/penjaga/{penjaga}/edit', [PenjagaController::class, 'edit'])
            ->name('penjaga.edit')
            ->can('update', 'penjaga');

        Route::put('/penjaga/{penjaga}', [PenjagaController::class, 'update'])
            ->name('penjaga.update')
            ->can('update', 'penjaga');
    });

    Route::delete('/penjaga/{penjaga}', [PenjagaController::class, 'destroy'])
        ->name('penjaga.destroy')
        ->middleware('role:admin')
        ->can('delete', 'penjaga');

    // Halaman yang dijaga Gate (Langkah 5)
    Route::get('/pengguna', [UserController::class, 'index'])
        ->name('pengguna.index')
        ->can('kelola-pengguna');
});