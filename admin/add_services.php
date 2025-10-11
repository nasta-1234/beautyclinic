<?php
    include '../components/connect.php';

    if (isset($_COOKIE['admin_id'])) {
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    //adding service in database
    if (isset($_POST['add_service'])) {
        
        $id = unique_id();

        $nama = $_POST['nama'];
        $nama = filter_var($nama, FILTER_SANITIZE_STRING);

        $harga = $_POST['harga'];
        $harga = filter_var($harga, FILTER_SANITIZE_STRING);

        $detail_layanan = $_POST['detail_layanan'];
        $detail_layanan = filter_var($detail_layanan, FILTER_SANITIZE_STRING);

        $kategori = $_POST['kategori'];
        $kategori = filter_var($kategori, FILTER_SANITIZE_STRING);
        
        
        $foto = $_FILES['foto']['name'];
        $foto = filter_var($foto, FILTER_SANITIZE_STRING);
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['foto']['size'];
        $image_tmp_name = $_FILES['foto']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        $status ='active';

        $select_image = $conn->prepare("SELECT * FROM layanan WHERE image = ?");
        $select_image->execute([$image]);

        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'image name repeated';
            }elseif ($image_size > 2000000) {
                $warning_msg[] = 'image size is too large';
            }else {
                move_uploaded_file($image_tmp_name, $image_folder)
            }
        }else {
            $image = '';
        }
        if($select_image->rowCount() > 0 AND $iamge != ''){
            $warning_msg[] = 'plese rename your image';
        }else {
            $insert_services = $conn->prepare("INSERT INTO layanan (id, nama, harga, foto, detail_layanan, kategori, status) VALUES(?,?,?,?,?,?,?)");
        }
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
            <h1>Tambahkan Layanan</h1>
            <img src="../image/layer.jpg" width="100">
        </div>
        <div class="form-container">
            <form action="" methode="post" enctype="multipart/form-data" class="register">
            <div class="input-field">
                <p>Nama Layanan <span>*</span></p>
                <input type="text" name="nama" placeholder="add service name" required class="box">
            </div>
            <div class="input-field">
                <p>Harga Layanan <span>*</span></p>
                <input type="number" name="price" placeholder="add service price" required class="box">
            </div>
            <div class="input-field">
                <p>Detail Layanan <span>*</span></p>
                <textarea name="detail_layanan"required placeholder="sevice description"class="box"></textarea>
            </div>
            <div class="input-field">
                <p>Kategori Layanan <span>*</span></p>
                <select name="kategori" class="box">
                    <option selected disabled>pilih kategori</option>
                    <option value="Perawatan Wajah">Perawatan Wajah</option>
                    <option value="Perawatan Tubuh">Perawatan Tubuh</option>
                    <option value="Perawatan Rambut dan Kulit Kepala">Perawatan Rambut dan Kulit Kepala</option>
                    <option value="Perawatan Kuku- Tangan dan Kaki">Perawatan Kuku- Tangan dan Kaki</option>
                    <option value="Konsultasi dan Produk Perawatan">Konsultasi dan Produk Perawatan</option>
                </select>
            </div>
            <div class="input-field">
                <p>Layanan image <span>*</span></p>
                <input type="file" name="foto" accept="image/*" required class="box">
            </div>
            <button type="submit" name="add_service" class="btn">Tambahkan Layanan</button>
            </form>
        </div>

    </section>

    <?php include '../components/admin_footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>