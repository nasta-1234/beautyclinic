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
    <title>View Janji Temu - Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
    <style>
        .filter-btn {
            padding: 8px 15px;
            background-color: #ff66b3;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-right: 5px;
        }
        .filter-btn:hover {
            background-color: #ff3399;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-action {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin: 2px;
        }
        .btn-edit { background-color: #4CAF50; }
        .btn-delete { background-color: #f44336; }
        .btn-edit:hover { background-color: #45a049; }
        .btn-delete:hover { background-color: #da190b; }
    </style>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <section class="dashboard">
        <div class="heading">
            <h1>View Janji Temu</h1>
            <span> <a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Janji Temu</span>
        </div>

        <div class="box-container">
            <a href="view_appoitment.php" class="filter-btn">Semua</a>
            <a href="view_appointment.php?status=active" class="filter-btn">Aktif</a>
            <a href="view_appointment.php?status=canceled" class="filter-btn">Batal</a>
        </div>

        <div class="table-container">
            <table>
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
                    if (isset($_GET['status']) && $_GET['status'] != '') {
                        $status = $_GET['status'];
                        $stmt = $conn->prepare("SELECT * FROM janji WHERE status = ? ORDER BY tanggal DESC, jam ASC");
                        $stmt->execute([$status]);
                    } else {
                        $stmt = $conn->prepare("SELECT * FROM janji ORDER BY tanggal DESC, jam ASC");
                        $stmt->execute();
                    }

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                                    <a href='edit_appointment.php?id={$row['id_janji']}' class='btn-action btn-edit'>Edit</a>
                                    <a href='delete_appointment.php?id={$row['id_janji']}' class='btn-action btn-delete' onclick=\"return confirm('Yakin ingin hapus janji ini?');\">Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13'>Tidak ada janji temu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php include '../components/admin_footer.php'; ?>
    <script src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
