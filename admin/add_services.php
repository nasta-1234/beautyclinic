<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

// Tambahkan layanan baru ke database
if (isset($_POST['add_service'])) {
    
    $id = unique_id(); // FIX: gunakan $id, bukan $id_

    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $harga = filter_var($_POST['harga'], FILTER_SANITIZE_STRING);
    $detail_layanan = filter_var($_POST['detail_layanan'], FILTER_SANITIZE_STRING);
    $kategori = filter_var($_POST['kategori'], FILTER_SANITIZE_STRING);

    $foto = $_FILES['foto']['name'];
    $foto = filter_var($foto, FILTER_SANITIZE_STRING);
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['foto']['size'];
    $image_tmp_name = $_FILES['foto']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    $status = 'active';

    $select_image = $conn->prepare("SELECT * FROM layanan WHERE foto = ?");
    $select_image->execute([$foto]);

    if (!empty($foto)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Nama gambar sudah digunakan, silakan ubah nama file.';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran gambar terlalu besar (maksimal 2MB).';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $foto = '';
    }

    if ($select_image->rowCount() > 0 && $foto != '') {
        $warning_msg[] = 'Silakan ubah nama gambar Anda.';
    } else {
        $insert_services = $conn->prepare("INSERT INTO layanan (id, nama, harga, foto, detail_layanan, kategori, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_services->execute([$id, $nama, $harga, $rename, $detail_layanan, $kategori, $status]);
        $success_msg[] = 'Pelayanan berhasil ditambahkan!';
    }
}

// Simpan layanan sebagai draft
if (isset($_POST['draft'])) {
    
    $id = unique_id();

    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $harga = filter_var($_POST['harga'], FILTER_SANITIZE_STRING);
    $detail_layanan = filter_var($_POST['detail_layanan'], FILTER_SANITIZE_STRING);
    $kategori = filter_var($_POST['kategori'], FILTER_SANITIZE_STRING);

    $foto = $_FILES['foto']['name'];
    $foto = filter_var($foto, FILTER_SANITIZE_STRING);
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['foto']['size'];
    $image_tmp_name = $_FILES['foto']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    $status = 'deactive';

    $select_image = $conn->prepare("SELECT * FROM layanan WHERE foto = ?");
    $select_image->execute([$foto]);

    if (!empty($foto)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Nama gambar sudah digunakan, silakan ubah nama file.';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran gambar terlalu besar (maksimal 2MB).';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $foto = '';
    }

    if ($select_image->rowCount() > 0 && $foto != '') {
        $warning_msg[] = 'Silakan ubah nama gambar Anda.';
    } else {
        $insert_services = $conn->prepare("INSERT INTO layanan (id, nama, harga, foto, detail_layanan, kategori, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_services->execute([$id, $nama, $harga, $rename, $detail_layanan, $kategori, $status]);
        $success_msg[] = 'Pelayanan berhasil disimpan sebagai draft!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Movement</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Tambah Layanan</h1>
            <p style="text-align: left;">
                Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
                Kelola semua kebutuhan klinik dalam satu tempat: <br>
                💎 Lihat jadwal booking harian & mingguan <br>
                💎 Pantau data pelanggan & riwayat perawatan <br>
                💎 Kelola layanan, promo, dan pembayaran dengan mudah <br>
                💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br><br>
                ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan layanan Anda."
            </p>
            <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Tambahkan Layanan</span>
        </div>
    </div>

    <section class="add_services">
        <div class="heading">
            <h1>Tambahkan Layanan</h1>
            <img src="../image/layer.jpg" width="100">
        </div>

        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                    <p>Nama Layanan <span>*</span></p>
                    <input type="text" name="nama" placeholder="Tambahkan nama layanan" required class="box">
                </div>
                <div class="input-field">
                    <p>Harga Layanan <span>*</span></p>
                    <input type="number" name="harga" placeholder="Tambahkan harga layanan" required class="box">
                </div>
                <div class="input-field">
                    <p>Detail Layanan <span>*</span></p>
                    <textarea name="detail_layanan" required placeholder="Penjelasan tentang layanan" class="box"></textarea>
                </div>
                <div class="input-field">
                    <p>Kategori Layanan <span>*</span></p>
                    <select name="kategori" class="box" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Perawatan Wajah">Perawatan Wajah</option>
                        <option value="Perawatan Tubuh">Perawatan Tubuh</option>
                        <option value="Perawatan Rambut dan Kulit Kepala">Perawatan Rambut dan Kulit Kepala</option>
                        <option value="Perawatan Kuku- Tangan dan Kaki">Perawatan Kuku - Tangan dan Kaki</option>
                        <option value="Konsultasi dan Produk Perawatan">Konsultasi dan Produk Perawatan</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>Foto Layanan <span>*</span></p>
                    <input type="file" name="foto" accept="image/*" required class="box">
                </div>
                <div class="flex-btn">
                    <button type="submit" name="add_service" class="btn">Tambahkan Layanan</button>
                    <button type="submit" name="draft" class="btn">Tambahkan ke Draft</button>
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
