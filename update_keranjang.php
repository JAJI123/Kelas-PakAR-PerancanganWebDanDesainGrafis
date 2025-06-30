<?php
require_once 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $jumlah = max(1, (int)$_POST['jumlah']);

    $query = "UPDATE keranjang SET jumlah = $jumlah WHERE id = $id";
    mysqli_query($koneksi, $query);
}

header("Location: keranjang.php");
exit;
