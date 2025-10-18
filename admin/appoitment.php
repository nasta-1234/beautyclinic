<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Janji Temu - Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <section class="dashboard">
        <div class="heading">
            <h1>Daftar Janji Temu</h1>
            <span> <a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Janji Temu</span>
        </div>

        <div class="box-container">
            <div class="box">
                <a href="add_appointment.php" class="btn">Tambah Janji Temu</a>
            </div>
        </div>

        <div class="table-container">
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID Janji</th>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>ID Layanan</th>
                        <th>ID Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_appointments = $conn->prepare("SELECT * FROM janji ORDER BY tanggal DESC, jam ASC");
                    $select_appointments->execute();

                    if ($select_appointments->rowCount() > 0) {
                        while ($row = $select_appointments->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>{$row['id_janji']}</td>";
                            echo "<td>{$row['id_user']}</td>";
                            echo "<td>{$row['nama']}</td>";
                            echo "<td>{$row['no_telp']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['id_layanan']}</td>";
                            echo "<td>{$row['id_karyawan']}</td>";
                            echo "<td>{$row['tanggal']}</td>";
                            echo "<td>{$row['jam']}</td>";
                            echo "<td>{$row['harga']}</td>";
                            echo "<td>{$row['status']}</td>";
                            echo "<td>{$row['status_pembayaran']}</td>";
                            echo "<td>
                                    <a href='edit_appointment.php?id={$row['id_janji']}' class='btn'>Edit</a>
                                    <a href='delete_appointment.php?id={$row['id_janji']}' class='btn' onclick=\"return confirm('Yakin ingin hapus janji ini?');\">Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13' style='text-align:center;'>Tidak ada janji temu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
</body>
</html>
