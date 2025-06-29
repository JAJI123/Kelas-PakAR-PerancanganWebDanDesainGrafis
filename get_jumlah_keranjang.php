<?php
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");

if (!$koneksi) {
    echo json_encode(['jumlah' => 0]);
    exit;
}

$result = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM keranjang");
$data = mysqli_fetch_assoc($result);
echo json_encode(['jumlah' => (int)$data['jumlah']]);
