<?php
$hide_home = true; // FLAG untuk sembunyikan konten home
include '../components/connect.php';
include '../components/user_header.php';


if(isset($_POST['submit'])){

   $id = unique_id();
   $nama  = htmlspecialchars(trim($_POST['nama']));
   $email = htmlspecialchars(trim($_POST['email']));
   $pass  = sha1($_POST['pass']);
   $cpass = sha1($_POST['cpass']);

   $foto = $_FILES['foto']['name'];
   $ext  = pathinfo($foto, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $tmp = $_FILES['foto']['tmp_name'];
   $path = '../uploaded_files/'.$rename;

   $check = $conn->prepare("SELECT * FROM pelanggan WHERE email = ?");
   $check->execute([$email]);

   if($check->rowCount() > 0){
      $warning_msg[] = 'Email sudah terdaftar!';
   }elseif($pass != $cpass){
      $warning_msg[] = 'Konfirmasi password tidak sama!';
   }else{
      $insert = $conn->prepare(
         "INSERT INTO pelanggan (id_pelanggan, nama, email, password, foto)
          VALUES (?,?,?,?,?)"
      );
      $insert->execute([$id, $nama, $email, $pass, $rename]);
      move_uploaded_file($tmp, $path);

      header('location: login.php');
      exit;
   }
}
?>

<section class="form-container">

   <form action="" method="post" class="register-form" enctype="multipart/form-data">
      <h3>REGISTRASI SEKARANG</h3>

      <div class="inputBox">
         <span>Nama *</span>
         <input type="text" name="nama" required placeholder="masukan nama anda">
      </div>

      <div class="inputBox">
         <span>Password *</span>
         <input type="password" name="pass" required placeholder="password">
      </div>

      <div class="inputBox">
         <span>Email *</span>
         <input type="email" name="email" required placeholder="email anda">
      </div>

      <div class="inputBox">
         <span>Konfirmasi Password *</span>
         <input type="password" name="cpass" required placeholder="konfirmasi password anda">
      </div>

      <div class="inputBox">
         <span>Profile *</span>
         <input type="file" name="foto" required>
      </div>

      <p>Sudah Memiliki Akun? <a href="login.php">Login Sekarang</a></p>

      <input type="submit" name="submit" value="Registrasi Sekarang" class="btn">
   </form>

</section>

<?php include '../components/user_footer.php'; ?>
