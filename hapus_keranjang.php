<?php
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM keranjang WHERE id = $id");
header("Location: keranjang.php");
?>
