<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>KIKI STICKER</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!-- Navigasi -->
    <nav>
        <div class="nav-wrapper">
            <!-- Logo & Brand -->
            <div class="logo">
                <img src="images/logo.png" alt="Logo KIKI STICKER">
                <span class="brand-name">KIKI STICKER</span>
            </div>

            <!-- Icon Keranjang -->
            <div class="icon-keranjang">
                <a href="keranjang.php">
                    <img src="images/icon/2.png" alt="keranjang">
                    <span class="keranjang-count">
                        <?php
                        if(isset($_SESSION['keranjang']) && is_array($_SESSION['keranjang'])) {
                            echo count($_SESSION['keranjang']); 
                        } else {
                            echo 0;
                        }
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <div class="header-opacity"></div>
        <div class="header-content">
            <h4>CONTOH PRODUK</h4>
            <h1>KIKI STICKER</h1>
        </div>
    </header>

    <!-- Judul Produk -->
    <section class="product-title-section">
        <div class="wrapper">
            <h2>Kamu Mungkin Suka</h2>
        </div>
    </section>

    <!-- Daftar Produk -->
    <section class="product-grid">
        <div class="grid-container">
            <?php
            $query = "SELECT * FROM produk ORDER BY id DESC";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <a href="detail_produk.php?id=<?= $row['id'] ?>" class="product-item">
                    <div class="product-image-container">
                        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" 
                             alt="<?= htmlspecialchars($row['nama_produk']) ?>" 
                             class="product-image">
                    </div>
                    <div class="product-details">
                        <h3><?= htmlspecialchars($row['kategori']) ?></h3>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </section>
</body>
</html>