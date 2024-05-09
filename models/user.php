<?php
require_once 'config.php'; // Koneksi ke database

// Fungsi untuk mengunggah file
function uploadImage($file, $directory = "global/img/uploads") {
    $target_dir = $directory; // Direktori tempat gambar akan disimpan
    $target_file = $target_dir . basename($file["name"]);
    $upload_ok = 1;

    // Cek apakah file adalah gambar
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false; // Bukan gambar
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        return false; // File sudah ada
    }

    // Cek ukuran file (contoh: maksimal 5MB)
    if ($file["size"] > 5000000) {
        return false; // File terlalu besar
    }

    // Cek tipe file yang diizinkan (jpg, png, gif)
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        return false; // Format tidak diizinkan
    }

    // Unggah file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; // Mengembalikan jalur gambar yang diunggah
    }

    return false; // Jika gagal
}

// Tambah gambar baru ke cover
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_cover'])) {
    $image_name = sanitizeInput($_POST['image_name']);
    $alt_text = sanitizeInput($_POST['alt_text'] ?? null);
    $description = sanitizeInput($_POST['description'] ?? null);
    $image_path = uploadImage($_FILES['image'], "global/img/uploads/carousel/");

    if ($image_path) {
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO cover (image_name, image_path, alt_text, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$image_name, $image_path, $alt_text, $description]);
    }
}

// Tambah gambar baru ke produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $image_name = sanitizeInput($_POST['image_name']);
    $alt_text = sanitizeInput($_POST['alt_text'] ?? null);
    $description = sanitizeInput($_POST['description'] ?? null);
    $image_path = uploadImage($_FILES['image'], "global/img/uploads/products/");

    if ($image_path) {
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO products (image_name, image_path, alt_text, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$image_name, $image_path, $alt_text, $description]);
    }
}

// Hapus gambar dari cover
if (isset($_POST['delete_cover'])) {
    $id = sanitizeInput($_POST['id']);
    
    // Ambil jalur gambar sebelum menghapus dari database
    $stmt = $pdo->prepare("SELECT image_path FROM cover WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    // Hapus file gambar dari sistem file
    if ($image && file_exists($image['image_path'])) {
        unlink($image['image_path']);
    }

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM cover WHERE id = ?");
    $stmt->execute([$id]);
}
    
// Hapus gambar dari produk
if (isset($_POST['delete_product'])) {
    $id = sanitizeInput($_POST['id']);
    
    // Ambil jalur gambar sebelum menghapus dari database
    $stmt = $pdo->prepare("SELECT image_path FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Hapus file gambar dari sistem file
    if ($image && file_exists($image['image_path'])) {
        unlink($image['image_path']);
    }

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

// // Fungsi untuk mengedit gambar
// function updateImage($id, $image_name, $alt_text, $description, $image_path = null) {
//     global $pdo; // Koneksi database

//     $query = "UPDATE cover SET image_name = ?, alt_text = ?, description = ? WHERE id = ?";
//     $params = [$image_name, $alt_text, $description, $id];

//     if ($image_path) {
//         $query = "UPDATE cover SET image_name = ?, alt_text = ?, description = ?, image_path = ? WHERE id = ?";
//         $params = [$image_name, $alt_text, $description, $image_path, $id];
//     }

//     $stmt = $pdo->prepare($query);
//     $stmt->execute($params);
// }

// Ambil semua gambar dari cover
$stmt = $pdo->prepare("SELECT * FROM cover");
$stmt->execute();
$cover_images = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil semua gambar dari produk
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$product_images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
