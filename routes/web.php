<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjagaController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e) {
        return "DB gagal connect: " . $e->getMessage();
    }
})->withoutMiddleware('web');

// Halaman daftar penjaga: bisa dilihat siapa saja (sama seperti video)
Route::get('/penjaga', [PenjagaController::class, 'index'])
    ->name('penjaga.index');

// Tambah, ubah, hapus: wajib login
Route::middleware('auth')->group(function () {
    Route::get('/penjaga/create', [PenjagaController::class, 'create'])
        ->name('penjaga.create');
    Route::post('/penjaga', [PenjagaController::class, 'store'])
        ->name('penjaga.store');
    Route::get('/penjaga/{penjaga}/edit', [PenjagaController::class, 'edit'])
        ->name('penjaga.edit');
    Route::put('/penjaga/{penjaga}', [PenjagaController::class, 'update'])
        ->name('penjaga.update');
    Route::delete('/penjaga/{penjaga}', [PenjagaController::class, 'destroy'])
        ->name('penjaga.destroy');
});