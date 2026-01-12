<?php
session_start();
$id_user = $_SESSION['id_pelanggan'] ?? '';
if (empty($id_user)) {
    die('User belum login');
}

// koneksi database
$conn = new PDO("mysql:host=localhost;dbname=db_beautyclinic", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ambil data janji + relasi
$stmt = $conn->prepare("
    SELECT 
        j.nama,
        COALESCE(l.nama, 'Layanan tidak tersedia') AS nama_layanan,
        COALESCE(t.nama, 'Dokter tidak tersedia') AS nama_karyawan,
        j.tanggal,
        j.jam,
        j.harga,
        j.status,
        j.status_pembayaran
    FROM janji j
    LEFT JOIN layanan l ON j.id_layanan = l.id_layanan
    LEFT JOIN team t ON j.id_karyawan = t.id_team
    WHERE j.id_user = ?
    ORDER BY j.tanggal DESC
");

$stmt->execute([$id_user]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Janji Temu</title>
    <link rel="stylesheet" href="css/user_style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #e040a8;
            text-align: center;
        }
        th {
            background: #de4dae;
        }
        .status-menunggu { color: orange; font-weight: bold; }
        .status-selesai { color: green; font-weight: bold; }
    </style>
</head>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #ffe4ec, #fff);
}

/* Judul */
h1, h2 {
    text-align: center;
    color: #e040a8;
    font-weight: 600;
    margin-bottom: 20px;
}

/* Card container */
.appointment-card {
    background: #e040a8;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(231,84,128,0.15);
    margin: 30px auto;
    width: 95%;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 15px;
    overflow: hidden;
}

/* Header */
table thead {
    background: linear-gradient(to right, #ff9ebc, #ffb6c1);
    color: white;
}

table th {
    padding: 14px;
    text-align: center;
    font-weight: 600;
}

/* Body */
table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e040a8;
}

table tbody tr:hover {
    background: #e040a8;
    transition: 0.3s;
}

/* Status badge */
.status-menunggu {
    background: #e040a8;
    color: #080808;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

/* Pembayaran */
.badge-belum {
    background: #ffcdd2;
    color: #c62828;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
}

/* Harga */
.harga {
    color: #e040a8;
    font-weight: 600;
}
</style>

<body>

<?php include 'components/user_header.php'; ?>

<section class="appointment-page">
    <h1 class="heading">Data Janji Temu</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Layanan</th>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($appointments) > 0): ?>
                <?php $no = 1; foreach($appointments as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['nama_layanan']); ?></td>
                    <td><?= htmlspecialchars($row['nama_karyawan']); ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['jam']; ?></td>
                    <td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>
                    <td class="status-<?= $row['status']; ?>">
                        <?= ucfirst($row['status']); ?>
                    </td>
                    <td><?= ucfirst($row['status_pembayaran']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Belum ada janji temu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

</body>
</html>
