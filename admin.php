<?php
require 'config.php'; // Koneksi ke database
require 'check-login.php'; // Koneksi ke user
require 'functions.php'; // Fungsi CRUD database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Gambar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Kelola Carousel dan Produk</h2>

    <!-- Form Tambah Gambar untuk Cover -->
    <h3>Tambah Gambar Cover</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Gambar</label>
            <input type="text" name="image_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alt Text</label>
            <input type="text" name="alt_text" class="form-control">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Unggah Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" name="add_cover" class="btn btn-primary">Tambah ke Cover</button>
    </form>

    <hr>

    <!-- Daftar Gambar Cover -->
    <h3>Gambar Cover yang Ada</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Gambar</th>
                <th>Alt Text</th>
                <th>Deskripsi</th>
                <th>Jalur Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cover_images as $image) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($image['id']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_name']) . "</td>";
                echo "<td>" . htmlspecialchars($image['alt_text']) . "</td>";
                echo "<td>" . htmlspecialchars($image['description']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_path']) . "</td>";
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($image['id']) . "'>";
                echo "<button type='submit' name='delete_cover' class='btn btn-danger'>Hapus</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <hr>

    <!-- Form Tambah Gambar untuk Produk -->
    <h3>Tambah Gambar Produk</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Gambar</label>
            <input type="text" name="image_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alt Text</label>
            <input type="text" name="alt_text" class="form-control">
        </div>

        <div class-group>
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Unggah Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" name="add_product" class='btn btn-primary'>Tambah ke Produk</button>
    </form>

    <hr>

    <!-- Daftar Gambar Produk -->
    <h3>Gambar Produk yang Ada</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Gambar</th>
                <th>Alt Text</th>
                <th>Deskripsi</th>
                <th>Jalur Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($product_images as $image) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($image['id']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_name']) . "</td>";
                echo "<td>" . htmlspecialchars($image['alt_text']) . "</td>";
                echo "<td>" . htmlspecialchars($image['description']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_path']) . "</td>";
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($image['id']) . "'>";
                echo "<button type='submit' name='delete_product' class='btn btn-danger'>Hapus</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Edit Gambar
    <h3>Edit Gambar Cover</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Gambar yang ingin diedit (berdasarkan ID)</label>
            <input type="text" name="id" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Nama Gambar Baru</label>
            <input type="text" name="image_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alt Text Baru</label>
            <input type="text" name="alt_text" class='form-control'>
        </div>

        <div class='form-group'>
            <label>Deskripsi Baru</label>
            <textarea name='description' class='form-control'></textarea>
        </div>

        <div class='form-group'>
            <label>Ganti Gambar (opsional)</label>
            <input type='file' name='image' class='form-control'>
        </div>

        <button type='submit' name='update_cover' class='btn btn-primary'>Update Cover</button>
    </form>

    <hr>

    <h3>Edit Gambar Produk</h3>
    <form method='POST' enctype='multipart/form-data'>
        <div class='form-group'>
            <label>Gambar yang ingin diedit (berdasarkan ID)</label>
            <input type='text' name='id' class='form-control' required>
        </div>
        
        <div class='form-group'>
            <label>Nama Gambar Baru</label>
            <input type='text' name='image_name' class='form-control' required>
        </div>

        <div class='form-group'>
            <label>Alt Text Baru</label>
            <input type='text' name='alt_text' class='form-control'>
        </div>

        <div class='form-group'>
            <label>Deskripsi Baru</label>
            <textarea name='description' class='form-control'></textarea>
        </div>

        <div class='form-group'>
            <label>Ganti Gambar (opsional)</label>
            <input type='file' name='image' class='form-control'>
        </div>

        <button type='submit' name='update_product' class='btn btn-primary'>Update Produk</button>
    </form> -->

</div>

<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>
