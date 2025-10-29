<?php
include '../components/connect.php';

// Cek login admin
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location:login.php');
    exit();
}

$success_msg = [];
$warning_msg = [];

// Hapus karyawan
if (isset($_POST['delete'])) {
    // ✅ Ambil id_karyawan dari form
    $id_karyawan = htmlspecialchars(trim($_POST['id_karyawan']), ENT_QUOTES, 'UTF-8');

    // Ambil foto (profil) karyawan dari database
    $select_image = $conn->prepare("SELECT profil FROM karyawan WHERE id_karyawan = ?");
    $select_image->execute([$id_karyawan]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);

    // Hapus file foto dari folder
    if ($fetch_image && !empty($fetch_image['profil'])) {
        $file_path = '../uploaded_files/' . $fetch_image['profil'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus data karyawan dari database
    $delete_karyawan = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
    $delete_karyawan->execute([$id_karyawan]);

    $success_msg[] = 'Karyawan berhasil dihapus.';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Karyawan</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
    <style>
        .foto {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Semua Karyawan</h1>
        <span>
            <a href="dashboard.php">Admin</a>
            <i class="bx bx-right-arrow-alt"></i>
            Lihat Karyawan
        </span>
    </div>
</div>

<section class="view_container">
    <div class="heading">
        <h1>Semua Karyawan</h1>
        <img src="../image/layer.png" width="100">
    </div>

    <div class="box-container">
        <!-- Pesan sukses / peringatan -->
        <?php foreach ($success_msg as $msg): ?>
            <p style="color:green; text-align:center;"><?= $msg; ?></p>
        <?php endforeach; ?>

        <?php foreach ($warning_msg as $msg): ?>
            <p style="color:red; text-align:center;"><?= $msg; ?></p>
        <?php endforeach; ?>

        <?php
        // Ambil semua karyawan
        $select_karyawan = $conn->prepare("SELECT * FROM karyawan ORDER BY nama ASC");
        $select_karyawan->execute();

        if ($select_karyawan->rowCount() > 0):
            while ($fetch_karyawan = $select_karyawan->fetch(PDO::FETCH_ASSOC)):
                $profil = !empty($fetch_karyawan['profil']) ? htmlspecialchars($fetch_karyawan['profil']) : 'default.png';
                $nama = !empty($fetch_karyawan['nama']) ? htmlspecialchars($fetch_karyawan['nama']) : 'Tanpa Nama';
                $status = !empty($fetch_karyawan['status']) ? htmlspecialchars($fetch_karyawan['status']) : 'Tidak diketahui';
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="id_karyawan" value="<?= htmlspecialchars($fetch_karyawan['id_karyawan']); ?>">

            <img src="/beautyclinic/uploaded_files/<?= $profil; ?>" class="foto" alt="<?= $nama; ?>">

            <div class="status" style="color:<?= $status === 'active' ? 'green' : 'red'; ?>;">
                <?= $status; ?>
            </div>

            <div class="content">
                <div class="title"><?= $nama; ?></div>
                <div class="flex-btn">
                    <a href="edit_karyawan.php?id_karyawan=<?= htmlspecialchars($fetch_karyawan['id_karyawan']); ?>" class="btn">Edit</a>
                    <button type="submit" name="delete" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">Hapus</button>
                    <a href="read_karyawan.php?get_id=<?= htmlspecialchars($fetch_karyawan['id_karyawan']); ?>" class="btn">Baca</a>
                </div>
            </div>
        </form>
        <?php endwhile; else: ?>
        <div class="empty">
            <p>
                Tidak ada karyawan yang ditambahkan! <br>
                <a href="add_karyawan.php" class="btn" style="margin-top:1rem;">Tambahkan Karyawan</a>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../components/admin_footer.php'; ?>
<script type="text/javascript" src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>
