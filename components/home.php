<?php
// Mulai koneksi database
require_once "connect.php";

// Cek apakah admin sudah login (berdasarkan cookie)
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Clinic - Home</title>
    <link rel="stylesheet" href="css/user_style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fffafc;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #ffb6c1;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 1.6em;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .hero {
            background: linear-gradient(rgba(255,182,193,0.5), rgba(255,182,193,0.5)), url('image/clinic_banner.jpg') center/cover no-repeat;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
        }
        .hero h2 {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 15px 25px;
            border-radius: 10px;
        }
        .content {
            padding: 40px 80px;
            text-align: center;
        }
        .btn {
            background-color: #ff69b4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #ff85c1;
        }
        footer {
            background-color: #ffb6c1;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<header>
    <h1>💖 Beauty Clinic</h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="admin/read_services.php">Layanan</a>
        <a href="admin/read_karyawan.php">Karyawan</a>

        <?php if ($admin_id): ?>
            <!-- Jika sudah login -->
            <a href="admin/dashboard.php">Dashboard</a>
            <a href="admin/logout.php" style="color:#ffeaea;">Logout</a>
        <?php else: ?>
            <!-- Jika belum login -->
            <a href="admin/login.php">Login</a>
            <a href="admin/register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero">
    <h2>Selamat Datang di Beauty Clinic<br>Perawatan Kecantikan Terbaik untuk Anda!</h2>
</section>

<section class="content">
    <h3>Tentang Kami</h3>
    <p>
        Beauty Clinic adalah tempat perawatan kecantikan profesional yang menyediakan berbagai layanan mulai dari facial, body treatment, hingga konsultasi kesehatan kulit.
        Kami berkomitmen memberikan pelayanan terbaik untuk menjaga keindahan dan kepercayaan diri Anda.
    </p>

    <?php if ($admin_id): ?>
        <a href="admin/dashboard.php" class="btn">Masuk ke Dashboard</a>
    <?php else: ?>
        <a href="admin/login.php" class="btn">Login untuk Melanjutkan</a>
    <?php endif; ?>
</section>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

</body>
</html>
