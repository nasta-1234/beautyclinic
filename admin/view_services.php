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

// Hapus layanan
if (isset($_POST['delete'])) {
    $id_layanan = filter_var($_POST['id_layanan'], FILTER_SANITIZE_STRING);

    // Hapus gambar dulu
    $select_image = $conn->prepare("SELECT foto FROM layanan WHERE id_layanan = ?");
    $select_image->execute([$id_layanan]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_image && $fetch_image['foto'] != '') {
        @unlink('../uploaded_files/'.$fetch_image['foto']);
    }

    // Hapus layanan
    $delete_service = $conn->prepare("DELETE FROM layanan WHERE id_layanan = ?");
    $delete_service->execute([$id_layanan]);

    $success_msg[] = 'Layanan berhasil dihapus.';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Layanan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Semua Layanan</h1>
            <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Lihat Layanan</span>
        </div>
    </div>

    <section class="view_container">
        <div class="box-container">
            <?php
            foreach ($success_msg as $msg) echo '<p style="color:green;">'.$msg.'</p>';
            foreach ($warning_msg as $msg) echo '<p style="color:red;">'.$msg.'</p>';

            $select_services = $conn->prepare("SELECT * FROM layanan ORDER BY nama ASC");
            $select_services->execute();

            if ($select_services->rowCount() > 0) {
                while ($fetch_service = $select_services->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="id_layanan" value="<?= $fetch_service['id_layanan']; ?>">
                
                <?php if($fetch_service['foto'] != '') { ?>
                    <img src="../uploaded_files/<?= $fetch_service['foto']; ?>" class="foto">
                <?php } ?>

                <div class="status" style="color:<?= $fetch_service['status'] == 'active' ? 'green' : 'red'; ?>;">
                    <?= $fetch_service['status']; ?>
                </div>

                <p class="harga">$<?= $fetch_service['harga']; ?>/-</p>

                <div class="content">
                    <div class="title"><?= $fetch_service['nama']; ?></div>
                    <div class="flex-btn">
                        <a href="edit_services.php?id_layanan=<?= $fetch_service['id_layanan']; ?>" class="btn">Edit</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Apakah ingin menghapus layanan ini?');">Hapus</button>
                        <a href="read_services.php?get_id=<?= $fetch_service['id_layanan']; ?>" class="btn">Baca</a>
                    </div>
                </div>
            </form>
            <?php
                }
            } else {
                echo '<div class="empty"><p>Tidak ada layanan yang ditambahkan! <br><a href="add_services.php" class="btn" style="margin-top:1rem;">Tambahkan Layanan</a></p></div>';
            }
            ?>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
</body>
</html>
