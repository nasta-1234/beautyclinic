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
    header('location:view_services.php');
    exit();
}

$get_id = htmlspecialchars($_GET['get_id'], ENT_QUOTES, 'UTF-8');

// Hapus layanan
if (isset($_POST['delete'])) {
    $s_id = htmlspecialchars(trim($_POST['service_id']), ENT_QUOTES, 'UTF-8');

    $delete_image = $conn->prepare("SELECT foto FROM layanan WHERE id_layanan = ?");
    $delete_image->execute([$s_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    
    if ($fetch_delete_image && $fetch_delete_image['foto'] != '') {
        $image_path = '../uploaded_files/' . $fetch_delete_image['foto'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $delete_service = $conn->prepare("DELETE FROM layanan WHERE id_layanan = ?");
    $delete_service->execute([$s_id]);

    header('location:view_services.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Layanan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Baca Layanan</h1>
        <p style="text-align: left;">
            Halo, Selamat Datang di Dashboard Beauty Clinic 🌸 <br>
            Kelola semua kebutuhan klinik dalam satu tempat: <br>
            💎 Lihat jadwal booking harian & mingguan <br>
            💎 Pantau data pelanggan & riwayat perawatan <br>
            💎 Kelola layanan, promo, dan pembayaran dengan mudah <br>
            💎 Dapatkan insight perkembangan bisnis klinik secara real-time <br><br>
            ✨ "Satu dashboard untuk mempermudah, mempercantik, dan mengembangkan layanan Anda."
        </p>
        <span><a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Baca Layanan</span>
    </div>
</div>

<section class="read_container">
    <div class="heading">
        <h1>Baca Layanan</h1>
        <img src="../image/layer.jpg" width="100">
    </div>

    <div class="container">
        <?php
        $select_service = $conn->prepare("SELECT * FROM layanan WHERE id_layanan = ?");
        $select_service->execute([$get_id]);

        if ($select_service->rowCount() > 0) {
            while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="service_id" value="<?= htmlspecialchars($fetch_service['id_layanan']); ?>">

            <div class="status" style="color: <?= ($fetch_service['status'] == 'active') ? 'green' : 'red'; ?>">
                <?= ucfirst($fetch_service['status']); ?>
            </div>

            <?php if (!empty($fetch_service['foto'])): ?>
                <img src="../uploaded_files/<?= htmlspecialchars($fetch_service['foto']); ?>" class="foto" alt="Foto Layanan">
            <?php endif; ?>

            <p class="harga">Rp<?= number_format($fetch_service['harga'], 0, ',', '.'); ?></p>
            <div class="nama"><?= htmlspecialchars($fetch_service['nama']); ?></div>
            <div class="content"><?= nl2br(htmlspecialchars($fetch_service['detail_layanan'])); ?></div>

            <div class="flex-btn">
                <a href="edit_services.php?id=<?= htmlspecialchars($fetch_service['id_layanan']); ?>" class="btn">Edit Layanan</a>
                <button type="submit" name="delete" class="btn" onclick="return confirm('Apakah ingin menghapus layanan ini?');">Hapus Layanan</button>
                <a href="view_services.php" class="btn">Kembali</a>
            </div>
        </form>
        <?php
            }
        } else {
            echo '
            <div class="empty">
                <p>Tidak ada layanan yang ditemukan! <br>
                <a href="add_services.php" class="btn" style="margin-top: 1rem;">Tambahkan Layanan</a></p>
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
