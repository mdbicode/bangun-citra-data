<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery CRUD</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
    
<?php
require_once 'db_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $file = $_FILES["fileToUpload"];
    
    if (empty($title)) {
        echo "Judul gambar harus diisi.";
    } else {
        $imagePath = uploadFile($file, $uploadDirectory, $title);
        
        if ($imagePath) {
            if (insertImage($title, $imagePath)) {
                echo "File ". basename($file["name"]). " berhasil diunggah.";
                header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page after form submission
                exit();
            } else {
                echo "Gagal menyimpan informasi gambar ke database.";
            }
        } else {
            echo "Gagal mengunggah file gambar.";
        }
    }
}


$images = getAllImages();
echo "<h2>Galeri Gambar</h2>";
echo "<div id='gallery'>";
if ($images) {
foreach ($images as $image) {
    echo "<div class='gallery-item' id='image_" . $image['id'] . "'>";
    echo "<img src='" . $image['image_url'] . "' alt='" . $image['title'] . "'>";
    echo "<a href='delete_image.php?id=" . $image['id'] . "' class='delete-icon' onclick='return confirm(\"Apakah Anda yakin ingin menghapus gambar ini?\")'>&times;</a>";
    echo "</div>";
}
    echo "</div>";
} else {
    echo "<p>Galeri kosong.</p>";
}

?>

    <h2>Tambah Gambar Baru</h2>
    <form id="uploadForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title">
        </div>
        <div class="form-group">
            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
            <button type="button" id="customUploadButton" class="btn">Pilih Gambar</button>
            <span id="selectedFile"></span>
        </div>
        <input type="submit" value="Tambah Gambar" class="btn">
    </form>
</div>

    <script src="assets/js/script.js"></script>
</body>
</html>
