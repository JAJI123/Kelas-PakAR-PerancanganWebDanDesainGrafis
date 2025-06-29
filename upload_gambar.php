<?php
// upload_gambar.php
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['gambar'])) {
    $produk_id = intval($_POST['produk_id']);
    $nama_file = basename($_FILES['gambar']['name']);
    $tmp_file = $_FILES['gambar']['tmp_name'];
    
    // Direktori upload
    $target_dir = "images/";
    $target_file = $target_dir . $nama_file;
    
    // Pindahkan file
    if (move_uploaded_file($tmp_file, $target_file)) {
        // Simpan ke database
        $query = "INSERT INTO produk_gambar (produk_id, nama_gambar) VALUES (?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "is", $produk_id, $nama_file);
        mysqli_stmt_execute($stmt);
        
        header("Location: detail_produk.php?id=$produk_id");
        exit;
    } else {
        echo "Gagal upload gambar.";
    }
}

// Form upload
$produk_id = intval($_GET['id']);
?>
<h2>Upload Gambar Tambahan</h2>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="produk_id" value="<?= $produk_id ?>">
    
    <label>Pilih Gambar:</label>
    <input type="file" name="gambar" accept="image/*" required>
    
    <button type="submit">Upload Gambar</button>
</form>