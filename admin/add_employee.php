<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location:login.php');
    exit();
}

$success_msg = [];
$warning_msg = [];

// Fungsi untuk tambah atau draft karyawan
function simpanKaryawan($conn, $status)
{
    global $success_msg, $warning_msg;

    $id = uniqid('emp_');
    $nama = htmlspecialchars(trim($_POST['nama']), ENT_QUOTES, 'UTF-8');
    $jabatan = htmlspecialchars(trim($_POST['jabatan']), ENT_QUOTES, 'UTF-8');
    $no_hp = htmlspecialchars(trim($_POST['no_hp']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $alamat = htmlspecialchars(trim($_POST['alamat']), ENT_QUOTES, 'UTF-8');

    // Upload foto
    $foto = $_FILES['foto']['name'] ?? '';
    $rename = '';

    if (!empty($foto)) {
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $rename = uniqid('foto_') . '.' . $ext;
        $image_size = $_FILES['foto']['size'];
        $image_tmp_name = $_FILES['foto']['tmp_name'];
        $image_folder = '../uploaded_files/' . $rename;

        if ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran foto terlalu besar! Maksimal 2MB.';
            return;
        }

        move_uploaded_file($image_tmp_name, $image_folder);
    }

    // Simpan ke database
    try {
        $stmt = $conn->prepare("INSERT INTO karyawan (id, nama, jabatan, no_hp, email, alamat, foto, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $nama, $jabatan, $no_hp, $email, $alamat, $rename, $status]);

        if ($status == 'active') {
            $success_msg[] = 'Karyawan berhasil ditambahkan!';
        } else {
            $success_msg[] = 'Data karyawan berhasil disimpan sebagai draft!';
        }
    } catch (PDOException $e) {
        $warning_msg[] = 'Terjadi kesalahan: ' . $e->getMessage();
    }
}

// Tambah karyawan aktif
if (isset($_POST['add_employee'])) {
    simpanKaryawan($conn, 'active');
}

// Simpan ke draft
if (isset($_POST['draft'])) {
    simpanKaryawan($conn, 'deactive');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" detail_layanan="width=device-width, initial-scale=1">
    <title>Tambah Karyawan - Beauty Clinic</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
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
        <h1>Tambah Karyawan</h1>
        <p>
            👩‍⚕️ Tambahkan data karyawan baru <br>
            🧾 Simpan informasi kontak dan jabatan <br>
            📸 Upload foto profil karyawan <br>
            ✨ Atur status aktif atau nonaktif
        </p>
        <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> Tambah Karyawan</span>
    </div>
</div>

<section class="add_services">
    <div class="heading">
        <h1>Formulir Tambah Karyawan</h1>
        <img src="../image/employee.png" width="100" alt="Employee Icon">
    </div>

    <div class="form-container">
        <?php
        foreach ($warning_msg as $msg) echo '<p style="color:red;">'.$msg.'</p>';
        foreach ($success_msg as $msg) echo '<p style="color:green;">'.$msg.'</p>';
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="input-field">
                <p>Nama Karyawan <span>*</span></p>
                <input type="text" name="nama" placeholder="Masukkan nama karyawan" required class="box">
            </div>

            <div class="input-field">
                <p>Jabatan <span>*</span></p>
                <input type="text" name="jabatan" placeholder="Contoh: Terapis, Kasir" required class="box">
            </div>

            <div class="input-field">
                <p>No. HP <span>*</span></p>
                <input type="text" name="no_hp" placeholder="Masukkan nomor HP" required class="box">
            </div>

            <div class="input-field">
                <p>Email <span>*</span></p>
                <input type="email" name="email" placeholder="Masukkan email" required class="box">
            </div>

            <div class="input-field">
                <p>Alamat <span>*</span></p>
                <textarea name="alamat" placeholder="Masukkan alamat lengkap" required class="box"></textarea>
            </div>

            <div class="input-field">
                <p>Foto Karyawan <span>*</span></p>
                <input type="file" name="foto" accept="image/*" required class="box">
            </div>

            <div class="flex-btn">
                <button type="submit" name="add_employee" class="btn">Tambahkan Karyawan</button>
                <button type="submit" name="draft" class="btn">Simpan ke Draft</button>
            </div>
        </form>
    </div>
</section>
<?php include '../components/admin_footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
