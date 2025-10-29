<?php
include '../components/connect.php';

// cek login
if (!isset($_COOKIE['admin_id'])) {
    header('location:login.php');
    exit();
}

// ambil id layanan
if (!isset($_GET['id_layanan'])) {
    header('location:view_services.php');
    exit();
}
$id_layanan = $_GET['id_layanan'];

$success_msg = [];
$warning_msg = [];

// ambil data lama
$select_service = $conn->prepare("SELECT * FROM layanan WHERE id_layanan = ?");
$select_service->execute([$id_layanan]);
$service = $select_service->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    header('location:view_services.php');
    exit();
}

// fungsi upload gambar baru
function uploadImage($file) {
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['name' => '', 'error' => null];
    }

    $foto = trim($file['name']);
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $rename = bin2hex(random_bytes(8)) . '.' . $ext;
    $image_size = $file['size'];
    $image_tmp_name = $file['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    if ($image_size > 2000000) {
        return ['error' => 'Ukuran gambar terlalu besar (maks 2MB).'];
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (!in_array($ext, $allowed)) {
        return ['error' => 'Format gambar tidak didukung.'];
    }

    move_uploaded_file($image_tmp_name, $image_folder);
    return ['name' => $rename];
}

// proses update
if (isset($_POST['update_service'])) {
    // ambil nilai baru atau pakai nilai lama
    $nama = trim($_POST['nama'] ?? $service['nama']);
    $harga = trim($_POST['harga'] ?? $service['harga']);
    $detail_layanan = trim($_POST['detail_layanan'] ?? $service['detail_layanan']);
    $kategori = trim($_POST['kategori'] ?? $service['kategori']);
    $status = trim($_POST['status'] ?? $service['status']);
    $foto = $service['foto']; // default: foto lama

    // jika upload foto baru
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
        $upload = uploadImage($_FILES['foto']);
        if ($upload['error']) {
            $warning_msg[] = $upload['error'];
        } else {
            // hapus foto lama
            if (!empty($service['foto']) && file_exists('../uploaded_files/'.$service['foto'])) {
                unlink('../uploaded_files/'.$service['foto']);
            }
            $foto = $upload['name'];
        }
    }

    // kalau tidak ada error
    if (empty($warning_msg)) {
        $update = $conn->prepare("
            UPDATE layanan 
            SET nama = ?, harga = ?, detail_layanan = ?, kategori = ?, foto = ?, status = ? 
            WHERE id_layanan = ?
        ");
        $update->execute([$nama, $harga, $detail_layanan, $kategori, $foto, $status, $id_layanan]);

        $success_msg[] = 'Layanan berhasil diperbarui!';
        // refresh data
        $select_service->execute([$id_layanan]);
        $service = $select_service->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Layanan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Edit Layanan</h1>
            <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Edit Layanan</span>
        </div>
    </div>

    <section class="edit_services">
        <div class="form-container">
            <?php
            foreach ($warning_msg as $msg) echo '<p style="color:red;">'.htmlspecialchars($msg).'</p>';
            foreach ($success_msg as $msg) echo '<p style="color:green;">'.htmlspecialchars($msg).'</p>';
            ?>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <p>Nama Layanan <span>*</span></p>
                <input type="text" name="nama" value="<?= htmlspecialchars($service['nama']); ?>" class="box">

                <p>Harga Layanan <span>*</span></p>
                <input type="number" name="harga" value="<?= htmlspecialchars($service['harga']); ?>" class="box">

                <p>Detail Layanan <span>*</span></p>
                <textarea name="detail_layanan" class="box"><?= htmlspecialchars($service['detail_layanan']); ?></textarea>

                <p>Kategori Layanan <span>*</span></p>
                <select name="kategori" class="box">
                    <option value="Perawatan Wajah" <?= $service['kategori']=='Perawatan Wajah'?'selected':'' ?>>Perawatan Wajah</option>
                    <option value="Perawatan Tubuh" <?= $service['kategori']=='Perawatan Tubuh'?'selected':'' ?>>Perawatan Tubuh</option>
                    <option value="Perawatan Rambut dan Kulit Kepala" <?= $service['kategori']=='Perawatan Rambut dan Kulit Kepala'?'selected':'' ?>>Perawatan Rambut dan Kulit Kepala</option>
                </select>

                <p>Foto Layanan</p>
                <?php if(!empty($service['foto'])): ?>
                    <img src="../uploaded_files/<?= htmlspecialchars($service['foto']); ?>" class="foto" style="width:100px;margin-bottom:10px;">
                <?php endif; ?>
                <input type="file" name="foto" accept="image/*" class="box">

                <p>Status <span>*</span></p>
                <select name="status" class="box">
                    <option value="active" <?= $service['status']=='active'?'selected':'' ?>>Aktif</option>
                    <option value="deactive" <?= $service['status']=='deactive'?'selected':'' ?>>Draft</option>
                </select>

                <div class="flex-btn">
                    <button type="submit" name="update_service" class="btn">Update Layanan</button>
                    <a href="view_services.php" class="btn">Kembali</a>
                </div>
            </form>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
