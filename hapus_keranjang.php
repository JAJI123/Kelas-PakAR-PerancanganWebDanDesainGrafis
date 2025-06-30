<?php
require_once 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM keranjang WHERE id = $id");
header("Location: keranjang.php");
?>
