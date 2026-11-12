<?php

require 'connection.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM penghuni_kost WHERE id = '$id'");

header('Location: manajemen-kost.php');
