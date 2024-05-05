<?php
// Menyertakan konfigurasi koneksi ke database
$host = 'localhost'; // Nama host untuk MySQL
$username = 'root'; // Nama pengguna database
$password = ''; // Kata sandi database
$dbname = 'bcd'; // Nama database

// Menghubungkan ke database menggunakan PDO (PHP Data Objects)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Mengatur mode error agar PDO melemparkan exception jika ada kesalahan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Fungsi untuk mengamankan input pengguna
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk mengalihkan halaman dengan aman
function redirect($url) {
    header("Location: $url");
    exit();
}

// Fungsi untuk memeriksa apakah metode HTTP adalah POST
function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// Fungsi untuk memeriksa apakah metode HTTP adalah GET
function isGet() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}
