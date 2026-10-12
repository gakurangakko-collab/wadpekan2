<?php
require "koneksi.php";

    $id    = $_GET["id"]; 
    $hasil = mysqli_execute_query($koneksi,
            "SELECT * FROM profil_penjaga WHERE id = ?", [$id]);
    $row   = mysqli_fetch_assoc($hasil);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id                      = $_POST["id"];
    $Nama_Penjaga_Kost       = $_POST["Nama_Penjaga_Kost"];
    $Alamat                  = $_POST["Alamat"];
    $Nomor_Telepon           = $_POST["Nomor_Telepon"];
    $Tugas_Kebersihan_Harian = $_POST["Tugas_Kebersihan_Harian"];
    $Tugas_Penanganan        = $_POST["Tugas_Penanganan"];

    $sql = "UPDATE profil_penjaga SET nama = ?, alamat = ?, no_telepon = ?, tugas = ?, area = ? WHERE id = ?";
    mysqli_execute_query($koneksi, $sql, [$Nama_Penjaga_Kost, $Alamat, $Nomor_Telepon, $Tugas_Kebersihan_Harian, $Tugas_Penanganan, $id]);
    
    header("Location: Index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tambahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="Index.php">Sistem Manajemen Kos & Properti</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Formulir Tambahan</h1>
        
        <form method="post">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Penjaga</label>
                <input type="text" class="form-control" id="nama" name="Nama_Penjaga_Kost" value="<?= $row["nama"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?= $row["alamat"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Nomor" class="form-label">Nomor telepon</label>
                <input type="text" class="form-control" id="Nomor" name="Nomor_Telepon" value="<?= $row["no_telepon"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tugas" class="form-label">Tugas Kebersihan Harian</label>
                <input type="text" class="form-control" id="tugas" name="Tugas_Kebersihan_Harian" value="<?= $row["tugas"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Area Penanganan</label>
                <input type="text" class="form-control" id="area" name="Tugas_Penanganan" value="<?= $row["area"]; ?>" required>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                <a href="Index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
