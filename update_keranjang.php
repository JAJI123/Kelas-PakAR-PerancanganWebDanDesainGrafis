<?php
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");

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
