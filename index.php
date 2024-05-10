<?php
// index.php

$request_uri = $_SERVER['REQUEST_URI'];

// Hapus awalan slash
$request_uri = ltrim($request_uri, '/');

// Pisahkan URL menjadi bagian-bagian
$url_parts = explode('/', $request_uri);

// Ambil rute yang diinginkan
$route = isset($url_parts[0]) ? $url_parts[0] : '';
// Lakukan penanganan rute
switch ($route) {
     case 'admin':
        include 'admin.php';
        break;            
    default:
        include 'home.php';
        break;
}
?>
