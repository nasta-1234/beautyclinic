<?php
    include '../components/connect.php';

    if (isset($_COOKIE['admin_id'])) {
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Mevement</title>
    <link  href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">

</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Dashboard</h1>
            <p style="text-align: left;">Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
                Kelola semua kebutuhan klinik dalam satu tempat: <br>
                💎 Lihat jadwal booking harian & mingguan <br>
                💎 Pantau data pelanggan & riwayat perawatan <br>
                💎 Kelola layanan, promo, dan pembayaran dengan mudah <br>
                💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br> <br>
                ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan layanan Anda."</p>
                <span> <a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>dashboard</span>
        </div>
    </div>

    <section class="dashboard">
        <div class="heading">
            <h1>Heading</h1>
            <img src="../image/layer.jpg" width="100">
        </div>
        <div class="box-container">
            <div class="box">
                <h3>Selamat Datang</h3>
                <p><?= $fetch_profile['nama']; ?></p>
                <a href="profile.php" class="btn">Lihat Profile</a>
            </div>
            <div class="box">
                <?php 
                $select_msg = $conn->prepare("SELECT * FROM pesanan ");
                $select_msg->execute();
                $num_of_msg = $select_msg->rowCount();
                ?>
                <h3><?= $num_of_msg; ?></h3>
                <a href="admin_message.php" class="btn">Lihat Pesanan</a>
            </div>
        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>