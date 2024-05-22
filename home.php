<?php
require_once 'config.php'; // Menggunakan koneksi database atau konfigurasi lainnya
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bangun Citra Data</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="global/css/style.css">
    <!-- CSS Eksternal untuk modal -->
    <link rel="stylesheet" href="global/css/modal.css">
</head>
<body>
<!-- Header -->
<div class="header">
    <div class="header-top">
        <div class="website-name">
            <h1>Bangun Citra Data</h1>
        </div>
        <div class="location-info">
            <!-- Ikon Lokasi dengan Tautan ke Elemen -->
            <a href="#google-maps-section" style="text-decoration: none; color: inherit;">
                <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>
                <span>Purwokerto, Banyumas</span>
            </a>
            <!-- Garis pemisah vertikal -->
            <div style="border-left: 2px solid #ccc; height: 25px; margin: 0 15px;"></div>
            <!-- Ikon Profil dengan trigger untuk membuka modal login -->
            <i class="fas fa-user-circle" style="font-size: 24px;" data-bs-toggle="modal" data-bs-target="#loginModal"></i>
        </div>
    </div>

    <div class="header-bottom">
        <div class="header-menu">
            <a href="#" target="_top">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#tentang">Tentang</a>
        </div>
        
        <!-- Kontainer untuk Send Message -->
        <div class="header-send-message">
            <a href="https://api.whatsapp.com/send?phone=6281391188327" target="_blank">
                <i class="fab fa-whatsapp"></i> Send Message
            </a>
        </div>
    </div>
</div>

<!-- Main Carousel -->
<div class="main-carousel">
    <div id="mainCarousel" class="carousel slide" 
        data-bs-ride="carousel" 
        data-bs-interval="5000" 
        data-bs-wrap="true" 
        data-bs-pause="false">
        
        <ol class="carousel-indicators">
            <?php
            // Indikator untuk main carousel
            $stmt = $pdo->prepare("SELECT * FROM cover"); // Sumber data berbeda untuk carousel baru
            $stmt->execute();
            $carousel_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $is_first = true;

            foreach ($carousel_items as $index => $item) {
                $active = $is_first ? 'class="active"' : '';
                echo "<li data-bs-target='#mainCarousel' data-bs-slide-to='$index' $active></li>";
                $is_first = false;
            }
            ?>
        </ol>
        
        <div class="carousel-inner">
            <?php
            $is_first = true;

            foreach ($carousel_items as $item) {
                $active_class = $is_first ? 'carousel-item active' : 'carousel-item';
                $is_first = false;

                $image_path = htmlspecialchars($item['image_path']);
                $alt_text = htmlspecialchars($item['alt_text'] ?? '');

                echo "<div class='carousel-item $active_class'>";
                echo "<img src='$image_path' alt='$alt_text' class='d-block w-100'>";
                echo "</div>";
            }
            ?>
        </div>
        
    </div>
</div>



<!-- Kontainer Produk -->
<div class="product-container" id="produk">
    <div class="container">
        <h2>Produk yang Kami Tawarkan</h2>
    </div>
    <div class="container">
        <div class="carousel slide" id="productCarousel" 
             data-bs-ride="carousel" 
             data-bs-interval="5000" 
             data-bs-wrap="true" 
             data-bs-pause="hover">
            
             <div class="container carousel-inner">
                <?php
                // Mengambil data gambar dari tabel 'products'
                $stmt = $pdo->prepare("SELECT * FROM products");
                $stmt->execute();
                $product_images = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Memisahkan data ke dalam kelompok-kelompok berisi 3 produk
                $chunks = array_chunk($product_images, 3);

                // Looping untuk membuat setiap slide dalam carousel
                foreach ($chunks as $index => $chunk) {
                    $active_class = ($index === 0) ? 'active' : ''; // Tandai slide pertama sebagai aktif
                    
                    echo "<div class='carousel-item $active_class'><div class='row'>";
                    
                    foreach ($chunk as $image) {
                        $image_path = htmlspecialchars($image['image_path']);
                        $alt_text = htmlspecialchars($image['alt_text'] ?? '');
                        $product_name = htmlspecialchars($image['image_name']);
                        
                        echo "<div class='col text-center'>";
                        echo "<img src='$image_path' alt='$alt_text' style='max-width: 200px; height: auto; background-color: #fff; border: 20px solid white; border-radius: 25px;'>";
                        echo "<br>";
                        echo "<br>";
                        echo "<h5>$product_name</h5>";
                        echo "</div>";
                    }
                    
                    echo '</div></div>'; // Tutup carousel-item dan baris
                }
                ?>
            </div>      
        </div>
        <!-- Kontrol Carousel -->
        <a class="carousel-control-prev" href="#productCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        
        <a class="carousel-control-next" href="#productCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>


<!-- Kontainer Map -->
<div class="tentang-container" id="tentang">
    <div class="row">
        <div class="col-lg-6">
            <h2>Dapatkan Harga Spesial <br> Sekarang Juga!</h2>
            <div class="tombol-order">
                <a href="https://api.whatsapp.com/send?phone=6281391188327" target="_blank" class="btn btn-success">
                    <i class="fas fa-shopping-cart"></i> Order Now
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="map-container" id="google-maps-section">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3427.848380031327!2d109.2290746!3d-7.4384145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655dc1d5ba9ab5%3A0x69ec85cc3ce59b7a!2sBangun+Citra+Data!5e0!3m2!1sid!2sid!4v1632930000000"
                    frameborder="0"
                    style="width: 100%; height: 300px;"
                    allowfullscreen
                    aria-hidden="false"
                ></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-content">
        <!-- Bagian Logo -->
        <div>
            <img class="footer-logo" src="global/img/logo.png" alt="Logo Bangun Citra Data">
        </div>
        <!-- Bagian Jam Operasional -->
        <div>
            <h6 style="color: grey;">Jam Operasional</h6>
            <span>Senin - Jum'at: 8 am - 4 pm</span>
            <span>Sabtu: 8 am - 1 pm</span>
            <span>Hari Libur: Tutup</span>
        </div>
        <!-- Bagian Kontak -->
        <div class="contact-info">
            <h6 style="color: grey;">Kontak</h6>
            <a href="https://api.whatsapp.com/send?phone=6281391188327" target="_blank"><i class="fa fa-phone"></i> +(62) 813-9118-8327</a>
            <a href="mailto:banguncitradata80@gmail.com" target="_blank"><i class="fas fa-envelope"></i> banguncitradata80@gmail.com</a>
        </div>
        <!-- Tautan ke Marketplace -->
        <div class="online-shop">
            <h6 style="color: grey;">Marketplace</h6>
            <a href="https://shopee.co.id/bcd_studio" target="_blank"><i class="fas fa-shopping-bag"></i> Shopee</a>
            <a href="https://www.tokopedia.com/bcds-1?source=universe&st=product" target="_blank"><i class="fas fa-store"></i> Tokopedia</a>
            <a href="https://www.bukalapak.com/u/bangun_citradata" target="_blank"><i class="fas fa-cart-arrow-down"></i> Bukalapak</a>
        </div>
        <!-- Bagian Media Sosial -->
        <div class="social-media">
            <h6 style="color: grey;">Media Sosial</h6>
            <a href="https://www.instagram.com/bcd_creative_workshop/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="https://www.facebook.com/BCD.Creative.Workshop?mibextid=ZbWKwL" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.linkedin.com/in/bangun-citra-data" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
    </div>
    <!-- Bagian Lisensi -->
    <div class="footer-license">
        &copy; 2024 Bangun Citra Data. All rights reserved.
    </div>
</div>

<!-- Modal untuk Form Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login ke Sistem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Login -->
                <form id="loginForm" onsubmit="return false;"> <!-- Hindari pengiriman form -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Nama Pengguna" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi" required>
                    </div>
                    <div class="text-danger" id="error-message" style="display: none;">Username atau password salah.</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="handleLogin()">Login</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<script>
    // JavaScript untuk Menangani Login melalui Modal
    function handleLogin() {
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const errorMessage = document.getElementById("error-message");

        const loginData = {
            username: username,
            password: password
        };

        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(loginData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Jika login sukses, alihkan pengguna ke halaman lain (misalnya, halaman admin)
                window.location.href = 'admin.php';
            } else {
                // Jika login gagal, tampilkan pesan kesalahan
                errorMessage.style.display = "block";
                errorMessage.textContent = data.message || 'Login gagal';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan. Coba lagi.");
        });
    }
</script>

</body>
</html>
