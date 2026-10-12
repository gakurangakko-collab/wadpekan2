<?php
require "koneksi.php";
$hasil = mysqli_query($koneksi, "SELECT * FROM profil_penjaga");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kos & Properti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 mb-4">
        <a class="navbar-brand" href="index.html">Sistem Manajemen Kos & Properti</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <h1 class="mb-0">Data Penjaga</h1>
        <p>Daftar profil penjaga kos beserta tugas dan area penanganannya.</p>

        <table class="table">
            <thead>
                <tr> 
                    <th>Nama Penjaga Kost</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Tugas Kebersihan Harian</th>
                    <th>Area Penanganan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
    <tr>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["alamat"]; ?></td>
        <td><?= $row["no_telepon"]; ?></td>
        <td><?= $row["tugas"]; ?></td>
        <td><?= $row["area"]; ?></td>
        <td>
             <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">edit</a>
             <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
             onclick="return confirm('Yakin ingin menghapus data ini?')">hapus</a>
</td>
    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>


