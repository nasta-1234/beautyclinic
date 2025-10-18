<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
}

// tambah karyawan ke database
if (isset($_POST['add_employee'])) {
    
    $id = unique_id();

    $nama = $_POST['nama'];
    $nama = filter_var($nama, FILTER_SANITIZE_STRING);

    $jabatan = $_POST['jabatan'];
    $jabatan = filter_var($jabatan, FILTER_SANITIZE_STRING);

    $no_hp = $_POST['no_hp'];
    $no_hp = filter_var($no_hp, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $alamat = $_POST['alamat'];
    $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
    
    // upload foto karyawan
    $foto = $_FILES['foto']['name'];
    $foto = filter_var($foto, FILTER_SANITIZE_STRING);
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['foto']['size'];
    $image_tmp_name = $_FILES['foto']['tmp_name'];
    $image_folder = '../uploaded_files/'.$rename;

    $status = 'active';

    $select_image = $conn->prepare("SELECT * FROM karyawan WHERE foto = ?");
    $select_image->execute([$foto]);

    if (isset($foto)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Nama file foto sudah digunakan!';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran foto terlalu besar!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $foto = '';
    }

    if ($select_image->rowCount() > 0 && $foto != '') {
        $warning_msg[] = 'Silakan ubah nama file foto.';
    } else {
        $insert_employee = $conn->prepare("INSERT INTO karyawan (id, nama, jabatan, no_hp, email, alamat, foto, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_employee->execute([$id, $nama, $jabatan, $no_hp, $email, $alamat, $rename, $status]);
        $success_msg[] = 'Karyawan berhasil ditambahkan!';
    }
}

// simpan ke draft
if (isset($_POST['draft'])) {

    $id = unique_id();

    $nama = $_POST['nama'];
    $nama = filter_var($nama, FILTER_SANITIZE_STRING);

    $jabatan = $_POST['jabatan'];
    $jabatan = filter_var($jabatan, FILTER_SANITIZE_STRING);

    $no_hp = $_POST['no_hp'];
    $no_hp = filter_var($no_hp, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $alamat = $_POST['alamat'];
    $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
    
    $foto = $_FILES['foto']['name'];
    $foto = filter_var($foto, FILTER_SANITIZE_STRING);
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['foto']['size'];
    $image_tmp_name = $_FILES['foto']['tmp_name'];
    $image_folder = '../uploaded_files/'.$rename;

    $status = 'deactive';

    $select_image = $conn->prepare("SELECT * FROM karyawan WHERE foto = ?");
    $select_image->execute([$foto]);

    if (isset($foto)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Nama file foto sudah digunakan!';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'Ukuran foto terlalu besar!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $foto = '';
    }

    if ($select_image->rowCount() > 0 && $foto != '') {
        $warning_msg[] = 'Silakan ubah nama file foto.';
    } else {
        $insert_employee = $conn->prepare("INSERT INTO karyawan (id, nama, jabatan, no_hp, email, alamat, foto, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_employee->execute([$id, $nama, $jabatan, $no_hp, $email, $alamat, $rename, $status]);
        $success_msg[] = 'Data karyawan berhasil disimpan ke draft!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" detail_layanan="width=device-width, initial-scale=1">
    <title>Tambah Karyawan</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Tambah Karyawan</h1>
        <p>Kelola data karyawan klinik dengan mudah: <br>
            👩‍⚕️ Tambahkan data karyawan baru <br>
            🧾 Simpan informasi kontak dan jabatan <br>
            📸 Upload foto profil karyawan <br>
            ✨ Pantau status aktif atau nonaktif karyawan
        </p>
        <span><a href="dashboard.php">Admin</a><i class="bx bx-right-arrow-alt"></i>Tambah Karyawan</span>
    </div>
</div>

<section class="add_services">
    <div class="heading">
        <h1>Tambahkan Karyawan Baru</h1>
        <img src="../image/employee.png" width="100">
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="input-field">
                <p>Nama Karyawan <span>*</span></p>
                <input type="text" name="nama" placeholder="Masukkan nama karyawan" required class="box">
            </div>
            <div class="input-field">
                <p>Jabatan <span>*</span></p>
                <input type="text" name="jabatan" placeholder="Masukkan jabatan (contoh: Terapis, Kasir)" required class="box">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>
