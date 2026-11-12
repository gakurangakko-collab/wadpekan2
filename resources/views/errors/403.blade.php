<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center py-5">
        <h1 class="display-1 fw-bold text-primary">403</h1>
        <p class="fs-5 text-muted">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}
        </p>
        <a href="{{ route('penjaga.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>