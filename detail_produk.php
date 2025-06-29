<?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "u747399580_kikisticker", "Bisdig2023", "u747399580_kikisticker");
if (!$koneksi) die("Koneksi gagal: " . mysqli_connect_error());

// Ambil ID produk dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data produk
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);
if (!$produk) die("Produk tidak ditemukan.");

// Ambil data varian
$varian_query = mysqli_query($koneksi, "SELECT * FROM varian WHERE produk_id = $id");

// Daftar produk khusus
$produk_khusus = [
    'HANTU LAUT' => ['folder' => 'hantu', 'images' => ['1.jpg', '2.jpg', '3.jpg'], 'color' => 'ff5722'],
    'KINGKONG'   => ['folder' => 'kingkong', 'images' => ['1.jpg', '2.jpg', '3.jpg', '4.jpg'], 'color' => '795548'],
    'JANGKAR'    => ['folder' => 'jangkar', 'images' => ['2.jpg', '3.jpg'], 'color' => '3f51b5'],
    'KANTAI'     => ['folder' => 'kantai', 'images' => ['2.jpg', '3.jpg'], 'color' => 'e91e63']
];

// Cek kategori khusus
$kategori_khusus = null;
$nama_produk_upper = strtoupper($produk['nama_produk']);
foreach ($produk_khusus as $key => $value) {
    if (strpos($nama_produk_upper, $key) !== false) {
        $kategori_khusus = $value;
        break;
    }
}

// Ambil gambar tambahan
$gambar_tambahan = [];
if ($kategori_khusus) {
    foreach ($kategori_khusus['images'] as $image) {
        $path = 'images/' . $kategori_khusus['folder'] . '/' . $image;
        if (file_exists($path)) {
            $gambar_tambahan[] = ['nama_gambar' => $kategori_khusus['folder'] . '/' . $image];
        }
    }
} else {
    $gambar_query = mysqli_query($koneksi, "SELECT * FROM produk_gambar WHERE produk_id = $id ORDER BY id");
    while ($g = mysqli_fetch_assoc($gambar_query)) {
        $path = 'images/' . $g['nama_gambar'];
        if (file_exists($path)) {
            $gambar_tambahan[] = $g;
        }
    }
}

// Tambahkan gambar utama di awal
array_unshift($gambar_tambahan, ['nama_gambar' => $produk['gambar']]);
$gambar_tambahan = array_unique($gambar_tambahan, SORT_REGULAR);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produk['nama_produk']) ?> - KIKI STICKER</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bagian_produk.css">
</head>
<body>

<!-- Header -->
<div class="header-toko">
    <h1>KIKI STICKER</h1>
</div>

<!-- Konten -->
<div class="container">

    <!-- Kolom Kiri -->
    <div class="kolom-kiri">
        <img src="images/<?= htmlspecialchars($produk['gambar']) ?>" class="product-image" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">

        <div class="thumbnail-gallery">
            <?php foreach ($gambar_tambahan as $index => $gambar): ?>
                <div class="thumbnail-item">
                    <img src="images/<?= htmlspecialchars($gambar['nama_gambar']) ?>" 
                         alt="Gambar <?= $index + 1 ?> - <?= htmlspecialchars($produk['nama_produk']) ?>" 
                         onclick="changeMainImage(this)">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Kolom Tengah -->
    <div class="kolom-tengah">
        <div class="title"><?= htmlspecialchars($produk['nama_produk']) ?></div>
        <div class="price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>

        <form method="POST" action="tambah_keranjang.php" class="form-keranjang">
            <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
            <input type="hidden" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']) ?>">
            <input type="hidden" name="harga" value="<?= $produk['harga'] ?>">
            <input type="hidden" name="gambar" value="<?= htmlspecialchars($produk['gambar']) ?>">

            <label for="varian">Pilih Varian:</label>
            <select name="varian" id="varian" required>
                <?php 
                mysqli_data_seek($varian_query, 0);
                while ($v = mysqli_fetch_assoc($varian_query)) : ?>
                    <option value="<?= htmlspecialchars($v['warna']) ?>"><?= htmlspecialchars($v['warna']) ?></option>
                <?php endwhile; ?>
            </select>

            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" value="1" min="1" required>

            <button type="submit" class="btn-tambah">Tambah ke Keranjang</button>
        </form>

        <div class="deskripsi-produk">
            <h3>Deskripsi Produk</h3>
            <div class="deskripsi-isi">
                <?= nl2br(htmlspecialchars($produk['deskripsi'])) ?>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="kolom-kanan">
        <div class="popup-box" id="popupBox">
            <img src="images/logo.png" alt="Logo KIKI STICKER" class="popup-logo">
            <button class="btn-kunjungi" onclick="toggleMarketplace()">KUNJUNGI TOKO</button>
            <div class="marketplace-icons" id="marketplaceLinks" style="display: none;">
                <a href="https://www.tiktok.com/@kiki_sticker" target="_blank">
                    <img src="images/logo-e/tiktokshop_logo.png" alt="TikTok">
                </a>
                <a href="https://shopee.co.id/kiki_sticker" target="_blank">
                    <img src="images/logo-e/shopee_logo.png" alt="Shopee">
                </a>
                <a href="https://www.tokopedia.com/kikisticker" target="_blank">
                    <img src="images/logo-e/tokopedia_logo.png" alt="Tokopedia">
                </a>
                <a href="https://www.lazada.co.id/shop/kiki-sticker/?itemId=7609624261&spm=a2o4j.pdp_revamp.seller.1.50c7141eKsLJ82&path=promotion-436161-0.htm&tab=promotion&channelSource=pdp" target="_blank">
                    <img src="images/logo-e/lazada_logo.png" alt="Lazada">
                </a>
            </div>
        </div>
    </div>

</div>

<!-- Script -->
<script>
function changeMainImage(thumbnail) {
    document.querySelector('.product-image').src = thumbnail.src;
}
function toggleMarketplace() {
    const links = document.getElementById('marketplaceLinks');
    links.style.display = links.style.display === 'none' ? 'flex' : 'none';
}
</script>

</body>
</html>
