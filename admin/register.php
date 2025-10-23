<?php
    include '../components/connect.php';
    if (isset($_POST['register'])) {
        $id = unique_id();

        $nama = $_POST['nama'];
        $nama = htmlspecialchars(trim($nama), ENT_QUOTES, 'UTF-8');

        $email = $_POST['email'];
        $email = htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8');

        $pass = sha1($_POST['pass']);
        $pass = htmlspecialchars(trim($pass), ENT_QUOTES, 'UTF-8');

        $cpass = sha1($_POST['cpass']);
        $cpass = htmlspecialchars(trim($cpass), ENT_QUOTES, 'UTF-8');

        $foto = $_FILES['foto']['name'];
        $foto = htmlspecialchars(trim($foto), ENT_QUOTES, 'UTF-8');
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['foto']['size'];
        $image_tmp_name = $_FILES['foto']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $select_admin->execute([$email]);

        if ($select_admin->rowCount() > 0) {
           $warning_msg[] = 'email already registered';
        }else{
            if ($pass != $cpass) {
               $warning_msg[] = 'konfirmasi password anda tidak sama';
            }else {
                $insert_admin = $conn->prepare("INSERT INTO admin(id, nama, email, password, foto) VALUES(?,?,?,?,?)");
                $insert_admin->execute([$id, $nama, $email, $cpass, $rename]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'admin baru sudah registrasi! tolong login sekarang';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Mevement</title>
    <link  href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">

</head>
<body>

    <div class="form-container form">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>REGISTRASI SEKARANG</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Nama <span>*</span></p>
                        <input type="text" name="nama" placeholder="masukan nama anda" maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Email <span>*</span></p>
                        <input type="email" name="email" placeholder="masukan email anda" maxlength="50" required class="box">
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Password<span>*</span></p>
                        <input type="password" name="pass" placeholder="masukan password anda" maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="konfirmasi password anda" maxlength="50" required class="box">
                    </div>
                </div>
            </div>
            <div class="input-field">
                <p>Profile<span>*</span></p>
                <input type="file" name="foto" accept="image/*" required class="box">
            </div>
            <p class="link">Sudah Memiliki Akun <a href="login.php">Login Sekarang</a></p>
            <button type="submit" name="register" class="btn">Registrasi Sekarang</button>
        </form>
    </div>















    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>