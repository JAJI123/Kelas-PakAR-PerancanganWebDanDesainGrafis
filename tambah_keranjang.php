<?php
// Start session at the very beginning
session_start();

// Database connection
require_once 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Initialize cart if not exists
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

// Get form data
$produk_id = $_POST['produk_id'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];
$varian = $_POST['varian'];
$jumlah = $_POST['jumlah'];

// Check if product already exists in cart
$item_exists = false;
foreach ($_SESSION['keranjang'] as &$item) {
    if ($item['id'] == $produk_id && $item['varian'] == $varian) {
        $item['jumlah'] += $jumlah;
        $item_exists = true;
        break;
    }
}

// If product doesn't exist in cart, add it
if (!$item_exists) {
    $_SESSION['keranjang'][] = [
        'id' => $produk_id,
        'nama_produk' => $nama_produk,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'varian' => $varian,
        'gambar' => $gambar
    ];
}

// Database operations
$cek = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE produk_id='$produk_id' AND varian='$varian'");
if (mysqli_num_rows($cek) > 0) {
    mysqli_query($koneksi, "UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE produk_id='$produk_id' AND varian='$varian'");
} else {
    mysqli_query($koneksi, "INSERT INTO keranjang (produk_id, nama_produk, harga, gambar, varian, jumlah) 
        VALUES ('$produk_id', '$nama_produk', '$harga', '$gambar', '$varian', '$jumlah')");
}

// Redirect to cart page
header("Location: keranjang.php");
exit;
?>