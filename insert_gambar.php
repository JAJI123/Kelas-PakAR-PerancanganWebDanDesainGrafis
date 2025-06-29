<?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_error($koneksi));
}

session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produk_id'])) {
    // Tangani AJAX tambah keranjang
    $id = $_POST['produk_id'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    $_SESSION['keranjang'][$id] = [
        'id' => $id,
        'nama_produk' => $nama,
        'harga' => $harga,
        'gambar' => $gambar,
        'jumlah' => isset($_SESSION['keranjang'][$id]) 
            ? $_SESSION['keranjang'][$id]['jumlah'] + 1 
            : 1
    ];

    echo json_encode(['status' => 'ok', 'jumlah' => count($_SESSION['keranjang'])]);
    exit;
}
?>


// Data produk contoh
$produk = [
    [
        'nama_produk' => 'Sticker Hantu Putih',
        'kategori' => 'Sticker Mobil',
        'deskripsi' => 'Deskripsi lengkap produk sticker hantu putih',
        'gambar' => 'images/hantu/1.jpg',
        'varian' => 'Putih',
        'harga' => 18700
    ],
    [
        'nama_produk' => 'Sticker Kingkong',
        'kategori' => 'Sticker Motor',
        'deskripsi' => 'Deskripsi lengkap produk sticker kingkong',
        'gambar' => 'images/hantu/2.jpg',
        'varian' => 'Hitam',
        'harga' => 18700
    ]
];

foreach ($produk as $item) {
    $query = "INSERT INTO produk 
              (nama_produk, kategori, deskripsi, gambar, varian, Harga) 
              VALUES (
                  '" . mysqli_real_escape_string($koneksi, $item['nama_produk']) . "',
                  '" . mysqli_real_escape_string($koneksi, $item['kategori']) . "',
                  '" . mysqli_real_escape_string($koneksi, $item['deskripsi']) . "',
                  '" . mysqli_real_escape_string($koneksi, $item['gambar']) . "',
                  '" . mysqli_real_escape_string($koneksi, $item['varian']) . "',
                  " . intval($item['harga']) . "
              )";
    
    if (!mysqli_query($koneksi, $query)) {
        echo "Error: " . mysqli_error($koneksi) . "<br>";
    }
}

echo "Data berhasil dimasukkan!";
mysqli_close($koneksi);
?>