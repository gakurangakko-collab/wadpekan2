<?php
require 'connection.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM penghuni_kost WHERE id = '$id'");
    header('Location: manajemen-kost.php');
    exit;
}

$query = 'SELECT * FROM penghuni_kost';

$daftar_penghuni = mysqli_query($koneksi, $query);

$total_penghuni = mysqli_num_rows($daftar_penghuni);
$total_lunas = 0;
$total_jatuh_tempo = 0;
$total_menunggak = 0;

foreach ($daftar_penghuni as $p) {
    if ($p['status'] == 'Lunas') {
        $total_lunas++;
    } elseif ($p['status'] == 'Belum lunas') {
        $total_jatuh_tempo++;
    } elseif ($p['status'] == 'Nunggak') {
        $total_menunggak++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Penghuni Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="manajemen-kost.php">
                <i class="bi bi-houses-fill me-2"></i>KostManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" aria-current="page" href="manajemen-kost.php">
                            <i class="bi bi-people-fill me-1"></i> Data Penghuni
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah-kost.php">
                            <i class="bi bi-person-plus-fill me-1"></i> Tambah Penghuni
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container pb-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 fw-bold mb-1">Manajemen Data Penghuni Kost</h1>
                <p class="text-muted mb-0">Daftar seluruh penghuni kost aktif dan status pembayarannya.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="manajemen-kost.php?reset_data=true" class="btn btn-outline-secondary shadow-sm"
                    title="Kembalikan data ke 4 data dummy awal" onclick="return confirm('Kembalikan data tabel ke 4 data dummy awal?')">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Data Dummy
                </a>
                <a href="tambah-kost.php" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Penghuni Baru
                </a>
            </div>
        </div>

        <section class="border p-4 border-black rounded mb-2">
            <h2 class="h5 fw-bold text-primary mb-3">
                <i class="bi bi-bar-chart-fill me-2"></i>Ringkasan Data Penghuni
            </h2>
            <div class="row g-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="text-muted small">Total Penghuni Aktif</div>
                        <div class="h4 fw-bold text-dark mt-1 mb-0"><?php echo $total_penghuni; ?> Orang</div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="text-muted small">Status Lunas</div>
                        <div class="h4 fw-bold text-success mt-1 mb-0"><?php echo $total_lunas; ?> Orang</div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="text-muted small">Belum Lunas</div>
                        <div class="h4 fw-bold text-warning mt-1 mb-0"><?php echo $total_jatuh_tempo; ?> Orang</div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="text-muted small">Menunggak</div>
                        <div class="h4 fw-bold text-danger mt-1 mb-0"><?php echo $total_menunggak; ?> Orang</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <span class="fw-bold"><i class="bi bi-funnel-fill me-1"></i> Cari dan Filter Penghuni</span>
            </div>
            <div class="card-body">
                <form action="manajemen-kost.php" method="get" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="cari" class="form-label fw-semibold">Pencarian:</label>
                        <input type="text" class="form-control" id="cari" name="cari"
                            placeholder="Cari berdasarkan nama, NIK, atau nomor HP...">
                    </div>
                    <div class="col-md-4">
                        <label for="filter-status" class="form-label fw-semibold">Status Sewa:</label>
                        <select class="form-select" id="filter-status" name="filter-status">
                            <option value="">Semua Status</option>

                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="manajemen-kost.php" class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </section>

        <section class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-table me-1"></i> Daftar Penghuni Kost</span>
                <span class="badge bg-primary"><?php echo mysqli_num_rows($daftar_penghuni); ?> Data</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama & NIK</th>
                            <th scope="col">Gender</th>
                            <th scope="col">No. HP / WA</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Kamar Kost</th>
                            <th scope="col">Tgl Masuk</th>
                            <th scope="col">Biaya Sewa / Bulan</th>
                            <th scope="col">Kontak Darurat</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
foreach ($daftar_penghuni as $penghuni) {
    ?>
                            <tr>
                                <td class="text-center fw-bold"><?php echo $no++; ?></td>
                                <td>
                                    <div class="fw-bold"><?php echo htmlspecialchars($penghuni['nama']); ?></div>
                                    <small class="text-muted"><?php echo htmlspecialchars($penghuni['nik']); ?></small>
                                </td>
                                <td>
                                    <?php if ($penghuni['jk'] == 'Laki-laki' || $penghuni['jk'] == 'Laki laki') { ?>
                                        <span class="badge bg-info text-dark">Laki-laki</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger-subtle text-danger">Perempuan</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo htmlspecialchars($penghuni['telepon']); ?></td>
                                <td><span class="small"><?php echo htmlspecialchars($penghuni['pekerjaan']); ?></span></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($penghuni['kamar']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($penghuni['tgl_masuk']); ?></td>
                                <td>Rp <?php echo number_format((int) $penghuni['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="small fw-semibold">
                                        <?php echo htmlspecialchars($penghuni['kontak_darurat']); ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php
                if ($penghuni['status'] == 'Lunas') {
                    echo '<span class="badge bg-success">Lunas</span>';
                } elseif ($penghuni['status'] == 'Belum lunas') {
                    echo '<span class="badge bg-warning text-dark">Belum lunas</span>';
                } else {
                    echo '<span class="badge bg-danger">Nunggak</span>';
                }
    ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="edit-kost.php?id=<?php echo $penghuni['id']; ?>" class="btn btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus-kost.php?id=<?php echo $penghuni['id']; ?>" class="btn btn-outline-danger" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="bg-white border-top py-4 text-center text-muted">
        <div class="container">
            <p class="mb-0">&copy; 2026 Sistem Pengelolaan Kost. Tugas Pemrograman Aplikasi Web (PAW).</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>