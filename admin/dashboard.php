<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Mevement</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
    <style>
        .quick-access {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .quick-access .btn {
            padding: 10px 20px;
            background-color: #ff66b3;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }
        .quick-access .btn:hover {
            background-color: #ff3399;
        }
    </style>
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
            <h1>Dashboard</h1>
            <img src="../image/layer.jpg" width="100">
        </div>

        <!-- Tombol cepat admin/janji/pelanggan -->
        <div class="quick-access">
            <a href="dashboard.php" class="btn">Admin</a>
            <a href="view_appointment.php" class="btn">Janji Temu</a>
            <a href="view_users.php" class="btn">Pelanggan</a>
        </div>

        <div class="box-container">
            <div class="box">
                <h3>Selamat Datang</h3>
                <p><?= $fetch_profile['nama']; ?></p>
                <a href="profile.php" class="btn">Lihat Profile</a>
            </div>

            <div class="box">
                <?php 
                $select_msg = $conn->prepare("SELECT * FROM pesanan");
                $select_msg->execute();
                $num_of_msg = $select_msg->rowCount();
                ?>
                <h3><?= $num_of_msg; ?></h3>
                <p>Semua Pesanan</p>
                <a href="admin_massage.php" class="btn">Lihat Pesanan</a>
            </div>

            <div class="box">
                <?php 
                $select_services = $conn->prepare("SELECT * FROM layanan");
                $select_services->execute();
                $num_of_services = $select_services->rowCount();
                ?>
                <h3><?= $num_of_services; ?></h3>
                <p>Semua Layanan</p>
                <a href="view_services.php" class="btn">Lihat Pelayanan</a>
            </div>

            <div class="box">
                <?php 
                $select_active_services = $conn->prepare("SELECT * FROM layanan WHERE status = ?");
                $select_active_services->execute(['active']);
                $num_of_active_services = $select_active_services->rowCount();
                ?>
                <h3><?= $num_of_active_services; ?></h3>
                <p>Layanan Aktif</p>
                <a href="view_services.php" class="btn">Pelayanan Aktif</a>
            </div>

            <div class="box">
                <?php 
                $select_deactive_services = $conn->prepare("SELECT * FROM layanan WHERE status = ?");
                $select_deactive_services->execute(['deactive']);
                $num_of_deactive_services = $select_deactive_services->rowCount();
                ?>
                <h3><?= $num_of_deactive_services; ?></h3>
                <p>Layanan Tidak Aktif</p>
                <a href="view_services.php" class="btn">Pelayanan Tidak Aktif</a>
            </div>

            <div class="box">
                <?php 
                $select_employee = $conn->prepare("SELECT * FROM karyawan");
                $select_employee->execute();
                $num_of_employee = $select_employee->rowCount();
                ?>
                <h3><?= $num_of_employee; ?></h3>
                <p>Semua Karyawan</p>
                <a href="view_employee.php" class="btn">Lihat Karyawan</a>
            </div>

            <div class="box">
                <?php 
                $select_appointment = $conn->prepare("SELECT * FROM janji");
                $select_appointment->execute();
                $num_of_appointment = $select_appointment->rowCount();
                ?>
                <h3><?= $num_of_appointment; ?></h3>
                <p>Janji Temu Dipesan</p>
                <a href="view_appointment.php" class="btn">Semua Janji Temu</a>
            </div>

            <div class="box">
                <?php 
                $select_canceled_appointment = $conn->prepare("SELECT * FROM janji WHERE status = ?");
                $select_canceled_appointment->execute(['canceled']);
                $num_of_canceled_appointment = $select_canceled_appointment->rowCount();
                ?>
                <h3><?= $num_of_canceled_appointment; ?></h3>
                <p>Janji Temu Batal</p>
                <a href="view_appointment.php" class="btn">Janji Temu Batal</a>
            </div>

            <div class="box">
                <?php 
                $select_users = $conn->prepare("SELECT * FROM pelanggan");
                $select_users->execute();
                $num_of_users = $select_users->rowCount();
                ?>
                <h3><?= $num_of_users; ?></h3>
                <p>Semua Pelanggan</p>
                <a href="view_user.php" class="btn">Lihat Pelanggan</a>
            </div>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
