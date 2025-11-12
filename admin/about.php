<?php
// Koneksi database
require_once __DIR__ . '/components/connect.php';

// Cek login
$id_pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beauty Clinic - Home</title>
<link rel="stylesheet" href="css/user_style.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
<style>
    /* Smooth scrolling untuk anchor links jika diperlukan */
    html {
        scroll-behavior: smooth;
    }
    /* Styling banner */
    .banner {
        padding: 50px 20px;
        background-color: #f9f9f9;
    }
    .detail h1 {
        color: #333;
    }
    .detail p {
        line-height: 1.6;
    }
</style>
</head>
<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>

<!-- home section start -->
<div class="banner">
    <div class="detail">
        <h1>Tentang Kita</h1>
        <p>Beauty Clinic adalah tempat perawatan kecantikan profesional yang menyediakan berbagai layanan mulai dari perawatan wajah,
        perawatan tubuh, hingga perawatan rambut dan kulit kepala. Kami berkomitmen memberikan pelayanan terbaik
        untuk menjaga keindahan dan kepercayaan diri Anda.
        </p>
        <span><a href="add_services.php">Tentang Kita</a></span> <!-- Diubah ke dashboard.php agar bisa masuk ke dashboard -->
    </div>
</div>

<!-- Footer -->
<?php include 'components/user_footer.php'; ?>

<!-- Script tambahan -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/admin_script.js"></script>
<?php include 'components/alert.php'; ?>

<script>
    // Smooth scroll untuk anchor links jika ada
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>
