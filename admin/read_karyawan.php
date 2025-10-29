<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

if (!isset($_GET['get_id'])) {
    header('location:view_view_employee.php');
    exit();
}

$get_id = htmlspecialchars($_GET['get_id'], ENT_QUOTES, 'UTF-8');

// Hapus karyawan
if (isset($_POST['delete'])) {
    $s_id = htmlspecialchars(trim($_POST['karyawan_id']), ENT_QUOTES, 'UTF-8');

    $delete_image = $conn->prepare("SELECT foto FROM karyawan WHERE id_karyawan = ?");
    $delete_image->execute([$s_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    
    if ($fetch_delete_image && $fetch_delete_image['foto'] != '') {
        $image_path = '../uploaded_files/' . $fetch_delete_image['foto'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $delete_karyawan = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
    $delete_karyawan->execute([$s_id]);

    header('location:view_view_employee.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca karyawan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Baca karyawan</h1>
        <p style="text-align: left;">
            Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
            Kelola semua kebutuhan klinik dalam satu tempat: <br>
            💎 Lihat jadwal booking harian & mingguan <br>
            💎 Pantau data pelanggan & riwayat perawatan <br>
            💎 Kelola karyawan, promo, dan pembayaran dengan mudah <br>
            💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br><br>
            ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan karyawan Anda."
        </p>
        <span><a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Baca karyawan</span>
    </div>
</div>

<section class="read_container">
    <div class="heading">
        <h1>Baca karyawan</h1>
        <img src="../image/layer.jpg" width="100">
    </div>

    <div class="container">
        <?php
        $select_karyawan = $conn->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
        $select_karyawan->execute([$get_id]);

        if ($select_karyawan->rowCount() > 0) {
            while ($fetch_karyawan = $select_karyawan->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="karyawan_id" value="<?= htmlspecialchars($fetch_karyawan['id_karyawan']); ?>">

            <div class="status" style="color: <?= ($fetch_karyawan['status'] == 'active') ? 'green' : 'red'; ?>">
                <?= ucfirst($fetch_karyawan['status']); ?>
            </div>

            <?php if (!empty($fetch_karyawan['profil'])): ?>
                <img src="../uploaded_files/<?= htmlspecialchars($fetch_karyawan['profil']); ?>" class="foto" alt="Foto karyawan" style="width: 1000px; height: 1000px;">
            <?php endif; ?>
            <div class="nama"><?= htmlspecialchars($fetch_karyawan['nama']); ?></div>
            <div class="content"><p>Pekerjaan: </p><?= nl2br(htmlspecialchars($fetch_karyawan['pekerjaan'])); ?></div>
            <div class="content"><p>Tentang Karyawan :</p><?= nl2br(htmlspecialchars($fetch_karyawan['deskripsi_profil'])); ?></div>
            <div class="content"><p>E-Mail : </p><?= nl2br(htmlspecialchars($fetch_karyawan['email'])); ?></div>
            <div class="content"><p>Nomor HP: </p><?= nl2br(htmlspecialchars($fetch_karyawan['no_telp'])); ?></div>
            <div class="flex-btn">
                <a href="edit_karyawan.php?id_karyawan=<?= htmlspecialchars($fetch_karyawan['id_karyawan']); ?>" class="btn">Edit</a>
                <button type="submit" name="delete" class="btn" onclick="return confirm('Apakah ingin menghapus karyawan ini?');">Hapus karyawan</button>
                <a href="view_employee.php" class="btn">Kembali</a>
            </div>
        </form>
        <?php
            }
        } else {
            echo '
            <div class="empty">
                <p>Tidak ada karyawan yang ditemukan! <br>
                <a href="add_view_employee.php" class="btn" style="margin-top: 1rem;">Tambahkan karyawan</a></p>
            </div>';
        }
        ?>
    </div>
</section>

<?php include '../components/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>

</body>
</html>
