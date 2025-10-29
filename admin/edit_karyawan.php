<?php
include '../components/connect.php';


// cek login
if (!isset($_COOKIE['admin_id'])) {
    header('location:login.php');
    exit();
}

$admin_id = $_COOKIE['admin_id']; // ✅ tambahkan ini


// ambil id karyawan
if (!isset($_GET['id_karyawan'])) {
    header('location:view_karyawans.php');
    exit();
}
$id_karyawan = $_GET['id_karyawan'];

$success_msg = [];
$warning_msg = [];

// ambil data lama
$select_karyawan = $conn->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
$select_karyawan->execute([$id_karyawan]);
$karyawan = $select_karyawan->fetch(PDO::FETCH_ASSOC);

if (!$karyawan) {
    header('location:view_karyawans.php');
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
if (isset($_POST['update_karyawan'])) {
    // ambil nilai baru atau pakai nilai lama
    $nama = trim($_POST['nama'] ?? $karyawan['nama']);
    $pekerjaan = trim($_POST['pekerjaan'] ?? $karyawan['pekerjaan']);
    $deskripsi_profil = trim($_POST['deskripsi_profil'] ?? $karyawan['deskripsi_profil']);
    $no_telp = trim($_POST['no_telp'] ?? $karyawan['no_telp']);
    $email = trim($_POST['email'] ?? $karyawan['email']);
    $status = trim($_POST['status'] ?? $karyawan['status']);
    $profil = $karyawan['profil']; // default: foto lama

    // jika upload foto baru
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
        $upload = uploadImage($_FILES['foto']);
        if ($upload['error']) {
            $warning_msg[] = $upload['error'];
        } else {
            // hapus foto lama
            if (!empty($karyawan['foto']) && file_exists('../uploaded_files/'.$karyawan['foto'])) {
                unlink('../uploaded_files/'.$karyawan['foto']);
            }
            $foto = $upload['name'];
        }
    }

    // kalau tidak ada error
    if (empty($warning_msg)) {
        $update = $conn->prepare("
            UPDATE karyawan 
            SET nama = ?, pekerjaan = ?,deskripsi_profil =? , no_telp = ?, email = ?, status = ?, profil = ? 
            WHERE id_karyawan = ?
        ");
        $update->execute([$nama, $pekerjaan, $deskripsi_profil, $no_telp, $email, $status, $profil, $id_karyawan]);

        $success_msg[] = 'karyawan berhasil diperbarui!';
        // refresh data
        $select_karyawan->execute([$id_karyawan]);
        $karyawan = $select_karyawan->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit karyawan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Edit karyawan</h1>
            <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Edit karyawan</span>
        </div>
    </div>

    <section class="edit_karyawans">
        <div class="form-container">
            <?php
            foreach ($warning_msg as $msg) echo '<p style="color:red;">'.htmlspecialchars($msg).'</p>';
            foreach ($success_msg as $msg) echo '<p style="color:green;">'.htmlspecialchars($msg).'</p>';
            ?>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <p>Nama karyawan <span>*</span></p>
                <input type="text" name="nama" value="<?= htmlspecialchars($karyawan['nama']); ?>" class="box">

                <p>pekerjaan <span>*</span></p>
                <input type="text" name="pekerjaan" value="<?= htmlspecialchars($karyawan['pekerjaan']); ?>" class="box">

                <p>email <span>*</span></p>
                <input type="text" name="email" value="<?= htmlspecialchars($karyawan['email']); ?>" class="box">

                <p>nomor telepon <span>*</span></p>
                <input type="text" name="no_telp" value="<?= htmlspecialchars($karyawan['no_telp']); ?>" class="box">

                <p>Detail karyawan <span>*</span></p>
                <textarea name="deskripsi_profil" class="box"><?= htmlspecialchars($karyawan['deskripsi_profil']); ?></textarea>

                <p>Foto karyawan</p>
                <?php if(!empty($karyawan['foto'])): ?>
                    <img src="../uploaded_files/<?= htmlspecialchars($karyawan['foto']); ?>" class="foto" style="width:100px;margin-bottom:10px;">
                <?php endif; ?>
                <input type="file" name="foto" accept="image/*" class="box">

                <p>Status <span>*</span></p>
                <select name="status" class="box">
                    <option value="active" <?= $karyawan['status']=='active'?'selected':'' ?>>Aktif</option>
                    <option value="deactive" <?= $karyawan['status']=='deactive'?'selected':'' ?>>Draft</option>
                </select>

                <div class="flex-btn">
                    <button type="submit" name="update_karyawan" class="btn">Update karyawan</button>
                    <a href="view_employee.php" class="btn">Kembali</a>
                </div>
            </form>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
