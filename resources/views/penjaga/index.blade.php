<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Housekeeper - Sistem Manajemen Kos &amp; Properti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar-custom .navbar-brand {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }

        .navbar-custom .nav-link {
            color: #374151;
            text-decoration: none;
        }

        .navbar-custom .nav-link:hover {
            color: #2563eb;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <a class="navbar-brand" href="{{ route('penjaga.index') }}">
            Sistem Manajemen Kos &amp; Properti
        </a>

        <ul class="navbar-nav ms-auto flex-row gap-3 align-items-center">
            @can('kelola-pengguna')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengguna.index') }}">Kelola Pengguna</a>
                </li>
            @endcan

            @auth
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">
                            Logout ({{ Auth::user()->username }} - {{ Auth::user()->role }})
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="container">
        <h1 class="mb-0">Data Housekeeper</h1>
        <p>Daftar housekeeper beserta tugas harian dan area penanganannya</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penjaga Kost</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Tugas Kebersihan Harian</th>
                        <th>Area Penanganan</th>
                        @auth
                            <th>Aksi</th>
                        @endauth
                    </tr>
                </thead>

                <tbody>
                    @forelse ($penjaga as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->tugas }}</td>
                            <td>{{ $item->area }}</td>

                            @auth
                                <td>
                                    <div class="d-flex gap-2">
                                        @can('update', $item)
                                            <a href="{{ route('penjaga.edit', $item) }}"
                                               class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete', $item)
                                            <form action="{{ route('penjaga.destroy', $item) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data penjaga ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::check() ? 7 : 6 }}" class="text-center text-muted py-4">
                                Belum ada data penjaga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @can('create', \App\Models\Penjaga::class)
            <div class="text-end mt-3 mb-5">
                <a href="{{ route('penjaga.create') }}" class="btn btn-primary">
                    Tambah Penjaga
                </a>
            </div>
        @endcan
    </div>
</body>
</html>