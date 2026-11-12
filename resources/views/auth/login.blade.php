@extends('layouts.app')

@section('title', 'Masuk - Sistem Pengelolaan Kost')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header bg-white py-3 text-center border-bottom">
                <i class="bi bi-shield-lock-fill text-primary fs-2 d-block mb-1"></i>
                <h2 class="h5 fw-bold mb-0">Masuk ke KostManager</h2>
                <small class="text-muted">Gunakan akun Anda untuk mengelola data penghuni kost</small>
            </div>
            <div class="card-body p-4">

                <div class="alert alert-info small py-2 mb-3">
                    <div class="fw-semibold mb-1"><i class="bi bi-info-circle me-1"></i> Akun Demo (Password: <code>password123</code>)</div>
                    <div>Pemilik: <code>admin@kost.com</code></div>
                    <div>Pengelola: <code>staff@kost.com</code></div>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
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
                                id="password" name="password" placeholder="Masukkan kata sandi" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                        <label class="form-check-label text-muted small" for="remember">Ingat saya di perangkat ini</label>
                    </div>

                    <!-- Tombol Masuk -->
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                    </button>
                </form>
            </div>
            <div class="card-footer bg-light py-3 text-center small text-muted">
                Belum memiliki akun? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Daftar Akun Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection
