<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));
?>

<h2>Edit Produk</h2>
<form action="" method="post" enctype="multipart/form-data">
  Nama Produk: <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required><br>
  Deskripsi: <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>
  Varian: <input type="text" name="varian" value="<?= $data['varian'] ?>"><br>
  Ganti Gambar (opsional): <input type="file" name="gambar"><br>
  <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
  $nama = $_POST['nama_produk'];
  $desk = $_POST['deskripsi'];
  $varian = $_POST['varian'];

  if ($_FILES['gambar']['name']) {
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $lokasi = "images/" . $gambar_name;
    move_uploaded_file($gambar_tmp, "../$lokasi");
    $gambar_sql = ", gambar='$lokasi'";
  } else {
    $gambar_sql = "";
  }

  mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama', deskripsi='$desk', varian='$varian' $gambar_sql WHERE id=$id");
  header("Location: list_produk.php");
}
?>
