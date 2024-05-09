<?php
session_start();

// Fungsi untuk memeriksa status login
function check_login_status() {
    if (!isset($_SESSION['username'])) {
        header('Location: login');
        exit();
    }
}

check_login_status();
?>