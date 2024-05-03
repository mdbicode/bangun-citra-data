<?php

require_once 'config.php';

// Fungsi untuk membuat koneksi ke database
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}

// Fungsi untuk mendapatkan semua gambar dari galeri
function getAllImages() {
    $conn = connectDB();
    $sql = "SELECT * FROM gallery";
    $result = $conn->query($sql);
    $images = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
    }
    $conn->close();
    return $images;
}

// Fungsi untuk mendapatkan informasi gambar berdasarkan ID
function getImageById($id) {
    $conn = connectDB();
    $id = $conn->real_escape_string($id);
    $sql = "SELECT * FROM gallery WHERE id=$id";
    $result = $conn->query($sql);
    $image = null;
    if ($result->num_rows == 1) {
        $image = $result->fetch_assoc();
    }
    $conn->close();
    return $image;
}
function insertImage($title, $image_url) {
    $conn = connectDB();
    $title = $conn->real_escape_string($title);
    $image_url = $conn->real_escape_string($image_url);
    $sql = "INSERT INTO gallery (title, image_url) VALUES ('$title', '$image_url')";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function deleteImage($id) {
    $conn = connectDB();

    $sql = "SELECT image_url FROM gallery WHERE id=$id";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filename = $row['image_url'];
        
        
        $filePath = $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    $sql = "DELETE FROM gallery WHERE id=$id";
    $result = $conn->query($sql);
    
    $conn->close();
    return $result;
}

$uploadDirectory = 'assets/image/';

function uploadFile($file, $uploadDirectory, $title) {
    $file_info = pathinfo($file['name']);
    $targetPath = $uploadDirectory . basename($title) . '.' . $file_info['extension'];
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $targetPath;
    } else {
        return false;
    }
}




?>
