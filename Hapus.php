<?php
require "koneksi.php";
$id    = $_GET["id"]; 
mysqli_execute_query($koneksi,
        "DELETE FROM profil_penjaga WHERE id = ?", [$id]);
header("Location: Index.php");
    exit;
?>