<?php
session_start(); // 🔥 WAJIB PALING ATAS

include '../components/connect.php';
include '../components/user_header.php';

if (isset($_POST['login'])) {

    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $pass  = sha1($_POST['pass']);

    $select_user = $conn->prepare("SELECT * FROM pelanggan WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);

    if ($select_user->rowCount() > 0) {
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_pelanggan'] = $row['id_pelanggan']; // ✅ ini sudah benar

        header('location: ../index.php');
        exit;
    } else {
        $warning_msg[] = 'Email atau password salah';
    }
}
?>

<section class="auth-container">

   <form action="" method="post" class="auth-form">
      <h3>LOGIN SEKARANG</h3>

      <div class="inputBox">
         <span>Email *</span>
         <input type="email" name="email" required placeholder="masukkan email anda">
      </div>

      <div class="inputBox">
         <span>Password *</span>
         <input type="password" name="pass" required placeholder="masukkan password">
      </div>

      <p>Belum Memiliki Akun?
         <a href="register.php">Registrasi Sekarang</a>
      </p>

      <input type="submit" name="login" value="Login Sekarang" class="btn">
   </form>

</section>

<?php include '../components/user_footer.php'; ?>
