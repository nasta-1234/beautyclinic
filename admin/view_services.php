<?php
include '../components/connect.php';

// Cek login admin
if (!isset($_COOKIE['admin_id'])) {
    header('location:login.php');
    exit();
}

$success_msg = [];
$warning_msg = [];

// Hapus layanan
if (isset($_POST['delete'])) {
    // ✅ Ambil id_layanan dari form
    $id_layanan = htmlspecialchars(trim($_POST['id_layanan']), ENT_QUOTES, 'UTF-8');

    // Ambil foto layanan dari database
    $select_image = $conn->prepare("SELECT foto FROM layanan WHERE id_layanan = ?");
    $select_image->execute([$id_layanan]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);

    // Hapus file foto dari folder
    if ($fetch_image && !empty($fetch_image['foto'])) {
        $file_path = '../uploaded_files/' . $fetch_image['foto'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus data layanan dari database
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
    <title>Lihat-Layanan</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
    <style>
        .quick-access {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .quick-access .btn {
            padding: 10px 20px;
            background-color: #ff66b3;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }
        .quick-access .btn:hover {
            background-color: #ff3399;
        }
    </style>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Semua Layanan</h1>
            <span>
                <a href="dashboard.php">Admin</a>
                <i class="bx bx-right-arrow-alt"></i>
                Lihat Layanan
            </span>
        </div>
    </div>

    <section class="view_container">
        <div class="box-container">

            <!-- Pesan sukses / peringatan -->
            <?php foreach ($success_msg as $msg): ?>
                <p style="color:green; text-align:center;"><?= $msg; ?></p>
            <?php endforeach; ?>

            <?php foreach ($warning_msg as $msg): ?>
                <p style="color:red; text-align:center;"><?= $msg; ?></p>
            <?php endforeach; ?>

            <?php
            // Ambil semua layanan
            $select_services = $conn->prepare("SELECT * FROM layanan ORDER BY nama ASC");
            $select_services->execute();

            if ($select_services->rowCount() > 0):
                while ($fetch_service = $select_services->fetch(PDO::FETCH_ASSOC)):
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="id_layanan" value="<?= htmlspecialchars($fetch_service['id_layanan']); ?>">

                <?php if (!empty($fetch_service['foto'])): ?>
                    <img src="/beautyclinic/uploaded_files/<?= htmlspecialchars($fetch_service['foto']); ?>"
                         class="foto"
                         alt="<?= htmlspecialchars($fetch_service['nama']); ?>">
                <?php endif; ?>

                <div class="status" style="color:<?= $fetch_service['status'] === 'active' ? 'green' : 'red'; ?>;">
                    <?= htmlspecialchars($fetch_service['status']); ?>
                </div>

                <p class="harga">Rp<?= number_format($fetch_service['harga'], 0, ',', '.'); ?></p>

                <div class="content">
                    <div class="title"><?= htmlspecialchars($fetch_service['nama']); ?></div>
                    <div class="flex-btn">
                        <a href="edit_services.php?id_layanan=<?= htmlspecialchars($fetch_service['id_layanan']); ?>" class="btn">Edit</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">Hapus</button>
                        <a href="read_services.php?get_id=<?= htmlspecialchars($fetch_service['id_layanan']); ?>" class="btn">Baca</a>
                    </div>
                </div>
            </form>
            <?php
                endwhile;
            else:
            ?>
            <div class="empty">
                <p>
                    Tidak ada layanan yang ditambahkan! <br>
                    <a href="add_services.php" class="btn" style="margin-top:1rem;">Tambahkan Layanan</a>
                </p>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
</body>
</html>
