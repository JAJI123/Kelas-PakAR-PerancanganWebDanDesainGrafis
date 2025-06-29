<?php
$host = "localhost"; // atau bisa juga pakai host dari Hostinger jika ada
$user = "u747399580_kikisticker";
$pass = "Bisdig2023"; // ganti sesuai password saat kamu buat
$db   = "u747399580_kikisticker";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
