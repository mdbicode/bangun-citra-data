<?php
require_once 'config.php'; // Koneksi ke database

// Lokasi file log
$log_file = 'logs/login_activity.log';

// Periksa apakah metode POST digunakan dan data yang diperlukan ada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari POST dan sanitasi
    $data = json_decode(file_get_contents("php://input"), true);
    $username = htmlspecialchars($data['username'] ?? '');
    $password = htmlspecialchars($data['password'] ?? '');

    // Periksa apakah pengguna ada di database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Jika login berhasil, kirim respons sukses dan catat log
        file_put_contents($log_file, date('Y-m-d H:i:s') . " - Login sukses untuk user: $username\n", FILE_APPEND);
        echo json_encode(['success' => true]);
    } else {
        // Jika login gagal, kirim respons gagal dan catat log
        file_put_contents($log_file, date('Y-m-d H:i:s') . " - Login gagal untuk user: $username\n", FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Login gagal']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid']);
}
