<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login - AgroTech Shop</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/AgroTech_Shop/pages/Login/css/style_login.css">
</head>

<body>

<div class="login-card">

    <!-- BAGIAN ATAS -->
    <div class="top-section">
        <img src="/AgroTech_Shop/assets/Logo.png" alt="Logo AgroTech" />

        <p>
            Menjual berbagai kebutuhan di bidang pertanian dan perkebunan.
        </p>
    </div>

    <!-- FORM LOGIN -->
    <div class="form-section">

        <div class="title-box">
            <h2>LOGIN</h2>
            <small>SELAMAT DATANG</small>
        </div>

        <form action="ProsesLogin.php" method="POST">

            <div class="input-field">
                <input type="text" name="username" placeholder="Email atau Username" required>
            </div>

            <div class="input-field">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="inline">
                <label><input type="checkbox" name="remember"> Ingat Saya</label>
                <a href="#">Lupa Password?</a>
            </div>

            <button type="submit" class="login-btn">LOGIN</button>
            
        </form>

        <!-- LINK REGISTER -->
        <p class="register-link">
            Belum punya akun? 
            <a href="/AgroTech_Shop/pages/Registrasi/Registrasi.php">
                Daftar Sekarang!
            </a>
        </p>

    </div>

</div>


</body>
</html>
