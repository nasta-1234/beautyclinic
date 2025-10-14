<?php
    include '../components/connect.php';

    if (isset($_COOKIE['admin_id'])) {
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    //delete services from database
    if (isset($_POST['delete'])) {
        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

        $delete_service = $conn->prepare("DELETE FROM layanan WHERE id = ?");
        $delete_service->execute([$service_id]);

        $success_msg[] = 'Layanan Berhasil Dihapus';
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" detail_layanan="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Mevement</title>
    <link  href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">

</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Lihat Layanan</h1>
            <p style="text-align: left;">Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
                Kelola semua kebutuhan klinik dalam satu tempat: <br>
                💎 Lihat jadwal booking harian & mingguan <br>
                💎 Pantau data pelanggan & riwayat perawatan <br>
                💎 Kelola layanan, promo, dan pembayaran dengan mudah <br>
                💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br> <br>
                ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan layanan Anda."</p>
                <span> <a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Lihat Layanan</span>
        </div>
    </div>

    <section class="view_container">
        <div class="heading">
            <h1>Semua Layanan</h1>
            <img src="../image/layer.jpg" width="100">
        </div>
        <div class="box-container">
            <?php
                $select_services = $conn->prepare("SELECT * FROM layanan");
                $select_services->execute();
                if ($select_services->rowCount() > 0) {
                    while ($fetch_service = $select_services->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
                <?php if($fetch_service['foto'] != ''){?>
                    <img src="../uploaded_files/<?= $fetch_service['foto']; ?>" class="foto">
                <?php } ?>
                <div class="status" style= "color : <?php if($fetch_service['status']=='active'){ echo "green";}else{echo "red";}?>"><?= $fetch_service['status']; ?></div>
                <p class="harga">$<?= $fetch_service['harga']; ?>/-</p>
                <div class="content">
                    <div class="title">
                        <?= $fetch_service['nama']; ?>
                    </div>
                    <div class="flex-btn">
                        <a href="edit_services.php?id=<?= $fetch_service['id']; ?>" class="btn">Edit</a>
                        <button type="submit" name ="delete" class="btn" onclick="return confirm ('Apakah ingin menghapus layanan ini?');">Hapus</button>
                        <a href="read_services.php?get_id=<?= $fetch_service['id']; ?>" class="btn">Baca</a>

                    </div>
                </div>
            </form>
            <?php
                    }
                }else {
                    echo '
                    <div class="empty">
                        <p>Tidak ada layanan yang ditambahkan ! <br> <a href="add_services.php" class = "btn" style= "margin-top = 1rem;">Tambahkan Layanan</a></p>
                    </div>
                    ';
                }
            ?>
        </div>
        
        
        
    </section>

    <?php include '../components/admin_footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>