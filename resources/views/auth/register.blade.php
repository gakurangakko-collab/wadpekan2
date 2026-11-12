@extends('layouts.app')

@section('title', 'Daftar Akun - Sistem Pengelolaan Kost')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header bg-white py-3 text-center border-bottom">
                <i class="bi bi-person-plus-fill text-primary fs-2 d-block mb-1"></i>
                <h2 class="h5 fw-bold mb-0">Daftar Akun Baru</h2>
                <small class="text-muted">Buat akun pengelola untuk mengelola data kost</small>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Minimal 6 karakter" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Ulangi Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-check2-circle"></i></span>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Ketik ulang kata sandi" required>
                        </div>
                    </div>

                    <!-- Tombol Daftar -->
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-person-check-fill me-1"></i> Daftar Sekarang
                    </button>
                </form>
            </div>
            <div class="card-footer bg-light py-3 text-center small text-muted">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
