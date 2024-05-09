<?php
// Script untuk menangani logout
session_start(); // Mulai sesi
session_unset(); // Hapus semua data sesi
session_destroy(); // Hancurkan sesi
header("Location: /bcd"); // Alihkan ke halaman utama
exit();
?>
