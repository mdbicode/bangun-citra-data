<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bangun Citra Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Header */
        .header {~
            display: row;
        }

        /* Header Top */
        .header-top {
            background-color: white; /* Warna latar belakang putih */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .website-name h1 {
            color: black; /* Warna teks hitam */
        }

        .location-info {
            color: blue; /* Warna teks dan ikon biru */
        }

        /* Header Bottom */
        .header-bottom {
            background-color: #001f3f; /* Biru dongker */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .header-menu {
            display: flex;
            gap: 20px;
        }

        .header-menu a {
            text-decoration: none;
            color: white; /* Teks putih */
            font-weight: bold; /* Memberi sedikit penekanan pada teks */
        }

        /* Garis bawah pada hover */
        .header-menu a:hover {
            text-decoration: underline; /* Garis bawah pada hover */
            text-decoration-color: white; /* Warna garis bawah putih */
        }

        /* Tombol WhatsApp di header */
        .header-send-message a {
            color: white; /* Warna teks putih */
            text-decoration: none;
        }

        .header-send-message i {
            color: white; /* Warna ikon putih */
        }

        /* Carousel */
        .carousel-item img {
            width: 100%;
            height: auto;
        }

        .carousel-inner .carousel-item {
            transition: transform 0.6s ease-in-out; // Menambah transisi yang lebih halus
        }


        /* Kontainer Produk */
        .product-carousel {
            background-color: #001f3f; /* Biru dongker, seperti header baris kedua */
            color: white; /* Teks putih */
            padding: 20px; /* Padding untuk konten */
        }

        /* Kontainer Map dan sejajarnya */
        .map-container {
            height: 300px;
            width: 100%;
            overflow: hidden;
            margin-bottom: 10px;
            background-color: white; /* Latar belakang putih */
        }

        /* Footer */
        .footer {
            background-color: black; /* Latar belakang hitam */
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .footer-content {
            display: flex;
            justify-content: space-between; /* Jarak yang konsisten antar bagian */
            align-items: flex-start; /* Konten sejajar di atas */
            color: white; /* Teks putih */
        }

        .footer-content a {
            text-decoration: none;
            color: white; /* Teks putih */
            /*font-weight: bold;  Memberi sedikit penekanan pada teks */
        }

        /* Garis bawah pada hover */
        .footer-content a:hover {
            text-decoration: underline; /* Garis bawah pada hover */
            text-decoration-color: white; /* Warna garis bawah putih */
        }

        .footer-content > div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin: 0 15px;
        }

        .footer-license {
            text-align: center;
            padding-top: 20px;
            font-size: 0.8em;
            color: white; /* Teks putih */
        }

        @media (max-width: 768px) {
            /* Penyesuaian untuk layar kecil, misalnya, pada perangkat mobile */
            .carousel-item img {
                max-width: 100%; /* Pastikan gambar menggunakan lebar penuh pada perangkat kecil */
            }
        }

    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="header-top">
        <div class="website-name" style="padding: 10px 20px;">
            <h1>Bangun Citra Data</h1>
        </div>
        <div class="location-info" style="padding: 10px 20px; display: flex; align-items: center;">
            <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i> Purwokerto, Banyumas
            <!-- Garis pemisah vertikal -->
            <div style="border-left: 2px solid #ccc; height: 25px; margin: 0 15px;"></div>
            <!-- Ikon Profil -->
            <i class="fas fa-user-circle" style="font-size: 24px;"></i>
        </div>
    </div>

    <div class="header-bottom" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="header-menu" style="padding-left: 20px;">
            <a href="#home">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#tentang">Tentang</a>
        </div>
        
        <!-- Kontainer untuk Send Message -->
        <div class="header-send-message" style="padding: 10px 20px; background-color: red; display: flex; align-items: center;">
            <a href="https://api.whatsapp.com/send?phone=6281391188327" target="_blank" style="color: white; text-decoration: none;">
                <i class="fab fa-whatsapp"></i> Send Message
            </a>
        </div>
    </div>
</div>

<!-- Carousel -->
<div id="mainCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indikator Carousel -->
    <ol class="carousel-indicators">
        <?php
        // Mengambil data gambar dari database
        $stmt = $pdo->prepare("SELECT * FROM cover");
        $stmt->execute();
        $carousel_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $is_first = true;
        $active_class = $is_first ? 'active' : '';

        // Membuat indikator berdasarkan jumlah item dalam database
        $index = 0;
        foreach ($carousel_items as $item) {
            $active = ($index === 0) ? 'class="active"' : ''; // Menandai item pertama sebagai aktif
            echo "<li data-target='#mainCarousel' data-slide-to='$index' $active></li>";
            $index++;
        }
        ?>
    </ol>

    <!-- Konten Carousel -->
    <div class="carousel-inner">
        <?php
        foreach ($carousel_items as $item) {
            $active_class = $is_first ? 'active' : '';
            $is_first = false;
            
            $image_path = htmlspecialchars($item['image_path']); // Jalur gambar
            $alt_text = htmlspecialchars($item['alt_text'] ?? ''); // Teks alternatif
            
            echo "<div class='carousel-item $active_class'>";
            echo "<img src='$image_path' alt='$alt_text'>";
            // echo "<img src='$image_path' alt='$alt_text' style='max-width: 80%; height: auto; display: flex; margin: auto;'>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Kontainer Produk -->
<div class="product-carousel">
    <h2 class="text-center">Produk yang Kami Tawarkan</h2>
    <div class="carousel slide" id="productCarousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-wrap="true">
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
                    echo "<img src='$image_path' alt='$alt_text' style='max-width: 200px; height: auto;'>";
                    echo "<h5>$product_name</h5>";
                    echo "</div>";
                }
                
                echo '</div></div>'; // Tutup carousel-item dan baris
            }
            ?>
        </div>

        <!-- Kontrol Carousel -->
        <a class="carousel-control-prev" href="#productCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>

        <a class="carousel-control-next" href="#productCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>


<!-- Kontainer Map dan Promosi -->
<div class="container mt-4">
    <div class="row text-center">
        <div class="col-lg-6">
            <h2>Dapatkan Harga Spesial Sekarang Juga!</h2>
            <a href="https://api.whatsapp.com/send?phone=6281391188327" target="_blank" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Order Now</a>
        </div>
        <div class="col-lg-6">
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3427.848380031327!2d109.2290746!3d-7.4384145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655dc1d5ba9ab5%3A0x69ec85cc3ce59b7a!2sBangun+Citra+Data!5e0!3m2!1sid!2sid!4v1632930000000"
                    frameborder="0" style="border:0; width:100%; height:100%;" allowfullscreen=""
                    aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="footer-content">
        <!-- Bagian Logo -->
        <div>
            <img src="global/img/logo.png" alt="Brand Logo" style="width: 250px; height: 100px;">
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<!-- Menonaktifkan Pause pada Carousel -->
<script>
$(document).ready(function() {
    $('#mainCarousel').carousel({
        interval: 3000, // Interval 5 detik
        pause: false // Matikan pause saat kursor berada di atas carousel
    });
});
</script>
</body>
</html>
