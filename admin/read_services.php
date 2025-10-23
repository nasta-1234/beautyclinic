<?php
    include '../components/connect.php';

    if (isset($_COOKIE['admin_id'])) {
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    $get_id = $_GET['get_id'];

    //delete services from database

    if (isset($_POST['delete'])) {
        
        $s_id = $_POST['service_id'];
        $s_id = htmlspecialchars(trim($s_id), ENT_QUOTES, 'UTF-8');

        $delete_image = $conn->prepare("SELECT * FROM layanan WHERE id = ?");
        $delete_image->execute([$s_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
        
        if ($fetch_delete_image['foto'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['foto']);
        }

        $delete_service = $conn->prepare("DELETE FROM layanan WHERE id = ?");
        $delete_service->execute([$s_id]);

        header('localhost:view_services.php');
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
            <h1>Baca Layanan</h1>
            <p style="text-align: left;">Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
                Kelola semua kebutuhan klinik dalam satu tempat: <br>
                💎 Lihat jadwal booking harian & mingguan <br>
                💎 Pantau data pelanggan & riwayat perawatan <br>
                💎 Kelola layanan, promo, dan pembayaran dengan mudah <br>
                💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br> <br>
                ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan layanan Anda."</p>
                <span> <a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Baca Layanan</span>
        </div>
    </div>

    <section class="read_container">
        <div class="heading">
            <h1>Baca Layanan</h1>
            <img src="../image/layer.jpg" width="100">
        </div>
        <div class="container">
            <?php
                $select_service = $conn->prepare("SELECT * FROM layanan WHERE id = ?");
                $select_service->execute([$get_id]);

                if ($select_service->rowCount() > 0) {
                    while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>" >;
                
                <div class="status" style= "color : <?php if($fetch_service['status']=='active'){ echo "green";}else{echo "red";}?>"><?= $fetch_service['status']; ?></div>
                
                <?php if($fetch_service['foto'] != ''){?>
                    <img src="../uploaded_files/<?= $fetch_service['foto']; ?>" class="foto">
                <?php } ?>

                 <p class="harga">$<?= $fetch_service['harga']; ?>/-</p>
                <div class="nama"><?= $fetch_service['nama']; ?></div>
                <div class="content"><?= $fetch_service['detail_layanan']; ?></div>

                <div class="flex-btn">
                    <a href="edit_services.php?id=<?= $fetch_service['id']; ?>" class="btn">Edit Layanan</a>
                        <button type="submit" name ="delete" class="btn" onclick="return confirm ('Apakah ingin menghapus layanan ini?');">Hapus Layanan</button>
                        <a href="view_services.php?post_id=<?= $fetch_service['id']; ?>" class="btn">Kebali</a>
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