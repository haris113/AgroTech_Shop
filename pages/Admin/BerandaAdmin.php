<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Manajemen Diskon Produk</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, sans-serif;
      background: #f4f8f0;
      color: #1a3a1a;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* HEADER */
    .admin-header {
      background: linear-gradient(135deg, #2d6a2d 0%, #3d8a3d 100%);
      color: #fff;
      padding: 24px;
      border-radius: 12px;
      margin-bottom: 24px;
      box-shadow: 0 4px 12px rgba(45, 106, 45, 0.2);
    }

    .admin-header h1 {
      margin: 0;
      font-size: 1.8rem;
    }

    .admin-header p {
      opacity: 0.9;
      margin-top: 8px;
    }

    /* TABS */
    .tabs {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
      border-bottom: 2px solid #d4edda;
      flex-wrap: wrap;
    }

    .tab-btn {
      padding: 12px 20px;
      background: none;
      border: none;
      color: #5a7a5a;
      cursor: pointer;
      font-weight: 600;
      border-bottom: 3px solid transparent;
      transition: 0.2s;
      font-size: 1rem;
    }

    .tab-btn.active {
      color: #2d6a2d;
      border-bottom-color: #7cb342;
    }

    .tab-btn:hover {
      color: #2d6a2d;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* TABLE */
    .table-wrapper {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(45, 106, 45, 0.1);
      overflow: hidden;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table thead {
      background: linear-gradient(135deg, #f0f7e8, #f8fbf3);
      border-bottom: 2px solid #7cb342;
    }

    .table th {
      padding: 16px;
      text-align: left;
      color: #2d6a2d;
      font-weight: 700;
    }

    .table td {
      padding: 14px 16px;
      border-bottom: 1px solid #e8f5e9;
    }

    .table tbody tr:hover {
      background: #f9fdf7;
    }

    /* FORM */
    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: #2d6a2d;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 10px 12px;
      border: 2px solid #d4edda;
      border-radius: 8px;
      font-size: 1rem;
      color: #2d6a2d;
      transition: 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #7cb342;
      box-shadow: 0 0 8px rgba(123, 179, 66, 0.2);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    /* BUTTONS */
    .btn {
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.2s;
      font-size: 0.95rem;
    }

    .btn-primary {
      background: linear-gradient(135deg, #2d6a2d, #3d8a3d);
      color: #fff;
      box-shadow: 0 2px 8px rgba(45, 106, 45, 0.2);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(45, 106, 45, 0.3);
    }

    .btn-warning {
      background: #ff9800;
      color: #fff;
    }

    .btn-warning:hover {
      background: #f57c00;
    }

    .btn-danger {
      background: #f44336;
      color: #fff;
    }

    .btn-danger:hover {
      background: #d32f2f;
    }

    .btn-small {
      padding: 6px 12px;
      font-size: 0.85rem;
    }

    /* DISCOUNT INFO */
    .discount-info {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 16px;
      margin-bottom: 24px;
    }

    .discount-card {
      background: linear-gradient(135deg, #f0f7e8, #f8fbf3);
      padding: 16px;
      border-radius: 12px;
      border: 2px solid #7cb342;
    }

    .discount-card h3 {
      color: #2d6a2d;
      margin-bottom: 8px;
      font-size: 1rem;
    }

    .discount-card p {
      color: #5a7a5a;
      font-size: 0.9rem;
      margin-bottom: 4px;
    }

    .discount-badge {
      display: inline-block;
      background: #7cb342;
      color: #fff;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 700;
    }

    /* INPUT INLINE */
    .inline-edit {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .inline-edit input {
      flex: 1;
      min-width: 80px;
    }

    .discount-input {
      width: 80px;
    }

    /* PRICE DISPLAY */
    .price-display {
      background: #f9fdf7;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #e8f5e9;
    }

    .price-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
      font-size: 0.9rem;
    }

    .price-row:last-child {
      margin-bottom: 0;
    }

    .price-label {
      color: #5a7a5a;
    }

    .price-value {
      color: #2d6a2d;
      font-weight: 600;
    }

    .savings {
      color: #7cb342;
      font-weight: 700;
    }

    .original {
      text-decoration: line-through;
      color: #999;
    }

    /* ALERT */
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 16px;
      font-size: 0.95rem;
    }

    .alert-success {
      background: #e8f5e9;
      border-left: 4px solid #7cb342;
      color: #1b5e20;
    }

    .alert-error {
      background: #ffebee;
      border-left: 4px solid #f44336;
      color: #b71c1c;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .table {
        font-size: 0.9rem;
      }

      .table th, .table td {
        padding: 8px 12px;
      }

      .form-row {
        grid-template-columns: 1fr;
      }

      .tabs {
        gap: 8px;
      }

      .tab-btn {
        padding: 10px 14px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <!-- HEADER -->
  <div class="admin-header">
    <h1>Admin Panel - Manajemen Diskon Produk</h1>
    <p>Kelola diskon untuk produk Anda dengan mudah</p>
  </div>

  <!-- TABS -->
  <div class="tabs">
    <button class="tab-btn active" onclick="switchTab('products')">Diskon Produk</button>
    <button class="tab-btn" onclick="switchTab('categories')">Diskon Kategori</button>
    <button class="tab-btn" onclick="switchTab('coupons')">Kode Kupon</button>
  </div>

  <!-- TAB: PRODUK -->
  <div id="products" class="tab-content active">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga Normal</th>
            <th>Diskon (%)</th>
            <th>Harga Setelah Diskon</th>
            <th>Penghematan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="productsTable"></tbody>
      </table>
    </div>
  </div>

  <!-- TAB: KATEGORI -->
  <div id="categories" class="tab-content">
    <h3 style="margin-bottom: 20px; color: #2d6a2d;">Diskon Kategori</h3>
    
    <div class="discount-info" id="categoryDiscounts"></div>

    <div style="background: #fff; padding: 24px; border-radius: 12px; margin-top: 20px;">
      <h4 style="margin-bottom: 16px; color: #2d6a2d;">Tambah Diskon Kategori</h4>
      <div class="form-row">
        <div class="form-group">
          <label>Kategori</label>
          <select id="categorySelect">
            <option value="">Pilih Kategori</option>
            <option value="Obat & Pupuk">Obat & Pupuk</option>
            <option value="Aksesoris">Aksesoris</option>
            <option value="Alat Modern">Alat Modern</option>
          </select>
        </div>
        <div class="form-group">
          <label>Diskon (%)</label>
          <input type="number" id="categoryDiscount" min="0" max="100" placeholder="Masukkan diskon">
        </div>
      </div>
      <button class="btn btn-primary" onclick="addCategoryDiscount()" style="width: 100%; margin-top: 12px;">Tambah</button>
    </div>
  </div>

  <!-- TAB: KUPON -->
  <div id="coupons" class="tab-content">
    <h3 style="margin-bottom: 20px; color: #2d6a2d;">Kode Kupon</h3>

    <div style="background: #fff; padding: 24px; border-radius: 12px; margin-bottom: 20px;">
      <h4 style="margin-bottom: 16px; color: #2d6a2d;">Tambah Kode Kupon</h4>
      
      <div class="form-group">
        <label>Kode Kupon</label>
        <input type="text" id="couponCode" placeholder="Contoh: AGRO2024" style="text-transform: uppercase;">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Jenis Diskon</label>
          <select id="couponType" onchange="toggleCouponType()">
            <option value="percent">Persen (%)</option>
            <option value="fixed">Nominal (Rp)</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nilai Diskon</label>
          <input type="number" id="couponValue" min="0" placeholder="Masukkan nilai">
        </div>
      </div>

      <div class="form-group">
        <label>Minimum Pembelian (Rp)</label>
        <input type="number" id="couponMinSpend" min="0" placeholder="0 untuk tanpa minimum">
      </div>

      <button class="btn btn-primary" onclick="addCoupon()" style="width: 100%; margin-top: 12px;">Tambah Kupon</button>
    </div>

    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Diskon</th>
            <th>Minimum Pembelian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="couponsTable"></tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Data produk (dari app.js)
  const products = [
    { id: 1, name: "Pupuk Urea 50kg", price: 350000, discount: 0 },
    { id: 2, name: "Pupuk NPK Mutiara 1kg", price: 25000, discount: 0 },
    { id: 3, name: "Pupuk Organik 10kg", price: 85000, discount: 0 },
    { id: 4, name: "Pupuk Daun Cair 1L", price: 35000, discount: 0 },
    { id: 5, name: "Pupuk Kambing Kering 5kg", price: 45000, discount: 0 },
    { id: 7, name: "Pestisida Cair 1L", price: 58000, discount: 0 },
  ];

  let categoryDiscounts = JSON.parse(localStorage.getItem('categoryDiscounts') || '[]');
  let couponCodes = JSON.parse(localStorage.getItem('couponCodes') || '[]');
  let productDiscounts = JSON.parse(localStorage.getItem('productDiscounts') || '{}');

  // Switch Tab
  function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');

    if (tabName === 'products') loadProducts();
    if (tabName === 'categories') loadCategories();
    if (tabName === 'coupons') loadCoupons();
  }

  // Load Products
  function loadProducts() {
    const table = document.getElementById('productsTable');
    table.innerHTML = products.map(p => {
      const discount = productDiscounts[p.id] || 0;
      const discounted = p.price - (p.price * discount / 100);
      const savings = p.price * discount / 100;

      return `
        <tr>
          <td>${p.id}</td>
          <td>${p.name}</td>
          <td>Rp${p.price.toLocaleString('id-ID')}</td>
          <td>
            <div class="inline-edit">
              <input type="number" class="discount-input" value="${discount}" min="0" max="100"
                     onchange="updateProductDiscount(${p.id}, this.value)">
              <span>%</span>
            </div>
          </td>
          <td>
            <div class="price-display">
              <div class="price-row">
                <span class="price-label">Normal:</span>
                <span class="price-value original">Rp${p.price.toLocaleString('id-ID')}</span>
              </div>
              <div class="price-row">
                <span class="price-label">Diskon:</span>
                <span class="savings">Rp${savings.toLocaleString('id-ID')}</span>
              </div>
              <div class="price-row">
                <span class="price-label" style="font-weight: 700;">Akhir:</span>
                <span class="price-value" style="font-size: 1.05rem; color: #7cb342;">Rp${discounted.toLocaleString('id-ID')}</span>
              </div>
            </div>
          </td>
          <td>Rp${savings.toLocaleString('id-ID')}</td>
          <td>
            <button class="btn btn-warning btn-small" onclick="resetProductDiscount(${p.id})">Reset</button>
          </td>
        </tr>
      `;
    }).join('');
  }

  // Update Product Discount
  function updateProductDiscount(productId, discount) {
    discount = Math.min(100, Math.max(0, parseInt(discount) || 0));
    productDiscounts[productId] = discount;
    localStorage.setItem('productDiscounts', JSON.stringify(productDiscounts));
    loadProducts();
    showAlert('Diskon produk diperbarui!', 'success');
  }

  // Reset Product Discount
  function resetProductDiscount(productId) {
    productDiscounts[productId] = 0;
    localStorage.setItem('productDiscounts', JSON.stringify(productDiscounts));
    loadProducts();
    showAlert('Diskon produk direset!', 'success');
  }

  // Load Categories
  function loadCategories() {
    const container = document.getElementById('categoryDiscounts');
    if (categoryDiscounts.length === 0) {
      container.innerHTML = '<p style="text-align: center; color: #999;">Belum ada diskon kategori</p>';
      return;
    }

    container.innerHTML = categoryDiscounts.map((cat, idx) => `
      <div class="discount-card">
        <h3>${cat.category}</h3>
        <p>Diskon: <span class="discount-badge">${cat.discount}%</span></p>
        <button class="btn btn-danger btn-small" onclick="removeCategoryDiscount(${idx})" style="margin-top: 12px;">Hapus</button>
      </div>
    `).join('');
  }

  // Add Category Discount
  function addCategoryDiscount() {
    const category = document.getElementById('categorySelect').value;
    const discount = parseInt(document.getElementById('categoryDiscount').value) || 0;

    if (!category) {
      showAlert('Pilih kategori terlebih dahulu', 'error');
      return;
    }

    if (discount < 0 || discount > 100) {
      showAlert('Diskon harus antara 0-100%', 'error');
      return;
    }

    categoryDiscounts.push({ category, discount });
    localStorage.setItem('categoryDiscounts', JSON.stringify(categoryDiscounts));
    
    document.getElementById('categorySelect').value = '';
    document.getElementById('categoryDiscount').value = '';
    
    loadCategories();
    showAlert('Diskon kategori ditambahkan!', 'success');
  }

  // Remove Category Discount
  function removeCategoryDiscount(idx) {
    categoryDiscounts.splice(idx, 1);
    localStorage.setItem('categoryDiscounts', JSON.stringify(categoryDiscounts));
    loadCategories();
    showAlert('Diskon kategori dihapus!', 'success');
  }

  // Load Coupons
  function loadCoupons() {
    const table = document.getElementById('couponsTable');
    if (couponCodes.length === 0) {
      table.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #999;">Belum ada kode kupon</td></tr>';
      return;
    }

    table.innerHTML = couponCodes.map((c, idx) => `
      <tr>
        <td><strong>${c.code}</strong></td>
        <td>${c.type === 'percent' ? c.value + '%' : 'Rp' + c.value.toLocaleString('id-ID')}</td>
        <td>Rp${(c.minSpend || 0).toLocaleString('id-ID')}</td>
        <td>
          <button class="btn btn-danger btn-small" onclick="removeCoupon(${idx})">Hapus</button>
        </td>
      </tr>
    `).join('');
  }

  // Add Coupon
  function addCoupon() {
    const code = document.getElementById('couponCode').value.trim().toUpperCase();
    const type = document.getElementById('couponType').value;
    const value = parseInt(document.getElementById('couponValue').value) || 0;
    const minSpend = parseInt(document.getElementById('couponMinSpend').value) || 0;

    if (!code) {
      showAlert('Masukkan kode kupon', 'error');
      return;
    }

    if (value <= 0) {
      showAlert('Nilai diskon harus lebih dari 0', 'error');
      return;
    }

    if (type === 'percent' && value > 100) {
      showAlert('Diskon persen maksimal 100%', 'error');
      return;
    }

    couponCodes.push({ code, type, value, minSpend });
    localStorage.setItem('couponCodes', JSON.stringify(couponCodes));
    
    document.getElementById('couponCode').value = '';
    document.getElementById('couponValue').value = '';
    document.getElementById('couponMinSpend').value = '';
    
    loadCoupons();
    showAlert('Kode kupon ditambahkan!', 'success');
  }

  // Remove Coupon
  function removeCoupon(idx) {
    couponCodes.splice(idx, 1);
    localStorage.setItem('couponCodes', JSON.stringify(couponCodes));
    loadCoupons();
    showAlert('Kode kupon dihapus!', 'success');
  }

  // Toggle Coupon Type
  function toggleCouponType() {
    const type = document.getElementById('couponType').value;
    const input = document.getElementById('couponValue');
    input.placeholder = type === 'percent' ? 'Masukkan diskon (0-100)' : 'Masukkan nominal';
  }

  // Show Alert
  function showAlert(message, type) {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;
    
    const container = document.querySelector('.container');
    container.insertBefore(alert, container.firstChild);
    
    setTimeout(() => alert.remove(), 3000);
  }

  // Initial Load
  loadProducts();
</script>

</body>
</html>