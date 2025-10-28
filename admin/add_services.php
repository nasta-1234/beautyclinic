<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

$success_msg = [];
$warning_msg = [];

// Fungsi untuk menambahkan layanan
function addService($conn, $status) {
    global $success_msg, $warning_msg;

    // Ambil data dari form
    $nama = htmlspecialchars(trim($_POST['nama']), ENT_QUOTES, 'UTF-8');
    $harga = htmlspecialchars(trim($_POST['harga']), ENT_QUOTES, 'UTF-8');
    $detail_layanan = htmlspecialchars(trim($_POST['detail_layanan']), ENT_QUOTES, 'UTF-8');
    $kategori = htmlspecialchars(trim($_POST['kategori']), ENT_QUOTES, 'UTF-8');

    // Buat id unik untuk layanan
    $id_layanan = uniqid('layanan_');

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $rename = '';
    if (!empty($foto)) {
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $rename = uniqid('foto_') . '.' . $ext;
        $image_size = $_FILES['foto']['size'];
        $image_tmp_name = $_FILES['foto']['tmp_name'];
        $image_folder = '../uploaded_files/' . $rename;

        if ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran gambar terlalu besar (maksimal 2MB).';
            return;
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }

    // Masukkan data ke database
    try {
        $insert_services = $conn->prepare("
            INSERT INTO layanan (id_layanan, nama, harga, foto, detail_layanan, kategori, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $insert_services->execute([$id_layanan, $nama, $harga, $rename, $detail_layanan, $kategori, $status]);

        $success_msg[] = $status == 'active' 
            ? 'Layanan berhasil ditambahkan!' 
            : 'Layanan berhasil disimpan sebagai draft!';
    } catch (PDOException $e) {
        $warning_msg[] = 'Terjadi kesalahan: ' . $e->getMessage();
    }
}

// Tombol Tambah Layanan aktif
if (isset($_POST['add_service'])) {
    addService($conn, 'active');
}

// Tombol Simpan Draft
if (isset($_POST['draft'])) {
    addService($conn, 'deactive');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Layanan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Tambah Layanan</h1>
            <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Tambahkan Layanan</span>
        </div>
    </div>

    <section class="add_services">
        <div class="form-container">
            <?php
            foreach ($warning_msg as $msg) echo '<p style="color:red;">'.$msg.'</p>';
            foreach ($success_msg as $msg) echo '<p style="color:green;">'.$msg.'</p>';
            ?>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <p>Nama Layanan <span>*</span></p>
                <input type="text" name="nama" placeholder="Nama layanan" required class="box">

                <p>Harga Layanan <span>*</span></p>
                <input type="number" name="harga" placeholder="Harga layanan" required class="box">

                <p>Detail Layanan <span>*</span></p>
                <textarea name="detail_layanan" placeholder="Detail layanan" required class="box"></textarea>

                <p>Kategori Layanan <span>*</span></p>
                <select name="kategori" class="box" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="Perawatan Wajah">Perawatan Wajah</option>
                    <option value="Perawatan Tubuh">Perawatan Tubuh</option>
                    <option value="Perawatan Rambut dan Kulit Kepala">Perawatan Rambut dan Kulit Kepala</option>
                    <option value="Perawatan Kuku - Tangan dan Kaki">Perawatan Kuku - Tangan dan Kaki</option>
                    <option value="Konsultasi dan Produk Perawatan">Konsultasi dan Produk Perawatan</option>
                </select>

                <p>Foto Layanan <span>*</span></p>
                <input type="file" name="foto" accept="image/*" required class="box">

                <div class="flex-btn">
                    <button type="submit" name="add_service" class="btn">Tambahkan Layanan</button>
                    <button type="submit" name="draft" class="btn">Simpan Draft</button>
                </div>
            </form>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
</body>
</html>
