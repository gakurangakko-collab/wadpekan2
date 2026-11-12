
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjaga - Sistem Manajemen Kos & Properti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3 mb-4">
        <a class="navbar-brand" href="{{ route('penjaga.index') }}">
            Sistem Manajemen Kos & Properti
        </a>
    </nav>

    <div class="container">
        <h1>Edit Penjaga</h1>
        <p>Ubah data profil penjaga sesuai kebutuhan.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('penjaga.update', $penjaga) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Penjaga</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="{{ old('nama', $penjaga->nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat"
                    value="{{ old('alamat', $penjaga->alamat) }}" required>
            </div>

            <div class="mb-3">
                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                    value="{{ old('no_telepon', $penjaga->no_telepon) }}" required>
            </div>

            <div class="mb-3">
                <label for="tugas" class="form-label">Tugas Kebersihan Harian</label>
                <input type="text" class="form-control" id="tugas" name="tugas"
                    value="{{ old('tugas', $penjaga->tugas) }}" required>
            </div>

            <div class="mb-3">
                <label for="area" class="form-label">Area Penanganan</label>
                <input type="text" class="form-control" id="area" name="area"
                    value="{{ old('area', $penjaga->area) }}" required>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('penjaga.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
