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
                <span> <a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Add Services</span>
        </div>
    </div>

    <section class="add_services">
        <div class="heading">
            <h1>Add Services</h1>
            <img src="../image/layer.jpg" width="100">
        </div>
        <div class="form-container">
            <form action="" methode="post" enctype="multipart/form-data" class="register">
            <div class="input-field">
                <p>Service name <span>*</span></p>
                <input type="text" name="nama" placeholder="add service name" required class="box">
            </div>
            <div class="input-field">
                <p>Service price <span>*</span></p>
                <input type="number" name="price" placeholder="add service price" required class="box">
            </div>
            <div class="input-field">
                <p>Service description <span>*</span></p>
                <textarea name="content"required placeholder="sevice description"class="box"></textarea>
            </div>
            <div class="input-field">
                <p>Service categori <span>*</span></p>
                <select >
                    <option selected disabled>select category</option>
                    <option value="Perawatan Wajah">Perawatan Wajah</option>
                    <option value="Perawatan Tubuh">Perawatan Tubuh</option>
                    <option value="Perawatan Rambut dan Kulit Kepala">Perawatan Rambut dan Kulit Kepala</option>
                    <option value="Perawatan Kuku- Tangan dan Kaki">Perawatan Kuku- Tangan dan Kaki</option>
                    <option value="Konsultasi dan Produk Perawatan">Konsultasi dan Produk Perawatan</option>
                </select>
            </div>
            <div class="input-field">
                <p>Service image <span>*</span></p>
                <input type="file" name="foto" accept="image/*" required class="box">
            </div>
            
            </form>
        </div>

    </section>

    <?php include '../components/admin_footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>