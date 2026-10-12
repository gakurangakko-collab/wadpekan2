<?php
$koneksi = mysqli_connect("localhost", "root", "", "kost_properti");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>