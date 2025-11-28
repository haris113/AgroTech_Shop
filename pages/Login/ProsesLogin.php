<?php
session_start();

// Koneksi Database (benar)
$koneksi = new mysqli("localhost", "root", "", "agrotech_haris");

// Jika gagal konek
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Pastikan form dikirim
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: /AgroTech_Shop/pages/Login/LoginUser.php");
    exit;
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Query login (lebih aman)
$stmt = $koneksi->prepare("SELECT id_akun, username, password, role 
                           FROM akun WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<script>alert("Username tidak ditemukan."); location="/AgroTech_Shop/pages/Login/LoginUser.php";</script>';
    exit;
}

$row = $result->fetch_assoc();

// Cek password (plaintext — karena database kamu masih plaintext)
if ($password !== $row['password']) {
    echo '<script>alert("Password salah."); location="/AgroTech_Shop/pages/Login/LoginUser.php";</script>';
    exit;
}

// Jika password benar → buat session
$_SESSION['logged_in'] = true;
$_SESSION['id_akun'] = $row['id_akun'];
$_SESSION['role'] = strtolower($row['role']);

// Routing berdasarkan role
if ($_SESSION['role'] === "pembeli") {
    header("Location: /AgroTech_Shop/pages/Pembeli/BerandaPembeli.php");
    exit;

} elseif ($_SESSION['role'] === "admin" || $_SESSION['role'] === "seller") {
    header("Location: /AgroTech_Shop/pages/Admin/BerandaAdmin.php");
    exit;

} else {
    echo '<script>alert("Role pengguna tidak dikenal."); location="/AgroTech_Shop/pages/Login/login.php";</script>';
    exit;
}
