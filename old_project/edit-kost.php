<?php
require 'connection.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM penghuni_kost WHERE id = '$id'");
$penghuni = mysqli_fetch_assoc($data);
$status_pesan = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jk = $_POST['jk'];
    $telepon = $_POST['telepon'];
    $pekerjaan = $_POST['pekerjaan'];
    $kamar = $_POST['kamar'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $harga = $_POST['harga'];
    $kontak_darurat = $_POST['kontak_darurat'];
    $status = $_POST['status'];

    $query = "UPDATE penghuni_kost SET nama='$nama', nik='$nik', jk='$jk', telepon='$telepon', pekerjaan='$pekerjaan', kamar='$kamar', tgl_masuk='$tgl_masuk', harga='$harga', kontak_darurat='$kontak_darurat', status='$status' WHERE id='$id'";
    mysqli_query($koneksi, $query);

    header('Location: manajemen-kost.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penghuni Kost</title>
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
                        <a class="nav-link" href="manajemen-kost.php">
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

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h1 class="h3 fw-bold mb-1">Edit Data Penghuni</h1>
                        <p class="text-muted mb-0">Perbarui formulir data penyewa di bawah ini.</p>
                    </div>
                    <a href="manajemen-kost.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Tabel
                    </a>
                </div>

                <?php if ($status_pesan == 'gagal') { ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $status_pesan; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <span class="fw-bold"><i class="bi bi-pencil-square me-1"></i> Formulir Ubah Data Penghuni</span>
                    </div>
                    <div class="card-body p-4">
                        <form action="edit-kost.php?id=<?php echo $penghuni['id']; ?>" method="POST">

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?php echo htmlspecialchars($penghuni['nama']); ?>" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-7">
                                    <label for="nik" class="form-label fw-semibold">Nomor KTP / NIK <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        value="<?php echo htmlspecialchars($penghuni['nik']); ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold d-block">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <div class="pt-2">
                                        <?php $is_laki = (stripos($penghuni['jk'], 'laki') !== false); ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk"
                                                id="laki" value="Laki-laki" <?php echo $is_laki ? 'checked' : ''; ?> required>
                                            <label class="form-check-label" for="laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk"
                                                id="perempuan" value="Perempuan" <?php echo ! $is_laki ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label fw-semibold">No. HP / WhatsApp <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon"
                                        value="<?php echo htmlspecialchars($penghuni['telepon']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan / Instansi</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        value="<?php echo htmlspecialchars($penghuni['pekerjaan']); ?>">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="kamar" class="form-label fw-semibold">Pilih Kamar Kost <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="kamar" name="kamar" required>
                                        <option value="">-- Pilih Kamar Tersedia --</option>
                                        <?php
                                        $opsi_kamar = [
                                            'Kamar A-01 (Griya Harmoni)',
                                            'Kamar A-02 (Griya Harmoni)',
                                            'Kamar B-05 (Barokah Jaya)',
                                            'Kamar C-03 (Green Residence)',
                                        ];
if (! in_array($penghuni['kamar'], $opsi_kamar) && ! empty($penghuni['kamar'])) {
    $opsi_kamar[] = $penghuni['kamar'];
}
foreach ($opsi_kamar as $k) {
    ?>
                                            <option value="<?php echo htmlspecialchars($k); ?>" <?php echo ($penghuni['kamar'] == $k) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($k); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_masuk" class="form-label fw-semibold">Tanggal Mulai Masuk <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk"
                                        value="<?php echo htmlspecialchars($penghuni['tgl_masuk']); ?>" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="harga" class="form-label fw-semibold">Biaya Sewa per Bulan (Rp) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            value="<?php echo htmlspecialchars($penghuni['harga']); ?>" min="0" step="50000" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label fw-semibold">Status Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Belum lunas" <?php echo ($penghuni['status'] == 'Belum lunas' || $penghuni['status'] == 'Jatuh Tempo') ? 'selected' : ''; ?>>Belum lunas</option>
                                        <option value="Lunas" <?php echo ($penghuni['status'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                                        <option value="Nunggak" <?php echo ($penghuni['status'] == 'Nunggak' || $penghuni['status'] == 'Menunggak') ? 'selected' : ''; ?>>Nunggak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="kontak_darurat" class="form-label fw-semibold">Kontak Darurat (Nama & No. HP) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kontak_darurat" name="kontak_darurat"
                                    value="<?php echo htmlspecialchars($penghuni['kontak_darurat']); ?>" required>
                                <div class="form-text">Dapat dihubungi jika terjadi keadaan mendesak terkait penghuni.</div>
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="manajemen-kost.php" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

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
