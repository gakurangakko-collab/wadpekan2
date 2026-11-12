<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Data Penghuni Kost') - KostManager</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Style dari Old Project (dengan sedikit peningkatan) -->
    <style>
        body {
            background-color: #f4f6f9;
            color: #333333;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        .custom-card-box {
            padding: 20px 24px;
            border: 2px solid #3b82f6;
            margin: 20px 0 25px 0;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08);
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
        }

        .card {
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            font-weight: 600;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        .table tbody td {
            font-size: 0.92rem;
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
            padding: 0.4em 0.7em;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ Auth::check() ? route('penghuni.index') : route('login') }}">
                <i class="bi bi-houses-fill me-2"></i>KostManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('penghuni.index') ? 'active fw-semibold' : '' }}" href="{{ route('penghuni.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Data Penghuni
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('penghuni.create') ? 'active fw-semibold' : '' }}" href="{{ route('penghuni.create') }}">
                                <i class="bi bi-person-plus-fill me-1"></i> Tambah Penghuni
                            </a>
                        </li>
                        @can('view-laporan-keuangan')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('penghuni.laporan') ? 'active fw-semibold' : '' }}" href="{{ route('penghuni.laporan') }}">
                                    <i class="bi bi-cash-coin me-1"></i> Laporan Keuangan
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3 text-white small">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            <span class="badge bg-light text-primary ms-1 text-capitalize">{{ Auth::user()->role }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active fw-semibold' : '' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active fw-semibold' : '' }}" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Daftar Akun
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container pb-5">
        <!-- Notifikasi Pesan Sukses / Error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <strong>Terjadi kesalahan input data:</strong>
                </div>
                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 text-center text-muted mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2026 Sistem Pengelolaan Kost. Tugas Pemrograman Aplikasi Web (PAW).</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
