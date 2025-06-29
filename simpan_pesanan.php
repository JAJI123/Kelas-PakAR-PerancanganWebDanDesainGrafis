<?php
session_start();
include 'koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$total = 0;

foreach ($_SESSION['keranjang'] as $item) {
  $total += 1; // ganti dengan harga jika sudah pakai harga
}

// Simpan pesanan utama
mysqli_query($koneksi, "INSERT INTO pesanan (nama_pembeli, alamat, total) VALUES ('$nama', '$alamat', $total)");
$id_pesanan = mysqli_insert_id($koneksi);

// Simpan detail
foreach ($_SESSION['keranjang'] as $item) {
  mysqli_query($koneksi, "INSERT INTO pesanan_detail (id_pesanan, id_produk, nama_produk, varian, jumlah) VALUES (
    $id_pesanan, '{$item['id']}', '{$item['nama']}', '{$item['varian']}', {$item['jumlah']}
  )");
}

unset($_SESSION['keranjang']);
echo "Pesanan berhasil disimpan. <a href='indeks.php'>Kembali</a>";
