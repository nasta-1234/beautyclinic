<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
}

// ambil semua data karyawan
$select_employee = $conn->prepare("SELECT * FROM karyawan ORDER BY nama ASC");
$select_employee->execute();
$employees = $select_employee->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Karyawan - Admin Panel</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Data Karyawan</h1>
        <p>Kelola dan pantau semua data karyawan klinik di halaman ini: <br>
            👩‍⚕️ Lihat daftar karyawan <br>
            ✏️ Edit informasi bila ada perubahan <br>
            🗑️ Hapus data jika sudah tidak aktif <br>
            💼 Pastikan semua karyawan tercatat dengan baik
        </p>
        <span><a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Data Karyawan</span>
    </div>
</div>

<section class="show-items">
    <div class="heading">
        <h1>Daftar Karyawan</h1>
        <img src="../image/employee.png" width="100">
    </div>
