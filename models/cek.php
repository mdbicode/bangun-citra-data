<?php
// Koneksi ke database
$pdo = new PDO('mysql:host=localhost;dbname=bcd', 'root', '');

// Query untuk mengambil data pengguna
$query = "SELECT * FROM user WHERE username = :username";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username);

$username = 'banguncitradata80@gmail.com'; // Nama pengguna yang ingin dicek
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "Username: " . $user['username'] . "<br>";
    echo "Password (hashed): " . $user['password'] . "<br>";
} else {
    echo "User tidak ditemukan.";
}
?>
