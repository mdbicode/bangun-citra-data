<?php
require_once 'models/user.php'; // Koneksi ke database dan fungsi CRUD
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Carousel dan Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- CSS Eksternal untuk admin -->
    <link rel="stylesheet" href="global/css/admin.css">
    <!-- CSS Eksternal untuk modal -->
    <link rel="stylesheet" href="global/css/modal.css">
</head>
<body>
<div class="container">
    <!-- Kontainer Atas -->
    <div class="container-top">
        <h2 class="text-center">Kelola Carousel dan Produk</h2>
        <form method="POST" action="logout.php" class="logout-form">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
    <hr>

    <!-- Kontainer Tengah -->
    <div class="container-middle">
        <div class="heading">
            <h3>List Gambar Carousel</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarouselModal">Tambah Gambar</button> <!-- Tombol untuk membuka modal -->
        </div>
        <hr>
        <!-- Tabel Gambar Carousel -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Gambar</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($cover_images as $image) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($image['id']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_name']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($image['image_path']) . "' alt='" . htmlspecialchars($image['alt_text']) . "' style='max-width: 100px; height: auto;'></td>";
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
    </div>

    <!-- Modal untuk Tambah Gambar Carousel -->
    <div class="modal fade" id="addCarouselModal" tabindex="-1" aria-labelledby="addCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarouselModalLabel">Tambah Gambar ke Carousel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan gambar ke carousel -->
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Gambar</label>
                            <input type="text" name="image_name" class="form-control" required>
                            <small class="text-muted"><i>*Wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Alt Text</label>
                            <input type="text" name="alt_text" class="form-control">
                            <small class="text-muted"><i>*Tidak wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control"></textarea>
                            <small class="text-muted"><i>*Tidak wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Unggah Gambar</label>
                            <input type="file" name="image" class="form-control" required>
                            <small class="text-muted"><i>*Sebaiknya gunakan gambar dengan ratio yang sama 1920 x 1280px</i></small> <!-- Keterangan -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_cover" class="btn btn-primary">Tambah Gambar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontainer Bawah -->
    <div class="container-bottom">
        <div class="heading">
            <h3>List Produk</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Tambah Produk</button>
        </div>
        <hr>
        <!-- Tabel Produk -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Produk</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($product_images as $image) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($image['id']) . "</td>";
                echo "<td>" . htmlspecialchars($image['image_name']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($image['image_path']) . "' alt='" . htmlspecialchars($image['alt_text']) . "' style='max-width: 100px; height: auto;'></td>";
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
    </div>

    <!-- Modal untuk Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan produk -->
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Produk</label>
                            <input type="text" name="image_name" class="form-control" required>
                            <small class="text-muted"><i>*Wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Alt Text</label>
                            <input type="text" name="alt_text" class="form-control">
                            <small class="text-muted"><i>*Tidak wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control"></textarea>
                            <small class="text-muted"><i>*Tidak wajib diisi</i></small> <!-- Keterangan -->
                        </div>
                        <div class="form-group">
                            <label>Unggah Gambar</label>
                            <input type="file" name="image" class="form-control" required>
                            <small class="text-muted"><i>*Sebaiknya gunakan gambar dengan ratio yang sama 520 x 520px</i></small> <!-- Keterangan -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_product" class="btn btn-primary">Tambah Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>
</html>
