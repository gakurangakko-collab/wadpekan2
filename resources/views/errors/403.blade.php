@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body p-5">
                    <div class="display-3 fw-bold text-danger mb-2">403</div>
                    <h1 class="h4 fw-bold mb-3">Akses Ditolak</h1>
                    <p class="text-muted mb-4">
                        {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}
                    </p>
                    <a href="{{ Auth::check() ? route('penghuni.index') : route('login') }}" class="btn btn-primary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

