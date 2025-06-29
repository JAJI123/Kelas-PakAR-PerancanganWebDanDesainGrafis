<?php
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$result = mysqli_query($koneksi, "
    SELECT keranjang.*, produk.nama_produk, produk.harga, produk.gambar 
    FROM keranjang 
    JOIN produk ON keranjang.produk_id = produk.id
");

$total_belanja = 0;
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
    $total_belanja += $row['jumlah'] * $row['harga'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - KIKI STICKER</title>
    <link rel="stylesheet" href="css/keranjang.css">
</head>
<body>

<!-- Navigasi -->
<nav>
  <div class="nav-wrapper">
    <div class="wrapper">
      <div class="logo">
        <a href="index.php">
          <img src="images/logo.png" alt="Logo KIKI STICKER">
        </a>
        <span class="brand-name">KIKI STICKER</span>
      </div>
      <div class="icon-keranjang">
        <a href="keranjang.php">
          <img src="images/icon/2.png" alt="Keranjang">
          <span class="keranjang-count"><?= count($items) ?></span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Container Keranjang -->
<div class="keranjang-container">
    <h2>Keranjang Belanja Anda</h2>

    <?php if (count($items) > 0): ?>
        <table class="keranjang-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Varian</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><img src="images/<?= htmlspecialchars($row['gambar']) ?>" width="60" alt="<?= htmlspecialchars($row['nama_produk']) ?>" class="produk-img"></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($row['varian']) ?></td>
                        <td>
                            <form action="update_keranjang.php" method="POST" class="qty-form">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="number" name="jumlah" value="<?= $row['jumlah'] ?>" min="1" class="qty-input">
                                <button type="submit" class="update-btn">✓</button>
                            </form>
                        </td>
                        <td class="price">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td class="price">Rp<?= number_format($row['jumlah'] * $row['harga'], 0, ',', '.') ?></td>
                        <td><a href="hapus_keranjang.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Hapus item ini?')">×</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-section">
            <strong>Total Belanja: Rp<?= number_format($total_belanja, 0, ',', '.') ?></strong>
        </div>

        <div class="action-buttons">
            <a href="#" class="checkout-btn">Lanjut ke Pembayaran</a>
            <a href="index.php" class="back-btn">← Lanjutkan Belanja</a>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <p>Keranjang belanja Anda kosong.</p>
            <a href="index.php" class="back-btn">← Kembali ke Beranda</a>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Pop-up Pembayaran -->
<div id="popupBayar" class="popup-modal">
  <div class="popup-content">
    <span class="close">&times;</span>
    <img src="images/maaf.png" alt="Maaf" style="max-width: 120px; display: block; margin: 0 auto 15px;">
    <p>Untuk pembayaran saat ini belum tersedia.</p>
  </div>

<script>
  const bayarBtn = document.querySelector('.checkout-btn');
  const popup = document.getElementById('popupBayar');
  const closePopup = document.querySelector('.popup-modal .close');

  if (bayarBtn) {
    bayarBtn.addEventListener('click', function(e) {
      e.preventDefault(); // Batalkan link default
      popup.style.display = 'block';
    });
  }

  if (closePopup) {
    closePopup.addEventListener('click', function() {
      popup.style.display = 'none';
    });
  }

  window.addEventListener('click', function(e) {
    if (e.target === popup) {
      popup.style.display = 'none';
    }
  });
</script>

</body>
</html>
