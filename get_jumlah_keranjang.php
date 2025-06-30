<?php
require_once 'koneksi.php';

if (!$koneksi) {
    echo json_encode(['jumlah' => 0]);
    exit;
}

$result = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM keranjang");
$data = mysqli_fetch_assoc($result);
echo json_encode(['jumlah' => (int)$data['jumlah']]);
