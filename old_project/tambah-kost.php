<?php
require 'connection.php';

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

    $query = "INSERT INTO penghuni_kostt (nama, nik, jk, telepon, pekerjaan, kamar, tgl_masuk, harga, kontak_darurat, status) VALUES ('$nama', '$nik', '$jk', '$telepon', '$pekerjaan', '$kamar', '$tgl_masuk', '$harga', '$kontak_darurat', '$status')";
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
    <title>Tambah Data Penghuni Kost Baru</title>
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
                        <a class="nav-link active fw-semibold" aria-current="page" href="tambah-kost.php">
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
                        <h1 class="h3 fw-bold mb-1">Tambah Penghuni Baru</h1>
                        <p class="text-muted mb-0">Isi formulir ringkas di bawah untuk mendaftarkan penyewa baru ke dalam database.</p>
                    </div>
                    <a href="manajemen-kost.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Lihat Data Tabel
                    </a>
                </div>

                <?php if ($status_pesan == 'berhasil') { ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <?php echo $status_pesan; ?>
                            </div>
                            <a href="manajemen-kost.php" class="btn btn-success btn-sm ms-3">
                                Buka Tabel Penghuni <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } elseif ($status_pesan == 'gagal') { ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $status_pesan; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <div class="custom-card-box">
                    <h2 class="h6 fw-bold text-primary mb-1">
                        <i class="bi bi-info-circle-fill me-1"></i> Petunjuk Pengisian
                    </h2>
                    <p class="text-muted small mb-0">
                        Data yang Anda submit melalui form ini akan langsung dimasukkan ke dalam database dan dapat langsung dilihat di halaman manajemen.
                    </p>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <span class="fw-bold"><i class="bi bi-person-lines-fill me-1"></i> Formulir Data Penghuni</span>
                    </div>
                    <div class="card-body p-4">
                        <form action="tambah-kost.php" method="POST">

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Contoh: Siti Rahma" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-7">
                                    <label for="nik" class="form-label fw-semibold">Nomor KTP / NIK <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="16 digit NIK sesuai KTP" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold d-block">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <div class="pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk"
                                                id="laki" value="Laki-laki" required>
                                            <label class="form-check-label" for="laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jk"
                                                id="perempuan" value="Perempuan">
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
                                        placeholder="08xxxxxxxxxx" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan / Instansi</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        placeholder="Contoh: Mahasiswa UGM / Karyawan">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="kamar" class="form-label fw-semibold">Pilih Kamar Kost <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="kamar" name="kamar" required>
                                        <option value="">-- Pilih Kamar Tersedia --</option>
                                        <option value="Kamar A-01 (Griya Harmoni)">Kamar A-01 (Kost Griya Harmoni)</option>
                                        <option value="Kamar A-02 (Griya Harmoni)">Kamar A-02 (Kost Griya Harmoni)</option>
                                        <option value="Kamar B-05 (Barokah Jaya)">Kamar B-05 (Kost Barokah Jaya)</option>
                                        <option value="Kamar C-03 (Green Residence)">Kamar C-03 (Kost Green Residence)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_masuk" class="form-label fw-semibold">Tanggal Mulai Masuk <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="harga" class="form-label fw-semibold">Biaya Sewa per Bulan (Rp) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            placeholder="1200000" min="0" step="50000" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label fw-semibold">Status Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Belum lunas" selected>Belum lunas</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Nunggak">Nunggak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="kontak_darurat" class="form-label fw-semibold">Kontak Darurat (Nama & No. HP) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kontak_darurat" name="kontak_darurat"
                                    placeholder="Contoh: Ibu Rahma (081298765432)" required>
                                <div class="form-text">Dapat dihubungi jika terjadi keadaan mendesak terkait penghuni.</div>
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <button type="reset" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save-fill me-1"></i> Simpan Data Penghuni
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
