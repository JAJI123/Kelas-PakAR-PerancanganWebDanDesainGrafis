<form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
  <label>Nama Produk:</label><br>
  <input type="text" name="nama_produk" required><br>

  <label>Harga:</label><br>
  <input type="number" name="harga" required><br>

  <label>Deskripsi:</label><br>
  <textarea name="deskripsi" required></textarea><br>

  <label>Gambar:</label><br>
  <input type="file" name="gambar" accept="image/*" required><br>

  <button type="submit">Simpan</button>
</form>
