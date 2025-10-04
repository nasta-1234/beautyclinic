<?php
    include '../components/connect.php';
    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ? LIMIT 1");
        $select_admin->execute([$email, $pass]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);

        if ($select_admin->rowCount() > 0) {
            setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
        }else{
            $warning_msg[] = 'email atau password salah';
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
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>LOGIN SEKARANG</h3>
                <div class="input-field">
                    <p>Email <span>*</span></p>
                    <input type="email" name="email" placeholder="masukan email anda" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>Password<span>*</span></p>
                    <input type="password" name="pass" placeholder="masukan password anda" maxlength="50" required class="box">
                </div>
            <p class="link">Belum Memiliki Akun <a href="register.php">Registrasi Sekarang</a></p>
            <button type="submit" name="login" class="btn">Login Sekarang</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>