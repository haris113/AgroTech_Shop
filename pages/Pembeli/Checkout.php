<!-- BACKDROP -->
<div id="backdrop" class="backdrop" hidden></div>

<!-- MODAL CHECKOUT -->
<div id="checkoutModal" class="modal" hidden>
  <div class="modal-content">
    <div class="modal-header">
      <h3>📋 Formulir Pemesanan</h3>
      <button id="closeModal" class="close-modal">✕</button>
    </div>
    <div class="modal-body">
      <form id="checkoutForm">
        <!-- Tab Navigation -->
        <div class="form-tabs">
          <button type="button" class="tab-btn active" data-tab="0">📋 Data Diri</button>
          <button type="button" class="tab-btn" data-tab="1">🚚 Pengiriman</button>
          <button type="button" class="tab-btn" data-tab="2">💳 Pembayaran</button>
        </div>

        <!-- Tab 1: Data Diri & Alamat -->
        <div class="form-tab active">
          <h4>📋 Data Diri Pembeli</h4>
          <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" id="fullName" name="fullName" required placeholder="Masukkan nama lengkap">
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Email *</label>
              <input type="email" id="email" name="email" required placeholder="contoh@email.com">
            </div>
            <div class="form-group">
              <label>No. Telepon *</label>
              <input type="tel" id="phone" name="phone" required placeholder="08xxxxxxxxxx">
            </div>
          </div>
          <div class="form-group">
            <label>Catatan Tambahan</label>
            <textarea id="notes" name="notes" placeholder="Catatan khusus untuk pesanan Anda"></textarea>
          </div>

          <h4 style="margin-top: 24px;">📍 Alamat Pengiriman</h4>
          <div class="form-group">
            <label>Provinsi *</label>
            <input type="text" id="province" name="province" required placeholder="Contoh: Jawa Barat">
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Kota/Kabupaten *</label>
              <input type="text" id="city" name="city" required placeholder="Contoh: Bandung">
            </div>
            <div class="form-group">
              <label>Kecamatan *</label>
              <input type="text" id="district" name="district" required placeholder="Contoh: Bandung Tengah">
            </div>
          </div>
          <div class="form-group">
            <label>Kode Pos *</label>
            <input type="text" id="zipCode" name="zipCode" required placeholder="Contoh: 40263">
          </div>
          <div class="form-group">
            <label>Alamat Lengkap *</label>
            <textarea id="address" name="address" required placeholder="Jln. XX No. 123, RT/RW 01/02"></textarea>
          </div>
        </div>

        <!-- Tab 2: Pengiriman -->
        <div class="form-tab">
          <h4>🚚 Pilih Metode Pengiriman</h4>
          <div class="shipping-options">
            <label class="shipping-option">
              <input type="radio" name="shipping" value="reguler" data-cost="25000" checked>
              <div class="shipping-info">
                <span class="shipping-name">📦 Reguler (3-5 hari)</span>
                <span class="shipping-cost">Rp25.000</span>
              </div>
            </label>
            <label class="shipping-option">
              <input type="radio" name="shipping" value="express" data-cost="50000">
              <div class="shipping-info">
                <span class="shipping-name">⚡ Express (1-2 hari)</span>
                <span class="shipping-cost">Rp50.000</span>
              </div>
            </label>
            <label class="shipping-option">
              <input type="radio" name="shipping" value="same-day" data-cost="100000">
              <div class="shipping-info">
                <span class="shipping-name">🚀 Same Day (Hari yang Sama)</span>
                <span class="shipping-cost">Rp100.000</span>
              </div>
            </label>
          </div>
          <div class="shipping-summary">
            <p>Biaya Pengiriman: <strong id="shippingCost">Rp25.000</strong></p>
          </div>
        </div>

        <!-- Tab 3: Pembayaran -->
        <div class="form-tab">
          <h4>💳 Pilih Metode Pembayaran</h4>
          <div class="payment-options">
            <label class="payment-option">
              <input type="radio" name="payment" value="bank-transfer" checked>
              <div class="payment-info">
                <span class="payment-name">🏦 Transfer Bank</span>
                <span class="payment-desc">Transfer langsung ke rekening bank kami</span>
              </div>
            </label>
            <label class="payment-option">
              <input type="radio" name="payment" value="e-wallet">
              <div class="payment-info">
                <span class="payment-name">📱 E-Wallet (GoPay, OVO, Dana)</span>
                <span class="payment-desc">Pembayaran via aplikasi e-wallet</span>
              </div>
            </label>
            <label class="payment-option">
              <input type="radio" name="payment" value="cod">
              <div class="payment-info">
                <span class="payment-name">💵 COD (Bayar di Tempat)</span>
                <span class="payment-desc">Bayar saat barang diterima</span>
              </div>
            </label>
            <label class="payment-option">
              <input type="radio" name="payment" value="installment">
              <div class="payment-info">
                <span class="payment-name">💰 Cicilan (0%)</span>
                <span class="payment-desc">Cicilan tanpa bunga 3 bulan</span>
              </div>
            </label>
          </div>

          <!-- Order Summary -->
          <div class="order-summary">
            <h5>Ringkasan Pesanan</h5>
            <div class="summary-row">
              <span>Subtotal:</span>
              <strong id="summarySubtotal">Rp0</strong>
            </div>
            <div class="summary-row">
              <span>Biaya Pengiriman:</span>
              <strong id="summaryShipping">Rp25.000</strong>
            </div>
            <div class="summary-row total">
              <span>Total Bayar:</span>
              <strong id="summaryTotal">Rp0</strong>
            </div>
          </div>
        </div>

        <!-- Form Navigation -->
        <div class="form-navigation">
          <button type="button" id="prevBtn" class="btn outline" style="display: none;">← Kembali</button>
          <button type="button" id="nextBtn" class="btn">Lanjut →</button>
          <button type="submit" id="submitBtn" class="btn" style="display: none;">✓ Pesan Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="app.js"></script>
<script src="buyer-form.js"></script>
<script src="checkout.js"></script>