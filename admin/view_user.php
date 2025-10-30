<?php
include '../components/connect.php';

// cek login
if (!isset($_COOKIE['admin_id'])) {
    header('location:login.php');
    exit();
}

$admin_id = $_COOKIE['admin_id']; // ✅ tambahkan ini

// Ambil semua pelanggan
$stmt = $conn->prepare("SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pelanggan - NASTA Beauty Clinic</title>
<link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
<style>
body {
    background-color: #fff0f5;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

/* Banner / Header halaman */
.banner {
    background: linear-gradient(135deg, #ffb6c1, #ff69b4);
    color: #fff;
    padding: 25px 20px;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.banner h2 {
    margin: 0 0 5px 0;
}
.banner span {
    font-size: 0.9em;
    color: #ffe4f1;
}
.banner a {
    color: #fff;
    text-decoration: none;
    margin-right: 5px;
}

/* Kontainer tabel */
.table-container {
    max-width: 950px;
    margin: 0 auto 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
th, td {
    padding: 15px;
    border-bottom: 1px solid #d63384;
    text-align: left;
}
th {
    background-color: #ff69b4;
    color: #fff;
    font-weight: 500;
}
img.profile {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #d63384;
}
tbody tr:hover {
    background-color: #ffe6f2;
    transition: 0.2s;
}
</style>
</head>
<body>
<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <h2 style="color: #101010;">Daftar Pelanggan</h2>
    <span><a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Pelanggan</span>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($users) > 0): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_pelanggan']) ?></td>
                        <td>
                            <?php 
                                $foto_path = '/beautyclinic/uploaded_files/' . $user['foto'];
                                if (!empty($user['foto']) && file_exists($_SERVER['DOCUMENT_ROOT'].$foto_path)) {
                                    $img_src = $foto_path;
                                } else {
                                    $img_src = '/beautyclinic/images/default-user.png';
                                }
                            ?>
                            <img src="<?= htmlspecialchars($img_src) ?>" class="profile" alt="Foto Pelanggan">
                        </td>
                        <td><?= htmlspecialchars($user['nama']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada pelanggan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../components/admin_footer.php'; ?>
 <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
