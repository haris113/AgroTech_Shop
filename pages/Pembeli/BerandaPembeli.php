<?php 
$koneksi = new mysqli("localhost", "root", "", "agrotech_haris");

// Jika gagal konek
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

session_start(); 

// Cek apakah user sudah login
$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
$foto = isset($_SESSION['foto']) && !empty($_SESSION['foto']) 
    ? $_SESSION['foto'] 
    : "assets/default-user.png";
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
    
    <div class="right-buttons">
      <?php if (!$isLoggedIn): ?>
        <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
      <?php endif; ?>
      
      <button id="openCart" class="cart-btn" aria-label="Buka Keranjang">
        🛒 <span id="cartCount">0</span>
      </button>
      
      <?php if ($isLoggedIn): ?>
        <div class="user-info">
          <img src="<?php echo htmlspecialchars($foto); ?>" 
               alt="<?php echo htmlspecialchars($username); ?>" 
               class="user-avatar"
               onerror="this.src='assets/default-user.png'">
          <span class="username"><?php echo htmlspecialchars($username); ?></span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- NOTIFIKASI LOGIN -->
<div id="loginAlert" style="display: none;">
  ⚠️ Silakan login terlebih dahulu untuk menambahkan produk ke keranjang
</div>

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
            $stok = isset($row['stok']) ? $row['stok'] : 0;

            // Hitung harga diskon
            $harga_diskon = ($diskon > 0)
                ? $harga - ($harga * $diskon / 100)
                : $harga;
    ?>

        <div class="product-card" 
             data-category="<?= htmlspecialchars($kategori) ?>" 
             data-name="<?= htmlspecialchars(strtolower($nama)) ?>"
             data-id="<?= $id ?>"
             data-price="<?= $harga_diskon ?>"
             data-original-price="<?= $harga ?>"
             data-discount="<?= $diskon ?>"
             data-stok="<?= $stok ?>">

            <!-- Badge Diskon -->
            <?php if ($diskon > 0): ?>
                <div class="discount-badge">-<?= $diskon ?>%</div>
            <?php endif; ?>

            <!-- Gambar -->
            <img src="<?= htmlspecialchars($image) ?>" 
                 alt="<?= htmlspecialchars($nama) ?>" 
                 class="product-img" 
                 onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">

            <!-- Nama -->
            <h4 class="product-name"><?= htmlspecialchars($nama) ?></h4>

            <!-- Kategori -->
            <p class="product-category"><?= htmlspecialchars($kategori) ?></p>

            <!-- Harga -->
            <div class="prices">
                <span class="price-now">Rp<?= number_format($harga_diskon, 0, ',', '.') ?></span>
                <?php if ($diskon > 0): ?>
                    <span class="price-old">Rp<?= number_format($harga, 0, ',', '.') ?></span>
                <?php endif; ?>
            </div>

            <!-- Stok -->
            <p class="product-stock">Stok: <?= $stok ?></p>

            <!-- Tombol -->
            <button class="add-cart-btn" 
                    data-id="<?= $id ?>"
                    <?= ($stok <= 0) ? 'disabled' : '' ?>>
                <?= ($stok <= 0) ? 'Stok Habis' : '+ Keranjang' ?>
            </button>
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

<!-- CART DRAWER -->
<div id="cartDrawer" class="cart-drawer">
  <div class="cart-header">
    <h4>🛒 Keranjang Belanja</h4>
    <button id="closeCart" aria-label="Tutup Keranjang">✕</button>
  </div>
  
  <div class="cart-items" id="cartItems">
    <p style="text-align: center; color: #999; padding: 40px 20px;">
      Keranjang belanja Anda masih kosong
    </p>
  </div>
  
  <div class="cart-footer">
    <div class="totals">
      <span>Total:</span>
      <span id="cartTotal">Rp0</span>
    </div>
    <button class="btn full" id="checkoutBtn" disabled>Checkout</button>
    <button class="btn outline full" id="clearCartBtn">Kosongkan Keranjang</button>
  </div>
</div>

<!-- BACKDROP -->
<div id="backdrop" class="backdrop" style="display: none;"></div>

<footer class="footer-modern">
  <div class="container">
    <p>🌾 AgroTech Shop</p>
    <small>Pertanian Modern Indonesia &copy; <span id="year"></span></small>
  </div>
</footer>

<script>
// Set tahun otomatis
document.getElementById('year').textContent = new Date().getFullYear();

// Cek apakah user sudah login
const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

// FITUR PENCARIAN DAN FILTER
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const productCards = document.querySelectorAll('.product-card');

function filterProducts() {
  const searchTerm = searchInput.value.toLowerCase().trim();
  const selectedCategory = categoryFilter.value;
  
  let visibleCount = 0;

  productCards.forEach(card => {
    const productName = card.getAttribute('data-name');
    const productCategory = card.getAttribute('data-category');
    
    const matchesSearch = productName.includes(searchTerm);
    const matchesCategory = selectedCategory === 'all' || productCategory === selectedCategory;
    
    if (matchesSearch && matchesCategory) {
      card.style.display = 'flex';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  showNoProductsMessage(visibleCount);
}

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

searchInput.addEventListener('input', filterProducts);
categoryFilter.addEventListener('change', filterProducts);

// ========== FITUR KERANJANG BELANJA ==========
let cart = JSON.parse(localStorage.getItem('agrotech_cart')) || [];

// Update cart count
function updateCartCount() {
  const count = cart.reduce((sum, item) => sum + item.quantity, 0);
  document.getElementById('cartCount').textContent = count;
}

// Update cart display
function updateCartDisplay() {
  const cartItemsContainer = document.getElementById('cartItems');
  const cartTotal = document.getElementById('cartTotal');
  const checkoutBtn = document.getElementById('checkoutBtn');
  
  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `
      <p style="text-align: center; color: #999; padding: 40px 20px;">
        Keranjang belanja Anda masih kosong
      </p>
    `;
    cartTotal.textContent = 'Rp0';
    checkoutBtn.disabled = true;
    return;
  }
  
  let html = '';
  let total = 0;
  
  cart.forEach(item => {
    const subtotal = item.price * item.quantity;
    total += subtotal;
    
    html += `
      <div class="cart-item">
        <img src="${item.image}" alt="${item.name}">
        <div>
          <strong style="display: block; margin-bottom: 4px;">${item.name}</strong>
          <small style="color: #666;">Rp${item.price.toLocaleString('id-ID')}</small>
          <div class="qty">
            <button onclick="decreaseQty(${item.id})">-</button>
            <span>${item.quantity}</span>
            <button onclick="increaseQty(${item.id})">+</button>
          </div>
        </div>
        <div style="text-align: right;">
          <strong style="display: block; color: #2e7d32;">Rp${subtotal.toLocaleString('id-ID')}</strong>
          <button class="remove" onclick="removeFromCart(${item.id})">🗑️</button>
        </div>
      </div>
    `;
  });
  
  cartItemsContainer.innerHTML = html;
  cartTotal.textContent = `Rp${total.toLocaleString('id-ID')}`;
  checkoutBtn.disabled = false;
}

// Add to cart
function addToCart(productId) {
  if (!isLoggedIn) {
    showLoginAlert();
    return;
  }
  
  const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
  const stok = parseInt(productCard.getAttribute('data-stok'));
  
  if (stok <= 0) {
    alert('Maaf, stok produk habis');
    return;
  }
  
  const product = {
    id: productId,
    name: productCard.querySelector('.product-name').textContent,
    price: parseFloat(productCard.getAttribute('data-price')),
    image: productCard.querySelector('.product-img').src,
    stok: stok
  };
  
  const existingItem = cart.find(item => item.id === productId);
  
  if (existingItem) {
    if (existingItem.quantity >= stok) {
      alert('Jumlah melebihi stok tersedia');
      return;
    }
    existingItem.quantity++;
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  
  saveCart();
  updateCartCount();
  updateCartDisplay();
  
  // Show success message
  showSuccessMessage('Produk berhasil ditambahkan ke keranjang');
}

// Increase quantity
function increaseQty(productId) {
  const item = cart.find(item => item.id === productId);
  if (item && item.quantity < item.stok) {
    item.quantity++;
    saveCart();
    updateCartCount();
    updateCartDisplay();
  } else {
    alert('Jumlah melebihi stok tersedia');
  }
}

// Decrease quantity
function decreaseQty(productId) {
  const item = cart.find(item => item.id === productId);
  if (item) {
    item.quantity--;
    if (item.quantity <= 0) {
      removeFromCart(productId);
    } else {
      saveCart();
      updateCartCount();
      updateCartDisplay();
    }
  }
}

// Remove from cart
function removeFromCart(productId) {
  cart = cart.filter(item => item.id !== productId);
  saveCart();
  updateCartCount();
  updateCartDisplay();
}

// Clear cart
function clearCart() {
  if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
    cart = [];
    saveCart();
    updateCartCount();
    updateCartDisplay();
  }
}

// Save cart to localStorage
function saveCart() {
  localStorage.setItem('agrotech_cart', JSON.stringify(cart));
}

// Show login alert
function showLoginAlert() {
  const loginAlert = document.getElementById('loginAlert');
  loginAlert.style.display = 'block';
  setTimeout(() => {
    loginAlert.style.display = 'none';
  }, 3000);
}

// Show success message
function showSuccessMessage(message) {
  const successMsg = document.createElement('div');
  successMsg.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4caf50;
    color: white;
    padding: 12px 16px;
    border-radius: 8px;
    z-index: 9999;
    font-weight: bold;
    animation: slideIn 0.3s ease;
  `;
  successMsg.textContent = message;
  document.body.appendChild(successMsg);
  
  setTimeout(() => {
    successMsg.remove();
  }, 2000);
}

// Cart drawer controls
const cartDrawer = document.getElementById('cartDrawer');
const backdrop = document.getElementById('backdrop');
const openCartBtn = document.getElementById('openCart');
const closeCartBtn = document.getElementById('closeCart');
const clearCartBtn = document.getElementById('clearCartBtn');

openCartBtn.addEventListener('click', () => {
  cartDrawer.classList.add('active');
  backdrop.style.display = 'block';
  updateCartDisplay();
});

closeCartBtn.addEventListener('click', () => {
  cartDrawer.classList.remove('active');
  backdrop.style.display = 'none';
});

backdrop.addEventListener('click', () => {
  cartDrawer.classList.remove('active');
  backdrop.style.display = 'none';
});

clearCartBtn.addEventListener('click', clearCart);

// Add to cart button listeners
const addCartButtons = document.querySelectorAll('.add-cart-btn');
addCartButtons.forEach(button => {
  button.addEventListener('click', function(e) {
    e.stopPropagation();
    const productId = this.getAttribute('data-id');
    addToCart(productId);
  });
});

// Checkout button
document.getElementById('checkoutBtn').addEventListener('click', () => {
  if (cart.length === 0) {
    alert('Keranjang belanja Anda masih kosong');
    return;
  }
  alert('Fitur checkout akan segera hadir!');
});

// Initialize cart count on page load
updateCartCount();

// Smooth scroll
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