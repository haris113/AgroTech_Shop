
<?php 
$koneksi = new mysqli("localhost", "root", "", "agrotech_haris");

// Jika gagal konek
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
session_start(); 
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "$username";
$foto = isset($_SESSION['foto']) ? $_SESSION['foto'] : "/AgroTech_Shop/assets/default-user.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroTech Shop - Pertanian Modern Indonesia</title>
  <link rel="stylesheet" href="../Pembeli/css/StyleBerandaPembeli.css">
</head>
<body>

<!-- HEADER -->
<header class="site-header">
  <div class="container">
    <h1 class="brand">🌾 AgroTech Shop</h1>
    <nav class="nav">
      <a href="#produk">Produk</a>
      <a href="#kontak">Kontak</a>
    </nav>
    <button id="openCart" class="cart-btn" aria-label="Buka Keranjang">
      🛒 <span id="cartCount">0</span>
    </button>
    <div class="user-info">
  <img src="<?php echo $foto; ?>" class="user-avatar">
  <span class="username"><?php echo $username; ?></span>
</div>

  </div>
</header>

<!-- HERO SECTION -->
<section class="hero">
  <div class="container">
    <h2>Pertanian Modern, Solusi Masa Kini</h2>
    <p>Temukan berbagai obat, aksesoris, dan alat pertanian terbaik di AgroTech Shop</p>
    <a href="#produk" class="btn btn-hero">Lihat Produk</a>
  </div>
</section>
<section id="produk">
    <h3>Katalog Produk</h3>

    <div class="search-filter-bar">
        <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cari produk...">
        <select id="categoryFilter">
            <option value="all">Semua Kategori</option>
            <option value="Obat & Pupuk">Obat & Pupuk</option>
            <option value="Aksesoris">Aksesoris</option>
            <option value="Alat Modern">Alat Modern</option>
        </select>
        <select id="subcategoryFilter">
            <option value="all">Semua Subkategori</option>
        </select>
    </div>

    <div class="product-container">
        <?php
        $query = "SELECT * FROM produk ORDER BY created_at DESC";
        $result = $koneksi->query($query);

        while ($row = $result->fetch_assoc()) {
        ?>

        <div class="product-card">

            <div class="product-img">
                <img src="<?= $row['image_url'] ?>" alt="<?= $row['nama'] ?>">
            </div>

            <div class="product-info">
                <p class="product-name"><?= $row['nama'] ?></p>

                <div class="price-box">
                    <?php if ($row['diskon'] > 0) { ?>
                        <span class="price-discount">
                            Rp<?= number_format($row['harga'] - ($row['harga'] * $row['diskon'] / 100), 0, ',', '.') ?>
                        </span>
                        <span class="price-original">
                            Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                        </span>
                        <span class="badge-diskon"><?= $row['diskon'] ?>% OFF</span>
                    <?php } else { ?>
                        <span class="price-discount">
                            Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                        </span>
                    <?php } ?>
                </div>

                <p class="sold">Stok: <?= $row['stok'] ?></p>
            </div>

        </div>

        <?php } ?>
    </div>
</section>


   <!-- KONTAK SECTION -->
<section id="kontak" class="contact-modern">
  <h3>📞 Hubungi Kami</h3>

  <div class="contact-grid">

    <div class="contact-card">
      <span class="icon">📸</span>
      <h4>Instagram</h4>
      <a href="https://instagram.com/agrotech_mart" target="_blank">@agrotech_mart</a>
    </div>

    <div class="contact-card">
      <span class="icon">📧</span>
      <h4>Email</h4>
      <a href="mailto:agrotech@gmail.com">agrotech@gmail.com</a>
    </div>

    <div class="contact-card">
      <span class="icon">📞</span>
      <h4>Telepon</h4>
      <a href="tel:+628123456789">+62 812-3456-789</a>
    </div>

  </div>
</section>


<footer class="footer-modern">
  <div class="container">
    <p>🌾 AgroTech Shop</p>
    <small>Pertanian Modern Indonesia &copy; <span id="year"></span></small>
  </div>
</footer>

<!-- CART DRAWER -->
<aside id="cartDrawer" class="cart-drawer">
  <div class="cart-header">
    <h4>🛒 Keranjang Belanja</h4>
    <button id="closeCart" aria-label="Tutup Keranjang">✕</button>
  </div>
  <div id="cartItems" class="cart-items"></div>
  <div class="cart-footer">
    <div class="totals">
      <span>Total:</span>
      <strong id="cartTotal">Rp0</strong>
    </div>
    <button id="checkoutBtn" class="btn full">Checkout</button>
    <button id="clearBtn" class="btn outline full">Kosongkan</button>
  </div>
</aside>


</body>
</html>