<?php
require_once 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// Tangani upload gambar
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
$path = "images/" . basename($gambar);

if (move_uploaded_file($tmp, $path)) {
    $query = "INSERT INTO produk (nama_produk, harga, deskripsi, gambar)
              VALUES ('$nama', $harga, '$deskripsi', '$gambar')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Produk berhasil disimpan!";
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal upload gambar.";
}
?>
