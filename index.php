<?php 
$koneksi = new mysqli("localhost", "root", "", "agrotech_haris");

// Jika gagal konek
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroTech Shop - Pertanian Modern Indonesia</title>
  <link rel="stylesheet" href="/agrotech_shop/css/style.css">
</head>
<body>

<div id="loginAlert">⚠ Anda harus login terlebih dahulu</div>

<!-- HEADER -->
<header class="site-header">
  <div class="container">
    <h1 class="brand">🌾 AgroTech Shop</h1>

    <nav class="nav">
      <a href="#produk">Produk</a>
      <a href="#kontak">Kontak</a>
    </nav>

    <div class="right-buttons">
      <button class="login-btn" onclick="location.href='/AgroTech_Shop/pages/Login/LoginUser.php'">
        Login
      </button>

      <button id="openCart" class="cart-btn" aria-label="Buka Keranjang">
        🛒 <span id="cartCount">0</span>
      </button>
    </div>
  </div>
</header>

<!-- HERO SECTION -->
<section class="hero">
  <div class="container">
    <h2>Pertanian Modern, Solusi Masa Kini</h2>
    <p>Temukan berbagai obat, aksesoris, dan alat pertanian terbaik di AgroTech Shop</p>
    <a href="#produk" class="btn-hero">Lihat Produk</a>
  </div>
</section>

<!-- MAIN -->
<main class="container">
  <section id="produk">
    <h3>Katalog Produk</h3>

    <div class="search-filter-bar">
      <input type="text" id="searchInput" placeholder="🔍 Cari produk...">
      <select id="categoryFilter">
        <option value="all">Semua Kategori</option>
        <option value="Obat & Pupuk">Obat & Pupuk</option>
        <option value="Aksesoris">Aksesoris</option>
        <option value="Alat Modern">Alat Modern</option>
      </select>
    </div>

    <!-- GRID PRODUK -->
    <div id="productGrid" class="grid">
    <?php
    $query = "SELECT * FROM produk ORDER BY created_at DESC";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
            $id     = $row['id'];
            $nama   = $row['nama'];
            $harga  = $row['harga'];
            $diskon = $row['diskon'];
            $image  = $row['image_url'];
            $kategori = isset($row['kategori']) ? $row['kategori'] : '';

            // Hitung harga diskon
            $harga_diskon = ($diskon > 0)
                ? $harga - ($harga * $diskon / 100)
                : $harga;
    ?>

        <div class="product-card" data-category="<?= htmlspecialchars($kategori) ?>" data-name="<?= htmlspecialchars(strtolower($nama)) ?>">

            <!-- Badge Diskon -->
            <?php if ($diskon > 0): ?>
                <div class="discount-badge">-<?= $diskon ?>%</div>
            <?php endif; ?>

            <!-- Gambar -->
            <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($nama) ?>" class="product-img" onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">

            <!-- Nama -->
            <h4 class="product-name"><?= htmlspecialchars($nama) ?></h4>

            <!-- Harga -->
            <div class="prices">
                <span class="price-now">Rp<?= number_format($harga_diskon, 0, ',', '.') ?></span>

                <?php if ($diskon > 0): ?>
                    <span class="price-old">Rp<?= number_format($harga, 0, ',', '.') ?></span>
                <?php endif; ?>
            </div>

            <button class="add-cart-btn" data-id="<?= $id ?>">+ Keranjang</button>
        </div>

    <?php 
        endwhile;
    else:
    ?>
        <p style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
            Tidak ada produk tersedia
        </p>
    <?php endif; ?>
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
</main>

<footer class="footer-modern">
  <div class="container">
    <p>🌾 AgroTech Shop</p>
    <small>Pertanian Modern Indonesia &copy; <span id="year"></span></small>
  </div>
</footer>

<script>
// Set tahun otomatis
document.getElementById('year').textContent = new Date().getFullYear();

// FITUR PENCARIAN DAN FILTER
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const productCards = document.querySelectorAll('.product-card');

// Fungsi untuk filter produk
function filterProducts() {
  const searchTerm = searchInput.value.toLowerCase().trim();
  const selectedCategory = categoryFilter.value;
  
  let visibleCount = 0;

  productCards.forEach(card => {
    const productName = card.getAttribute('data-name');
    const productCategory = card.getAttribute('data-category');
    
    // Check search term
    const matchesSearch = productName.includes(searchTerm);
    
    // Check category
    const matchesCategory = selectedCategory === 'all' || productCategory === selectedCategory;
    
    // Show or hide card
    if (matchesSearch && matchesCategory) {
      card.style.display = 'flex';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Tampilkan pesan jika tidak ada produk
  showNoProductsMessage(visibleCount);
}

// Fungsi untuk menampilkan pesan "tidak ada produk"
function showNoProductsMessage(count) {
  const grid = document.getElementById('productGrid');
  let noProductMsg = document.getElementById('noProductMessage');
  
  if (count === 0) {
    if (!noProductMsg) {
      noProductMsg = document.createElement('p');
      noProductMsg.id = 'noProductMessage';
      noProductMsg.style.cssText = 'grid-column: 1/-1; text-align: center; padding: 40px; color: #999; font-size: 16px;';
      noProductMsg.textContent = '🔍 Tidak ada produk yang sesuai dengan pencarian Anda';
      grid.appendChild(noProductMsg);
    }
  } else {
    if (noProductMsg) {
      noProductMsg.remove();
    }
  }
}

// Event listeners
searchInput.addEventListener('input', filterProducts);
categoryFilter.addEventListener('change', filterProducts);

// FITUR KERANJANG (Placeholder - perlu login)
const addCartButtons = document.querySelectorAll('.add-cart-btn');
const loginAlert = document.getElementById('loginAlert');

addCartButtons.forEach(button => {
  button.addEventListener('click', function(e) {
    e.stopPropagation();
    
    // Tampilkan alert login
    loginAlert.style.display = 'block';
    
    // Sembunyikan setelah 3 detik
    setTimeout(() => {
      loginAlert.style.display = 'none';
    }, 3000);
  });
});

// Smooth scroll untuk navigasi
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});
</script>

</body>
</html>