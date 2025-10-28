<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../components/connect.php';

if (isset($conn)) {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

if (!isset($_COOKIE['admin_id'])) {
    header('location:login.php');
    exit();
}

$admin_id = $_COOKIE['admin_id'] ?? null;
$success_msg = [];
$warning_msg = [];

function addService(PDO $conn, array $data, array $files, string $status): void {
    global $success_msg, $warning_msg;

    $nama = trim((string)($data['nama'] ?? ''));
    $harga_raw = trim((string)($data['harga'] ?? ''));
    $detail_layanan = trim((string)($data['detail_layanan'] ?? ''));
    $kategori = trim((string)($data['kategori'] ?? ''));

    if ($nama === '' || $harga_raw === '' || $detail_layanan === '' || $kategori === '') {
        $warning_msg[] = 'Semua field wajib diisi.';
        return;
    }

    if (!is_numeric($harga_raw)) {
        $warning_msg[] = 'Harga harus berupa angka.';
        return;
    }

    $harga = (int)$harga_raw;

    $foto_name = $files['foto']['name'] ?? '';
    $foto_tmp = $files['foto']['tmp_name'] ?? '';
    $foto_error = $files['foto']['error'] ?? 4;

    if ($foto_error !== 0) {
        $warning_msg[] = 'Upload foto gagal. Pastikan memilih file gambar.';
        return;
    }

    $ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (!in_array($ext, $allowed, true)) {
        $warning_msg[] = 'Ekstensi file tidak didukung.';
        return;
    }

    $uploadDir = __DIR__ . '/../uploaded_files/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    if (!is_writable($uploadDir)) {
        $warning_msg[] = 'Folder upload tidak bisa ditulis. Cek permission.';
        return;
    }

    $rename = uniqid('foto_', true) . '.' . $ext;
    $target = $uploadDir . $rename;

    if (!move_uploaded_file($foto_tmp, $target)) {
        $warning_msg[] = 'Gagal memindahkan file ke folder upload.';
        return;
    }

    // Simpan ke database
    try {
        $id_layanan = uniqid('layanan_', true);
        $stmt = $conn->prepare("INSERT INTO layanan 
            (id_layanan, nama, harga, foto, detail_layanan, kategori, status)
            VALUES (:id_layanan, :nama, :harga, :foto, :detail_layanan, :kategori, :status)");
        $stmt->execute([
            ':id_layanan' => $id_layanan,
            ':nama' => $nama,
            ':harga' => $harga,
            ':foto' => $rename,
            ':detail_layanan' => $detail_layanan,
            ':kategori' => $kategori,
            ':status' => $status
        ]);

        $success_msg[] = '✅ Layanan berhasil ditambahkan!';
    } catch (PDOException $e) {
        if (file_exists($target)) @unlink($target);
        $warning_msg[] = 'Terjadi kesalahan database: ' . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service'])) {
        addService($conn, $_POST, $_FILES, 'active');
    } elseif (isset($_POST['draft'])) {
        addService($conn, $_POST, $_FILES, 'deactive');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah-Layanan</title>
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
        <h1>Tambah Layanan</h1>
    </div>
</div>

<section class="add_services">
    <div class="form-container">
        <?php
            foreach ($warning_msg as $m) echo '<p style="color:red;">'.$m.'</p>';
            foreach ($success_msg as $m) echo '<p style="color:green;">'.$m.'</p>';
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="register">
            <p>Nama Layanan <span>*</span></p>
            <input type="text" name="nama" placeholder="Nama layanan" required class="box">

            <p>Harga Layanan <span>*</span></p>
            <input type="number" name="harga" placeholder="Harga layanan" required class="box" min="0">

            <p>Detail Layanan <span>*</span></p>
            <textarea name="detail_layanan" placeholder="Detail layanan" required class="box"></textarea>

            <p>Kategori Layanan <span>*</span></p>
            <select name="kategori" class="box" required>
                <option value="" disabled selected>Pilih kategori</option>
                <option value="Perawatan Wajah">Perawatan Wajah</option>
                <option value="Perawatan Tubuh">Perawatan Tubuh</option>
            </select>

            <p>Foto Layanan <span>*</span></p>
            <input type="file" name="foto" accept="image/*" required class="box">

            <div class="flex-btn">
                <button type="submit" name="add_service" class="btn">Tambahkan Layanan</button>
                <button type="submit" name="draft" class="btn">Simpan Draft</button>
            </div>
        </form>
    </div>
</section>

<?php include '../components/admin_footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>

