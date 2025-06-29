<?php
include '../koneksi.php';
$result = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
?>

<h2>Daftar Produk</h2>
<a href="tambah_produk.php">+ Tambah Produk</a>
<table border="1" cellpadding="8">
  <tr>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Deskripsi</th>
    <th>Varian</th>
    <th>Aksi</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><img src="../<?= $row['gambar'] ?>" width="80"></td>
      <td><?= $row['nama_produk'] ?></td>
      <td><?= $row['deskripsi'] ?></td>
      <td><?= $row['varian'] ?></td>
      <td>
        <a href="edit_produk.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="hapus_produk.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
