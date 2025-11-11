<?php
// Koneksi ke database
require_once __DIR__ . '/components/connect.php';

// Cek apakah user login
if (isset($_COOKIE['id_pelanggan'])) {
    $id_pelanggan = $_COOKIE['id_pelanggan'];
} else {
    $id_pelanggan = '';
}
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fffafc;
            margin: 0;
            padding: 0;
        }

        /* ===== Hero Section ===== */
        .hero {
            background: linear-gradient(rgba(255,182,193,0.4), rgba(255,182,193,0.4)),
                        url('image/form-bg-1.jpg') center/cover no-repeat;
            height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
        }

        .hero h2 {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 1.8rem;
            line-height: 1.4;
        }

        /* ===== Content ===== */
        .content {
            padding: 60px 20px;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .content h3 {
            color: #ff69b4;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .content p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .btn {
            background-color: #ff69b4;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin: 5px;
        }

        .btn:hover {
            background-color: #ff85c1;
        }

        footer {
            background-color: #ffb6c1;
            color: white;
            text-align: center;
            padding: 5px;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- Navbar/Header -->
    <?php include 'components/user_header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <h2>Selamat Datang di Beauty Clinic<br>Perawatan Kecantikan Terbaik untuk Anda!</h2>
    </section>

    <!-- Tentang Kami -->
    <section class="content">
        <h3>Tentang Kami</h3>
        <p>
            Beauty Clinic adalah tempat perawatan kecantikan profesional yang menyediakan berbagai layanan mulai dari facial,
            body treatment, hingga konsultasi kesehatan kulit. Kami berkomitmen memberikan pelayanan terbaik
            untuk menjaga keindahan dan kepercayaan diri Anda.
        </p>

        <!-- Tombol login/registrasi -->
        <?php if ($id_pelanggan): ?>
            <a href="profile.php" class="btn">Lihat Profil Saya</a>
            <a href="components/user_logout.php" onclick="return confirm('Yakin ingin logout?');" class="btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Registrasi</a>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <?php include 'components/user_footer.php'; ?>

    <footer>
        <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
    </footer>

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/admin_script.js"></script>
    <?php include 'components/alert.php'; ?>

</body>
</html>
