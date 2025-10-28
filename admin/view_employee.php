<?php
include '../components/connect.php';

// cek login admin
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location:login.php');
    exit;
}

// ambil semua data karyawan
$select_employee = $conn->prepare("SELECT * FROM karyawan ORDER BY nama ASC");
$select_employee->execute();
$employees = $select_employee->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan - Admin Panel</title>

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">

    <style>
        /* Tombol Kembali Lucu 💕 */
        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #ff8ad4;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(255, 0, 150, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
        }

        .btn-kembali:hover {
            background-color: #ff5fc2;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 0, 150, 0.4);
        }

        .btn-kembali span {
            font-size: 18px;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- 💕 Tombol kembali ke halaman utama employe -->
<a href="dashboard.php" class="btn-kembali"><span>⟵</span> Kembali</a>

<div class="banner">
    <div class="detail">
        <h1>Data Karyawan</h1>
        <p>
            Kelola dan pantau semua data karyawan klinik di halaman ini:<br>
            👩‍⚕️ Lihat daftar karyawan<br>
            ✏️ Edit informasi bila ada perubahan<br>
            🗑️ Hapus data jika sudah tidak aktif<br>
            💼 Pastikan semua karyawan tercatat dengan baik
        </p>
        <span>
            <a href="dashboard.php">Admin</a>
            <i class="bx bx-right-arrow-alt"></i>
            Data Karyawan
        </span>
    </div>
</div>

<section class="show-items">
    <div class="heading">
        <h1>Daftar Karyawan</h1>
        <img src="/klinik/image/employee.png" width="100" alt="Gambar Karyawan">
    </div>

    <div class="table-container">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($employees) > 0): ?>
                    <?php $no = 1; foreach ($employees as $emp): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($emp['nama']); ?></td>
                            <td><?= htmlspecialchars($emp['jabatan']); ?></td>
                            <td><?= htmlspecialchars($emp['email']); ?></td>
                            <td>
                                <a href="edit_karyawan.php?id=<?= $emp['id']; ?>" class="btn-edit">Edit</a>
                                <a href="hapus_karyawan.php?id=<?= $emp['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada data karyawan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
