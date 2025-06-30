<?php
require_once 'config.php';
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Upload gambar
$target_dir = "images/hantu/";
$target_file = $target_dir . basename($_FILES["gambar"]["name"]);

// Pindahkan file upload
if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    // Simpan ke database
    $query = "INSERT INTO produk 
              (name_prodok, kategori, deskripsl, gambar, variant, Harga) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssssi",
        $_POST['nama_produk'],
        $_POST['kategori'],
        $_POST['deskripsi'],
        $target_file,
        $_POST['variant'],
        $_POST['harga']
    );
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: produk.php?status=sukses");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Error upload gambar";
}
?>