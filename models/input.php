<?php
include '../config.php'; // Menghubungkan dengan database

$username = 'banguncitradata'; // Nama pengguna yang akan dimasukkan

// Hashing password menggunakan bcrypt
$plain_password = 'bcdcompany'; // Kata sandi asli
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT); // Hash kata sandi

// Masukkan data ke dalam database
$query = "INSERT INTO user (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashed_password);

$stmt->execute(); // Menyimpan data pengguna

echo "Data pengguna berhasil disimpan.";
?>
