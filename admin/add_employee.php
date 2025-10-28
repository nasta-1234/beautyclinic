<?php
include '../components/connect.php';

if (!isset($_COOKIE['admin_id'])) {
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
        header {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10000 !important;
            background: #fff;
        }

        .banner,
        .add_services {
            margin-top: 120px !important;
            position: relative;
            z-index: 1;
        }

        .sidebar {
            position: fixed !important;
            top: 0;
            left: 0;
            z-index: 9999 !important;
            background: #fff;
            height: 100%;
            overflow-y: auto;
        }

        #user-btn, #toggle-btn {
            cursor: pointer;
            z-index: 10001;
        }

        .profile_detail {
            position: absolute;
            top: 80px;
            right: 20px;
            background: #fff;
            z-index: 10002 !important;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: none;
        }

        .profile_detail.active {
            display: block;
        }

        .btn-back {
            background-color: #ff69b4;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color: #ff8ac9;
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

            <div class="flex-btn" style="margin-top: 1rem;">
                <a href="dashboard.php" class="btn-back"><i class="bx bx-arrow-back"></i> Kembali ke Dashboard</a>
            </div>
        </form>
    </div>
</section>

<?php include '../components/admin_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userBtn = document.querySelector('#user-btn');
    const profile = document.querySelector('.profile_detail');
    const toggleBtn = document.querySelector('#toggle-btn');
    const sidebar = document.querySelector('.sidebar');

    if (userBtn && profile) {
        userBtn.onclick = () => profile.classList.toggle('active');
    }

    if (toggleBtn && sidebar) {
        toggleBtn.onclick = () => sidebar.classList.toggle('active');
    }
});
</script>

<?php include '../components/alert.php'; ?>
</body>
</html>
