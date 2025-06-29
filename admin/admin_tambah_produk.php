<?php include '../koneksi.php'; ?>

<h2>Tambah Produk</h2>
<form action="" method="post" enctype="multipart/form-data">
  Nama Produk: <input type="text" name="nama_produk" required><br>
  Deskripsi: <textarea name="deskripsi"></textarea><br>
  Varian (pisahkan dengan koma): <input type="text" name="varian"><br>
  Gambar: <input type="file" name="gambar"><br>
  <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama_produk'];
  $desk = $_POST['deskripsi'];
  $varian = $_POST['varian'];

  // Upload gambar
  $gambar_name = $_FILES['gambar']['name'];
  $gambar_tmp = $_FILES['gambar']['tmp_name'];
  $lokasi = "images/" . $gambar_name;
  move_uploaded_file($gambar_tmp, "../$lokasi");

  mysqli_query($koneksi, "INSERT INTO produk (nama_produk, deskripsi, varian, gambar) 
    VALUES ('$nama', '$desk', '$varian', '$lokasi')");

  header("Location: list_produk.php");
}
?>
